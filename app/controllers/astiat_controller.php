<?php

// Astiastotietokannan astia-tietokohteen kontrollerit

class AstiatController extends BaseController{
    
    // Haetaan kaikki astiat tietokannasta
    
    public static function listaa(){
        $astiat = Astiat::all();
        View::make('astia/astiat_listaus.html', array('astiat' => $astiat));
    }
  
    // Yksittäisen astian tiedot
    
    public static function show($as_id) {
        $astia = Astiat::find($as_id);
        View::make('astia/astiantiedot.html', array('astia' => $astia));
    }
    
    public static function muokkaa($as_id){
        self::check_logged_in();
        $astia = Astiat::find($as_id);
        View::make('astia/muutos.html', array('astia' => $astia));
    }
    
    // Uuden astian lisäys, vain sisäänkirjautuneena
    
    public static function create(){
        self::check_logged_in();
        View::make('lisays/new.html');
    }
    
    public static function store(){
   
        $params = $_POST;
        
        $attributes = (array(
          'nimi' => $params['nimi'],
          'vari' => $params['vari'],
          'koko' => $params['koko'],
          'hinta' => $params['hinta'],
          'muoto' => $params['muoto'],
          'malli' => $params['malli'],
          'om_id' => $params['om_id'],
          'om_id2' => $params['om_id2']    
        ));

        $astia = new Astiat($attributes);
        $errors = $astia->errors();
    
        if(count($errors) > 0){
        View::make('/lisays/new.html', array('errors' => $errors, 'attributes' => $attributes));
      
        }else{
      
        $astia->save();
        Redirect::to('/astia/' . $astia->as_id, array('message' => 'Astia on lisätty astiasto tietokantaan.'));
        }
    }
  
    // Astian muokkaaminen, vain sisäänkirjaututneena 
    
    public static function update($as_id){
        
        $params = $_POST;

        $attributes = array(
          'as_id' => $as_id,
          'nimi' => $params['nimi'],
          'vari' => $params['vari'],
          'koko' => $params['koko'],  
          'hinta' => $params['hinta'],
          'muoto' => $params['muoto'],
          'malli' => $params['malli'],
          'om_id' => $params['om_id'],
          'om_id2' => $params['om_id2'] 
        );

        $astia = new Astiat($attributes);
        $errors = $astia->errors();

        if(count($errors) > 0){ 
        View::make('/astia/muutos.html', array('errors' => $errors, 'attributes' => $attributes));
      
        }else{
        $astia->update();
        Redirect::to('/astia/' . $astia->as_id, array('message' => 'Astiaa on nyt muokattu onnistuneesti!'));
        }
    }

    // Astian poistaminen, vain sisäänkirjautuneena
    
    public static function poista($as_id){
        self::check_logged_in();
    
        $astia = new Astiat(array('as_id' => $as_id));
        $astia->destroy();

       Redirect::to('/astia', array('message' => 'Astia on  nyt poistettu onnistuneesti!'));
    }
}
