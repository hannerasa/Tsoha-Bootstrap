<?php

// Base -ohjaus
  $routes->get('/', function() {
    HelloWorldController::index();
  });

  // Hiekkalaatikko -ohjaus
  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  
  // kirjautumis -ohjaukset
   $routes->get('/kirjautuminen', function(){
  // Kirjautumislomakkeen esittäminen
    UserController::login();
   });

  $routes->post('/kirjautuminen', function(){
  // Kirjautumisen käsittely
  UserController::handle_login();
  });
  
  $routes->post('/logout', function(){
  UserController::logout();
});
   
 
 // Astiat -ohjaukset
 
 
   $routes->get('/astia', function(){
   AstiatController::listaa();
   });
   
   $routes->get('/astia/:as_id', function($as_id){
   AstiatController::show($as_id);  
   });
  
   $routes->get('/astia/:as_id/muokkaa', function($as_id){
   AstiatController::muokkaa($as_id);  
   });
  
   $routes->post('/astia/:as_id/muokkaa', function($as_id){
   AstiatController::update($as_id);
   });
  
   $routes->post('/astia/:as_id/poista', function($as_id){
   AstiatController::poista($as_id); 
   });
  
   $routes->post('/astia', function(){
   AstiatController::store();
   });
 
   $routes->get('/lisays/new', function(){
   AstiatController::create();
   });

// Brandi ohjaukset 

 
   $routes->get('/brandi', function(){
   BrandiController::listaa();
   });
   
  $routes->get('/brandi/:bra_id', function($bra_id){
  BrandiController::show($bra_id);  
  });
 
  $routes->get('/brandi/:bra_id', function($bra_id){
   BrandiController::show($bra_id);  
   });
  
   $routes->get('/brandi/:bra_id/muokkaa', function($bra_id){
   BrandiController::muokkaa($bra_id);  
   });
  
   $routes->post('/brandi/:bra_id/muokkaa', function($bra_id){
   BrandiController::update($bra_id);
   });
  
   $routes->post('/brandi/:bra_id/poista', function($bra_id){
   BrandiController::poista($bra_id); 
   });
  
   $routes->post('/brandi', function(){
   BrandiController::store();
   });
 
   $routes->get('/lisays/newb', function(){
   BrandiController::create();
   });