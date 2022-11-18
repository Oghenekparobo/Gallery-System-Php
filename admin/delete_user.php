<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()){ redirect('login.php');}?>

 <?php 
  $user_id = $_GET['id'];

  if(empty($user_id )){
    redirect("users.php");
  }

   $user= User::find_by_id($user_id);

   if($user){
    $user->delete_user();
    redirect("users.php");
   }else{
    redirect("users.php");
   }

 
 
 
 ?>