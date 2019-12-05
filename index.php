<?php
	session_set_cookie_params(1800); //le cookie de session dure 30 minutes

	$DS = DIRECTORY_SEPARATOR;
	require_once '.' . $DS . 'lib' . $DS . 'File.php';
	session_start();
	require_once File::build_path(array('lib', 'Session.php'));

	Session::time_reset_panier(900); // le panier dure 15 minutes avant d'être réinitialisé
	Session::check_last_activity(1800); // la session dure 30 minutes

	require_once File::build_path(array('controller', 'Router.php'));


?>
