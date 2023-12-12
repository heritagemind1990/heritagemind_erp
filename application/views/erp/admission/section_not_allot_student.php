
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
              <u><b> Section Not Alloted :</b></u> 
                </h3>
                <h3 class="card-title float-right">
                <a href="<?=base_url();?>registered-student" class="btn btn-danger"><i class="fas fa-backward"></i>   Back</a>
                </h3>
              </div>
              <!-- /.card-header -->
            <div class="card-body">
            <table id="example1" class="table table-bordered">
                    <tr class="bg-secondary">
                        <th>Sr.No.</th>
                        <th>Standard / Class Name.</th>
                        <th>Total No of Registration</th>
                    </tr>
                    <?php $i=1;foreach($registered as $r){?>
                    <tr>
                        <td><?=$i;?>.</td>
                        <td><?=$r->class;?></td>
                        <td><a href="<?=base_url();?>view-section-not-allot-student/register/<?=$r->class;?>" class="btn btn-success" style="width: 80px;"><?=$r->totalregister;?></a></td>

                    </tr>
                    <?php $i++; };?>
                </table>
            </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
      </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  