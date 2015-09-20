<?php


  class HelloWorld extends BaseModel{

    public static function say_hi(){
      return 'Hello World!';
    }

public static function sandbox(){
    $skyrim = Astiat::find(1);
    $astia = Astiat::all();
    // Kint-luokan dump-metodi tulostaa muuttujan arvon
    Kint::dump($astia);
    Kint::dump($skyrim);
  }
  }
