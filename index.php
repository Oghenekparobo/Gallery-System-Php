<?php include 'includes/header.php'; ?>
<?php
 $photos = Photo::find_all();

?>

<div class="row">
    <div class="col-md-12">
    <div class="thumbnails row">
        <?php foreach ($photos as $photo) { ?>
           
                <div class="col-xs-6 col-md-3">
                    <a class="thumbnail" href="photo.php?id=<?php echo $photo->id; ?>">
                    <img class="photo img-responsive" src="admin/<?php echo $photo->picture_path(); ?>" alt="img">
                    </a>
                </div>
        
        
        <?php } ?>
        </div>
    </div>
</div>


 <?php include 'includes/footer.php'; ?>
