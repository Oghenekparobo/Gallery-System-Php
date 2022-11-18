<?php
// class for photos
class Photo extends Db_object
{
    protected static $db_table = 'photos';
    protected static $db_table_feilds = array('title', 'caption', 'description', 'type', 'filename', 'alternate_text',  'size');
    public $id;
    public $title;
    public $caption;
    public $description;
    public $type;
    public $filename;
    public $alternate_text;
    public $size;

    // directory for our images
    public $upload_directory = "images";
 

    // set file method ; this method is passing $_FILE['uploaded_file'] as an arguement
    public function set_file($file)
    {
        // error check
        if (empty($file) || !$file || !is_array($file)) {
            $this->custom_errors[] = "there was no file uploaded";
            return false;
        } elseif ($file['error'] != 0) {
            $this->custom_errors[] = $this->upload_errors[$file['error'] ];
            
        } else {
            $this->filename = basename($file['name']); //basename get the name ofn the file, only sees the name of the file
            $this->temp_path = $file['tmp_name']; //temporary location of file
            $this->type =  $file['type'];
            $this->size =  $file['size'];
            
        }
    }

    // methood for dynamic image path
    public function picture_path(){
        return $this->upload_directory.DS.$this->filename;
    }

    // save  method
    public  function save(){
       if($this->id){ 
            $this->update();
       }else{
        if(!empty($this->custom_errors)){
            return false;
        }

        if(empty($this->filename) ||empty($this->temp_path)){
            $this->custom_errors[] = "the file is not available";
            return false;
        }
         $target_path = SITE_ROOT.DS.'admin'.DS.$this->picture_path();
       
        if(file_exists( $target_path )){
         $this->custom_errors[]= "file already exists";
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

    // delete photo method 
    public function delete_photo(){
        if($this->delete()){
            $target_path = SITE_ROOT.DS.'admin'.DS.$this->picture_path();
            // delete file
           return unlink( $target_path) ? true : false;
        }else{
            return false;
        }
    }
}
