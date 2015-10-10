<?php

// Astiastotietokannan käyttäjä-tietokohteen mallit

class Kayttaja extends BaseModel {
    
    public $kayt_id;
    public $nimi;
    public $password;
    public $rooli;

    // Autentikoi käyttäjän
    
    public static function authenticate($nimi, $password){
        
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE nimi = :nimi and password = :password LIMIT 1');
        $query->execute (array('nimi' => $nimi, 'password' => $password));
        $row = $query->fetch();
        if ( $row ){
            
              $kayttaja = new Kayttaja(array('kayt_id' => $row ['kayt_id'],
                'nimi' => $row['nimi'],
                'rooli' => $row['rooli']
            ));
            
            return $kayttaja;
            
        }else{
             return null;
        }
    }
    
    // Etsii käyttäjän
    
    public static function etsi($kayt_id){
        $query = DB::connection()->prepare('SELECT * from Kayttaja where kayt_id = :kayt_id LIMIT 1');
        $query->execute(array('kayt_id' => $kayt_id));
        $row = $query->fetch();
        if ( $row ){
            $kayttaja = new Kayttaja(array('kayt_id' =>  $row['kayt_id'], 
                                            'nimi' => $row['nimi'],
                                            'rooli' => $row['rooli']
            ));
            
            return $kayttaja;
        }else{
            return null;
        }
    }  
}