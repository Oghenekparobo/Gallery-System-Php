<?php

class User
{
    // giving our database table for users a variable, abstracting the table
    protected static $db_table = 'users';
    protected static $db_table_feilds = array('username', 'password', 'firstname', 'lastname');
    public $id;
    public $username;
    public $firstname;
    public $lastname;
    public $password;


    // select all users
    public static function find_all_users()
    {

        return self::find_this_query("SELECT * FROM " . self::$db_table . " ");
    }

    // select users from id
    public static function find_users_id($id)
    {
        $result_set = self::find_this_query("SELECT * FROM users WHERE id= $id");
        return !empty($result_set) ? array_shift($result_set) : false;

        // $found_user = mysqli_fetch_array($result_set);
        // return $found_user;
    }

    // manage queries function
    public static function find_this_query($sql)
    {
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array();
        while ($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = self::instatiation($row);
        }
        return $the_object_array;
    }

    public static function verify_user($username, $password)
    {
        global $database;

        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE username = '$username'";
        $sql .= "AND password = '$password' LIMIT 1";
        $result_set = self::find_this_query($sql);
        return !empty($result_set) ? array_shift($result_set) : false;
    }


    public static function instatiation($the_record)
    {
        $the_object = new self;
        // $the_object->id = $found_user['id'];
        // $the_object->username = $found_user['username'];
        // $the_object->firstname = $found_user['firstname'];
        // $the_object->lastname = $found_user['lastname'];
        // $the_object->password = $found_user['password'];
        foreach ($the_record as $the_attribute => $value) {
            if ($the_object->has_the_attribute($the_attribute)) {
                $the_object->$the_attribute = $value;
            }
        }
        return $the_object;
    }

    private function has_the_attribute($the_attribute)
    {
        $object_properties =  get_object_vars($this);
        return  array_key_exists($the_attribute, $object_properties);
    }

    // abstracting our class properties
    protected  function properties()
    {
        // var_dump(get_object_vars($this))  ;
        // exit;

        // var_dump(self::$db_table_feilds);

        global $database;
        $properties = array();
        //    var_dump(self::$db_table_feilds ); 
        foreach (self::$db_table_feilds as $db_feild) {
        
            if (property_exists($this, $db_feild)) {
                $properties[$db_feild] =$database->escape_string($this->$db_feild) ;
                echo $this->$db_feild . "<br>";
            }

           
        }
        return  $properties;
    }

  

    // abstract itenary functon to create or update users
    public function save()
    {
        return isset($this->id) ?  $this->update() : $this->create();
    }

    // create method
    public  function create()
    {
        global $database;

        $properties = $this->properties();

        // $username =  $database->escape_string($this->username);
        // $password =   $database->escape_string($this->password);
        // $firstname = $database->escape_string($this->firstname);
        // $lastname =  $database->escape_string($this->lastname);

        $sql = "INSERT INTO " . self::$db_table . "(" . implode(",", array_keys($properties)) . ")";
        $sql .= "VALUES('" . implode("','", array_values($properties)) . "')";

        if ($database->query($sql)) {
            $this->id = $database->insert_id();
            return true;
        } else {
            return false;
        }
    }

    // update method
    public function update()
    {
        global $database;

        $properties = $this->properties();
        $properties_pairs = array();

        foreach ($properties as $key => $value) {
            $properties_pairs[] = "$key = '$value'";
        }


        $id =  $database->escape_string($this->id);
        // $username =  $database->escape_string($this->username);
        // $password =   $database->escape_string($this->password);
        // $firstname = $database->escape_string($this->firstname);
        // $lastname =  $database->escape_string($this->lastname);

        $sql =  "UPDATE " . self::$db_table . " SET " . implode(",", $properties_pairs) . " WHERE id = $id";

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    // delete method

    public function delete()
    {
        global $database;
        $id =  $database->escape_string($this->id);
        $sql = "DELETE FROM " . self::$db_table . " WHERE id = $id";
        $database->query($sql);


        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }
}
