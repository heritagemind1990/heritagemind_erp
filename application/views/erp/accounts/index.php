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
              <li class="breadcrumb-item"><a href="<?=base_url();?>library-data">Home</a></li>
              <li class="breadcrumb-item active"><?=$title;?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php $Tfine = $Tfee = 0; 
        foreach($monthfee as $fee)
        {
          $Tfee = $Tfee + $fee->submitted_fee;
          $Tfine =$Tfine + $fee->fine;
        } 
        ?>
         <?php $Ttodayfine = $Ttodayfee = 0; 
        foreach($todayfee as $todayfees)
        {
          $Ttodayfine = $Ttodayfine + $todayfees->submitted_fee;
          $Ttodayfee =$Ttodayfee + $todayfees->fine;
        } 
        ?>
         <!-- Main content -->
    <section class="content">
      <!-- 1st Row -->
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              
                <h3><?=$Tfee+$Tfine;?></h3>

                <p>This Month Fee Collection</p>
              </div>
              <div class="icon">
              <i class="fas fa-rupee-sign"></i>
              </div>
              <a href="<?=base_url();?>fee-collection-this-month-report" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
           <div class="small-box bg-warning">
              <div class="inner">
                <h3><?=$Ttodayfee+$Ttodayfine;?></h3>

                <p>Today Fee Collection</p>
              </div>
              <div class="icon">
              <i class="fas fa-rupee-sign"></i>
              </div>
              <a href="<?=base_url();?>fee-collection-report" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <?php $tstudent = 0; foreach($this_month_paid_student as $thismonth):
                 if($thismonth->month1==date('m'))
                 {
                  // April
                    $stu_id =  $thismonth->student_id;
                   $count = $this->accounts_model->Counter('fee_submitted', array('student_id'=>$stu_id));
                     $tstudent += $count;
                 }
                 if($thismonth->month2==date('m'))
                 {
                  // May
                   $stu_id =  $thismonth->student_id;
                   $count = $this->accounts_model->Counter('fee_submitted', array('student_id'=>$stu_id));
                     $tstudent += $count;

                 }
                 if($thismonth->month3==date('m'))
                 {
                  // June
                   $stu_id =  $thismonth->student_id;
                   $count = $this->accounts_model->Counter('fee_submitted', array('student_id'=>$stu_id));
                     $tstudent += $count;
                  
                 }
                 if($thismonth->month4==date('m'))
                 {
                  // July
                   $stu_id =  $thismonth->student_id;
                   $count = $this->accounts_model->Counter('fee_submitted', array('student_id'=>$stu_id));
                     $tstudent += $count;
                  
                 }
                 if($thismonth->month5==date('m'))
                 {
                  // August
                   $stu_id =  $thismonth->student_id;
                   $count = $this->accounts_model->Counter('fee_submitted', array('student_id'=>$stu_id));
                     $tstudent += $count;

                 }
                 if($thismonth->month6==date('m'))
                 {
                  // September
                   $stu_id =  $thismonth->student_id;
                   $count = $this->accounts_model->Counter('fee_submitted', array('student_id'=>$stu_id));
                     $tstudent += $count;
                  
                 }
                 if($thismonth->month7==date('m'))
                 {
                  // October
                  $stu_id =  $thismonth->student_id;
                   $count = $this->accounts_model->Counter('fee_submitted', array('student_id'=>$stu_id));
                     $tstudent += $count;
                  
                 }
                 if($thismonth->month8==date('m'))
                 {
                  // November
                   $stu_id =  $thismonth->student_id;
                   $count = $this->accounts_model->Counter('fee_submitted', array('student_id'=>$stu_id));
                     $tstudent += $count;
                 }
                 if($thismonth->month9==date('m'))
                 {
                  // December
                  $stu_id =  $thismonth->student_id;
                   $count = $this->accounts_model->Counter('fee_submitted', array('student_id'=>$stu_id));
                     $tstudent += $count;
                  
                 }
                 if($thismonth->month10==date('m'))
                 {
                  // January
                   $stu_id =  $thismonth->student_id;
                   $count = $this->accounts_model->Counter('fee_submitted', array('student_id'=>$stu_id));
                     $tstudent += $count;
                  
                 }
                 if($thismonth->month11==date('m'))
                 {
                  // February
                  $stu_id =  $thismonth->student_id;
                   $count = $this->accounts_model->Counter('fee_submitted', array('student_id'=>$stu_id));
                     $tstudent += $count;
                  
                 }
                 if($thismonth->month12==date('m'))
                 {
                  // March
                  $stu_id =  $thismonth->student_id;
                   $count = $this->accounts_model->Counter('fee_submitted', array('student_id'=>$stu_id));
                     $tstudent += $count;
                 }


          endforeach;?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?=$tstudent;?></h3>

                <p>This Month Paid fee Student</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?=base_url();?>this-month-paid-fee-student" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
           <?php 
                 
                  $tstudent2 = 0; foreach($get_total_student as $thismonth): 
                     $tstudent2 = $tstudent2+1;
                      endforeach;
       
          ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?=$tstudent2-$tstudent;?></h3>

                <p>This Month Unpaid fee Student</p>
              </div>
              <div class="icon">
              <i class="ion ion-person-add"></i>
              </div>
              <a href="<?=base_url();?>this-month-unpaid-fee-student" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
      </div><!-- /.container-fluid -->
      <!-- 2nd Row -->
      
    </section>
    <!-- Main content -->
    <section class="content">

     <div class="container-fluid">
        <div class="row">
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>academic-year-master">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fa-solid fa-calendar-day"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Academic Year Master</span>
                <span class="info-box-text subheading">Total academic year  :- <?=$total_academic_year;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>fee-type-master">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fa fa-credit-card" aria-hidden="true"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Fee Type Master</span>
                <span class="info-box-text subheading">Total Fee Type  :- <?=$total_fee_type;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
              <!-- /.col -->
              <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>fee-head-master">
            <div class="info-box">
              <span class="info-box-icon bg-primary"><i class="fa-solid fa-chalkboard"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Fee Head Master</span>
                <span class="info-box-text subheading">Total Fee Head  :- <?=$total_fee_head;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
              <!-- /.col -->
              <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>fee-scheme-master">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fa-solid fa-file-contract"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Fee Scheme Master</span>
                <span class="info-box-text subheading">Total Fee Scheme :- <?=$total_fee_scheme;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>fee-structure">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fa-solid fa-inr"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Fee Structure</span>
                <span class="info-box-text subheading">Total Fee Scheme :- <?=$total_fee_scheme;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>view-fee-structure">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fa-solid fa-inr"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">View Fee Structure</span>
                <span class="info-box-text subheading">Total Fee Scheme :- <?=$total_fee_scheme;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>fee-collection">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa-solid fa-wallet"></i></span>

              <div class="info-box-content">
                <span class="info-box-number">Fee Collection</span>
                <span class="info-box-text subheading">Today Collection :- <?=$total_fee_scheme;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>fee-collection-report">
            <div class="info-box">
              <span class="info-box-icon bg-info"> <i class="fa-solid fa-hand-holding-dollar"></i></span>
              <div class="info-box-content">
                <span class="info-box-number">Fee Collection Report</span>
                <span class="info-box-text subheading">Today Collection :- <?=$total_fee_scheme;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>student-fee-collection-report">
            <div class="info-box">
              <span class="info-box-icon bg-info"> <i class="fa-solid fa-hand-holding-dollar"></i></span>
              <div class="info-box-content">
                <span class="info-box-number">Student Wise  Report</span>
                <span class="info-box-text subheading">Today Collection :- <?=$total_fee_scheme;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>student-fee-defaulter-list">
            <div class="info-box">
              <span class="info-box-icon bg-info"> <i class="fa-solid fa-hand-holding-dollar"></i></span>
              <div class="info-box-content">
                <span class="info-box-number">Student Fee  Defaulter List</span>
                <span class="info-box-text subheading">Today Collection :- <?=$total_fee_scheme;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
          <a href="<?=base_url();?>section-wise-fee-collection-report">
            <div class="info-box">
              <span class="info-box-icon bg-info"> <i class="fa-solid fa-hand-holding-dollar"></i></span>
              <div class="info-box-content">
                <span class="info-box-number">Section Wise Report</span>
                <span class="info-box-text subheading">Today Collection :- <?=$total_fee_scheme;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    
</section>
 
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 