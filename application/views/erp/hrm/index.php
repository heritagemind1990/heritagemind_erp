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
              <li class="breadcrumb-item"><a href="<?=base_url();?>hrm-data">Home</a></li>
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
          <a href="<?=base_url();?>teacher-information">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa-solid fa-chalkboard-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Teacher Information</span>
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
          <a href="<?=base_url();?>room-master">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fa-solid fa-house"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Room Master</span>
                <span class="info-box-text subheading">Total Room :- <?=$total_room;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>role-master">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fa-solid fa-users-gear"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Role Master</span>
                <span class="info-box-text subheading">Total Role :- <?=$total_role;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>role-assign-master">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-user-graduate"></i></span>

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
             <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>working-hour-master">
            <div class="info-box">
              <span class="info-box-icon bg-primary"><i class="fas fa-history"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Working Hour Master</span>
                <span class="info-box-text subheading">Total Role  :- <?=$total_role;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>staff-attendance-register">
            <div class="info-box">
              <span class="info-box-icon bg-primary"><i class="fa-solid fa-calendar-days"></i></span>

              <div class="info-box-content">
                <span class="info-box-text text-bold">Staff Attendance Register</span>
                <span class="info-box-text subheading">Total Present  :- <?=$total_role;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            </a>
            <!-- /.info-box -->
          </div>
          
        </div>
      </div><!-- /.container-fluid -->

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
