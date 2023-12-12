
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
              <li class="breadcrumb-item"><a href="<?=base_url();?>library-data">Library</a></li>
              <li class="breadcrumb-item active"><?=$title;?></li>
            </ol>
          </div><!-- /.col -->
          <div class="col-sm-11"></div>
          <div class="col-sm-1"> <a href="<?=base_url();?>library-data" class="btn btn-danger btn-sm mt-1"><i class="fas fa-backward"></i>   Back</a></div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
     <form class="form ajaxsubmit validate-form submit reload-page" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
      <div class="container-fluid">
      <div class="row">
      <div class="col-4">
          <label for="">Select Section<span class="text-danger">*</span></label>
          <select name="section" id="section" class="form-control">
            <?=$sections;?>
          </select>
      </div>
      <div class="col-4">
          <label for="">Select teacher<span class="text-danger">*</span></label>
          <select name="teacher" id="teacher" class="form-control">
          <?=$teachers;?>
          </select>
      </div>
      <div class="col-4">
        <label for="">No of Days Allowed Books</label>
        <input type="number" name="days" id="" class="form-control" placeholder="Enter No of days books allowed teachers">
      </div>
      <div class="col-12" id="book">
        
        </div>
      <div class="col-5"></div>
      <div class="col-2">
        <button class="btn btn-sm btn-primary mt-2" type="submit">Assign Now</button>
      </div>
       <div class="col-5"></div>
      </div>
      </div><!-- /.container-fluid -->
      </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
$('#section').change(function() {
    var id = $(this).val();
    $('#book').load('<?=base_url()?>Inst/getBooks/'+id);
})
</script>
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            teaher:"required",
            days:"required",
            section:{
                required:true,
            }
            
        },
        messages: {
            teaher:"Please select teacher",
            days:"Please enter no of days books allowed teachers",
            section: {
                required : "Please select section",
            }
        }
    }); 
});
</script>