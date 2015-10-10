<?php

// Astiastotietokannan brändi-tietokohteen kontrollerit


class BrandiController extends BaseController{
    
    // Haetaan kaikki brändit tietokannasta
    
    public static function listaa(){
       $brandit = Brandi::all(); 
       View::make('brandi/brandit_listaus.html', array('brandit' => $brandit));
    }
  
    // Yksittäisen brändin tiedot
    
    public static function show($bra_id) {
        $brandi = Brandi::find($bra_id);
        View::make('brandi/brandintiedot.html', array('brandi' => $brandi));
    }
    
    // Muokkaa brändiä, vain sisäänkirjautuneena
       
    public static function muokkaa($bra_id){
        self::check_logged_in();
        $brandi = Brandi::find($bra_id);
        View::make('brandi/muutosb.html', array('brandi' => $brandi));
    }
         
    // Uuden brändin lisäys, vain sisäänkirjautuneena
    
    public static function create(){
        self::check_logged_in();
        View::make('lisays/newb.html');
    }
    
    public static function store(){
   
        $params = $_POST;
       
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
        Redirect::to('/brandi/' . $brandi->bra_id, array('message' => 'Brändi on lisätty astiasto tietokantaan.'));
        }
    }
  
    // Brändin muokkaaminen, vain sisäänkirjaututneena 
    
    public static function update($bra_id){
        $params = $_POST;

        $attributes = array(
          'bra_id' => $bra_id,
          'nimi' => $params['nimi'],
          'valmistaja' => $params['valmistaja'],
          'maa' => $params['maa']
        );

        $brandi = new Brandi($attributes);
        $errors = $brandi->errors();

        if(count($errors) > 0){
        View::make('/brandi/muutosb.html', array('errors' => $errors, 'attributes' => $attributes));
        }else{
            
        $brandi->update();
        Redirect::to('/brandi/' . $brandi->bra_id, array('message' => 'Brändi on nyt muokattu onnistuneesti!'));
      }
    }

    // Brändin poistaminen, vain sisäänkirjautuneena
  
    public static function poista($bra_id){
        self::check_logged_in();
   
        $brandi = new Brandi(array('bra_id' => $bra_id));
        $brandi->destroy();

        Redirect::to('/brandi', array('message' => 'Brändi on  nyt poistettu onnistuneesti!'));
    }  
    
}
