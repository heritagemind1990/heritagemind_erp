
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
              <h3 class="card-title float-left">
                </h3>
                <h3 class="card-title float-right">
                <a href="<?=base_url();?>class-wise-registered" class="btn btn-danger"><i class="fas fa-backward"></i>   Back</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                     <tr>
                        <th>Sr.No.</th>
                        <th>Standard / Class</th>
                        <th>Full Name.</th>
                        <th>Father's Name</th>
                        <th>Mother's Name</th>
                        <th>Father's No.</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $i=1;foreach($classdata as $data){?>
                    <tr>
                        <td><?=$i;?>.</td>
                        <td><?=$data->class;?></td>
                        <td><?=$data->fname.''.$data->lname;?></td>
                        <td><?=$data->father;?></td>
                        <td><?=$data->mother;?></td>
                        <td><?=$data->father_no;?></td>
                        <td><?=$data->address;?></td>
                        <td><button class="btn btn-danger btn-sm"><?=$data->type;?></button></td>
                        <td>
                        <button class="btn btn-primary btn-sm" onclick="return display_details(<?php echo $data->id; ?>, '<?php echo base_url('view-register-student/view-more') ?>')">View More</button>
                        </td>
                    </tr>
                    <?php $i++;}?>
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