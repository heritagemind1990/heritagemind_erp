
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
              <li class="breadcrumb-item"><a href="<?=base_url();?>admission-data">Admission</a></li>
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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              <h3 class="card-title float-right">
                <a href="<?=base_url();?>section-wise-student-master" class="btn btn-danger btn-sm"><i class="fas fa-backward"></i>   Back</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 pb-5">
                <table class="table table-hover text-nowrap  table-bordered">
                  <thead>
                  <tr>
                    <th>Sr.No</th>
                    <th>Student ID</th>
                    <th>Enrollment/Sr No.</th>
                    <th>Section</th>
                    <th>Student Name</th>
                    <th>Father's Name</th>
                    <th>Mother's Name</th>
                    <th>Father's No.</th>
                    <th>D.O.B</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;foreach($student as $s){?>
                  <tr>
                    <td><?=$i;?></td>
                    <td><?=$s->stu_id;?></td>
                    <td><?=$s->enrollment;?></td>
                    <td><?=$s->section_name;?></td>
                    <td><?php echo $s->fname.' '.$s->lname;?></td>
                    <td><?=$s->father;?></td>
                    <td><?=$s->mother;?></td>
                    <td><?=$s->father_no;?></td>
                    <td><?php 
                   $excel_date =$s->dob;    
                   //Convert excel date to mysql db date
                  $unix_date = ($excel_date - 25569) * 86400;
                  $excel_date = 25569 + ($unix_date / 86400);
                  $unix_date = ($excel_date - 25569) * 86400;
                  //Insert below to sql
                  echo $added_date = gmdate("d/m/Y", $unix_date); ?></td>
                    <td> <button class="btn btn-danger btn-sm" onclick="return display_details(<?php echo $s->id; ?>, '<?php echo base_url('view-register-student/view-more') ?>')">View More</button></td>
                  </tr>
                  <?php $i++;};?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div id="modal-div"></div>
  <script>
    function display_details(stu_id, send_url) {
        $.ajax({
            url: send_url,
            method: "POST",
            data: {
                id: stu_id
            },
            success: function(data) {
                const dataArr = JSON.parse(data);
                if (dataArr.status) {
                    $('#modal-div').html(dataArr.data);
                    $('#customerDetailModal').modal('show');
                } else {
                    alert(dataArr.message);
                }
            }
        });
    }

    </script>
    <script>
      
    </script>