<?php

class User
{
    public $id;
    public $username;
    public $firstname;
    public $lastname;
    public $password;


    // select all users
    public static function find_all_users()
    {

        return self::find_this_query("SELECT * FROM users");
    }

    // select users from id
    public static function find_users_id($id)
    {
        global $database;
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
        while($row = mysqli_fetch_array($result_set)){
            $the_object_array[]= self::instatiation($row);
        }
        return $the_object_array;
    }

    public static function verify_user($username , $password){
        global $database;

        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM users WHERE username = '$username'";
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

    private function has_the_attribute($the_attribute){
        $object_properties =  get_object_vars($this);
       return  array_key_exists($the_attribute , $object_properties);

    }

    // create method
    public  function create(){ 
        global $database;
        $username =  $database->escape_string($this->username);
        $password=   $database->escape_string($this->password);
        $firstname = $database->escape_string($this->firstname);
        $lastname =  $database->escape_string($this->lastname);
    
        $sql = "INSERT INTO users(username , password , firstname , lastname)";
        $sql .= " VALUES('$username', '$password' , '$firstname' , '$lastname')";

        if($database->query($sql)){ 
            $this->id = $database->insert_id();
            return true;
        }else{
            return false;
        }
    }

    // update method
    public function update(){
        global $database;
        $id =  $database->escape_string($this->id);
        $username =  $database->escape_string($this->username);
        $password=   $database->escape_string($this->password);
        $firstname = $database->escape_string($this->firstname);
        $lastname =  $database->escape_string($this->lastname);

        $sql =  "UPDATE users SET  username =   '$username', password =   '$password', firstname =  '$firstname',lastname =   '$lastname' WHERE id = $id";

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1 ) ? true : false;
    
    }

    // delete method

    public function delete(){ 
        global $database;
        $id =  $database->escape_string($this->id);
        $sql = "DELETE FROM users WHERE id = $id";
        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1 ) ? true : false;
    


    }
}
