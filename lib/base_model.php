<?php

  class BaseModel{
    // "protected"-attribuutti on k‰ytˆss‰ vain luokan ja sen perivien luokkien sis‰ll‰
    protected $validators;

    public function __construct($attributes = null){
      // K‰yd‰‰n assosiaatiolistan avaimet l‰pi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lis‰t‰‰n avaimen nimiseen attribuuttin siihen liittyv‰ arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      // Lis‰t‰‰n $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
        // Kutsu validointimetodia t‰ss‰ ja lis‰‰ sen palauttamat virheet errors-taulukkoon
      
        $errors = array_merge($errors, $this->{$validator}());
      }

      return $errors;
    }
    
    public function validate_string_length($string, $length){
        
        $errors = array();
        if($string== '' || $string == null){
            $errors[] = $string . ' kentt‰ ei saa olla tyhj‰! Pituuden oltava v‰hint‰‰n ' . $length . ' merkki‰.';
        } else
        
        
        if(strlen($string) < $length){
            $errors[] = $string .' on liian lyhyt! Pituuden oltava v‰hint‰‰n ' . $length . ' merkki‰.';
        }
        return $errors;
    }
    

  }
