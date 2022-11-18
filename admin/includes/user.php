<?php

class User extends Db_object
{
    // giving our database table for users a variable, abstracting the table
    protected static $db_table = 'users';
    protected static $db_table_feilds = array('username', 'password', 'firstname', 'lastname', 'img');
    public $id;
    public $username;
    public $firstname;
    public $lastname;
    public $password;
    public $img;

      // directory for our images
    //  public $upload_directory = "user_img";
    public $upload_directory = "images";
     public $image_placeholder = "https://via.placeholder.com/5.png";

     public function image_path_and_placeholder(){
            return empty($this->img)? $this->image_placeholder : $this->upload_directory.DS.$this->img;
     }
 

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

     // set file method ; this method is passing $_FILE['uploaded_file'] as an arguement
     public function set_user($user_img)
     {
         // error check
         if (empty($user_img) || !$user_img || !is_array($user_img)) {
             $this->custom_errors[] = "there was no user image uploaded";
             return false;
         } elseif ($user_img['error'] != 0) {
             $this->custom_errors[] = $this->upload_errors[$user_img['error'] ];
             
         } else {
             $this->img = basename($user_img['name']); //basename get the name ofn the file, only sees the name of the file
             $this->temp_path = $user_img['tmp_name']; //temporary location of file
            
             
         }
     }

       // save image method
    public  function save_user(){
      if($this->id){ 
           $this->update();
      }else{
       if(!empty($this->custom_errors)){
           return false;
       }

       if(empty($this->img) ||empty($this->temp_path)){
           $this->custom_errors[] = "the file is not available";
           return false;
       }
        $target_path = SITE_ROOT.DS.'admin'.DS.$this->image_path_and_placeholder();
      
       if(file_exists( $target_path )){
        $this->custom_errors[]= "user image already exists";
        return false;
       }

       if(move_uploaded_file($this->temp_path , $target_path )){ 
               if($this->create()){ 
                   unset($this->temp_path);
                   return true;
               }
       }else{
           $this->custom_errors = "file permission not granted";
           return false;
       }

       $this->create();
      }
   }

     // delete user method 
     public function delete_user(){
      if($this->delete()){
          $target_path = SITE_ROOT.DS.'admin'.DS.$this->image_path_and_placeholder();
          // delete file
         return unlink( $target_path) ? true : false;
      }else{
          return false;
      }
  }

    
  

    
}
