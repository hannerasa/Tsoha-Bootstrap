 <?php

// Astiastotietokannan omistaja-tietokohteen mallit

class Omistaja extends BaseModel{
 
    public $om_id;
    public $nimi;
    
     public static function findOmistaja($as_id) {
        $query = DB::connection()->prepare('SELECT * FROM Omistaja '
                . 'JOIN Omistaja_Astiat ON Omistaja.om_id = Omistaja_Astiat.omas_id '
                . 'WHERE Omistaja_Astiat.asom_id = :as_id');
        $query->execute(array('as_id' => $as_id));
        $rows = $query->fetchAll();
        $omistajat = array();
        
        foreach ($rows as $row) {
            $omistajat[] = new Omistaja(array(
                'om_id' => $row['om_id'],
                'nimi' => $row['nimi']
            ));
        }
        return $omistajat;
    }
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Omistaja');
        $query->execute();
    
        $rows = $query->fetchAll();
        $omistajat = array();
    
        foreach($rows as $row){
               $omistajat[] = new Omistaja(array(
               'om_id' => $row['om_id'],
               'nimi' => $row['nimi']          
            ));
        }
        return $omistajat;
    }
    // Etsii omistajan
   
    public static function find($om_id){
        $query = DB::connection()->prepare('SELECT * FROM Omistaja WHERE om_id = :om_id LIMIT 1');
        $query->execute(array('om_id' => $om_id));
        $row = $query->fetch();

        if($row){
            $omistaja = new Omistaja(array(
             'om_id' => $row['om_id'],
             'nimi' => $row['nimi']
            ));
        return $omistaja;
        }
        return null;
    } 
}