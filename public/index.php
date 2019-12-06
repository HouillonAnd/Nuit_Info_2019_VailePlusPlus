<?php
session_name('sessionMMElog');
session_start();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > (30*60))) {
    session_unset();
    session_destroy();
} else {
    $_SESSION['LAST_ACTIVITY'] = time();
}

require_once ('../lib/File.php');
require_once (File::build_path(array("controller", "Routeur.php")));
?>
