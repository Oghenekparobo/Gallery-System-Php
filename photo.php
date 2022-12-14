<?php require_once('admin/includes/init.php');?>
<?php if(!$session->is_signed_in()){ redirect('login.php');}?>
<!DOCTYPE html>
<html lang="en">
  <?php
  if(empty($_GET['id'])){
    redirect('index.php');
  }
    $photo = Photo::find_by_id($_GET['id']);
  
    if(isset($_POST['submit'])){ 
        $author = $_POST['author'];
        $body = $_POST['body'];

        $new_comment =  Comment::create_comment( $photo->id , $author, $body );
        if($new_comment && $new_comment->save()){
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
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

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
                <?php foreach ($comments as $comment):?>
                <div class="media">
                    <a class="pull-left" href="#">
                    <img  class="img-responsive media-img" src="admin/<?php echo $photo->picture_path(); ?>" alt="photo_img">

                    </a>
                 
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment->author ?>
                            <!-- <small>August 25, 2014 at 9:30 PM</small> -->
                        </h4>
                       <?php echo  $comment->body ?>                 
                     </div>

                </div>
                <?php endforeach; ?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
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
