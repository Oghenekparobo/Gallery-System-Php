<?php include "includes/header.php";?>
<?php if(!$session->is_signed_in()){ redirect('login.php');}?>
<?php              

$comments = Comment::find_all();


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
                    Comments
                   
                </h1>


                <div class="col-md-12">
                    <table class="table table-hover borderd">
                        <thead>
                        <tr class="text-capitalize">
                            
                           <th>id</th>
                           <th>photo_id</th>
                           <th>author</th>
                           <th>body</th>
                           
                        </tr>
                      
                        </thead>
                        <tbody>
                        <tr>
                        <?php foreach ($comments as $comment) : ?>
                            <td><?php echo $comment->id?></td>
                           <td>
                            <?php echo $comment->photo_id?>
                              <!-- actions -->
                              <div class="text-uppercase actions_link" >  
                                <a href="delete_comments.php?id=<?php echo $comment->id?>">delete</a>
                                <a href="#">view</a>
                            </div>
                        </td>
                           <td><?php echo $comment->author?></td>
                           <td><?php echo $comment->body?></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>

             </div>
        </div>
        <!-- /.row -->

    </div>

</div>
<!-- /#page-wrapper -->

<?php include "includes/footer.php";?>