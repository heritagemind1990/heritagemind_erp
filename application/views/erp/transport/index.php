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
              <li class="breadcrumb-item"><a href="<?=base_url();?>transport-data">Home</a></li>
              <li class="breadcrumb-item active"><?=$title;?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

<div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>drivers-master">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fa-solid fa-user-tie"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Divers Master</span>
                <span class="info-box-text subheading">Total Driver  :- <?=$total_drivers;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
                 <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>conductors-master">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fa-solid fa-user-tie"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Conductor Master</span>
                <span class="info-box-text subheading">Total Conductor  :- <?=$total_conductors;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
                   <!-- /.col -->
           <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>vehicle-master">
            <div class="info-box">
              <span class="info-box-icon bg-primary"><i class="fa-solid fa-bus"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Vehicle Master</span>
                <span class="info-box-text subheading">Total Vehicle  :- <?=$total_vehicle;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
                   <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>route-allocation">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-road"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Route Allocation</span>
                <span class="info-box-text subheading">Total Route  :- <?=$total_route;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
           <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>sub-route-map">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa-solid fa-map-location-dot"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Sub Route Map</span>
                <span class="info-box-text subheading">Total Sub Route  :- <?=$total_sub_route;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>student-route-map">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fa-solid fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Student Route Map</span>
                <span class="info-box-text subheading">Total Sub Route  :- <?=$total_sub_route;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
            <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>student-vehicle-attendance">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fa-solid fa-calendar-days"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Student Vehicle Attendance</span>
                <span class="info-box-text subheading">Total Sub Route  :- <?=$total_sub_route;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
        </div>
      </div><!-- /.container-fluid -->

  </div>
  <!-- /.content-wrapper -->
