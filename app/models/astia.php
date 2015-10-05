<?php

class Astiat extends BaseModel{
 
  public $as_id;
  public $nimi;
  public $vari;
  public $koko;
  public $hinta;
  public $muoto;
  public $malli;
  public $om_id;
  public $om_id2;
  public $brandit;
  

  public function __construct($attributes){
    parent::__construct($attributes);
     $this->validators = array(
            'validate_nimi', 
            'validate_vari', 
            'validate_koko',
            'validate_hinta', 
            'validate_muoto',
            'validate_malli',
            'validate_om_id',
            'validate_om_id2'
          );
  }
  
    public function validate_nimi(){
        return parent::validate_string_length($this->nimi, 3);
    }
    
    public function validate_vari(){
        return parent::validate_string_length($this->vari, 4);
    }
    
    public function validate_koko(){
        return parent::validate_string_length($this->koko, 2);
        
    }   
    
    public function validate_hinta(){
        return parent::validate_string_length($this->hinta, 2);
    } 
    
    public function validate_muoto(){
        return parent::validate_string_length($this->muoto, 4);
    }
    
    public function validate_malli(){
        return parent::validate_string_length($this->malli, 4);
    }
    public function validate_om_id(){
        return parent::validate_string_length($this->om_id, 1);
    }
    public function validate_om_id2(){
        return parent::validate_string_length($this->om_id2, 1);
    }

 public static function all(){
    $query = DB::connection()->prepare('SELECT * FROM Astiat');
    $query->execute();
    
    $rows = $query->fetchAll();
    $astiat = array();
    
    foreach($rows as $row){
           $astiat[] = new Astiat(array(
           'as_id' => $row['as_id'],
           'nimi' => $row['nimi'],
           'vari' => $row['vari'],
           'koko' => $row['koko'],
           'hinta' => $row['hinta'],
           'muoto' => $row['muoto'],
           'malli' => $row['malli'],
           'om_id' => $row['om_id'],
           'om_id2' => $row['om_id2'],
           'brandit' => Brandi::findBrandi($row['as_id'])    
                   
        ));
    }
    return $astiat;
  }

  public function save(){
    
    $query = DB::connection()->prepare('INSERT INTO Astiat (nimi, vari, koko, hinta, muoto, malli,om_id, om_id2) VALUES (:nimi,:vari,:koko,:hinta,:muoto,:malli,:om_id,:om_id2) RETURNING as_id');
    $query->execute(array('nimi' => $this->nimi,
        'vari' => $this->vari,
        'koko' => $this->koko,
        'hinta' => $this->hinta,
        'muoto' => $this->muoto,
        'malli' => $this->malli, 
        'om_id' => $this->om_id,
        'om_id2' => $this->om_id2));
    
    $row = $query->fetch();
    $this->as_id = $row['as_id'];
  }
   public static function find($as_id){
    $query = DB::connection()->prepare('SELECT * FROM Astiat WHERE as_id = :as_id LIMIT 1');
    $query->execute(array('as_id' => $as_id));
    $row = $query->fetch();

    if($row){
      $astia = new Astiat(array(
        'as_id' => $row['as_id'],
        'nimi' => $row['nimi'],
        'vari' => $row['vari'],
        'koko' => $row['koko'],
        'hinta' => $row['hinta'],
        'muoto' => $row['muoto'],
        'malli' => $row['malli'],
        'om_id' => $row['om_id'],
        'om_id2' => $row['om_id2'],
        'brandit' => Brandi::findBrandi($as_id)  
          
        ));
       return $astia;
    }

    return null;
  } 
    public function update(){
        $query = DB::connection()->prepare('UPDATE Astiat SET nimi = :nimi, vari = :vari, koko = :koko, hinta = :hinta, muoto = :muoto, malli = :malli, om_id = :om_id, om_id2 = :om_id2 WHERE as_id = :as_id');
        $query->execute(array('as_id' => $this->as_id,
                              'nimi' => $this->nimi, 
                              'vari' => $this->vari, 
                              'koko' => $this->koko, 
                              'hinta' => $this->hinta, 
                              'muoto' => $this->muoto,
                              'malli' => $this->malli,
                              'om_id' => $this->om_id,
                              'om_id2' => $this->om_id2));
    }
        
     public function destroy() {
         
        $query = DB::connection()->prepare('DELETE from Brandi_Astiat where asbra_id = :as_id');
        $query->execute(array('as_id' => $this->as_id)); 
        
        $query = DB::connection()->prepare('DELETE FROM Astiat WHERE as_id = :as_id');
        $query->execute(array('as_id' => $this->as_id));
    }
}