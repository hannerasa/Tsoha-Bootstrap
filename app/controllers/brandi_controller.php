<?php

class BrandiController extends BaseController{
    
    
  public static function listaa(){
    // Haetaan kaikki brandit tietokannasta
    $brandit = Brandi::all();
    // Renderöidään views/brandi kansiossa sijaitseva tiedosto brandit_listaus.html muuttujan $brandi datalla
    View::make('brandi/brandit_listaus.html', array('brandit' => $brandit));
  }
  
  public static function show($bra_id) {
        $brandit = Brandi::find($bra_id);
        View::make('brandi/brandintiedot.html', array('brandit' => $brandit));
    }
       
   }
