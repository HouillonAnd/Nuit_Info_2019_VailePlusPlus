<?php

require_once (File::build_path(array('lib', 'QueryBuilder.php')));
require_once (File::build_path(array('lib', 'Messenger.php')));

class ControllerHome {

	protected static $object = "home";

    public static function buildFrontPage() {

        $tab_category = ModelCategory::selectAll();
        $view='marketplace';
        $pagetitle='frontpage';
        require (File::build_path(array("view", "view.php")));
    }
}

?>