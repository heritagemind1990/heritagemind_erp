
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?=$_SESSION['name'];?> Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
   <!-- BEGIN: Content-->
        <div class="content-body pl-3 pr-3 card">
            <!-- Base style table -->
            <section id="base-style">
                <div class="row">

                    <style type="text/css">
                        .profile-pic{
                            position: relative;
                            width: 150px;
                            height: 150px;
                            margin-bottom: 15px;
                            border-radius: 50%;
                            border: 2px solid blueviolet ;

                        }

                        .profile-pic input{
                            display: none;
                            
                        }
                        .profile-pic img{
                            position: absolute;
                            width: 100%;
                            max-width: 150px;
                            height: 100%;
                            max-height: 150px;
                            border-radius: 50%;
                            border: 2px solid blueviolet ;

                        }
                        .profile-pic label{
                                position: absolute;
                                bottom: 0;
                                margin: auto;
                                text-align: center;
                                height: 22%;
                                color: white;
                                /* background: #80808075; */
                                width: 100%;
                                cursor: pointer;
                                z-index: 0;
                        }
                    </style>

                    <div class="col-md-12">
              
                        <form class="form ajaxsubmit reload-page update-form" action="<?=base_url()?>admin-profile-img" method="POST" enctype="multipart/form-data">
                            <div class="profile-pic">
                                <div></div>
                                <img  src="<?php echo  IMGS_URL.$admin_data->photo?>">
                            </div>
                       
                    </div>

                    <div class="col-md-6">
                        <div class="cards">
                           
                           
                            <div class="card-content collapse show" id="tb">
                                <div class="row justify-content-center p-1">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                                <label for="duration">Update Photo <sup>*</sup></label>
                                                <input type="file" class="form-control" name="photo">
                                            </div>

                                            <div class="form-group">
                                                <label for="duration">Name <sup>*</sup></label>
                                                <input type="text" class="form-control" placeholder="Name" name="name" value="<?=$admin_data->name?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="duration">Email <sup>*</sup></label>
                                                <input type="text" class="form-control" placeholder="Email" name="email" value="<?=$admin_data->email?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="duration">Contact Number <sup>*</sup></label>
                                                <input type="text" class="form-control" placeholder="Contact" name="contact" value="<?=$admin_data->contact?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="duration"><br></label>
                                                <input type="submit" class="btn btn-danger waves-light" type="submit" value="UPDATE">
                                            </div>
                                        </form>
                                    </div>

                                    
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="cards">
                           
                           
                            <div class="card-content collapse show" id="tb">
                                <div class="row justify-content-center p-1">
                                    

                                    <div class="col-md-12">

                                        <form class="form ajaxsubmit reload-page" action="<?=base_url()?>admin-change-password" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="duration">Old Password <sup>*</sup></label>
                                                <input type="password" class="form-control" placeholder="Old Password" name="old_password" >
                                            </div>

                                            <div class="form-group">
                                                <label for="duration">New Password <sup>*</sup></label>
                                                <input type="password" class="form-control" placeholder="New Password" name="new_password" >
                                            </div>

                                            <div class="form-group">
                                                <label for="duration">Confirm password <sup>*</sup></label>
                                                <input type="password" class="form-control" placeholder="Confirm password" name="conf_password" >
                                            </div>

                                            <div class="form-group">
                                                <label for="duration"><br></label>
                                                <input type="submit" class="btn btn-primary btn-sm" placeholder="Duration" name="name" value="Change Password">
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
              
            </section>
       
</div>
<!-- END: Content-->


    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
