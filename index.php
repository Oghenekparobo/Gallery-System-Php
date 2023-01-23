<?php include 'includes/header.php'; ?>
<?php


$page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;

$items_per_page = 4;
$items_total_count = Photo::count_all();


$photos = Photo::find_all();

$paginate = new Paginate($page, $items_per_page, $items_total_count);

$sql = "SELECT * FROM ";
$sql .= " photos LIMIT {$items_per_page}";
$sql .= " OFFSET {$paginate->offset()}";

$photos = Photo::find_by_query($sql);

?>

<div class="row">
    <div class="col-md-12">
        <div class="thumbnails row">
            <i class="bi bi-0-square-fill"></i>
            <?php foreach ($photos as $photo) { ?>

                <div class="col-xs-6 col-md-3">
                    <a class="thumbnail" href="photo.php?id=<?php echo $photo->id; ?>">
                        <img class="photo img-responsive" src="admin/<?php echo $photo->picture_path(); ?>" alt="img">
                    </a>
                </div>


            <?php } ?>
        </div>

        <div class="row">
            <ul class="pager">
                <?php

                if ($paginate->page_total() > 1) {

                    if ($paginate->has_next()) {
                        echo "<li class='next'><a href='index.php?page={$paginate->next()}'>next</a></li>";
                    }


                    if ($paginate->has_previous()) {
                        echo "<li class='next'><a href='index.php?page={$paginate->previous()}'>previous</a></li>";

                    }

                }


                ?>


            </ul>
        </div>
    </div>
</div>


<?php include 'includes/footer.php'; ?>