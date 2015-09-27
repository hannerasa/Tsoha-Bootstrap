<?php


class Kayttaja extends BaseModel {
    
    public $kayt_id;
    public $nimi;
    public $password;
    public $rooli;

    public static function authenticate($nimi, $password){
        
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE nimi = :nimi and password = :password LIMIT 1');
        $query->execute (array('nimi' => $nimi, 'password' => $password));
        $row = $query->fetch();
        if ( $row ){
            
              $kayttaja = new Kayttaja(array(
                'nimi' => $row['nimi'],
                'rooli' => $row['rooli']
             ));
            
            return $kayttaja;
            
        }else{
             return null;
        }
    }

   
}