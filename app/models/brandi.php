<?php

class Brandi extends BaseModel{
 
  public $bra_id;
  public $nimi;
  public $valmistaja;
  public $maa;
  
  

  public function __construct($attributes){
    parent::__construct($attributes);
  }

 public static function all(){
    $query = DB::connection()->prepare('SELECT * FROM Brandi');
    $query->execute();
    
    $rows = $query->fetchAll();
    $brandi = array();
    
    foreach($rows as $row){
           $brandi[] = new Brandi(array(
           'bra_id' => $row['bra_id'],
           'nimi' => $row['nimi'],
           'valmistaja' => $row['valmistaja'],
           'maa' => $row['maa']
                             
        ));
    }
    return $brandi;
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

}