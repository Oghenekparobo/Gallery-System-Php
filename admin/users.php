<?php include "includes/header.php";?>
<?php if(!$session->is_signed_in()){ redirect('login.php');}?>
<?php              

$users = User::find_all();


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
                    Users
                    <small> <a href="add_user.php" class="btn btn-primary" >Add User</a> </small>
                </h1>


                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <tr class="text-capitalize">
                            
                           <th>id</th>
                           <th>photo</th>
                           <th>username</th>
                           <th>firstname</th>
                           <th>lastname</th>
                        </tr>
                      
                        </thead>
                        <tbody>
                        <tr>
                        <?php foreach ($users as $user) : ?>
                            <td><?php echo $user->id?></td>
                           <td >
                            <img class="user-img" src="<?php echo $user->image_path_and_placeholder()?>" alt="users">
                
                        
                        </td>
                           <td>
                            <?php echo $user->username?>
                              <!-- actions -->
                              <div class="text-uppercase actions_link" >  
                                <a href="edit_user.php?id=<?php echo $user->id?>">edit</a>
                                <a href="delete_user.php?id=<?php echo $user->id?>">delete</a>
                                <a href="#">view</a>
                            </div>
                        </td>
                           <td><?php echo $user->firstname?></td>
                           <td><?php echo $user->lastname?></td>
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