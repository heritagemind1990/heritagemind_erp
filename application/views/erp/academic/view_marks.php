
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
              <li class="breadcrumb-item"><a href="<?=base_url();?>academic-data">Academic</a></li>
              <li class="breadcrumb-item active"><?=$title;?></li>
            </ol>
          </div><!-- /.col -->
          <div class="col-sm-11"></div>
          <div class="col-sm-1">
          <a href="<?=base_url();?>student-marks-upload" class="btn btn-danger btn-sm float-right"><i class="fas fa-backward"></i>   Back</a>
          </div>
        
          <div class="col-sm-12">
          <hr style="border:1px solid green;">
          <?php $tea = $this->academic_model->view_data_id('teacher_master',$map->tea_id);
                $student = $this->academic_model->get_student($map->section_id);?>
           <div class="row">
            <div class="col-sm-3">
            <span>Teacher Name : <?=$tea->name;?></span> <br><span>Subject Name : <?=$map->sub_name;?></span>
            </div>
            <div class="col-sm-8">
            <form action="<?=base_url('student-marks-upload/view_marks/'.$map->id);?>" method="post">
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
              <div class="card-content collapse show" id="tb">
              <div class="card-body table-responsive p-0 pb-5">
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
                    $exam = $this->academic_model->getDataID('exam_master',$exam_id); ?>
                    <tr>
                      <td><?=$i;?></td>
                      <td><?=$stu->stu_id;?></td>
                      <td><?=$stu->enrollment;?></td>
                      <td><?=$stu->fname.' '.$stu->lname;?></td>
                      <td><?=$stu->section_name;?></td>
                      <?php $marks = $this->academic_model->getStudentMark($stu->id,$exam_id,$map->id,$map->section_id,$map->sub_id);;?>
                      <td><input type="text" name="marks[]"  class="form-control" placeholder="Enter Marks" <?php if($marks->student_id??''==$stu->id){;?> value="<?=$marks->marks;?>" <?php if($marks->is_locked=='lock'){echo 'readonly';}?> <?php }else{echo 'value="Not Uploaded"';} ;?> readonly></td>
                    </tr> 
                    <?php $i++; endforeach;?>
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
