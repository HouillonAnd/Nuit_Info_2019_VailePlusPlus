<?php

    require_once (File::build_path(array('model', 'ModelUser.php')));
    require_once (File::build_path(array('lib', 'Security.php')));
    require_once (File::build_path(array('lib', 'Session.php')));
    require_once (File::build_path(array('lib', 'Validate.php')));
    require_once (File::build_path(array('lib', 'Messenger.php')));

class ControllerUser {

    protected static $object = "user";

    public static function read() {
        if (isset($errorMessage)) { unset($errorMessage); }
        if (is_null(myGet('login'))) {
            $errorMessage = 'Some attribut are NULL';
        } else if (!(Session::is_connected())) {
            $errorMessage = 'You need to be connected';
        } else if (!(Session::is_user(myGet('login'))) && !(Session::is_admin())) {
            $errorMessage = 'Cant access this page';
        }
        if (!isset($errorMessage)) {
            $login = myGet('login');
            $user = ModelUser::select($login);
            if ($user == false) {
                self::error();
            } else {
                $view='detail';
                $pagetitle='Detail user';
                require_once (File::build_path(array("view", "view.php")));
            }
        } else {
            Messenger::alert($errorMessage);
            self::error();
        }
    }

    public static function readAll() {
        if (isset($errorMessage)) { unset($errorMessage); }
        if (!(Session::is_connected())) {
            $errorMessage = 'You need to be connected';
        } else if (!(Session::is_admin())) {
            $errorMessage = 'Cant access this page';
        }
        if(!isset($errorMessage)) {
            $tab_user = ModelUser::selectAll();
            if($tab_user == false) {
                self::error();
            } else {
            $view='list';
            $pagetitle='Users list';
            require (File::build_path(array("view", "view.php")));
            }
        } else {
            Messenger::alert($errorMessage);
            $view='connect';
            $pagetitle='Connection';
            require (File::build_path(array("view", "view.php")));
        }
    }

    public static function create() {
        if (Conf::getDebug() == True) { $method = "get"; } else { $method = "post";}
        $login = "";
        $lastName = "";
        $surname = "";
        $password1 = "";
        $password2 = "";
        $mail = "";
        $shippingaddress = "";
        $billingaddress = "";
        $required = "required";
        $action = "created";
        $view='update';
        $pagetitle='User\'s creation';
        require (File::build_path(array("view", "view.php")));
    }

    public static function created() {
        if (isset($errorMessage)) { unset($errorMessage); }
        if (is_null(myGet('login')) || is_null(myGet('lastName')) || is_null(myGet('surname')) || is_null(myGet('password1')) || is_null(myGet('password2')) || is_null(myGet('mail')) || is_null(myGet('shippingaddress')) || is_null(myGet('billingaddress'))) {
            $errorMessage = 'Some of the attribut are NULL';
        } else if (ModelUser::select(myGet('login')) !== false) {
            $errorMessage = 'This login is not available';
        } else if (myGet('password1') !== myGet('password2')) {
            $errorMessage = 'problem of password that do no match';
        } else if (!(filter_var(myGet('mail'), FILTER_VALIDATE_EMAIL))) {
            $errorMessage = 'invalid email address format';
        }
        if (!isset($errorMessage)) {
            $data = array (
                'login' => myGet('login'),
                'lastName' => myGet('lastName'),
                'surname' => myGet('surname'),
                'password' => Security::chiffrer(myGet('password1')),
                'mail' => myGet('mail'),
                'admin' => 0,
                'nonce' => Security::generateRandomHex(),
                'wallet' => 0,
                'level' => 0,
                'spend' => 0,
                'billingaddress' => myGet('billingaddress'),
                'shippingaddress' => myGet('shippingaddress'),
            );
            $user = new ModelUser($data);
            $user->save($data);
            Validate::sendValidationMail($data);
            $view='created';
            $pagetitle='user created';
            require (File::build_path(array("view", "view.php")));
        } else {
            Messenger::alert($errorMessage);
            $login = htmlspecialchars(myGet('login'));
            $lastName = htmlspecialchars(myGet('lastName'));
            $surname = htmlspecialchars(myGet('surname'));
            $password1 = "";
            $password2 = "";
            $shippingaddress = htmlspecialchars(myGet('shippingaddress'));
            $billingaddress = htmlspecialchars(myGet('billingaddress'));
            $required = "required";
            $action = "create";
            $view='update';
            $pagetitle='user creation';
            require (File::build_path(array("view", "view.php")));
        }
    }

    public static function delete() {
        $login = myGet('login');
        if (Session::is_connected() && (Session::is_user(myGet('login')) || Session::is_admin())) {
            $view='delete';
            $pagetitle='Delete validation';
            require (File::build_path(array("view", "view.php")));
        } else {
            Messenger::alert('You are not allowed to do such action');
            self::connect();
        }
    }

