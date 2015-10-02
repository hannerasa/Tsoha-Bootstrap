<?php

class BrandiController extends BaseController{
    
    
  public static function listaa(){
    // Haetaan kaikki brandit tietokannasta
    $brandit = Brandi::all();
    // Renderöidään views/brandi kansiossa sijaitseva tiedosto brandit_listaus.html muuttujan $brandi datalla
    View::make('brandi/brandit_listaus.html', array('brandit' => $brandit));
  }
  
  public static function show($bra_id) {
        $brandi = Brandi::find($bra_id);
        View::make('brandi/brandintiedot.html', array('brandi' => $brandi));
    }
       
   public static function muokkaa($bra_id){
      
        $brandi = Brandi::find($bra_id);
        View::make('brandi/muutosb.html', array('brandi' => $brandi));
    }
    
     
    // näyttää lomakkeen
    public static function create(){
    //    self::check_logged_in();
        View::make('lisays/newb.html');
    }
    
  public static function store(){
   
    $params = $_POST;
    
    // Alustetaan uusi Brandi-luokan olion käyttäjän syöttämillä arvoilla
    
    $attributes = (array(
      'nimi' => $params['nimi'],
      'valmistaja' => $params['valmistaja'],
      'maa' => $params['maa']
    ));

    $brandi = new Brandi($attributes);
    $errors = $brandi->errors();
    
     if(count($errors) > 0){
      
        View::make('/lisays/newb.html', array('errors' => $errors, 'attributes' => $attributes));
      
    }else{
      
    $brandi->save();

         // Ohjataan käyttäjän lisäyksen jälkeen brandisto tietokannan esittelysivulle
        Redirect::to('/brandi/' . $brandi->bra_id, array('message' => 'Brändi on lisätty astiasto tietokantaan.'));
        }
  
  }
  
  // Astian muokkaaminen (lomakkeen käsittely)
  public static function update($bra_id){
    $params = $_POST;

    $attributes = array(
      'bra_id' => $bra_id,
      'nimi' => $params['nimi'],
      'valmistaja' => $params['valmistaja'],
      'maa' => $params['maa']
    );

    // Alustetaan Brandi-olio käyttäjän syöttämillä tiedoilla
    $brandi = new Brandi($attributes);
    $errors = $brandi->errors();

    if(count($errors) > 0){
      
        View::make('/brandi/muutosb.html', array('errors' => $errors, 'attributes' => $attributes));
      
    }else{
      
      $brandi->update();

      Redirect::to('/brandi/' . $brandi->bra_id, array('message' => 'Brändi on nyt muokattu onnistuneesti!'));
    }
  }

  // Brandin poistaminen
  
  public static function poista($bra_id){
    self::check_logged_in();
   
    $brandi = new Brandi(array('bra_id' => $bra_id));
    $brandi->destroy();

    Redirect::to('/brandi', array('message' => 'Brändi on  nyt poistettu onnistuneesti!'));
  }  
    
   }
