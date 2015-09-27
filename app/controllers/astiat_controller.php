<?php

class AstiatController extends BaseController{
    
    
  public static function listaa(){
    // Haetaan kaikki astiat tietokannasta
    $astiat = Astiat::all();
    // Render�id��n views/astia kansiossa sijaitseva tiedosto astiat_listaus.html muuttujan $astia datalla
    View::make('astia/astiat_listaus.html', array('astiat' => $astiat));
  }
  
  public static function show($as_id) {
        $astiat = Astiat::find($as_id);
        View::make('astia/astiantiedot.html', array('astiat' => $astiat));
    }
    
    public static function muokkaa($as_id){
      
        $astiat = Astiat::find($as_id);
        View::make('astia/muutos.html', array('astiat' => $astiat));
    }
    
     
    // n�ytt�� lomakkeen
    public static function create(){
    //    self::check_logged_in();
        View::make('lisays/new.html');
    }
    
  public static function store(){
   
    $params = $_POST;
    
    // Alustetaan uusi Astia-luokan olion k�ytt�j�n sy�tt�mill� arvoilla
    
    $astiat = new Astiat(array(
      'nimi' => $params['nimi'],
      'vari' => $params['vari'],
      'koko' => $params['koko'],
      'hinta' => $params['hinta'],
      'muoto' => $params['muoto'],
      'malli' => $params['malli']      
    ));

    // Kutsutaan  olion save metodia.
    $astiat->save();

    // Ohjataan k�ytt�j� lis�yksen j�lkeen astiasto tietokannan esittelysivulle
    Redirect::to('/astia/' . $astiat->as_id, array('message' => 'Astia on lis�tty astiasto tietokantaan.'));
  }
  

  // Astian muokkaaminen (lomakkeen k�sittely)
  public static function update($as_id){
    $params = $_POST;

    $attributes = array(
      'as_id' => $as_id,
      'nimi' => $params['nimi'],
      'vari' => $params['vari'],
      'hinta' => $params['hinta'],
      'muoto' => $params['muoto'],
      'malli' => $params['malli']
    );

    // Alustetaan Astia-olio k�ytt�j�n sy�tt�mill� tiedoilla
    $astiat = new Astiat($attributes);
    $errors = $astiat->errors();

    if(count($errors) > 0){
      View::make('astia/edit.html', array('errors' => $errors, 'attributes' => $attributes));
    }else{
      // Kutsutaan alustetun olion update-metodia, joka p�ivitt�� astian tiedot tietokannassa
      $astiat->update();

      Redirect::to('/astia/' . $astiat->id, array('message' => 'Astiaa on nyt muokattu onnistuneesti!'));
    }
  }

  // Astian poistaminen
  public static function poista($as_id){
    // Alustetaan Astiat-olio annetulla id:ll�
    $astiat = new Astiat(array('as_id' => $as_id));
    // Kutsutaan Astia-malliluokan metodia destroy, joka poistaa pelin sen id:ll�
    $astiat->destroy();

    // Ohjataan k�ytt�j� astioiden  listaussivulle ilmoituksen kera
    Redirect::to('/astia', array('message' => 'Astia on  nyt poistettu onnistuneesti!'));
  }
}
