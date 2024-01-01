
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper pt-4 pb-5">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">My Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url();?>student-dashboard">Home</a></li>
              <li class="breadcrumb-item active">My Dashboard</li>
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
          <a href="<?=base_url();?>my-notice">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa-solid fa-chalkboard-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Notice Board</span>
                <span class="info-box-text subheading" >Today Total  Notice :- <?=$total_notice;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          
          <!-- /.col -->
        
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>student-subject-notes">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fa-solid fa-book"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Subject Notes</span>
                <span class="info-box-text subheading"> Today Total Notes :- <?=$total_room;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>student-home-work">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fa-solid fa-book-open"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Home Work</span>
                <span class="info-box-text subheading">Today Home Work :- <?=$total_home_work;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>student-time-table">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fa-solid fa-calendar-days"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">My Time Table</span>
                <span class="info-box-text subheading">Total Role  :- <?//=$total_role;?></span>
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
          <a href="<?=base_url();?>student-gate-pass">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-house-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">My Gate Pass</span>
                <span class="info-box-text subheading" >Today GatePass :- <?=$total_gate_pass;?></span>
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
                <span class="info-box-number">My Comment</span>
                <span class="info-box-text subheading">Total Student  :- <?//=$total_student;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>my-marks">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-poll-h"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">My Marks</span>
                <span class="info-box-text subheading">Total Exam:- <?=$total_exams;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>student-transport-stoppage">
            <div class="info-box">
              <span class="info-box-icon bg-primary"><i class="fa-solid fa-bus"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">My Transport Stoppage</span>
                <span class="info-box-text subheading">Total Time :- <?//=$total_left;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->

<!-- 3rd Row -->

<div class="container-fluid">
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>student-leave-request">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fa-solid fa-person-booth"></i></span>
              <div class="info-box-content">
                <span class="info-box-text text-bold">My Leave Request</span>
                <span class="info-box-text subheading" >Total Student :- <?//=$total_student;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>my-attendance">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fa-regular fa-calendar-days"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">My Attendance</span>
                <span class="info-box-text subheading">Today  :- <?//=$total_student;?></span>
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
                <span class="info-box-text text-bold">My Marks</span>
                <span class="info-box-text subheading">Total Student:- <?//=$total_student;?></span>
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
                <span class="info-box-text text-bold">My Transport Stoppage</span>
                <span class="info-box-text subheading">Total Time :- <?//=$total_left;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

   