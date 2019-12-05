<?php
require_once(File::build_path(array("config", "Conf.php")));

class Model {
    public static $pdo;

    public static function Init() {
        //Initializing the variables for connections
        $hostname = Conf::getHostname();
        $database_name = Conf::getDatabase();
        $login = Conf::getLogin();
        $password = Conf::getPassword();

        //Testing for errors
        try {
            self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name",$login,$password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            //var_dump(self::$pdo);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); //Shown the error message if we use debug
            } else {
                //That's a general error, we do it here to avoid code duplication
                $controller='general';
                $view='error';
                $pagetitle='Erreur générale';
                require(File::build_path(array('view', 'View.php')));
            }
            die();
        }
    }

    public static function selectAll() {
        $table_name=strtoupper(static::$object);
        $class_name='Model'.$table_name;
        $sql_request="SELECT * FROM $table_name";
        $answer = Model::$pdo->query($sql_request);
        return $formatted_answer=$answer->fetchAll(PDO::FETCH_CLASS, $class_name);
    }

    public static function selectAllOrdered($attribute, $order) {
        $table_name=strtoupper(static::$object);
        $class_name='Model'.$table_name;
        $order = strtoupper($order);
        $sql_request="SELECT * FROM $table_name ORDER BY $attribute $order";
        $answer = Model::$pdo->query($sql_request);
        return $formatted_answer=$answer->fetchAll(PDO::FETCH_CLASS, $class_name);
    }

    public static function selectAllBy($attribute){
        try{
            $table_name = strtoupper(static::$object);
            $class_name = 'Model'.$table_name;
            $attribute_key = static::$primary;
            $sql = "SELECT * FROM $table_name WHERE $attribute_key=:attribute";

            $rep_prep = Model::$pdo->prepare($sql);

            $values = array(
                "attribute" =>$attribute,
            );

            $rep_prep->execute($values);
            $tab_res = $req_prep->fetchAll();
            if (empty($tab_res)) {
                return false;
            } else {
                return $tab_res;
            }
        }catch(PDOException $e) {
            return false;
        }
    }

    public static function select($primary_value) {
        try {
            $table_name=strtoupper(static::$object);
            $class_name='Model'.$table_name;
            $primary_key=static::$primary;
            $sql = "SELECT * FROM $table_name WHERE $primary_key=:key";

            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "key" => $primary_value,
            );

            $req_prep->execute($values);

            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);

            $tab_res = $req_prep->fetchAll();
            if (empty($tab_res)) {
                return false;
            } else {
                return $tab_res[0];
            }
        } catch(PDOException $e) {
            return false;
        }
    }

    public static function update($data) {
        try {
            $table_name=strtoupper(static::$object);
            $class_name='Model'.$table_name;
            $primary_key=static::$primary;
            $set = '';
            foreach ($data as $key => $value) {
                if ($key!=$primary_key) {
                    $set = $set . $key . '=:' . $key . ', ';
                }
            }
            $set=substr($set, 0, -2);
            $sql = "UPDATE $table_name SET $set WHERE $primary_key=:$primary_key";

            $req_prep = Model::$pdo->prepare($sql);

            $values = array();

            foreach ($data as $key => $value) {
                $values[$key]=$value;
            }
            $req_prep->execute($values);

            return true;
        } catch(PDOException $e) {
            var_dump($e);
        }
    }

    public static function save($data) {
        try {
            $table_name=strtoupper(static::$object);
            $class_name='Model'.$table_name;
            $primary_key=static::$primary;
            $columns='(';
            $vals='(';
            foreach ($data as $key => $value) {
                $columns = $columns . $key . ', ';
                $vals = $vals . ':' . $key . ', ';
            }
            $columns=substr($columns, 0, -2);
            $vals=substr($vals, 0, -2);
            $columns = $columns . ')';
            $vals = $vals . ')';
            $sql = "INSERT INTO $table_name $columns VALUES $vals";

            $req_prep = Model::$pdo->prepare($sql);

            $values = array();

            foreach ($data as $key => $value) {
                $values[$key]=$value;
            }
            $req_prep->execute($values);
            return true;
        } catch(PDOException $e) {
            var_dump($e);
        }
    }
}

//Model will initialize itself whenever required
Model::Init();

?>
