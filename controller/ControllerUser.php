<?php
require_once File::build_path(array('model', 'ModelUser.php'));
require_once File::build_path(array('lib', 'Security.php'));

class ControllerUser {
    protected static $object='user';

    public static function readAll() {
        if (Session::is_admin()) {
            //Call Database
            $tab_user = ModelUser::selectAll();
            $view = 'List';
            $pagetitle = 'List of users';
        } else {
             $error = 'You don\'t have the permission to perform this action';
             $obj = 'general';
             $view = 'Error';
             $pagetitle = 'Error';
         }
         require File::build_path(array('view', 'View.php'));
    }

    public static function read() {
        $user = ModelUser::select(universalGet('userMail'));
        if($user != false) {
            $view = 'Detail';
            $pagetitle = htmlspecialchars($user->get('userFirstName')) . " " . htmlspecialchars($user->get('userName'));
            require File::build_path(array('view', 'View.php'));
        } else {
            $error = 'User not found';
            $obj = 'general';
            $view = 'Error';
            $pagetitle = 'Error';
        }
        require File::build_path(array('view', 'View.php'));
    }

    public static function register() {
        $isCreating=true;
        $view = 'Update';
        $pagetitle = 'Register';
        $require_path=File::build_path(array('view', 'View.php'));
        require $require_path;
    }

    public static function created() {
        //Check if the confirmed password is the same as the password, if a user is already created with this mail adress and if the mail adress is valid
        if (universalGet('password') == universalGet('confirm_password') && filter_var(universalGet('mail'), FILTER_VALIDATE_EMAIL) && ModelUser::select(universalGet('mail')) == false) {
            $nonce = Security::generateRandomHex();
            $data = array('userMail' => universalGet('mail'),
                'login' => universalGet('login'),
                'userFirstName' => universalGet('firstname'),
                'userName' => universalGet('name'),
                'password' => Security::shash(universalGet('password')),
                'profilePicture' => "https://www.villascitemirabel.com/wp-content/uploads/2016/07/default-profile.png",
                'nonce' => $nonce);
            if (ModelUser::save($data) != true) {
                $error = 'There was an error during the creation of your account';
                $obj = 'general';
                $view = 'Error';
                $pagetitle = 'Error';
            } else {
                $validation_mail = "Click here to validate your SkålEiga Account: https://webinfo.iutmontp.univ-montp2.fr/~boulayp/Projet-PHP-A2/index.php?contoller=user&action=validate&mail=" . universalGet('mail') . "&nonce=" . $nonce;
                mail( universalGet('mail'), "Account Confirmation", $validation_mail);
                $obj="general";
                $view = 'Confirmation';
                $confirmation = "Succesfuly Registered! Please check your emails for validation.";
                $pagetitle = 'Registered';
            }
        } else {
        if(universalGet('password') != universalGet('confirm_password')){
             $error = 'You passwords don\'t match';
             $obj = 'general';
             $view = 'Error';
             $pagetitle = 'Error';
             } else if (!filter_var(universalGet('mail'), FILTER_VALIDATE_EMAIL)){
                 $error = 'Mail error: chekc your email address';
                 $obj = 'general';
                 $view = 'Error';
                 $pagetitle = 'Error';
                } else if(ModelUser::select(universalGet('mail')) == true) {
                    $error = 'An account already uses this mail';
                    $obj = 'general';
                    $view = 'Error';
                    $pagetitle = 'Error';
                }
         }
        require File::build_path(array('view', 'View.php'));
    }

    public static function update() {
        if(Session::is_loggedin() && ($_SESSION['userMail']==universalGet('mail') || Session::is_admin())) {
            if (universalGet('mail')!=null) {
                $u = ModelUser::select(universalGet('mail'));
            } else {
                $u = ModelUser::select($_SESSION['userMail']);
            }
            $view = 'Update';
            $pagetitle = 'Update profile';
        } else {
            if (isset($_SESSION['userMail']) && universalGet('mail')!=null && $_SESSION['userMail']!=universalGet('mail')) {
                $error = 'You don\'t have the permission to perform this action';
                $obj = 'general';
                $view = 'Error';
                $pagetitle = 'Error';
            } else {
                $error = 'You have to be logged in to update your account';
                $obj = 'general';
                $view = 'Error';
                $pagetitle = 'Error';
                }
        }
        require File::build_path(array('view', 'View.php'));
    }

    public static function updated() {
        //Check if the confirmed password is the same as the password, if a user is already created with this mail adress and if the mail adress is valid
        if ((Session::is_admin() || $_SESSION['userMail']==universalGet('mail')) && universalGet('password') == universalGet('confirm_password') && ModelUser::select(universalGet('mail')) == true) {
            if(Session::is_admin() && universalGet('isAdmin')!=null && universalGet('isAdmin')=="true") {
                $admin=true;
            } else {
                $admin=false;
            }

            if(Session::is_admin() && universalGet('mail')!=$_SESSION['userMail']) {
                $mail=universalGet('mail');
            } else {
                $mail=$_SESSION['userMail'];
            }

            if(universalGet('picture')!=null){
              $picture=universalGet('picture');
            } else {
              $picture=ModelUser::select(universalGet('mail'))->get('profilePicture');
            }

            $data = array('userMail' => $mail,
                'login' => universalGet('login'),
                'userFirstName' => universalGet('firstname'),
                'userName' => universalGet('name'),
                'password' => Security::shash(universalGet('password')),
                'profilePicture' => $picture,
                'isAdmin' => $admin,
                'nonce' => 'NULL');

            if (ModelUser::update($data) != true) {
                $error = 'There was an error during the update of your account.';
                $obj = 'general';
                $view = 'Error';
                $pagetitle = 'Error';
            } else {
                $obj="general";
                $view = 'Confirmation';
                $confirmation = "Profile Succesfuly Updated!";
                $pagetitle = 'Profile Updated';
            }
        } else {
            $error = 'There was an error during the update of your account.';
            $obj = 'general';
            $view = 'Error';
            $pagetitle = 'Error';
        }
        require File::build_path(array('view', 'View.php'));
    }

    public static function validate() {
        if (ModelUser::validate(universalGet('mail'), universalGet('nonce'))) {
            $obj="general";
            $view = 'Confirmation';
            $confirmation = "Account succesfuly validated!";
            $pagetitle = 'Validation complete';
        } else {
            $error = 'We could not validate your account. It might have alreaby been activated';
            $obj = 'general';
            $view = 'Error';
            $pagetitle = 'Error';
        }
        require File::build_path(array('view', 'View.php'));
    }

    public static function connect() {
        $view = 'Connect';
        $pagetitle = 'Connect';
        require File::build_path(array('view', 'View.php'));
    }

    public static function connected() {
        if (ModelUser::checkPassword(universalGet('mail'), Security::shash(universalGet('password')))) {
            $_SESSION['userMail']=universalGet('mail');
            $u=ModelUser::select(universalGet('mail'));
            $_SESSION['isAdmin']=$u->get('isAdmin');
            $obj="general";
            $view = 'Temp';
            $pagetitle = 'Connected';
        } else {
            var_dump(Security::shash(universalGet('password')));
            $error = 'We could not log you in. Please check your password and your mail address';
            $obj = 'general';
            $view = 'Error';
            $pagetitle = 'Error';
        }
        require File::build_path(array('view', 'View.php'));
    }

    public static function disconnect() {
        session_destroy();
        $obj="general";
        $view = 'Confirmation';
        $confirmation = "Succesfuly disconnected!";
        $pagetitle = 'Disconnected';
        require File::build_path(array('view', 'View.php'));
    }

}
?>