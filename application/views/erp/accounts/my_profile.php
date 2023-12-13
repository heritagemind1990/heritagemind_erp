
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper pt-4 pb-5">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?=$title;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url();?>accounts-data">Accounts</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php $rs = $this->teacher_model->getDataID('teacher_master',$_SESSION['MUserId']);?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
        <div class="container-fluid px-4 mt-4">
    <hr class="mt-0 mb-4">
    <div class="row">
    <div class="col-xl-4">
    <div class="row">
        <div class="col-xl-12">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header font-weight-bold">Profile Picture</div>
                <div class="card-body text-center">
                    <img  src="<?=IMGS_URL.$rs->self_pic;?>"  onerror="this.src='<?=base_url('assets/users/');?>noimg.png';" height="200px" alt="" style="border-radius:50%;width:200px;margin-top:-0.5rem">
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 1 MB</div>
                    <!-- Profile picture upload button-->
                    <form class="form ajaxsubmit reload-page" action="<?=base_url('teacher-profile/edit-image/'.$rs->id)?>" method="POST" enctype="multipart/form-data">
                    <input id="profile-pic" type="file" class="onchange-submit btn btn-primary col-sm-4 col-lg-8 col-md-6" accept="image/*" name="file">
                    <!-- <button class="btn btn-primary" type="button">Upload new image</button> -->
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-12 mt-3">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header font-weight-bold">Change Password</div>
                <div class="card-body">
                <form class="form ajaxsubmit reload-page" action="<?=base_url('teacher-profile/change-password/'.$rs->id)?>" method="POST" enctype="multipart/form-data">
                  <div class="row">
                  <div class="col-md-12">
                <label class="small mb-1" for="inputFirstName">New Password</label>
                  <input class="form-control" id="inputFirstName" type="password" name="password">
                  </div>
                  <div class="col-md-12">
                <label class="small mb-1" for="inputFirstName">Confirm Password</label>
                  <input class="form-control" id="inputFirstName" type="password" name="cpassword">
                  </div>
                  <div class="col-md-6 mt-3">
                    <button class="btn btn-primary" type="submit">Change Password</button>
                  </div>
                  </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="col-xl-8">
    <div class="row"> 
        <div class="col-xl-12">
        <form class="form ajaxsubmit reload-page" action="<?=base_url('teacher-profile/edit-details/'.$rs->id)?>" method="POST" enctype="multipart/form-data">
            <!-- Account details card-->
            <div class="card">
            
                <div class="card-header font-weight-bold">Basic Details</div>
                <div class="card-body">
                        <div class="row gx-3">
                               <!-- Form Group (username)-->
                        <div class="mb-3 col-md-6">
                            <label class="small mb-1" for="inputUsername">Username</label>
                            <input class="form-control" id="inputUsername" type="text" name="username"  value="<?=$rs->username;?>">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="small mb-1" for="inputUsername">Email</label>
                            <input class="form-control" id="inputUsername" type="text" name="email" value="<?=$rs->email;?>">
                        </div>
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Name</label>
                                <input class="form-control" id="inputFirstName" type="text" name="name" value="<?=$rs->name;?>">
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Father's Name</label>
                                <input class="form-control" id="inputLastName" type="text" name="father_name" value="<?=$rs->father_name;?>">
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Phone number</label>
                                <input class="form-control" id="inputPhone" type="tel" name="phone" value="<?=$rs->phone;?>">
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Joining Date</label>
                                <input class="form-control" id="inputBirthday" type="date" name="joindate" value="<?=$rs->joindate;?>">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Teaching Qualification</label>
                                <input class="form-control" id="inputBirthday" type="text" name="teaching_qualification" value="<?=$rs->teaching_qualification;?>">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">Address</label>
                                <textarea class="form-control" id="inputBirthday"  name="address"><?=$rs->address;?></textarea>
                            </div>
                        </div>
                </div>
                <div class="card-header font-weight-bold">Accounts Details</div>
                <div class="card-body">
                        <div class="row gx-3">
                               <!-- Form Group (username)-->
                        <div class="mb-3 col-md-6">
                            <label class="small mb-1" for="inputUsername">Pan Number</label>
                            <input class="form-control" id="inputUsername" type="text" name="pan"   value="<?=$rs->pan;?>">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="small mb-1" for="inputUsername">Aadhaar Number</label>
                            <input class="form-control" id="inputUsername" type="text" name="adhaar" value="<?=$rs->adhaar;?>">
                        </div>
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Account Holder Name</label>
                                <input class="form-control" id="inputFirstName" type="text" name="account_holder_name" value="<?=$rs->account_holder_name;?>">
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Account Number</label>
                                <input class="form-control" id="inputLastName" type="number" name="account_number" value="<?=$rs->account_number;?>">
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Bank Name</label>
                                <input class="form-control" id="inputPhone" type="text" name="bank" value="<?=$rs->bank;?>">
                            </div>
                            <!-- Form Group (birthday)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputBirthday">IFSC Code</label>
                                <input class="form-control" id="inputBirthday" type="text" name="ifsc" value="<?=$rs->ifsc;?>">
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1" for="inputBirthday">Aadhaar Front</label>
                                <input class="form-control" id="inputBirthday" type="file" name="adharfile" >
                            </div>
                            <div class="col-md-2 mt-3">
                            <img  src="<?=IMGS_URL.$rs->adharfile;?>"   onerror="this.src='<?=base_url('assets/noimg/');?>logo.jpg';"height="50px" alt="" >
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1" for="inputBirthday">Aadhaar Back</label>
                                <input class="form-control" id="inputBirthday" type="file" name="adhaarfile_back" >
                            </div>
                            <div class="col-md-2 mt-3">
                            <img  src="<?=IMGS_URL.$rs->adhaarfile_back;?>"   onerror="this.src='<?=base_url('assets/noimg/');?>logo.jpg';" height="50px" alt="" >
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1" for="inputBirthday">Pan File</label>
                                <input class="form-control" id="inputBirthday" type="file" name="panfile" >
                            </div>
                            <div class="col-md-2 mt-3">
                            <img  src="<?=IMGS_URL.$rs->panfile;?>"   onerror="this.src='<?=base_url('assets/noimg/');?>logo.jpg';" height="50px" alt="" >
                            </div>
                            <div class="col-md-4">
                                <label class="small mb-1" for="inputBirthday">Bank Passbook</label>
                                <input class="form-control" id="inputBirthday" type="file" name="bank_passbook" >
                            </div>
                            <div class="col-md-2 mt-3">
                            <img  src="<?=IMGS_URL.$rs->bank_passbook;?>"  onerror="this.src='<?=base_url('assets/noimg/');?>logo.jpg';" height="50px" alt="" >
                            </div>
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit">Update Details</button>
                    </form>
                </div>
                </div>
            </div>
    </div>
            </div>
        </div>
    </div>
</div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
