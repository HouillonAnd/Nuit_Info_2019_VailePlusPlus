<?php

class Conf {

    static private $databases = array (
        'hostname' => '51.83.251.45',
        // le nom de la base de donnée
        'database' => 'vaileplusplus',
        // root
        'login' => 'admin',
        // mdp créer à l'installation, certainement un root
        'password' => 'vaileplusplus'
        // a remplir
    );

    static private $debug = True;

    static public function getDebug() {
        return self::$debug;
    }

    static public function getLogin() {
        return self::$databases['login'];
      }

    static public function getDatabase() {
        return self::$databases['database'];
    }

    static public function getHostname() {
        return self::$databases['hostname'];
    }

    static public function getPassword() {
        return self::$databases['password'];
    }

}

?>
