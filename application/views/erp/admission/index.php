<style>
  .subheading{
 font-size:0.9rem ;
 color:#000;
  }
</style>
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
              <li class="breadcrumb-item"><a href="<?=base_url();?>academic-data">Home</a></li>
              <li class="breadcrumb-item active"><?=$title;?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <!-- 1st row -->
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>admission-system">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa-solid fa-book"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Admission System</span>
                <span class="info-box-text subheading" >Total Notice :- <?=$total_student;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>admission-section-allot">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold"> Student Section Allot</span>
                <span class="info-box-text subheading">Section Not Alloted Student  :- <?=$total_sec_not_allot;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>concession-master">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fas fa-puzzle-piece"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Concession Master</span>
                <span class="info-box-text subheading">Total Concession :- <?=$total_concession;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>section-wise-student-master">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas fa-user-graduate"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold"> Student Master</span>
                <span class="info-box-text subheading">Total Student  :- <?=$total_student;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->


<!-- 2nd Row -->

<div class="container-fluid">
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>student-document-master">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-user-graduate"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Student Document Master</span>
                <span class="info-box-text subheading" >Total Student :- <?=$total_student;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>student-update-master">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-user-graduate"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Student Update Details</span>
                <span class="info-box-text subheading">Total Student  :- <?=$total_student;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>category-wise-student">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa-solid fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Category Wise All Student</span>
                <span class="info-box-text subheading">Total Student:- <?=$total_student;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>left-student">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa-solid fa-left-long"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Left Student</span>
                <span class="info-box-text subheading">Total Left Student :- <?=$total_left;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>admission-student-attendance-register">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fa-solid fa-calendar"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Attendance Register</span>
                <span class="info-box-text subheading">Total  Student :- <?=$total_student;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><b>Admission Chart</b></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-9 float-left">
                  <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                  <div class=" col-md-3float-right">
                <table class="table">
                    <tr>
                      <td>Enquiry :-</td>
                      <td><?php echo  $enquery = $this->erp_model->Counter('student_master', array('type'=>'ENQUIRY','regstatus'=>'0' )); ?></td>
                    </tr>
                    <tr>
                      <td>Registered :-</td>
                      <td> <?php echo  $registered = $this->erp_model->Counter('student_master', array('type'=>'REGISTERED','regstatus'=>'1' )); ?></td>
                    </tr>
                    <tr>
                      <td>On Hold :-</td>
                      <td><?php echo  $hold = $this->erp_model->Counter('student_master', array('type'=>'ONHOLD','regstatus'=>'2' )); ?></td>
                    </tr>
                    <tr>
                      <td>Rejected :-</td>
                      <td><?php echo  $rejected = $this->erp_model->Counter('student_master', array('type'=>'REJECTED','regstatus'=>'3' )); ?></td>
                    </tr>
                    <tr>
                      <td>Is Left :-</td>
                      <td><?php echo  $left = $this->erp_model->Counter('student_master', array('IsLeft'=>'1' )); ?></td>
                    </tr>
                </table>
              </div>
                </div>
                
              
              </div>
              
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
