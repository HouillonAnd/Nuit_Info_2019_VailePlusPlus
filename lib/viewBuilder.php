<?php

    class viewBuilder {

    public static function displayView($v_view, $v_pagetitle, $data) {
        $array = array("view", "view.php");
		$view = $v_view;
		$pagetitle = $v_pagetitle;
		require_once (File::build_path($array));
	}

}
?>