<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()){ redirect('login.php');}?>

 <?php 
  $photo_id = $_GET['id'];

  if(empty($photo_id)){
    redirect("photos.php");
  }

   $photo = Photo::find_by_id($photo_id);

   if($photo){
    $photo->delete_photo();
    redirect("photos.php");
   }else{
    redirect("photos.php");
   }

 
 
 
 ?>