<?php

class BrandiController extends BaseController{
    
    
  public static function listaa(){
    // Haetaan kaikki brandit tietokannasta
    $brandit = Brandi::all();
    // Render�id��n views/brandi kansiossa sijaitseva tiedosto brandit_listaus.html muuttujan $brandi datalla
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
    
     
    // n�ytt�� lomakkeen
    public static function create(){
    //    self::check_logged_in();
        View::make('lisays/newb.html');
    }
    
  public static function store(){
   
    $params = $_POST;
    
    // Alustetaan uusi Brandi-luokan olion k�ytt�j�n sy�tt�mill� arvoilla
    
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

         // Ohjataan k�ytt�j�n lis�yksen j�lkeen brandisto tietokannan esittelysivulle
        Redirect::to('/brandi/' . $brandi->bra_id, array('message' => 'Br�ndi on lis�tty astiasto tietokantaan.'));
        }
  
  }
  
  // Astian muokkaaminen (lomakkeen k�sittely)
  public static function update($bra_id){
    $params = $_POST;

    $attributes = array(
      'bra_id' => $bra_id,
      'nimi' => $params['nimi'],
      'valmistaja' => $params['valmistaja'],
      'maa' => $params['maa']
    );

    // Alustetaan Brandi-olio k�ytt�j�n sy�tt�mill� tiedoilla
    $brandi = new Brandi($attributes);
    $errors = $brandi->errors();

    if(count($errors) > 0){
      
        View::make('/brandi/muutosb.html', array('errors' => $errors, 'attributes' => $attributes));
      
    }else{
      
      $brandi->update();

      Redirect::to('/brandi/' . $brandi->bra_id, array('message' => 'Br�ndi on nyt muokattu onnistuneesti!'));
    }
  }

  // Brandin poistaminen
  
  public static function poista($bra_id){
    self::check_logged_in();
   
    $brandi = new Brandi(array('bra_id' => $bra_id));
    $brandi->destroy();

    Redirect::to('/brandi', array('message' => 'Br�ndi on  nyt poistettu onnistuneesti!'));
  }  
    
   }
