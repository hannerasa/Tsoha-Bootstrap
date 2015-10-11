<?php

// Astiastotietokannan astia-tietokohteen mallit

class Astiat extends BaseModel{
 
   public $as_id;
   public $nimi;
   public $vari;
   public $koko;
   public $hinta;
   public $muoto;
   public $malli;
   public $omistajat = array();
   public $brandit = array();
  

    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array(
            'validate_nimi', 
            'validate_vari', 
            'validate_koko',
            'validate_hinta', 
            'validate_muoto',
            'validate_malli'
        );
    }
  
    // Syötettyjen kenttien tarkastus
    
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
  
    // Hakee kaikki astiat taulusta
    
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
               'omistajat' => Omistaja::findOmistaja($row['as_id']),
               'brandit' => Brandi::findBrandi($row['as_id'])              
            ));
        }
        return $astiat;
    }

    // Tallentaa astian tiedot Astiat-tauluun
    
    public function save(){
   
        $query = DB::connection()->prepare('INSERT INTO Astiat (nimi, vari, koko, hinta, muoto, malli) VALUES (:nimi,:vari,:koko,:hinta,:muoto,:malli) RETURNING as_id');
        $query->execute(array('nimi' => $this->nimi,
            'vari' => $this->vari,
            'koko' => $this->koko,
            'hinta' => $this->hinta,
            'muoto' => $this->muoto,
            'malli' => $this->malli      
            ));
        
        $row = $query->fetch();
        $this->as_id = $row['as_id'];
        
        foreach ($this->brandit as $brandi){
        $this->saveAstianBrandi($brandi, $row['as_id']);
        }
        
        foreach ($this->omistajat as $omistaja){
        $this->saveAstianOmistaja($omistaja, $row['as_id']);
        
        }
    
    }
    // Tallentaa astian brandi -tiedon Brandi_Astiat tauluun
    
    public function saveAstianBrandi($brandi, $as_id) {        
           
        $query = DB::connection()->prepare ('INSERT INTO Brandi_Astiat (asbra_id, braas_id) VALUES (:asbra_id, :braas_id)');
        $query->execute(array(
            'asbra_id' => $as_id,
            'braas_id' => $brandi
            ));                
    }  
      
    // Tallentaa astian omistaja -tiedon Omistaja_Astiat tauluun
    
    public function saveAstianOmistaja($omistaja, $as_id) {        
           
        $query = DB::connection()->prepare ('INSERT INTO Omistaja_Astiat (asom_id, omas_id) VALUES (:asom_id, :omas_id)');
        $query->execute(array(
            'asom_id' => $as_id,
            'omas_id' => $omistaja
            ));                
    }  
    
    // Etsii astian
    
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
            'omistajat' => Omistaja::findOmistaja($as_id),    
            'brandit' => Brandi::findBrandi($as_id)  
          
        ));
        return $astia;
        }
        return null;
    } 
    
    // Astian ja astian brädin + omistajan muutos
    
    public function update(){
 
        $query = DB::connection()->prepare('UPDATE Astiat SET nimi = :nimi, vari = :vari, koko = :koko, hinta = :hinta, muoto = :muoto, malli = :malli WHERE as_id = :as_id');
        $query->execute(array('as_id' => $this->as_id,
                              'nimi' => $this->nimi, 
                              'vari' => $this->vari, 
                              'koko' => $this->koko, 
                              'hinta' => $this->hinta, 
                              'muoto' => $this->muoto,
                              'malli' => $this->malli)) ;
               
        $row = $query->fetch();
        
        $query = DB::connection()->prepare('DELETE FROM Brandi_Astiat where asbra_id = :as_id');
        $query->execute(array('as_id' => $this->as_id));
        $row = $query->fetch();
        
        foreach ($this->brandit as $brandi){
            $this->saveAstianBrandi($brandi, $this->as_id);
        }
        $query = DB::connection()->prepare('DELETE FROM Omistaja_Astiat where asom_id = :as_id');
        $query->execute(array('as_id' => $this->as_id));
        $row = $query->fetch();
        
        foreach ($this->omistajat as $omistaja){
            $this->saveAstianOmistaja($omistaja, $this->as_id);
        }     
    }
        
    // Astiat poisto + yhteydet brändi ja omistaja poisto
    
    public function destroy() {
         
        $query = DB::connection()->prepare('DELETE from Brandi_Astiat where asbra_id = :as_id');
        $query->execute(array('as_id' => $this->as_id)); 
        
        $query = DB::connection()->prepare('DELETE from Omistaja_Astiat where asom_id = :as_id');
        $query->execute(array('as_id' => $this->as_id));
        
        $query = DB::connection()->prepare('DELETE FROM Astiat WHERE as_id = :as_id');
        $query->execute(array('as_id' => $this->as_id));
    }
}