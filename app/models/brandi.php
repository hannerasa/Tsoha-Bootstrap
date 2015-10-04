<?php

class Brandi extends BaseModel{
 
  public $bra_id;
  public $nimi;
  public $valmistaja;
  public $maa;
  
  public function __construct($attributes){
    parent::__construct($attributes);
     $this->validators = array(
            'validate_nimi', 
            'validate_valmistaja', 
            'validate_maa'
          );
  }
  
    public function validate_nimi(){
        return parent::validate_string_length($this->nimi, 3);
    }
    
    public function validate_valmistaja(){
        return parent::validate_string_length($this->valmistaja, 4);
    }
    
    public function validate_maa(){
        return parent::validate_string_length($this->maa, 3);
        
    }   

 public static function all(){
    $query = DB::connection()->prepare('SELECT * FROM Brandi');
    $query->execute();
    
    $rows = $query->fetchAll();
    $brandit = array();
    
    foreach($rows as $row){
           $brandit[] = new Brandi(array(
           'bra_id' => $row['bra_id'],
           'nimi' => $row['nimi'],
           'valmistaja' => $row['valmistaja'],
           'maa' => $row['maa']
                             
        ));
    }
    return $brandit;
  }

  public function save(){
    
    $query = DB::connection()->prepare('INSERT INTO Brandi (nimi, valmistaja, maa) VALUES (:nimi,:valmistaja,:maa) RETURNING bra_id');
    $query->execute(array('nimi' => $this->nimi,
        'valmistaja' => $this->valmistaja,
        'maa' => $this->maa));
    
    $row = $query->fetch();
    $this->bra_id = $row['bra_id'];
  }
  
    public static function find($bra_id){
    $query = DB::connection()->prepare('SELECT * FROM Brandi WHERE bra_id = :bra_id LIMIT 1');
    $query->execute(array('bra_id' => $bra_id));
    $row = $query->fetch();

    if($row){
      $brandi = new Brandi(array(
        'bra_id' => $row['bra_id'],
        'nimi' => $row['nimi'],
        'valmistaja' => $row['valmistaja'],
        'maa' => $row['maa']
        ));
       return $brandi;
    }
    return null;
  } 
  
   public function update(){
        $query = DB::connection()->prepare('UPDATE Brandi SET nimi = :nimi, valmistaja = :valmistaja, maa = :maa WHERE bra_id = :bra_id');
        $query->execute(array('bra_id' => $this->bra_id, 
                              'nimi' => $this->nimi,
                              'valmistaja' => $this->valmistaja, 
                              'maa' => $this->maa ));
    }
     
     public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Brandi WHERE bra_id = :bra_id');
        $query->execute(array('bra_id' => $this->bra_id));
    }
    
     public static function findBrandi($as_id) {
        $query = DB::connection()->prepare('SELECT * FROM Brandi '
                . 'JOIN Brandi_Astiat ON Brandi.bra_id = Brandi_Astiat.braas_id '
                . 'WHERE Brandi_Astiat.asbra_id = :as_id');
        $query->execute(array('as_id' => $as_id));
        $rows = $query->fetchAll();
        $brandit = array();
        foreach ($rows as $row) {
            $brandit[] = new Brandi(array(
                'bra_id' => $row['bra_id'],
                'nimi' => $row['nimi']
            ));
        }
        return $brandit;
    }

}