<?php
function my_autoloader($class) {
    $class= strtolower($class);
    $the_path = "includes/{$class}.php";

    if(file_exists($the_path)){ 
        require_once($the_path);
    }else{
        die("the file, {$class}.php was not found");
    }
}

 spl_autoload_register('my_autoloader');



//  function to redirect users
function redirect($location){ 
    header("location: {$location}");
}
?>