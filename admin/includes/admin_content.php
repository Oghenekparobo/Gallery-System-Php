 <!-- Page Heading -->

 <div class="container-fluid">

     <div class="row">
         <?php


            // $found_user =  User::find_users_id(1);
            // $result = User::instatiation($found_user);
            // echo  $result->username;


            // $user =  new User();
            // // $user->id= 37;
            // $user->username = 'mr man';
            // $user->password = 'sugar';
            // $user->lastname = 'cramel';
            // $user->firstname = 'hush';

            // $photo = Photo::find_all();
            // print_r($photo);


            // $photo =  new Photo();
            // $photo = Photo::find_by_id(9);
            // $photo->caption = 'next generation';
            // $photo->alternate_text = 'inspired by a helicopter';
            // $photo->description ='blue white blue';
            //    $photo->save();
    //   echo   $photo->type;
            // $photo->id= 3;
            // $photo->title= 'hello';
            // $photo->description = 'hippie';
            // $photo->type = 'mb49';
            // $photo->filename= 'land';
            // $photo->size= 'large';
            // $photo->save();
           
            // $user->update();
            // $user->find_all_users();
            // foreach ($users as $user) {
            //        echo $user->username;
            //     }

            // $user =  User::find_users_id(7);
            // $user->delete();
            // $user->username= 'supreme';
            // $user->password= '31';
            // $user->delete();




            // $user->create();


            // $photos =  Photo::find_all();
            // // echo $users->username;
            // foreach ( $photos as $photo) {
            //    echo $photo->description;
            // }


            // echo INCLUDE_PATH;


            ?>

         <div class="col-lg-12">
             <h1 class="page-header">
                 Dashboard
                 <small>Admin Dashboard</small>
             </h1>
             <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $session->count; ?></div>
                                        <div>New Views</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                     <div>Page View from Gallery</div>
                                  <span class="pull-left">View Details</span> 
                               <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> 
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                     <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-photo fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo Photo::count_all(); ?></div>
                                        <div>Photos</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Total Photos in Gallery</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>


                     <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo User::count_all(); ?></div>

                                        <div>Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Total Users</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                      <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo Comment::count_all(); ?></div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">Total Comments</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>


                        </div> <!--First Row-->

                        <div class="row">
                        <div id="piechart" style="width: 900px; height: 500px;"></div>
                        </div>




         </div>
     </div>
     <!-- /.row -->

 </div>