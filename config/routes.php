<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/kirjautuminen', function(){
  // Kirjautumislomakkeen esittäminen
  UserController::login();
});

  $routes->post('/kirjautuminen', function(){
  // Kirjautumisen käsittely
  UserController::handle_login();
 });
   
  //Astia listaus ja astian tiedot
    $routes->get('/astia', function(){
    AstiatController::listaa();
   });
   
  $routes->get('/astia/:as_id', function($as_id){
  AstiatController::show($as_id);  
  });
  
  $routes->get('/astia/:as_id/muokkaa', function($as_id){
  AstiatController::muokkaa($as_id);  
  });
  
  $routes->post('/astia', function(){
  AstiatController::store();
});
   // Astian lisäyslomakkeen näyttäminen
$routes->get('/lisays/new', function(){
  AstiatController::create();
});

 //Brandi listaus ja Brandi tiedot
    $routes->get('/brandi', function(){
    BrandiController::listaa();
   });
   
  $routes->get('/brandi/:bra_id', function($bra_id){
  BrandiController::show($bra_id);  
  });