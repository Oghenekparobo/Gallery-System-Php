<?php

class User extends Db_object
{
    // giving our database table for users a variable, abstracting the table
    protected static $db_table = 'users';
    protected static $db_table_feilds = array('username', 'password', 'firstname', 'lastname');
    public $id;
    public $username;
    public $firstname;
    public $lastname;
    public $password;


    public static function verify_user($username, $password)
    {
        global $database;

        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " . self::$db_table . " WHERE username = '$username'";
        $sql .= "AND password = '$password' LIMIT 1";
        $result_set = self::find_by_query($sql);
        return !empty($result_set) ? array_shift($result_set) : false;
    }


  

    
}
