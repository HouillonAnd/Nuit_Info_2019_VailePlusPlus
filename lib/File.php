<?php

    class File {

        public static function build_path($path_array) {
//            $DS = DIRECTORY_SEPARATOR;
//            $ROOT_FOLDER = __DIR__ . $DS . "..";
//            return $ROOT_FOLDER . $DS . join($DS, $path_array);
            return __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . join(DIRECTORY_SEPARATOR, $path_array);
        }

    }

?>
