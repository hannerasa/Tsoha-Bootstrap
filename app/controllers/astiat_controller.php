<?php

class AstiatController extends BaseController{
  public static function listaa(){
    // Haetaan kaikki astiat tietokannasta
    $astia = Astiat::all();
    // Render�id��n views/astia kansiossa sijaitseva tiedosto astiat_listaus.html muuttujan $astia datalla
    View::make('astia/astiat_listaus.html', array('astia' => $astia));
  }
  public static function store(){
   
    $params = $_POST;
    // Alustetaan uusi Astia-luokan olion k�ytt�j�n sy�tt�mill� arvoilla
    $astia = new Astia(array(
      'nimi' => $params['nimi'],
      'vari' => $params['vari'],
      'koko' => $params['koko'],
      'hinta' => $params['hinta'],
      'muoto' => $params['muoto'],
      'malli' => $params['malli']      
    ));

    // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
    $astia->save();

    // Ohjataan k�ytt�j� lis�yksen j�lkeen astiasto tietokannan esittelysivulle
    Redirect::to('/astia/' . $astia->id, array('message' => 'Astia on lis�tty astia tietokantaan.'));
  }
}