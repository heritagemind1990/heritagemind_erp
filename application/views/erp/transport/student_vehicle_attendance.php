    
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
              <li class="breadcrumb-item"><a href="<?=base_url();?>conductors-master">Transport</a></li>
              <li class="breadcrumb-item active"><?=$title;?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
      <!-- Main content -->
      <section class="content">
      <div class="container-fluid">
       <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              <!-- /.card-header -->
              <div class="card-content collapse show" id="tb">
              <div class="card-body table-responsive p-0 pb-2">
                <table class="table table-hover text-nowrap  table-bordered">
                  <thead>
                  <tr class="bg-info">
                    <th colspan="3" class="text-center">Student Details</th>
                    <th colspan="31" class="text-center">Date</th>
                  </tr>
                  <tr class="bg-primary">
                    <th>Student Name</th>
                    <th>Student ID</th>
                    <th>Section</th>
                    <?php 
            $current_Month 	= date('m');
            $year 			= date('Y');
            $date = mktime(12, 0, 0, $current_Month, 1, $year);
            $numberOfDays = cal_days_in_month(CAL_GREGORIAN, $current_Month, $year);
	        for ($day = 1; $day <= $numberOfDays; $day++) {
            $pdate = date('Y-m-' . sprintf("%02d", $day), $date);
            $days =  date_format(date_create($pdate), "D");
             echo '<th>'.sprintf("%02d", $day).'<br>'.$days.'</th>';
            }
            ?>

                  </tr>
                  </thead>  
                  <tbody>
                    <tr class="bg-warning">
                 <td>Ajay</td>
                 <td>23737237</td>
                 <td>3-B</td>
           <?php  for ($day = 1; $day <= $numberOfDays; $day++) {
            $pdate = date('Y-m-' . sprintf("%02d", $day), $date);
            $days =  date_format(date_create($pdate), "D");
             echo '<th>'.'P'.'</th>';
            }
            ?>
                 
                 </tr>    
                  </tbody>
                </table>
                </div>
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
      </div>
      </div><!-- /.container-fluid -->
    </section>

  </div>