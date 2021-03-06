<?php

// Base -ohjaus
  $routes->get('/', function() {
    HelloWorldController::index();
  });

// Hiekkalaatikko -ohjaus
  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  
// Kirjautumis -ohjaukset
  
// Kirjautumislomakkeen esitt�minen  
   $routes->get('/kirjautuminen', function(){
    UserController::login();
   });

// Kirjautumisen k�sittely
   $routes->post('/kirjautuminen', function(){
   UserController::handle_login();
   });
  
// Uloskirjautuminen  
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
   
   // Omistaja ohjaukset 
   
   // Alla olevia ei k�ytet�

   $routes->get('/omistaja', function(){
   OmistajaController::listaa();
   });
   
   $routes->get('/omistaja/:om_id', function($om_id){
   OmistajaController::show($om_id);  
   });
 
   $routes->get('/omistaja/:om_id', function($om_id){
   OmistajaController::show($om_id);  
   });
  
   $routes->get('/omistaja/:om_id/muokkaa', function($om_id){
   OmistajaController::muokkaa($om_id);  
   });
  
   $routes->post('/omistaja/:om_id/muokkaa', function($om_id){
   OmistajaController::update($om_id);
   });
  
   $routes->post('/omistaja/:om_id/poista', function($om_id){
   OmistajaController::poista($om_id); 
   });
  
   $routes->post('/omistaja', function(){
   OmistajaController::store();
   });
 
   $routes->get('/lisays/newb', function(){
   OmistajaController::create();
   });