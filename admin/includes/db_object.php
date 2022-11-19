<?php

// parent class
class Db_object

{
       // custom errors
       public $custom_errors = array();
 
      // errors array
      public $upload_errors = array(
        UPLOAD_ERR_OK => "there s no error",
        UPLOAD_ERR_INI_SIZE => "the uploaded file exceeds the upload max size directive",
        UPLOAD_ERR_FORM_SIZE => "the uploaded file size exceeds the MAX_FILE_SIZE directive",
        UPLOAD_ERR_PARTIAL => "the uploaded file was only partially uploaded",
        UPLOAD_ERR_NO_FILE => "no file was uploaded",
        UPLOAD_ERR_NO_TMP_DIR => "missing a temporary folder",
        UPLOAD_ERR_CANT_WRITE => "failed to write to desk",
        UPLOAD_ERR_EXTENSION => "a PHP extension stopped the file upload."
    );

        // temporary path for our images
    public $temp_path;
    

    // select all users
    public static function find_all()
    {

        return static::find_by_query("SELECT * FROM ". static::$db_table . " ");
    }

    // select users from id
    public static function find_by_id($id)
    {
        $result_set = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE id= $id");
        return !empty($result_set) ? array_shift($result_set) : false;

        // $found_user = mysqli_fetch_array($result_set);
        // return $found_user;
    }

    // manage queries function
    public static function find_by_query($sql)
    {
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array();
        while ($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = self::instatiation($row);
        }
        return $the_object_array;
    }

    public static function instatiation($the_record)
    {
        $calling_class = get_called_class();
        $the_object = new  $calling_class;
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
        // var_dump(static::$db_table_feilds);
        global $database;
        $properties = array();
        //    var_dump(static::$db_table_feilds ); 
        foreach (static::$db_table_feilds as $db_feild) {
                    
            if (property_exists($this, $db_feild)) {
                $properties[$db_feild] = $database->escape_string($this->$db_feild);
                // echo $this->$db_feild . "<br>";
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

        $sql = "INSERT INTO " . static::$db_table . "(" . implode(",", array_keys($properties)) . ")";
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

        $sql =  "UPDATE " . static::$db_table . " SET " . implode(",", $properties_pairs) . " WHERE id = $id";

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    // delete method

    public function delete()
    {
        global $database;
        $id =  $database->escape_string($this->id);
        $sql = "DELETE FROM " . static::$db_table . " WHERE id = $id";
        $database->query($sql);


        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }
}
