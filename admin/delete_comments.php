<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()){ redirect('login.php');}?>

 <?php 
  $comment_id = $_GET['id'];

  if(empty($comment_id )){
    redirect("comments.php");
  }

   $comment= Comment::find_by_id($comment_id);

   if($comment){
    $comment->delete();
    redirect("comments.php");
   }else{
    redirect("comments.php");
   }

 
 
 
 ?>