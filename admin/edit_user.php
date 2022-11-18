<?php include "includes/header.php";?>
<?php if(!$session->is_signed_in()){ redirect('login.php');}?>
<?php

$id = $_GET['id'];

if(empty($id)){ 
redirect('photos.php');
}else{
    $user = User::find_by_id($id);
    if(isset($_POST['update'])){ 
        $user->username = $_POST['username'];
        $user->firstname = $_POST['firstname'];
        $user->lastname = $_POST['lastname'];
        $user->password = $_POST['password'];
        // $user->set_user($_FILES['img']);
        var_dump( $user->set_user($_FILES['img']));
        $user->save_user();
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
                   Edit users
                    <small>make changes to your photo</small>
                </h1>

                <form action="" method="post" enctype="multipart/form-data">
                <div class="col-md-8 text-capitalize">
                <div class="form-group">
                    <label for="img">user image</label>
                    <input class="form-control"   type="file" name="img" value="<?php echo $user->image_path_and_placeholder(); ?>" >
                </div>
                 <div class="form-group">
                    <label for="Username">Username</label>
                    <input class="form-control"    type="text" name="username" value="<?php echo $user->username ?>" >
                </div>
                <div class="form-group">
                    <label for="firstname">Firstname</label>
                    <input class="form-control"  type="text" name="firstname" value="<?php echo $user->firstname ?>">
                </div> 
                <div class="form-group">
                    <label for="lastname">lastname</label>
                    <input class="form-control"  type="text" name="lastname" value="<?php echo $user->lastname ?>">
                </div>
                <div class="form-group">
                    <label for="password">password</label>
                    <input class="form-control"  type="password" name="password" value="<?php echo $user->password ?>">
                </div>
                </div>


                <div class="info-box-update pull-right ">
                 <input type="submit" name="update" value="ADD" class="btn btn-primary btn-lg ">
                 </div> 

            </form>
              
             
             </div>
        </div>
        <!-- /.row -->

    </div>

</div>
<!-- /#page-wrapper -->

<?php include "includes/footer.php";?>