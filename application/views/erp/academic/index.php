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
          <a href="<?=base_url();?>academic-notice">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa-solid fa-book"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Notice Master</span>
                <span class="info-box-text subheading" >Total Notice :- <?=$total_notice;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>class-master">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Class Master</span>
                <span class="info-box-text subheading">Total Classes  :- <?=$total_class;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>section-master">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fas fa-puzzle-piece"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Section Master</span>
                <span class="info-box-text subheading">Total NoSectiontice :- <?=$total_section;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>section-allot-master">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas fa-user-graduate"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold"> Student Section Allot</span>
                <span class="info-box-text subheading">Section Not Alloted Student  :- <?=$total_section;?></span>
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
          <a href="<?=base_url();?>academic-student-master">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-user-graduate"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Student Master</span>
                <span class="info-box-text subheading" >Total Student :- <?=$total_student;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>holiday-master">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-snowman"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Holidays Events</span>
                <span class="info-box-text subheading">Total Holidays in Months  :- <?=$total_holiday;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>category-master">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa-solid fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Category Master</span>
                <span class="info-box-text subheading">Total C ategory :- <?=$total_category;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>academic-student-attendance-register">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa-solid fa-calendar"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Attendance Register</span>
                <span class="info-box-text subheading">Today Todal Student Absent  :- <?=$total_section;?></span>
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
          <a href="<?=base_url();?>exam-master">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fa-solid fa-book-open-reader"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Exam Master</span>
                <span class="info-box-text subheading" >Total Exam :- <?=$total_exam;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>student-marks-upload">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas fa-check-circle"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Student Marks Upload</span>
                <span class="info-box-text subheading">Total Exam :- <?=$total_class;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>student-remarks-upload">
            <div class="info-box">
              <span class="info-box-icon bg-primary"><i class="fas fa-check-circle"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Student Remarks Upload</span>
                <span class="info-box-text subheading">Exam :- <?=$total_section;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>subject-master">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-book"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Subject Master</span>
                <span class="info-box-text subheading">Today Subject :- <?=$total_subject;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>subject-topic-master">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-book"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Subject Topic Master</span>
                <span class="info-box-text subheading">Today Subject :- <?=$total_topic;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>academic-section-wise-period-master">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa-solid fa-clock"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Set Section Periods</span>
                <span class="info-box-text subheading">Today Subject :- <?=$total_topic;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>academic-calendar">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fa-solid fa-calendar-days"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Academic Calendar</span>
                <span class="info-box-text subheading">Today Subject :- <?=$total_topic;?></span>
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
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->