<?php

	require_once File::build_path(array('model', 'Model.php'));

	class ModelUser extends Model{

		private $email;
		private $nom;
		private $prenom;
		private $age;
		private $genre;
		private $situation;
		private $statut;
		private $etude;
		private $region;
		private $emploi;
		private $profilePicture; //link
        private $isAdmin;
        protected static $object='user';
        protected static $primary= 'email';

        /**
         * ModelUser constructor.
         * @param $email
         * @param $nom
         * @param $prenom
         * @param $age
         * @param $genre
         * @param $situation
         * @param $statut
         * @param $etude
         * @param $region
         * @param $emploi
         * @param $profilePicture
         * @param $isAdmin
         */
        public function __construct($email = NULL, $nom = NULL, $prenom = NULL, $age = NULL, $genre = NULL, $situation = NULL, $statut = NULL, $etude = NULL, $region = NULL, $emploi = NULL, $profilePicture = NULL, $isAdmin = NULL) {
            if(!is_null($email) && !is_null($nom) && !is_null($prenom) && !is_null($age) && !is_null($genre) && !is_null($situation) && !is_null($statut) && !is_null($etude) && !is_null($region) && !is_null($emploi) && !is_null($profilePicture) && !is_null($isAdmin)) {
                $this->email = $email;
                $this->nom = $nom;
                $this->prenom = $prenom;
                $this->age = $age;
                $this->genre = $genre;
                $this->situation = $situation;
                $this->statut = $statut;
                $this->etude = $etude;
                $this->region = $region;
                $this->emploi = $emploi;
                $this->profilePicture = $profilePicture;
                $this->isAdmin = $isAdmin;
            }
        }


        public function get($attribute){
			return $this->$attribute;
		}


        public static function checkPassword($mail,$shashed_pwd) {
            try{
                $sql = "SELECT * FROM USER WHERE userMail=:mail AND password=:pwd";

                $rep_prep = Model::$pdo->prepare($sql);

                $values = array(
                    "mail" => $mail,
                    "pwd" => $shashed_pwd,
                );

                $rep_prep->execute($values);
                $tab_res = $rep_prep->fetchAll();
                if (empty($tab_res) || sizeof($tab_res)!=1) {
                    return false;
                } else {
                    return true;
                }
            }catch(PDOException $e) {
                return false;
            }
        }

        public static function validate($mail,$nonce) {
            try{
                $sql = "SELECT * FROM USER WHERE userMail=:mail AND nonce=:non";

                $req_prep = Model::$pdo->prepare($sql);

                $values = array(
                    "mail" => $mail,
                    "non" => $nonce
                );
                $req_prep->execute($values);
                $tab_res = $req_prep->fetchAll();
                if (empty($tab_res) || sizeof($tab_res)!=1) {
                    return false;
                } else {
                    $sql = "UPDATE USER SET nonce=NULL WHERE userMail=:mail";

                    $req_prep = Model::$pdo->prepare($sql);

                    $values = array(
                        "mail" => $mail,
                    );
                    $req_prep->execute($values);
                    return true;
                }
            }catch(PDOException $e) {
                return false;
            }
        }
	}
?>
