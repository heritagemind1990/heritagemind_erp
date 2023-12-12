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
              <li class="breadcrumb-item"><a href="<?=base_url();?>principal-data">Home</a></li>
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
          <a href="<?=base_url();?>subject-teacher-mapping">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa fa-users" aria-hidden="true"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Subject Teacher Mapping</span>
                <span class="info-box-text subheading" >Total Teacher :- <?=$total_teacher;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          
          <!-- /.col -->
        
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>class-teacher-mapping">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fa fa-users" aria-hidden="true"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Class Teacher mapping</span>
                <span class="info-box-text subheading">Total Room :- <?=$total_room;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>section-head-mapping">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fa fa-users" aria-hidden="true"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Section Head Mapping</span>
                <span class="info-box-text subheading">Total Role :- <?=$total_role;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>role-assign">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas fa-user-graduate"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Role Assign</span>
                <span class="info-box-text subheading">Total Role  :- <?=$total_role;?></span>
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
          <a href="<?=base_url();?>principal-student-gate-pass">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas fa-house-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Student Gate Pass</span>
                <span class="info-box-text subheading">Today Total GatePass:- <?=$total_gate_pass;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>principal-student-master">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-user-graduate"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Student Master</span>
                <span class="info-box-text subheading">Total Student  :- <?=$total_student;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>principal-student-attendance-register">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa-solid fa-calendar"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Attendance Register</span>
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
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>principal-section-time-table">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa-solid fa-calendar-days"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Set Time Table</span>
                <span class="info-box-text subheading">Total Student:- <?=$total_student;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>principal-student-marks-upload">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas fa-check-circle"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Student Marks Upload</span>
                <span class="info-box-text subheading">Total Exam :- <?//=$total_class;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
             <!-- /.col -->
             <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>student-marksheet-individual">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fa-solid fa-file-arrow-down"></i></span>

              <div class="info-box-content">
                <span class="info-box-number"> Individual Marksheet</span>
                <span class="info-box-text subheading">Total Exam :- <?//=$total_class;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>student-marksheet">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fa-solid fa-file-arrow-down"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Student Marksheet</span>
                <span class="info-box-text subheading">Total Exam :- <?//=$total_class;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
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
                <h3 class="card-title"><b>Hrm Chart</b></h3>

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
