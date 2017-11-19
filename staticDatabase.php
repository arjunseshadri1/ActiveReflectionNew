<?php

//turn on debugging messages
ini_set('display_errors', 'On');
error_reporting(E_ALL);


define('DATABASE', 'as3395');
define('USERNAME', 'as3395');
define('PASSWORD', 'Ilw3YILr3');
define('CONNECTION', 'sql2.njit.edu');

class dbConn {

    protected static $db;

    private function __construct() {

        try {
            self::$db = new PDO('mysql:host=' . CONNECTION . ';dbname=' . DATABASE, USERNAME, PASSWORD);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
    }

    public static function getConnection() {

        if (!self::$db) {
            new dbConn();
        }
        return self::$db;
    }

}

class collection {

    static public function create() {
        $model = new static::$modelName;

        return $model;
    }

    static public function findAll() {

        $db = dbConn::getConnection();
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName;
        $statement = $db->prepare($sql);
        $statement->execute();
        $class = static::$modelName;
        $statement->setFetchMode(PDO::FETCH_CLASS, $class);
        $recordsSet = $statement->fetchAll();
        return $recordsSet;
    }

    static public function findOne($id) {

        $db = dbConn::getConnection();
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE id =' . $id;
        $statement = $db->prepare($sql);
        $statement->execute();
        $class = static::$modelName;
        $statement->setFetchMode(PDO::FETCH_CLASS, $class);
        $recordsSet = $statement->fetchAll();
        return $recordsSet[0];
    }

}

class accounts extends collection {

    protected static $modelName = 'account';

}

class todos extends collection {

    protected static $modelName = 'todo';

}

class model {

    protected $tableName;

    public function insert($fields, $vals) {
        $db = dbConn::getConnection();
        $sql = $sql = 'insert into ' . $this->tableName . '(' . $fields . ') values(' . $vals . ')';
        $statement = $db->prepare($sql);
        $statement->execute();
    }

    public function update($values, $id) {
        $db = dbConn::getConnection();
        $sql = 'update ' . $this->tableName . ' set ' . $values . ' where id=' . $id;
        $statement = $db->prepare($sql);
        $statement->execute();
    }

    public function delete($id) {
        $db = dbConn::getConnection();
        $sql = 'delete from ' . $this->tableName . ' where id=' . $id;
        $statement = $db->prepare($sql);
        $statement->execute();
    }

}

class account extends model {
    
    public $id;
    public $email;
    public $fname;
    public $lname;
    public $phone;
    public $birthday;
    public $gender;
    public $password;

    public function __construct() {
        $this->tableName = 'accounts';
    }
    

}

class todo extends model {
    
    public $id;
    public $owneremail;
    public $ownerid;
    public $createddate;
    public $duedate;
    public $message;
    public $isdone;

    public function __construct() {
        $this->tableName = 'todos';
    }

}
