<?php

class AstiatController extends BaseController{
    
    
  public static function listaa(){
    // Haetaan kaikki astiat tietokannasta
    $astiat = Astiat::all();
    // Render�id��n views/astia kansiossa sijaitseva tiedosto astiat_listaus.html muuttujan $astia datalla
    View::make('astia/astiat_listaus.html', array('astiat' => $astiat));
  }
  
  public static function show($as_id) {
        $astia = Astiat::find($as_id);
        View::make('astia/astiantiedot.html', array('astia' => $astia));
    }
    
    public static function muokkaa($as_id){
      
        $astia = Astiat::find($as_id);
        View::make('astia/muutos.html', array('astia' => $astia));
    }
    
     
    // n�ytt�� lomakkeen
    public static function create(){
    //    self::check_logged_in();
        View::make('lisays/new.html');
    }
    
  public static function store(){
   
    $params = $_POST;
    
    // Alustetaan uusi Astia-luokan olion k�ytt�j�n sy�tt�mill� arvoilla
    
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

         // Ohjataan k�ytt�j�n lis�yksen j�lkeen astiasto tietokannan esittelysivulle
        Redirect::to('/astia/' . $astia->as_id, array('message' => 'Astia on lis�tty astiasto tietokantaan.'));
        }
  
  }
  
  // Astian muokkaaminen (lomakkeen k�sittely)
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

    // Alustetaan Astia-olio k�ytt�j�n sy�tt�mill� tiedoilla
    $astia = new Astiat($attributes);
    $errors = $astia->errors();

    if(count($errors) > 0){
      
        View::make('/astia/muutos.html', array('errors' => $errors, 'attributes' => $attributes));
      
    }else{
      
      $astia->update();

      Redirect::to('/astia/' . $astia->as_id, array('message' => 'Astiaa on nyt muokattu onnistuneesti!'));
    }
  }

  // Astian poistaminen
  public static function poista($as_id){
    // Alustetaan Astiat-olio annetulla as_id:ll�
    $astia = new Astiat(array('as_id' => $as_id));
    // Kutsutaan Astia-malliluokan metodia destroy, joka poistaa astian sen as_id:ll�
    $astia->destroy();

    // Ohjataan k�ytt�j�n astioiden  listaussivulle ilmoituksen kera
    Redirect::to('/astia', array('message' => 'Astia on  nyt poistettu onnistuneesti!'));
  }
}
