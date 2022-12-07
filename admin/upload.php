<?php include 'includes/header.php'; ?>
<?php if (!$session->is_signed_in()) {
    redirect('login.php');
}?>

<?php $message = '';
if (isset($_POST['submit'])) {
    $photo = new Photo();
    $photo->title = $_POST['title'];
    // var_dump($_FILES['file_upload']);
    // exit;
    $photo->set_file($_FILES['file_upload']);

    if ($photo->save()) {
        $message = 'photo uploaded successfully';
    } else {
        $message = join('<br>', $photo->custom_errors);
    }
}

?>


<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">


    <?php include 'includes/top_nav.php'; ?>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php include 'includes/side_nav.php'; ?>
    <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">
        


    <!-- Page Heading -->

    <div class="container-fluid">

        <div class="row">
            <?php echo $message; ?>
            <div class="col-lg-12">
                <h1 class="page-header">
                    Uploads
                    <small>upload image</small>
                </h1>
                <div class="col-md-6">
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" name="title" class="form-group">
                    </div>
                    <div class="form-group">
                        <input type="file" name="file_upload">
                    </div>
                    <input type="submit" value="submit" name="submit">
               </form>
            
                </div>
               
            </div>
        </div>
        <!-- /.row -->

    </div>

</div>
<!-- /#page-wrapper -->

<?php include 'includes/footer.php'; ?>