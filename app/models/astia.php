<?php

class Astiat extends BaseModel{
 
  public $as_id;
  public $nimi;
  public $vari;
  public $koko;
  public $hinta;
  public $muoto;
  public $malli;
  

  public function __construct($attributes){
    parent::__construct($attributes);
  }

 public static function all(){
    $query = DB::connection()->prepare('SELECT * FROM Astiat');
    $query->execute();
    
    $rows = $query->fetchAll();
    $astia = array();
    
    foreach($rows as $row){
           $astia[] = new Astiat(array(
           'as_id' => $row['as_id'],
           'nimi' => $row['nimi'],
           'vari' => $row['vari'],
           'koko' => $row['koko'],
           'hinta' => $row['hinta'],
           'muoto' => $row['muoto'],
           'malli' => $row['malli']
                   
        ));
    }
    return $astia;
  }

  public function save(){
    
    $query = DB::connection()->prepare('INSERT INTO Astia (nimi, vari, koko, hinta, muoto, malli) VALUES (:nimi,:vari,:koko,:hinta,:muoto,:malli) RETURNING id');
    $query->execute(array('nimi' => $this->nimi, 'vari' => $this->vari, 'koko' => $this->koko,'hinta' => $this->hinta, 'muoto' => $this->muoto, 'malli' => $this->malli ));
    $row = $query->fetch();
    $this->as_id = $row['as_id'];
  }
   /*public static function find($as_id){
    $query = DB::connection()->prepare('SELECT * FROM Astiat WHERE as_id = :as_id LIMIT 1');
    $query->execute(array('as_id' => $as_id));
    $row = $query->fetch();

    if($row){
      $astia = new Astiat(array($routes->post('/astia', function(){
    AstiatController::store();
});
        'as_id' => $row['as_id'],
        'name' => $row['name']
        ));

      return $astia;
    }

    return null;
  } */

}