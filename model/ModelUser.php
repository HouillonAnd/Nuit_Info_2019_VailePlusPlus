<?php

require_once (File::build_path(array('model', 'Model.php')));

class ModelUser extends Model {

	private $login;
	private $lastName;
	private $surname;
	private $mail;
	private $admin;
	private $wallet;
	private $level;
	private $spend;
	private $shippingaddress;
	private $billingaddress;

	protected static $object = "user";
	protected static $primary = "login";

	public function __construct($data = NULL) {
		if (!is_null($data)) {
			$this->login = $data['login'];
			$this->lastName = $data['lastName'];
			$this->surname = $data['surname'];
			$this->mail = $data['mail'];
			$this->admin = $data['admin'];
			$this->wallet = $data['wallet'];
			$this->level = $data['level'];
			$this->spend = $data['spend'];
			$this->shippingaddress = $data['shippingaddress'];
			$this->billingaddress = $data['billingaddress'];
		}
	}

	public function get($nom_attribut) {
        if (property_exists($this, $nom_attribut))
            return $this->$nom_attribut;
        return false;
	}

	public function set($nom_attribut, $valeur) {
        if (property_exists($this, $nom_attribut))
            $this->$nom_attribut = $valeur;
        return false;
	}

	public static function checkPassword($login, $mot_de_passe_chiffre) {
		$primary_key = static::$primary;
		$table_name = static::$object;
		try {
			$req_prep = Model::$pdo->prepare("SELECT COUNT(*) FROM $table_name WHERE $primary_key = :login AND password = :mdp");
			$values = array (
				"login" => $login,
				"mdp" => $mot_de_passe_chiffre,
			);
			$req_prep->execute($values);
			$answer = $req_prep->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			if(Conf::getDebug()) {
				echo $e->getMessage();
			} else {
				echo 'Une erreur est survenue <a href="index.php?action=buildFrontPage&controller=home"> retour à la page d\'acceuil </a>';
			}
			die();
		}
		if ($answer['COUNT(*)'] == 0) {
			return false;
		} else {
			return true;
		}
	}

	// Quand on se connecte, on vérifie que le champ nonce de la relation user est vide.
	// S'il n'est pas vide, c'est que l'utilisateur n'a pas valider son compte et il doit donc d'abord en passer par le mail qui lui a été envoyé.
	public static function checkNonce($login) {
		try {
			$req_prep = Model::$pdo->prepare("SELECT nonce FROM user WHERE login = :login");
			$values = array ("login" => $login);
			$req_prep->execute($values);
			$answer = $req_prep->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			if(Conf::getDebug()) {
				echo $e->getMessage();
			} else {
				echo 'Une erreur est survenue <a href="index.php?action=buildFrontPage&controller=home"> retour à la page d\'acceuil </a>';
			}
			die();
		}
		if ($answer['nonce'] !== NULL) {
			return false;
		} else {
			return true;
		}
	}

	public static function nonceAndId($login, $nonce) {
		try {
			$sql = "SELECT COUNT(*) FROM user WHERE login = ':login' AND nonce = ':nonce'";
			$req_prep = Model::$pdo->prepare($sql);
			$values = array (
				"login" => $login,
				"nonce" => $nonce
			);
			$req_prep->execute($values);
			$answer = $req_prep->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			if(Conf::getDebug()) {
				echo $e->getMessage();
			} else {
				echo 'Une erreur est survenue <a href="index.php?action=buildFrontPage&controller=home"> retour à la page d\'acceuil </a>';
			}
			die();
		}
		if ($answer !== NULL) {
			return true;
		} else {
			return false;
			}
	}

	public static function eraseNonce($login, $nonce) {
		try {
			$req_prep = Model::$pdo->prepare("UPDATE user SET nonce = NULL WHERE login = :login AND nonce = :nonce");
			$values = array (
				"login" => $login,
				"nonce" => $nonce
			);
			$req_prep->execute($values);
		} catch (PDOException $e) {
			if(Conf::getDebug()) {
				echo $e->getMessage();
			} else {
				echo 'Une erreur est survenue <a href="index.php?action=buildFrontPage&controller=home"> retour à la page d\'acceuil </a>';
			}
			die();
		}
	}

//	113fb26b8401d29a75f2fc6b1d806db30c8c8d585848c23dfc8a2f98fd51a506

// UPDATE user SET password = 6b877d9d9b62b3831a745b3b4c28d3d83455db93352242f22369266227f2aceb WHERE login = visiteur AND password = 113fb26b8401d29a75f2fc6b1d806db30c8c8d585848c23dfc8a2f98fd51a506

// UPDATE user SET `password` = :newmdp WHERE `login` = ':login' AND `password` = ':oldmdp'


	public static function updatePassword($old, $login, $new) {
		try {
			$req_prep = Model::$pdo->prepare("UPDATE user SET password = :newmdp WHERE login = :login AND password = :oldmdp");
			$values = array (
				":newmdp" => $new,
				":login" => $login,
				":oldmdp" => $old,
			);
			$req_prep->execute($values);
		} catch (PDOException $e) {
			if(Conf::getDebug()) {
				echo $e->getMessage();
			} else {
				echo 'Une erreur est survenue <a href="index.php?action=buildFrontPage&controller=home"> retour à la page d\'acceuil </a>';
			}
			die();
		}
	}
}

?>
