<?php

// Astiastotietokannan br�ndi-tietokohteen kontrollerit


class BrandiController extends BaseController{
    
    // Haetaan kaikki br�ndit tietokannasta
    
    public static function listaa(){
       $brandit = Brandi::all(); 
       View::make('brandi/brandit_listaus.html', array('brandit' => $brandit));
    }
  
    // Yksitt�isen br�ndin tiedot
    
    public static function show($bra_id) {
        $brandi = Brandi::find($bra_id);
        View::make('brandi/brandintiedot.html', array('brandi' => $brandi));
    }
    
    // Muokkaa br�ndi�, vain sis��nkirjautuneena
       
    public static function muokkaa($bra_id){
        self::check_logged_in();
        $brandi = Brandi::find($bra_id);
        View::make('brandi/muutosb.html', array('brandi' => $brandi));
    }
         
    // Uuden br�ndin lis�ys, vain sis��nkirjautuneena
    
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
        Redirect::to('/brandi/' . $brandi->bra_id, array('message' => 'Br�ndi on lis�tty astiasto tietokantaan.'));
        }
    }
  
    // Br�ndin muokkaaminen, vain sis��nkirjaututneena 
    
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
        Redirect::to('/brandi/' . $brandi->bra_id, array('message' => 'Br�ndi on nyt muokattu onnistuneesti!'));
      }
    }

    // Br�ndin poistaminen, vain sis��nkirjautuneena
  
    public static function poista($bra_id){
        self::check_logged_in();
   
        $brandi = new Brandi(array('bra_id' => $bra_id));
        $brandi->destroy();

        Redirect::to('/brandi', array('message' => 'Br�ndi on  nyt poistettu onnistuneesti!'));
    }  
    
}
