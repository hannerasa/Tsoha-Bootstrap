<?php

class UserController extends BaseController{
    
    public static function logout(){
    $_SESSION['kayttaja'] = null;
    Redirect::to('/', array('message' => 'Olet kirjautunut ulos!'));
  }
    
  public static function login(){
      View::make('kirjautuminen/kirjautuminen.html');
  }
  
  public static function handle_login(){
    $params = $_POST;

    $kayttaja = Kayttaja::authenticate($params['nimi'], $params['password']);

    if(!$kayttaja){
      View::make('kirjautuminen/kirjautuminen.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'nimi' => $params['nimi']));
    }else{
      $_SESSION['kayttaja'] = $kayttaja->kayt_id;

      Redirect::to('/', array('message' => 'Tervetuloa Astiastotietokantaan ' . $kayttaja->nimi . '!'));
    }
  }
  
  }