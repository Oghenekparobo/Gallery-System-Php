 <!-- Page Heading -->

 <div class="container-fluid">

     <div class="row">
        <?php
        $result = $database->query("SELECT * FROM users ");
        $f = mysqli_fetch_array($result);
        echo $f['username'];

        ?>

         <div class="col-lg-12">
             <h1 class="page-header">
                 Dashboard
                 <small>Subheading</small>
             </h1>
             <ol class="breadcrumb">
                 <li>
                     <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                 </li>
                 <li class="active">
                     <i class="fa fa-file"></i> Blank Page
                 </li>
             </ol>
         </div>
     </div>
     <!-- /.row -->

 </div>