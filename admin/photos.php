<?php include "includes/header.php";?>
<?php if(!$session->is_signed_in()){ redirect('login.php');}?>
<?php              

$photos = Photo::find_all();


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
                    Photos
                    <small>pictures list</small>
                </h1>


                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <tr class="text-capitalize">
                            
                           <th>id</th>
                           <th>photo</th>
                           <th>filename</th>
                           <th>title</th>
                           <th>size</th>
                        </tr>
                      
                        </thead>
                        <tbody>
                        <tr>
                        <?php foreach ($photos as $photo) : ?>
                            <td><?php echo $photo->id?></td>
                           <td>
                            <img src="<?php echo $photo->picture_path()?>" alt="photos">
                            <div class="text-uppercase pictures_link" >  
                                <a href="#">edit</a>
                                <a href="delete.php/?id=<?php echo $photo->id?>">delete</a>
                                <a href="#">view</a>
                            </div>
                        
                        </td>
                           <td><?php echo $photo->filename?></td>
                           <td><?php echo $photo->title?></td>
                           <td><?php echo $photo->size?></td>
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