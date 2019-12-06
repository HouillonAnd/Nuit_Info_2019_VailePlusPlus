<?php

class Validate {

    public static function validation() {
        if (!is_null(ModelUser::select(myGet('login'))) && ModelUser::nonceAndId(myGet('login'), myGet('nonce'))) {
            ModelUser::eraseNonce(myGet('login'), myGet('nonce'));
        } else {
            echo "Mauvaise clef de validation";
        }
    }

    public static function sendValidationMail($data) {
        $http = "http://";
        $domaine = $_SERVER['HTTP_HOST'];
        $path = $_SERVER['PHP_SELF'];
        $data1 = "?controller=user&action=validation";
        $data2 = "&login=".$data['login'];
        $data3 = "&nonce=".$data['nonce'];
        $message = $http . $domaine . $path . $data1 . $data2 . $data3;
        $headers = "FROM : Mystic Market Everywhere";
//      exemple de lien deçu dans le mail depuis localhost
//      http://localhost:8888/PHP/ProjetPHPS3/public/index.php?controller=user&action=validation&login=test&nonce=asadzfz
//      exemple de lien deçu dans le mail depuis webinfo
//      http://webinfo.iutmontp.univ-montp2.fr/~simondonj/ecommerce/public/index.php?controller=user&action=validation&login=p&nonce=51437bc0d7ffd8affd3a6e877edce424
        mail($data['mail'], "validation", $message, $headers);
        echo "le mail a bien été envoyé";
    }

}
?>
