<?php include "includes/header.php"; ?>
<?php include "includes/photo_modal.php"; ?>
<?php if (!$session->is_signed_in()) {
    redirect('login.php');
} ?>
<?php

$id = $_GET['id'];

if (empty($id)) {
    redirect('users.php');
} else {
    $user = User::find_by_id($id);
    $message = "";

    if (isset($_POST['update'])) {
        $user->username = $_POST['username'];
        $user->firstname = $_POST['firstname'];
        $user->lastname = $_POST['lastname'];
        $user->password = $_POST['password'];


        if (!empty($_FILES['img'])) {
            $user->set_user($_FILES['img']);
            if ($user->save_user()) {
                $user->save();
                redirect("edit_user.php?id={$user->id}");
            } else {
                $message = join("<br>", $user->custom_errors);
            }

        } else {
            $user->save();
        }







    }

}

?>
<!-- Navigation -->



<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

    <?php include "includes/top_nav.php" ?>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php include "includes/side_nav.php" ?>
    <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">


    <!-- Page Heading -->

    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-12">

                <h1 class="page-header">
                    Edit users
                    <small>
                        <?php echo $message ?>
                    </small>
                </h1>

                <div class="col-md-6">
                    <a href="#" data-toggle="modal" data-target="#photo-modal"><img class="user-img"
                            src="<?php echo $user->image_path_and_placeholder(); ?>" alt="user image">
                    </a>
                </div>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="col-md-8 text-capitalize">
                        <div class="form-group">
                            <input class="form-control" type="file" name="img">
                        </div>
                        <div class="form-group">
                            <label for="Username">Username</label>
                            <input class="form-control" type="text" name="username"
                                value="<?php echo $user->username ?>">
                        </div>
                        <div class="form-group">
                            <label for="firstname">Firstname</label>
                            <input class="form-control" type="text" name="firstname"
                                value="<?php echo $user->firstname ?>">
                        </div>
                        <div class="form-group">
                            <label for="lastname">lastname</label>
                            <input class="form-control" type="text" name="lastname"
                                value="<?php echo $user->lastname ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">password</label>
                            <input class="form-control" type="password" name="password"
                                value="<?php echo $user->password ?>">
                        </div>
                    </div>


                    <div class="info-box-update pull-right ">
                        <a id="user-id"  class="btn btn-danger px-2 btn-lg" href="delete_user.php?id=<?php echo $user->id ?>">delete</a>
                        <input type="submit" name="update" value="UPDATE" class="btn btn-primary btn-lg ">
                    </div>

                </form>


            </div>
        </div>
        <!-- /.row -->

    </div>

</div>
<!-- /#page-wrapper -->

<?php include "includes/footer.php"; ?>