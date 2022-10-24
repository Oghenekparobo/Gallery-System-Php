<?php include("includes/header.php"); 

if($session->is_signed_in()){ 
redirect('index.php');
}


if(isset($_POST['submit'])){ 
$username = trim($_POST['username']);
$password = trim($_POST['password']);



// method to check database user

$found_user = User::verify_user($username , $password);

if($found_user){
    $session->login($found_user);
    redirect('index.php');
}else{
    $message = 'Your password or username is incorrect';
}

}else{
    $username = "";
    $password = "";

}


?>



<div class="col-md-4 col-md-offset-3">

<h4 class="bg-danger"><?php echo isset($message)? $message  : ''; ?></h4>
	
<form id="login-id" action="" method="post">
	
<div class="form-group">
	<label for="username">Username</label>
	<input type="text" class="form-control" name="username" value="<?php echo $username; ?>" >

</div>

<div class="form-group">
	<label for="password">Password</label>
	<input type="password" class="form-control" name="password" value="<?php echo htmlentities($password); ?>">
	
</div>


<div class="form-group">
<input type="submit" name="submit" value="Submit" class="btn btn-primary">

</div>


</form>


</div>