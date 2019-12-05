<?php
class Session {
    public static function is_user($mail) {
        return (!empty($_SESSION['userMail']) && ($_SESSION['userMail'] == $mail));
    }

    public static function is_admin() {
        return (!empty($_SESSION['isAdmin']) && $_SESSION['isAdmin']);
    }

    public static function is_loggedin() {
        return !empty($_SESSION['userMail']);
    }

    public static function time_reset_panier($time){
    	if(isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $time)){
    		unset($_SESSION['cart']);
    	}
    }

    public static function check_last_activity($time){
    	if(isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > $time)){
    		session_unset();
    		session_destroy();
    	}else{
    		$_SESSION['LAST_ACTIVITY'] = time();
    	}
    }
}
?>