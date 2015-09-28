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
    $astiat = array();
    
    foreach($rows as $row){
           $astiat[] = new Astiat(array(
           'as_id' => $row['as_id'],
           'nimi' => $row['nimi'],
           'vari' => $row['vari'],
           'koko' => $row['koko'],
           'hinta' => $row['hinta'],
           'muoto' => $row['muoto'],
           'malli' => $row['malli']
                   
        ));
    }
    return $astiat;
  }

  public function save(){
    
    $query = DB::connection()->prepare('INSERT INTO Astiat (nimi, vari, koko, hinta, muoto, malli) VALUES (:nimi,:vari,:koko,:hinta,:muoto,:malli) RETURNING as_id');
    $query->execute(array('nimi' => $this->nimi,
        'vari' => $this->vari,
        'koko' => $this->koko,
        'hinta' => $this->hinta,
        'muoto' => $this->muoto,
        'malli' => $this->malli ));
    
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
        'malli' => $row['malli']
        ));
       return $astia;
    }

    return null;
  } 
 public function update(){
        $query = DB::connection()->prepare('UPDATE Astiat '
                . 'SET nimi = :nimi, vari = :vari, koko = :koko, hinta = :hinta, muoto = :muoto, malli = :malli '
                . 'WHERE as_id = :as_id');
        $query->execute(array('nimi' => $this->nimi, 
                              'vari' => $this->vari, 
                              'koko' => $this->koko, 
                              'hinta' => $this->hinta, 
                              'muoto' => $this->muoto,
                              'malli' => $this->malli, 
                              'as_id' => $this->as_id));
    }
}