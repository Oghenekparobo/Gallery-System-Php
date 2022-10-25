 <!-- Page Heading -->

 <div class="container-fluid">

     <div class="row">
        <?php
        

        $found_user =  User::find_users_id(1);
        $result = User::instatiation($found_user);
        echo  $result->username;

        $user = new User();
        $user->id =3 ;
    

        $user->delete();
        
        
        // $users =  User::find_all_users();
        // foreach ($users as $user) {
        //    echo $user->username;
        // }



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