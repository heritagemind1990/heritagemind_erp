
<?php
if($this->session->MName=='' || $this->session->MLogin==false)
{
    redirect('student');
}
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$title;?> | Heritage Mind | </title>
    <base href="<?php echo base_url();?>">

    <link rel="icon" type="image/x-icon" href="<?=base_url('assets/');?>photo/images/h.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('assets/');?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?=base_url('assets/');?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url('assets/');?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets/');?>dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?=base_url('assets/');?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?=base_url('assets/');?>plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?=base_url('assets/');?>plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="<?=base_url('assets/');?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url('assets/');?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url('assets/');?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/toast/toastr.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/toast/select2.min.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/toast/sweetalert.css">
<style>
  @media only screen and (min-width: 320px) and (max-width: 500px) {
    .head{
    width: 300px !important;
  }
}
.myheader
 {
  background: linear-gradient(90deg, rgba(69,236,252,0.9948354341736695) 0%, rgba(27,255,149,1)100%) !important;
 }
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
<label for="" class="error"></label>
<label for="" class="success"></label>
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?=base_url('assets/');?>photo/images/h.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top myheader" style="height: 57px;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?=base_url();?>student-dashboard" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <?php $rs = $this->teacher_model->getDataID('student_master',$_SESSION['MUserId']);?>
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
        <img  src="<?=IMGS_URL.$rs->self_img;?>"  onerror="this.src='<?=base_url('assets/users/');?>noimg.png';" height="40px" alt="" style="border-radius:50%;width:35px;margin-top:-0.5rem">
          <!-- <i class="far fa-user"></i> -->
          <span class="badge badge-danger navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item bg-info">
            <!-- Message Start -->
            <div class="media">
              
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <?=$_SESSION['MName']?>
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?=base_url();?>admin-profile" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <div class="media-body">
              <p class="text-sm text-muted"><i class="fas fa-user"></i> Profile</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?=base_url();?>student-logout" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <div class="media-body">
              <p class="text-sm text-muted"><i class="fas fa-sign-out-alt"></i> Log Out</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen"  role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 bg-info">
    <!-- Brand Logo -->
    <a href="<?=base_url();?>student-dashboard" class="brand-link">
      <!--<img src="<?=base_url('assets/');?>photo/images/logo.png" alt="iGradePlus Logo" class="brand-image img-circle elevation-3" style="opacity: .8">-->
      <span class="brand-text font-weight-light pl-3" style="font-size:2rem"><b>Heritage Mind</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
       
        
          <li class="nav-item">
            <a href="<?=base_url();?>my-notice" class="nav-link">
            <i class="fa-solid fa-chalkboard-user"></i>
              <p>
                 My Notice
              </p>
            </a>
          </li>
        
          <li class="nav-item">
            <a href="<?=base_url();?>student-subject-notes" class="nav-link">
            <i class="fa fa-book" aria-hidden="true"></i>
              <p>
                 Subject Notes
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url();?>student-home-work" class="nav-link">
            <i class="fa-solid fa-book-open"></i>
              <p>
                  Home Work
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url();?>student-time-table" class="nav-link">
            <i class="fa-solid fa-calendar-days"></i>
              <p>
               Time Table
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="<?=base_url();?>student-gate-pass" class="nav-link">
            <i class="fas fa-house-user"></i>
              <p>
                Student Gate Pass
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url();?>my-marks" class="nav-link">
            <i class="fas fa-poll-h"></i>
              <p>
               My Marks
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url();?>my-attendance" class="nav-link">
            <i class="fa-regular fa-calendar-days"></i>
              <p>
              My Attendance
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url();?>student-transport-stoppage" class="nav-link">
            <i class="fa-solid fa-bus"></i>
              <p>
              My Transport Stoppage
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url();?>student-leave-request" class="nav-link">
            <i class="fa-solid fa-person-booth"></i>
              <p>
              My Leave Request
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>