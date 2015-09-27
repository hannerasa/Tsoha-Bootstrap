<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
<<<<<<< HEAD
  
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
=======
    
    $routes->get('/astia', function(){
  AstiatController::listaa();
   });
   
  $routes->post('/astia', function(){
  AstiatController::store();
});
   // Astian lisÃ¤yslomakkeen nÃ¤yttÃ¤minen
$routes->get('/lisays/new', function(){
  AstiatController::create();
});
>>>>>>> 202ab7fea7f72036be92aa73ab0191d271bfe9d8
