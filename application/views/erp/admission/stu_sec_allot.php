
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
        <div class="row mb-2">
          <div class="col-sm-6">
          </div><!-- /.col -->
          <div class="col-sm-6">
          <h3 class="card-title float-right">
                <a href="<?=base_url();?>section-not-allot-student" class="btn btn-danger"><i class="fas fa-backward"></i>   Back</a>
                </h3>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<?php foreach($section as $t){
 $class   = $t->class_name;
 $name = $t->fname.'  '.$t->lname;
 $stu_id = $t->stu_id;
 $STUDENTID = $t->STUDENTID;
}
    ?>
    <!-- Main content -->
          <div class="container-fluid">
            <div class="row ml-5">
                <div class="col-12">
                <div class="col-md-4">
                     <span>Class :- <?php echo $class;?></span>
                    </div>
                    <div class="col-md-4">
                        <span>Student Name :- <?=$name;?></span>
                    </div>
                    <div class="col-md-4">
                        <span>Student ID :- <?=$STUDENTID;?></span>
                    </div>
                    <form class="form ajaxsubmits validate-form submit reload-page" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
                    <input type="hidden" value="<?=$stu_id;?>" name="stu_id">
                 <div class="col-8 mt-3">
                     <label for="">Select Section :-</label>
                        <select name="section" id="" class="form-control">
                            <option selected="true" disabled="disabled" value="">--Select Section--</option>
                            <?php foreach($section as $s){?>
                            <option value="<?=$s->id;?>"><?=$s->section_name;?></option>
                            <?php }?>
                        </select>
                    </div>
                <div class="col-4 mt-5">
                     <input type="submit" class="btn btn-primary btn-sm" value="Section Allot">
                </div>
                </form>
                </div>
            </div>
          </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
       
    $(document).on("submit", '.ajaxsubmits', function(event) {
    var table=$('#example1').val();
    event.preventDefault(); 
    $this = $(this);
    if ($this.hasClass("append")) {
        var append_data = $($this.attr('append-data')).val();
        $(this).append('<input type="hidden" name="append" value="'+append_data+'" /> ');

    }
    var form_data = new FormData(this);
    form_valid = true;

    if ($this.hasClass("validate-form")) {
        if ($this.valid()) {
            form_valid = true;
        }
        else{
            form_valid = true;
        }
    }

    setTimeout(function() {
        if (form_valid == true) {
           // alert("Helo");
            $.ajax({
                url: $this.attr("action"),
                type: $this.attr("method"),
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data){
                    console.log(data);
                    data = JSON.parse(data);
                    $('.'+data.res).html(data.msg);
                    if (data.res=='success') {
       
                        window.location = '<?php echo base_url('registered-student') ;?>';
                       
                    }
                    if (data.errors) {
                        $.each(data.errors,function(key,value){
                            $this.find(`[name="${key}"]`).parents(`.form-group`).find(`.error`).text(value);
                        })
                    }
                    alert_toastr(data.res,data.msg);
                    ///loadtb();
                }
                
            })
        }
    }, 100);

    return false;
})

    
</script>