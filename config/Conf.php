<?php
  class Conf {

  static private $databases = array(
	//UIT server
    'hostname' => '51.83.251.45',

    'database' => 'vaileplusplus',

    'login' => 'admin',

    //(=PHPMyAdmin pwd, INE by defaut)
    'password' => 'vaileplusplus'
  );

  static private $debug = false;

  static public function getLogin() {
    return self::$databases['login'];
  }

  static public function getHostname() {
    return self::$databases['hostname'];
  }

  static public function getDatabase() {
    return self::$databases['database'];
  }

  static public function getPassword() {
    return self::$databases['password'];
  }

  static public function getDebug() {
  	return self::$debug;
  }
}
?>
