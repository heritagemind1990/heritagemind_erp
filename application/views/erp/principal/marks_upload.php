
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
              <li class="breadcrumb-item"><a href="<?=base_url();?>principal-data">Principal</a></li>
              <li class="breadcrumb-item active"><?=$title;?></li>
            </ol>
          </div><!-- /.col -->
          <div class="col-sm-11"></div>
          <div class="col-sm-1">
          <a href="<?=base_url();?>principal-student-marks-upload" class="btn btn-danger btn-sm float-right"><i class="fas fa-backward"></i>   Back</a>
          </div>
        
          <div class="col-sm-12">
          <hr style="border:1px solid green;">
          <?php $tea = $this->principal_model->view_data_id('teacher_master',$map->tea_id);
                $student = $this->principal_model->get_student($map->section_id);?>
           <div class="row">
            <div class="col-sm-3">
            <span>Teacher Name : <?=$tea->name;?></span> <br><span>Subject Name : <?=$map->sub_name;?></span>
            </div>
            <div class="col-sm-8">
            <form action="<?=base_url('principal-student-marks-upload/marks_upload/'.$map->id);?>" method="post">
            <div class="col-sm-11">
                <select name="exam" id="exam" class="form-control">
                    <option value="">--Select Exam--</option>
                    <?php foreach($exam as $e):?>
                    <option value="<?=$e->id;?>" <?php if($exam_id==$e->id){echo "selected";} ;?> ><?=$e->title;?></option>
                    <?php endforeach;?>    
                </select>
            </div>
            <div class="col-sm-1">
                <button type="submit"  class="btn  btn-primary" onclick="upload_marks()">Submit</button>
            </div>
            </form>
            </div>
           </div>
            <hr style="border:1px solid green;">
          </div>
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" style="display:<?php if(!empty($exam_id)){echo "inline";}else{echo "none";};?>;">
      <div class="container-fluid">
      <div class="row">
      <div class="col-12">
            <div class="card">
              <div class="card-header bg-info">
              <h3 class="card-title float-left ml-2">
               Upload Marks
                </h3>
              </div>
              <!-- /.card-header -->
              <form class="form ajaxamrksubmit validate-form submit reload-page" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
              <div class="card-content collapse show" id="tb">
              <div class="card-body table-responsive p-0 pb-2">
                <table class="table table-hover text-nowrap  table-bordered">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Student ID</th>
                    <th>SRNO</th>
                    <th>Studet Name</th>
                    <th>Section</th>
                    <th>Marks</th>
                  </tr>
                  </thead>  
                  <tbody>
                    <?php $i=1;foreach($student as $stu):
                    $exam = $this->principal_model->getDataID('exam_master',$exam_id); ?>
                    <tr>
                      <td><?=$i;?></td>
                      <td><?=$stu->stu_id;?></td>
                      <td><?=$stu->enrollment;?></td>
                      <td><?=$stu->fname.' '.$stu->lname;?></td>
                      <td><?=$stu->section_name;?></td>
                      <?php $marks = $this->principal_model->getStudentMark($stu->id,$exam_id,$map->id,$map->section_id,$map->sub_id);;?>
                      <td><input type="number" name="marks[]" max="<?=$exam->max_marks;?>" min="0" oninput="checkValue(this);" class="form-control" placeholder="Enter Marks" <?php if($marks->student_id??''==$stu->id){;?> value="<?=$marks->marks;?>"  <?php }else{echo 'value="0"';} ;?> ></td>
                    </tr>
                   
                    <input type="hidden" name="stu_id[]" value="<?=$stu->id;?>">
                    <?php $count1 = $this->erp_model->Counter('student_marks', array( 'section_id'=> $map->section_id,'student_id' => $stu->id,'sst_id'=>$map->id,'exam_id'=>$exam_id,'sub_id'=>$map->sub_id,'is_deleted'=>'NOT_DELETED','status'=>'1','is_locked'=>'lock'));?>  
                    <?php $i++; endforeach;?>
                  </tbody>
                </table>
                    <input type="hidden" name="exam_id" value="<?=$exam_id;?>">
                    <input type="hidden" name="SSTId" value="<?=$map->id;?>">
                    <input type="hidden" name="section" value="<?=$map->section_id;?>">
                    <input type="hidden" name="sub_id" value="<?=$map->sub_id;?>">
                    <?php if($count1 ==1){;?>
                      <button class="btn btn-danger float-right mt-3 mb-4 mr-5" type="submit">Locked</button>
                      <?php }else if(!empty($marks)){;?>
                <button class="btn btn-danger float-right mt-3 mb-4 mr-5" type="submit">Final Submit</button>
                <?php }else{?>
                <button class="btn btn-primary float-right mt-3 mb-4 mr-5" type="submit">Submit</button>
                <?php } ?>
              </div>
                </div>
                </form>
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
 <script>
 // this checks the value and updates it on the control, if needed
function checkValue(sender) {
    let min = sender.min;
    let max = sender.max;
    // here we perform the parsing instead of calling another function
    let value = parseInt(sender.value);
    if (value>max) {
        sender.value = min;
    } else if (value<min) {
        sender.value = max;
    }
}
  $(document).on("submit", '.ajaxamrksubmit', function(event) {
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