    public static function confirmDelete() {
        if (isset($errorMessage)) { unset($errorMessage);}
        if (is_null(myGet('login'))) {
            $errorMessage = 'Some of the attribut are NULL';
        } else if (!(Session::is_connected()) || (!(Session::is_user(myGet('login'))) && !(Session::is_admin()))) {
            $errorMessage = 'Can\'t access this page';
        }
        if(!isset($errorMessage)) {
            $login = "";
            $view='confirmDelete';
            $pagetitle='Delete validation';
            require (File::build_path(array("view", "view.php")));
        } else {
            $view='delete';
            $pagetitle='Delete validation';
            require (File::build_path(array("view", "view.php")));
        }
    }

    /*
    * Seul l'admin ou l'utilisateur en question peuvent faire delete sur l'utilisateur
    * On préremplie les champs lastName, surname et mail
    */
    public static function deleted() {
        if (isset($errorMessage)) { unset($errorMessage); }
        if (is_null(myGet('login') && is_null('password'))) {
            $errorMessage = 'Some of the attribut are NULL';
        } else if (!(Session::is_user(myGet('login')) || Session::is_admin())) {
            $errorMessage = 'Cant access this page';
        } else if (!(Session::is_connected()) || (!(Session::is_user(myGet('login'))) && !(Session::is_admin()))) {
            $errorMessage = 'Cant access this page';
        } else if (!ModelUser::checkPassword(myGet('login'), Security::chiffrer(myGet('password'))) && !ModelUser::checkPassword($_SESSION['login'], Security::chiffrer(myGet('password')))  ) {
            $errorMessage = 'Wrong password';
        }
        if (!isset($errorMessage) && Session::is_user(myGet('login'))) {
            $user = ModelUser::select(myGet('login'));
            ModelUser::deleteById(myGet('login'));
            unset($_SESSION['login']);
            session_destroy();
            setcookie(session_name(),'',time()-1);
            $view='deleted';
            $pagetitle='Deleted';
            require (File::build_path(array("view", "view.php")));
        } else if (!isset($errorMessage) && Session::is_admin()) {
            ModelUser::deleteById(myGet('login'));
            $view='deleted';
            $pagetitle='Deleted';
            require (File::build_path(array("view", "view.php")));
        } else {
            Messenger::alert($errorMessage);
            self::connect();
        }
    }

    /*
    * Seul l'admin ou l'utilisateur en question peuvent faire update sur l'utilisateur
    * On préremplie les champs lastName, surname et mail
    */
	public static function update() {
        if (Session::is_user(myGet('login')) || Session::is_admin()) {
            if (Conf::getDebug() == True) { $method = "get"; } else { $method = "post";}
            $user = ModelUser::select(myGet('login'));
            if($user->get('admin') == 0) { $checked = NULL; } else { $checked = 'checked="checked"';}
            $login = htmlspecialchars($user->get('login'));
            $lastName = htmlspecialchars($user->get('lastName'));
            $surname = htmlspecialchars($user->get('surname'));
            $mail = htmlspecialchars($user->get('mail'));
            $shippingaddress = htmlspecialchars($user->get('shippingaddress'));
            $billingaddress = htmlspecialchars($user->get('billingaddress'));
            $password1 = "";
            $password2 = "";
            $required = "readonly";
			$action = "updated";
			$view='update';
			$pagetitle='User modification';
			require (File::build_path(array("view", "view.php")));
    	} else {
            self::connect();
        }
    }

    /*
    * On vérifie que c'est l'admin ou l'utilisateur en question qui tente de faire updated
    * On ne fait l'udpate que si les 2 mots de passe sont les mêmes
    *
    */
	public static function updated() {
        if (isset($errorMessage)) { unset($errorMessage);}
        if (is_null('login') || is_null('lastName') || is_null('surname') || is_null('mail') || is_null('shippingaddress') || is_null('billingaddress') || is_null('password1') || is_null('password2')) {
            $codeError = 1;
            $errorMessage = 'Some of the attribut are NULL';
        } else if (!(Session::is_connected()) || (!(Session::is_user(myGet('login'))) && !(Session::is_admin()))) {
            $codeError = 2;
            $errorMessage = 'Cant access this page';
        } else if (myGet('password1') !== myGet('password2')) {
            $codeError = 1;
            $errorMessage = 'The password is not matching';
        } else if (!ModelUser::checkPassword(myGet('login'), Security::chiffrer(myGet('password1'))) && !ModelUser::checkPassword($_SESSION['login'], Security::chiffrer(myGet('password1')))) {
            $codeError = 1;
            $errorMessage = 'Wrong password';
        } else if (!Session::is_admin() && myGet('admin') !== NULL && myGet('admin') == on) {
            $codeError = 2;
            $errorMessage = 'CHEATER !!!';
        }
        if (!isset($errorMessage)) {
            if (Session::is_admin() && myGet('admin') !== NULL && myGet('admin') == on) { $admin = 1; } else { $admin = 0; }
            $data = array (
				'login' => htmlspecialchars(myGet('login')),
				'lastName' => htmlspecialchars(myGet('lastName')),
				'surname' => htmlspecialchars(myGet('surname')),
                'mail' => htmlspecialchars(myGet('mail')),
                'admin' => $admin,
                'nonce' => NULL,
                'level' => htmlspecialchars(myGet('level')),
                'spend' => htmlspecialchars(myGet('spend')),
                'shippingaddress' => htmlspecialchars(myGet('shippingaddress')),
                'billingaddress' => htmlspecialchars(myGet('billingaddress')),
            );
			ModelUser::updateByID($data);
			$view='updated';
			$pagetitle='User modificated';
			require (File::build_path(array("view", "view.php")));
        } else if ($codeError == 1) {
            if (Conf::getDebug() == True) { $method = "get"; } else { $method = "post";}
            Messenger::alert($errorMessage);
			$login = myGet('login');
			$lastName = myGet('lastName');
			$surname = myGet('surname');
			$mail = myGet('mail');
            $shippingaddress = myGet('shippingaddress');
            $billingaddress = myGet('billingaddress');
            $required = "required";
			$action = "updated";
			$view = 'update';
			$pagetitle='Users creation';
			require (File::build_path(array("view", "view.php")));
        } else {
            Messenger::alert($errorMessage);
            self::connect();
        }
    }

