<?php

session_start();

require_once './bootstrap.php';

spl_autoload_register('autoload');

function autoload($class_name) {
    
    $array_paths = array(
        'database/',
        'app/classes/',
        'models/',
        'controllers/'
    );
// bdlna (/) -> (\)
    //  c:\xamp\htdocs\gestion-employer\ app \classes \Redirect
    $parts = explode('\\',$class_name); //(array)tatjib nom de class (chemain)
    $name = array_pop($parts); // supprimer dernier element wstoker dans $name ('nom fichier.php')

    foreach($array_paths as $path){
        $file = sprintf($path . '%s.php',$name);  // $path-> app\classes  ---$name -> Redirect // app\classes\Redirect.php
        if(is_file($file)){  // wach file exist
            include_once $file;
        }
        
    }
}