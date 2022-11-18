
<?php include "includes/header.php";?>
<?php if(!$session->is_signed_in()){ redirect('login.php');}?>
<?php 
  $message = " ";
   $user = new User();
 if(isset($_POST['submit'])){
  
    $user->username = $_POST['username'];
    $user->firstname = $_POST['firstname'];
    $user->lastname = $_POST['lastname'];
    $user->password = $_POST['password'];
    $user->set_user($_FILES['img']);

    if($user->save_user()){
        $message = "added user successfully";
    }else{
        $message = join("<br>" , $user->custom_errors);
    }
    
    
    
 }

?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

    <?php include "includes/top_nav.php"?>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php include "includes/side_nav.php"?>
    <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">

    <!-- Page Heading -->

    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">
                  Add User
                    <small>    <?php echo $message; ?></small>
                </h1>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="col-md-8 text-capitalize">
                <div class="form-group">
                    <label for="img">user image</label>
                    <input class="form-control"   type="file" name="img">
                </div>
                 <div class="form-group">
                    <label for="Username">Username</label>
                    <input class="form-control"    type="text" name="username">
                </div>
                <div class="form-group">
                    <label for="firstname">Firstname</label>
                    <input class="form-control"  type="text" name="firstname">
                </div> 
                <div class="form-group">
                    <label for="lastname">lastname</label>
                    <input class="form-control"  type="text" name="lastname">
                </div>
                <div class="form-group">
                    <label for="password">password</label>
                    <input class="form-control"  type="password" name="password">
                </div>
                </div>


                <div class="info-box-update pull-right ">
                 <input type="submit" name="submit" value="ADD" class="btn btn-primary btn-lg ">
                 </div> 

            </form>
              
             </div>
        </div>
        <!-- /.row -->

    </div>

</div>
<!-- /#page-wrapper -->

<?php include "includes/footer.php";?>