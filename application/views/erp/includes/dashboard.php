
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper pt-4 pb-5">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">My Roles</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">My Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <!-- 1st Row -->
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        <?php  foreach($roles as $role){?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h4><?php echo $role->role_name;?></h4>
              </div>
              <div class="icon">
              <i class="fa-solid fa-person-chalkboard"></i>
              </div>
              <a href="<?=base_url($role->url_name);?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php }?>
        </div>
      </div><!-- /.container-fluid -->
      <!-- 2nd Row -->
      
    </section>
    <!-- /.content -->


    <!-- Good Morning -->
      <!-- Main content -->
      <section class="content">
      <!-- 1st Row -->
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-sm-4"></div>
          <div class="col-sm-4">
          <?php
        date_default_timezone_set("Asia/Kolkata");  
        $h = date('G');

        if($h>=5 && $h<=11)
        {
            $result =  "Good morning";
        }
        else if($h>=12 && $h<=15)
        {
            $result = "Good afternoon";
        }
        else
        {
            $result = "Good evening";
        }
    ?> 
          <label for="" class="text-center"><?php echo $result.'&nbsp;&nbsp;&nbsp;'.$_SESSION['MName'] ;?></label>
     
          </div>
          <div class="col-sm-4"></div>
        
        </div>
      </div><!-- /.container-fluid -->
      <!-- 2nd Row -->
      
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->