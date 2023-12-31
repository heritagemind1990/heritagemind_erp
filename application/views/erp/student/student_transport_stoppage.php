
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
              <li class="breadcrumb-item"><a href="<?=base_url();?>student-dashboard">Student</a></li>
              <li class="breadcrumb-item active"><?=$title;?></li>
            </ol>
          </div><!-- /.col -->
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content datas">
      <div class="container-fluid">
      <div class="row">
      <div class="col-11">
      </div>
      <div class="col-1 mb-2">
      <a href="<?=base_url();?>student-dashboard" class="btn btn-danger btn-sm"><i class="fas fa-backward"></i>   Back</a>
     </div>
     <!-- Title Media and Actions Card -->
     <div class="col-4">
        <div class="card pmd-card">
            <div class="card-body d-flex flex-row">
                <div class="media-body">
                    <h4 class="card-subtitle">Student Details</h4>
                    <hr style="margin-top: -0.1rem;border:1px solid green">
                      <span>Name :- <b><?=$student->fname.' '.$student->lname;?></b></span><br>
                      <span>Class :- <b><?=$student->class_name;?></b></span><br>
                      <span>Section :- <b><?=$student->section_name;?></b></span><br>
                      <span>Address :- <b><?=$student->address;?></b></span>
                </div>
                <img class="ml-3 mt-4" src="<?=IMGS_URL.$student->self_img;?>"  onerror="this.src='<?=base_url('assets/users/');?>noimg.png';"  width="80" height="80">
            </div>
        </div>
     </div>
     <div class="col-4">
        <div class="card pmd-card">
             <div class="card-body d-flex flex-row">
                <div class="media-body">
                    <h4 class="card-subtitle">Driver Details</h4>
                    <hr style="margin-top: -0.1rem;border:1px solid green">
                      <span>Name :- <b><?=$student->driver_name;?></b></span><br>
                      <span>Mobile :- <b><?=$student->driver_mobile;?></b></span><br>
                      <span>Address :- <b><?=$student->driver_address;?></b></span><br><br>
                </div>
                <img class="ml-3 mt-4" src="<?=IMGS_URL.$student->driver_photo;?>"  onerror="this.src='<?=base_url('assets/users/');?>noimg.png';"  width="80" height="80">
            </div>
        </div>
     </div>
     <div class="col-4">
        <div class="card pmd-card">
            <div class="card-body d-flex flex-row">
                <div class="media-body">
                    <h4 class="card-subtitle">Conductor Details</h4>
                    <hr style="margin-top: -0.1rem;border:1px solid green">
                    <span>Name :- <b><?=$student->conductor_name;?></b></span><br>
                      <span>Mobile :- <b><?=$student->conductor_mobile;?></b></span><br>
                      <span>Address :- <b><?=$student->conductor_address;?></b></span><br><br>
                </div>
                <img class="ml-3 mt-4" src="<?=IMGS_URL.$student->conductor_photo;?>"  onerror="this.src='<?=base_url('assets/users/');?>noimg.png';"  width="80" height="80">
            </div>
        </div>
     </div>
     <div class="col-12">
        <div class="card pmd-card">
             <div class="card-body d-flex flex-row">
                <div class="media-body">
                  <div class="row">
                    <div class="col-md-4">
                    <h4 class="card-subtitle"> Timing Details</h4>
                    <hr style="margin-top: -0.1rem;border:1px solid green;width:100% !important">
                    <span>Pickup Time :- <b><?=_time($student->pick_up_time);?></b></span><br>
                      <span>Stop Time :- <b><?=$student->stop_time;?> min</b></span><br>
                    </div>
                    <div class="col-md-4">
                    <h4 class="card-subtitle"> Route Details</h4>
                    <hr style="margin-top: -0.1rem;border:1px solid green;width:100% !important">
                    <span>Route :- <b><?=$student->start_route.'  -  '.$student->end_route;?></b></span><br>
                      <span>Pickup Point :- <b><?=$student->pick_up;?></b></span><br>
                      <span>Drop Point :- <b><?=$student->drop_off;?></b></span><br>
                    </div>
                    <div class="col-md-4">
                    <h4 class="card-subtitle">Vehicle  Details</h4>
                    <hr style="margin-top: -0.1rem;border:1px solid green;width:100% !important">
                    <span>Vehicle Name :- <b><?=$student->vehicle_name;?></b></span><br>
                      <span>Vehicle No :- <b><?=$student->vehicle_no;?></b></span><br>
                      <span>Student Capacity :- <b><?=$student->vehicle_child_capacity;?></b></span><br>
                    </div>
                  </div>
                  
                </div>
                <img class="ml-3 mt-4" src="<?=IMGS_URL.$student->vehicle_photo;?>"  onerror="this.src='<?=base_url('assets/users/');?>noimg.png';"  width="80" height="80">
            </div>
        </div>
     </div>
      </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->