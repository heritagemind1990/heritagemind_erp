             
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
              <li class="breadcrumb-item"><a href="<?=base_url();?>teacher-date">Teacher</a></li>
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
                 <h3 class="card-title float-left ml-2">
                    <div class="row">
                        <div class="col-3">

                        </div>
                        <div class="col-3">
                            
                        </div>
                    </div>
                </h3>
              <h3 class="card-title float-right ml-2">
                <a href="<?=base_url();?>upload-hw" class="btn btn-danger btn-sm"><i class="fas fa-backward"></i>   Back</a>
                </h3>
               
               
              </div>
              <!-- /.card-header -->
              <div class="card-content collapse show" id="tb">
              <div class="card-body table-responsive p-0 pb-2">
                <table class="table table-hover text-nowrap  table-bordered">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Student ID</th>
                    <th>Enrollment / SrNo</th>
                    <th>Student Name</th>
                    <th>Section Name</th>
                    <th>Subject Name</th>
                    <th>Home Work</th>
                    <th>Hw File</th>
                     <th>Hw Status</th>
                    <th  class="text-center">Action</th>
                    <th>Parent Check</th>
                  </tr>
                  </thead>  
                  <tbody>
               
                <?php $i=1;foreach($rows as $r){
                 
                     ?>
                  <tr>
                    <td><?=$i;?></td>
                    <td><?=$r->stu_id;?></td>
                    <td><?=$r->enrollment;?></td>
                    <td><?=$r->fname.' '.$r->lname;?></td>
                    <td><?=$r->section_name;?></td>
                    <td><?=$r->sub_name;?></td>
                    <td><?php if($r->student_id==$r->studentid){echo $r->hw_remark;};?></td>
                    <td><?php if($r->student_id==$r->studentid){?> <a href="<?php echo IMGS_URL.$r->hw_file ;?>" target="_blank"><i class="fa fa-download" style="color:blue"></i></a> <?php };?></td>
                    <td><?php if($r->student_id==$r->studentid){echo 'Completed';}else{echo 'Not Completed';};?></td>
                  
                  
                    <td>
                      <?php $count = $this->erp_model->Counter('stu_hw_submit', array('student_id'=>$r->student_id,'hw_submit_date'=>$r->hw_date));
                      if($count==1){?>
                      <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-lg<?=$i;?>">Check HW</a>
                      <?php }else{?>
                        <a class="btn btn-sm btn-primary" onClick="hw()">Check HW</a>
                      <?php };?>
                    </td>
                    <td> <?php if($r->student_id==$r->studentid){?><span class="text-center" ><i class="<?=($r->parent_status==1) ? 'fa-regular fa-circle-check' : 'fa-solid fa-circle-xmark'?>" title="Click for chenage status" style="color:<?=($r->parent_status==1) ? 'green' :'red'?> "></i></span><?php }?>
                    </td>
                    </tr>
                  <div class="modal fade closebtn" id="modal-lg<?=$i;?>">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                 <form class="form submithomework validate-form submit reload-page" action="<?=base_url('upload-hw/submit-check');?>" method="post" enctype= multipart/form-data>
                    <div class="modal-header">
                      <h4 class="modal-title"><?=$r->fname.' '.$r->lname;?> ( <?=$r->stu_id;?> )</h4>
                      <h4 class="modal-title ml-5"><?php  if($r->student_id==$r->studentid){ if($r->teacher_status==1){echo "<p style='color:green'>Already Checked</p>";}else{echo "";};}?></h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="stu_id" id="" value="<?=$r->student_id;?>">
                      <input type="hidden" name="hw_date" id="" value="<?=$r->hw_date;?>">
                      <div class="row pt-3 pb-3">
                        <div class="col-md-10">
                          <textarea name="remark" id="" class="form-control" placeholder="Enter Remark" required><?php if($r->student_id==$r->studentid){echo $r->teacher_check ?? '';};?></textarea>
                        </div>
                        <div class="col-md-2">
                          <label for="">Check</label>
                          <input type="checkbox" name="check" value="1" style="width:50px;height:20px" class="checkbox mt-2" <?php if($r->student_id==$r->studentid){ if($r->teacher_status==1){echo "checked";}else{}};?> required>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary ">Checked</button>
                    </div>
                </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
                  <?php  $i++ ;}?>
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper --> 
  
 <script type="text/javascript">
  function hw()
      {
     
        alert_toastr("error","Sorry Home WorK Not Submitted by Student");
      }
</script>  
  <script type="text/javascript">
    
$(document).on("submit", '.submithomework', function(event) {
   //alert("Hello");
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
                      $('.closebtn').modal('hide');
                        if ($this.hasClass("reload-page")) {
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        }
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
 