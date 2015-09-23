<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
    
    $routes->get('/astia', function(){
  AstiatController::listaa();
   });
   
  $routes->post('/astia', function(){
  AstiatController::store();
});
   // Astian lisäyslomakkeen näyttäminen
$routes->get('/lisays/new', function(){
  AstiatController::create();
});
