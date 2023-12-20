
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper pt-4 pb-5" >
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?=$title;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url();?>student-dashboard">Student</a></li>
              <li class="breadcrumb-item active"><?=$title;?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" style="margin-bottom: 60rem;">
      <div class="container-fluid">
      <div class="row">
      <div class="col-12">
            <div class="cards">
              <div class="card-header">
                <div class="row">
                    <div class="col-6">
                     <select name="exam" id="exam" class="form-control exam">
                        <option value="">--Select--</option>
                        <?php foreach($exam as $ex):?>
                        <option value="<?=$ex->id;?>"><?=$ex->title;?></option>
                        <?php endforeach;?>    
                     </select>
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary" onclick="fetch_result()" type="button">Submit</button>
                    </div>
                    <div class="col-2">
                    <h3 class="card-title float-right ml-2">
                  <a href="<?=base_url();?>student-dashboard" class="btn btn-danger btn-sm"><i class="fas fa-backward"></i>   Back</a>
                 </h3>
                    </div>
                </div>
             

              </div>
              <!-- /.card-header -->
              <div class="card-content collapse show show-result" id="tb"  style="display: none;">
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
function fetch_result()
{
    var exam = $('#exam').val();
    if(exam !=''){
$.ajax({
    url: "<?php echo base_url('my-marks/tb'); ?>",
    method: "POST",
    data: {
      exam:exam,
    },
    success: function(data){
      $(".show-result").css("display","block");
        $("#tb").html(data);

    },
});
    }else
    {
      alert_toastr("error","Please select exam.");
    }
}
</script>