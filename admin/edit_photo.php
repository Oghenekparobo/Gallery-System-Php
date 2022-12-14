<?php include "includes/header.php";?>
<?php if(!$session->is_signed_in()){ redirect('login.php');}?>
<?php

$id = $_GET['id'];

if(empty($id)){ 
redirect('photos.php');
}else{
    $photo = Photo::find_by_id($id);
    if(isset($_POST['update'])){ 
        $photo->title = $_POST['title'];
        $photo->caption = $_POST['caption'];
        $photo->alternate_text = $_POST['alternate_text'];
        $photo->description = $_POST['description'];
        $photo->save();
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
                   Edit Photos
                    <small>make changes to your photo</small>
                </h1>

            <form action="" method="post" enctype="">
                <div class="col-md-8 text-capitalize">
                <div class="form-group ">
                <label for="title">Title</label>
                    <input class="form-control form-group"  type="text" name="title" value="<?php echo $photo->title; ?>">
                </div>
                <div class="form-group ">
                    <a href="#" class="thumbnail" ><img src="<?php echo $photo->picture_path()?>" alt="photos"></a>
                </div>
                 <div class="form-group">
                    <label for="caption">Caption</label>
                    <input class="form-control form-group"    type="text" name="caption"  value="<?php echo $photo->caption; ?>">
                </div>
                <div class="form-group">
                    <label for="alternate_text">alternate text</label>
                    <input class="form-control form-group"  type="text" name="alternate_text"   value="<?php echo $photo->alternate_text; ?>" >
                </div> 
                <div class="form-group">
                    <label for="description">description</label>
                    <textarea class="form-control" id="summernote" name="description" id="" cols="30" rows="10"><?php echo $photo->description; ?></textarea>
                </div>
                
                </div>


            <!-- right side bar -->

                <div class="col-md-4" >
                            <div  class="photo-info-box">
                                <div class="info-box-header">
                                   <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                                </div>
                            <div class="inside">
                              <div class="box-inner">
                                 <p class="text">
                                   <span class="glyphicon glyphicon-calendar"></span> Uploaded on: April 22, 2030 @ 5:26
                                  </p>
                                  <p class="text ">
                                    Photo Id: <span class="data photo_id_box"><?php echo $photo->id; ?></span>
                                  </p>
                                  <p class="text">
                                    Filename: <span class="data"><?php echo $photo->filename; ?></span>
                                  </p>
                                 <p class="text">
                                  File Type: <span class="data"><?php echo $photo->type; ?></span>
                                 </p>
                                 <p class="text">
                                   File Size: <span class="data"><?php echo $photo->size; ?></span>
                                 </p>
                              </div>
                              <div class="info-box-footer clearfix">
                                <div class="info-box-delete pull-left">
                                <a href="delete.php?<?php echo $photo->id; ?>" class="btn btn-danger btn-lg ">Delete</a>  
                                </div>
                                <div class="info-box-update pull-right ">
                                    <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                </div>   
                              </div>
                            </div>          
                        </div>
                    </div>

                

            </form>
              
             </div>
        </div>
        <!-- /.row -->

    </div>

</div>
<!-- /#page-wrapper -->

<?php include "includes/footer.php";?>