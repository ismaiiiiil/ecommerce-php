<?php

class Session{
    static public function set($type, $message) {
        setcookie($type, $message, time() + 5, "/");
        /*
        time() lw9t daba
        5 seconde wtimchi
        "/" takhdm fprojet kaml
        */ 
    }
}




?>