    public static function securitySetting() {
        $user = ModelUser::select(myGet('login'));
        $login = $user->get('login');
        $password1 = "";
        $password2 = "";
        $password3 = "";
        $action = "securitySettingModified";
        $view='securitySettings';
        $pagetitle='connection';
        require (File::build_path(array("view", "view.php")));
    }

    public static function securitySettingModified() {
        if (isset($errorMessage)) { unset($errorMessage);}
        if (!Session::is_connected()) {
            $errorMessage = 'You need to be connected';
        } else if (!Session::is_user(myGet('login'))) {
            $errorMessage = 'Cant access this page';
        } else if (is_null(myGet('password1')) || is_null(myGet('password2')) || is_null(myGet('password3'))) {
            $errorMessage = 'Some attribute are NULL';
        } else if (myGet('password1') !== myGet('password2')) {
            $errorMessage = 'Problem of password';
        } else if (myGet('password3') === myGet('password2')) {
            $errorMessage = 'The new password cant be the same as the old one';
        }
        if(!isset($errorMessage)) {
            $user = ModelUser::select(myGet('login'));
            $user->updatePassword(Security::chiffrer(myGet('password1')), $user->get('login'), Security::chiffrer(myGet('password3')));
            Messenger::alert('Your password have been updated');
            $view='profil';
            $pagetitle='accueil';
            require (File::build_path(array("view", "view.php")));
        } else {
            Messenger::alert($errorMessage);
            $view='profil';
            $pagetitle='accueil';
            require (File::build_path(array("view", "view.php")));
        }
    }

    public static function connect() {
        if (Conf::getDebug() == True) { $method = "get"; } else { $method = "post";}
        $view='connect';
        $pagetitle='connection';
        require (File::build_path(array("view", "view.php")));
    }

    public static function connected() {
        if (ModelUser::checkPassword(myGet('login'), Security::chiffrer(myGet('password'))) && ModelUser::checkNonce(myGet('login'))) {
            $_SESSION['login'] = myGet('login');
            $user = ModelUser::select(myGet('login'));
            if ($user->get('admin') == true) {
                $_SESSION['admin'] = true;
            }
            $_SESSION['connected'] = true;
            $view='profil';
            $pagetitle='User\'s detail';
            require (File::build_path(array("view", "view.php")));
        } else {
            Messenger::alert("Problem, please try again");
            $password = "";
            $login = myGet('login');
            self::connect();
        }
    }

    public static function disconnect() {
        unset($_SESSION['login']);
        session_destroy();
        setcookie(session_name(),'',time()-1);
        $view='disconnected';
        $pagetitle='accueil';
        require (File::build_path(array("view", "view.php")));
    }

    public static function profil() {
        $user = ModelUser::select(myGet('login'));
        if (Session::is_user($user->get('login')) && Session::is_connected()) {
            $view='profil';
            $pagetitle='accueil';
            require (File::build_path(array("view", "view.php")));
        } else {
            self::error();
        }
    }

    public static function preference() {
        $action = "personnalisation";
        $view='preference';
        $pagetitle='settings';
        require (File::build_path(array("view", "view.php")));
    }

    public static function personnalisation() {
        $user = ModelUser::select($_SESSION['login']);
        // setcookie("preference", myGet('preference'), time()+3600);
        $_SESSION['preference'] = myGet('preference');
        $view='profil';
        $pagetitle='profil';
        require (File::build_path(array("view", "view.php")));
    }

    public static function error() {
        $view='error';
        $pagetitle='Page d\'erreur';
        require File::build_path(array('view','view.php'));
    }

//----------------------------------- VALIDATION COMPTE --------------------------------------------------------------------------------------

    public static function validation() {
        Validate::validation();
        $view='profil';
        $pagetitle='profile';
        require (File::build_path(array("view", "view.php")));
    }

}

?>
