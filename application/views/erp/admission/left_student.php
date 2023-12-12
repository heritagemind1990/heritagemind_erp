
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
                <a href="<?=base_url();?>admission-data" class="btn btn-danger btn-sm"><i class="fas fa-backward"></i>   Back</a>
                </h3>
                <div class="card-title float-left">
                <form autocomplete="off" class="form dynamic-tb-search" action="<?=$tb_url?>" method="POST" enctype="multipart/form-data" tagret-tb="#tb">
         <div class="row justify-content-center">
             <div class="col-md-12">
                 <div class="form-group mb-0">
                     <label for="name">Search</label>
                     <input type="text" class="form-control input-sm" name="tb-search" id="tb-search" value="<?php if($search!='null'){echo $search;}?>" placeholder="Search..." />
                 </div>
             </div>
         </div>
                </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-content collapse show" id="tb">
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
  <input type="hidden" name="tb" value="<?=$tb_url?>">
<script>
function loadtb(url=null){
    if (url!=null) {
        var tbUrl = url;
    }
    else{
        var tbUrl = $('[name="tb"]').val();
    }

    if (tbUrl!='') {
        $('#tb').load(tbUrl);
    }
}

loadtb();
</script>
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