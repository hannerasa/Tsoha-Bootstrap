<?php

  class HelloWorldController extends BaseController{

    public static function index(){
     // make-metodi render�i app/views-kansiossa sijaitsevia tiedostoja
  	View::make('base.html');
      //  echo 'T�m� on etusivu!';

   }

    public static function sandbox(){
      // Testaa koodiasi t��ll�
      //echo 'Hello World!';
      View::make('helloworld.html'); 

    }
  }
