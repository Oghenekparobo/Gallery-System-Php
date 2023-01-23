<?php require_once 'admin/includes/init.php'; ?>
<?php if (!$session->is_signed_in()) {
    redirect('login.php');
}?>
<!DOCTYPE html>
<html lang="en">
  <?php
  if (empty($_GET['id'])) {
      redirect('index.php');
  }
    $photo = Photo::find_by_id($_GET['id']);

    if (isset($_POST['submit'])) {
        $author = $_POST['author'];
        $body = $_POST['body'];

        $new_comment = Comment::create_comment($photo->id, $author, $body);
        if ($new_comment && $new_comment->save()) {
            redirect("photo.php?id=$photo->id");
        }
    }

    $comments = Comment::find_comment($photo->id);

    ?>


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>photos</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-post.css" rel="stylesheet">

</head>

<body>

    <!-- Navigation -->
    <?php include 'includes/header.php'; ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-12">

                <!-- Title -->
                <h1><?php echo $photo->title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">user</a>
                </p>

                <hr>     <!-- Date/Time -->
                <!-- <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p> -->

                <hr>

                <!-- Preview Image -->
            
                <img class="img-responsive" src="admin/<?php echo $photo->picture_path(); ?>" alt="photo_img">

                <hr>

                <!-- Post Content -->
                <p class="lead"> <?php echo $photo->description; ?></p>
                
                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
             
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                    <div class="form-group">
                        <label for="author">author</label>
                            <input  type="text" class="form-control" name="author">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="body" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <?php foreach ($comments as $comment) { ?>
                <div class="media">
                    <a class="pull-left" href="#">
                    <img  class="img-responsive media-img" src="admin/<?php echo $photo->picture_path(); ?>" alt="photo_img">

                    </a>
                 
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment->author; ?>
                            <!-- <small>August 25, 2014 at 9:30 PM</small> -->
                        </h4>
                       <?php echo $comment->body; ?>                 
                     </div>

                </div>
                <?php } ?>
            </div>

            
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer class="">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
