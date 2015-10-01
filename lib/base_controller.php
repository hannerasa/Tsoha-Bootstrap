<?php

  class BaseController{

    public static function get_user_logged_in(){
    
         if (isset($_SESSION['kayttaja'])){
          $kayt_id = $_SESSION['kayttaja'];
          
          $kayttaja = Kayttaja::etsi($kayt_id);
          
          return $kayttaja;
      }
      else
      {
          return null;
       }
       
    }  

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
    }

  }
