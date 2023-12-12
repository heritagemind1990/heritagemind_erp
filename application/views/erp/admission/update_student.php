
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
              <li class="breadcrumb-item active">Student Document Master</li>
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
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
              <h3 class="card-title float-left ml-2">
              <button class="float-right btn-sm btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#showModal-xl" data-whatever="Update Student (<?php echo  $student->fname.' '.$student->lname ;?>)" data-url="<?=$new_url?>" >Update Student</button>
                </h3>
              <h3 class="card-title float-right">
                <a href="<?=base_url();?>student-update-master" class="btn btn-danger btn-sm"><i class="fas fa-backward"></i>   Back</a>
                </h3>
              </div>
              <!-- /.card-header -->
             <div class="card-body">
             <div class="col-sm-2 card">
                    <label for="" class="text-center">Student Photo</label>
                    <?php if($student->self_img  !=''){?>
                    <a href="<?php echo IMGS_URL.$student->self_img ;?>" download="<?php echo IMGS_URL.$student->self_img ;?>"><i class="fa-solid fa-download" download></i></a>
                    <?php }else{?>
                      <span><i  class="fa-solid fa-download" download></i></span>
                      <?php }?>
                    <a  data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery" download>
                    <img src="<?php echo IMGS_URL.$student->self_img ;?>" class="img-fluid mb-2 " style="height:150px;width:100%"/>
                    </a>
                    <?php if($student->self_img ==''){?>
                    <button class="float-right btn-sm btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Add Photo" data-url="<?=$add_photo?>" >Add Photo</button>
                    <?php }else{?>
                      <button class="float-right btn-sm btn btn-danger" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Photo" data-url="<?=$add_photo?>" >Update Photo</button>
                    <?php } ;?>
                  </div>
                <table class="table col-12" >
                <tr style="border: 2px solid black;">
                        <td style="border: 2px solid black;">Class :- </td>
                        <td style="border: 2px solid black; "><?=$student->class_name;?></td>
                        <td style="border: 2px solid black;">Section :- </td>
                        <td style="border: 2px solid black; "><?=$student->section_name;?></td>
                    </tr>
                    <tr style="border: 2px solid black;">
                        <td style="border: 2px solid black;">Student ID :- </td>
                        <td style="border: 2px solid black; "><?=$student->stu_id;?></td>
                        <td style="border: 2px solid black;">Enrollment / Sr No. :- </td>
                        <td style="border: 2px solid black;"><?=$student->enrollment;?></td>
                    </tr>
                    <tr style="border: 2px solid black;">
                        <td style="border: 2px solid black;">Roll No :- </td>
                        <td style="border: 2px solid black; "><?=$student->roll_no;?></td>
                        <td style="border: 2px solid black;">Category :- </td>
                        <td style="border: 2px solid black;"><?php foreach($category as $c){ if($c->id==$student->category_id){echo $c->name;} ;};  ?></td>
                    </tr>
                    <tr style="border: 2px solid black;">
                        <td style="border: 2px solid black;">If Concession Applicable :- </td>
                        <td style="border: 2px solid black; "><?php foreach($concession as $c){ $consid=$c->id; if($c->id==$student->concession_id){echo $c->title;} ;}  ?> <?php if($student->concession_id !=0) {;?>of <?php }?> <b><?php foreach($rs as $r){  if($r->id==$student->brother_id){ $subBrotherId=$r->brother_id; echo $r->fname.' '.$r->lname ;
                           ?> <?php if($subBrotherId !=''){echo ',';}else{?>or  <?php }
                           $se = $this->admission_model->Select('student_master', '*', array('brother_id'=>$student->id ,'type'=>'REGISTERED' ));
                           foreach($se as $s)
                           { 
                             $subbrother = $s->id;
                             if($s->gender=='MALE'){echo 'Sister of ' ;}else{ echo 'Brother of ';};echo '<b>'.$s->fname.'  '.$s->lname.'</b>';
                           }
                           $se = $this->admission_model->Select('student_master', '*', array('id'=>$subBrotherId ,'type'=>'REGISTERED' ));
                           foreach($se as $s)
                           { 
                             $subbrother = $s->id;
                             if($s->gender=='MALE'){echo 'Sister of ' ;}else{ echo 'Brother of ';};echo '<b>'.$s->fname.'  '.$s->lname.'</b>';
                           }
                      
                        } 
                        
                    
                         ;};?></b> 
                        <?php 
                        if($student->concession_id !=0)
                        {

                        }else{
                      $se = $this->admission_model->Select('student_master', '*', array('brother_id'=>$student->id ,'type'=>'REGISTERED' ));
                      foreach($se as $s)
                      { 
                        $subbrother = $s->id;
                        if($s->gender=='MALE'){echo 'Brother of ' ;}else{ echo 'Sister of ';};echo '<b>'.$s->fname.'  '.$s->lname.'</b>';
                         ?> or  <?php $se = $this->admission_model->Select('student_master', '*', array('brother_id'=>$subbrother ,'type'=>'REGISTERED' ));
                        foreach($se as $s)
                        { 
                          $subbrother = $s->id;
                          if($s->gender=='MALE'){echo 'Sister of ' ;}else{ echo 'Brother of ';};echo '<b>'.$s->fname.'  '.$s->lname.'</b>';
                        }
                      }}  
                        ;?>
                      
                       </td>
                        <td style="border: 2px solid black;">Full Name :- </td>
                        <td style="border: 2px solid black;"><?=$student->fname.'  '.$student->lname;?></td>
                    </tr>
                    <tr style="border: 2px solid black;">
                        <td style="border: 2px solid black;">Father's Name:- </td>
                        <td style="border: 2px solid black; "><?=$student->father;?></td>
                        <td style="border: 2px solid black;">Mother's Name :- </td>
                        <td style="border: 2px solid black;"><?=$student->mother;?></td>
                    </tr>
                    <tr style="border: 2px solid black;">
                        <td style="border: 2px solid black;">Contact Number :- </td>
                        <td style="border: 2px solid black; "><?=$student->mobile;?></td>
                        <td style="border: 2px solid black;">Father's Number. :- </td>
                        <td style="border: 2px solid black;"><?=$student->father_no;?></td>
                    </tr>
                    <tr style="border: 2px solid black;">
                        <td style="border: 2px solid black;">Email Address:- </td>
                        <td style="border: 2px solid black; "><?=$student->email;?></td>
                        <td style="border: 2px solid black;">D.O.B :- </td>
                        <td style="border: 2px solid black;"><?php 
                                 $excel_date =$student->dob;    
                                 //Convert excel date to mysql db date
                                $unix_date = ($excel_date - 25569) * 86400;
                                $excel_date = 25569 + ($unix_date / 86400);
                                $unix_date = ($excel_date - 25569) * 86400;
                                //Insert below to sql
                                echo $added_date = gmdate("d/m/Y", $unix_date); ?></td>
                    </tr>
                    <tr style="border: 2px solid black;">
                        <td style="border: 2px solid black;">Gender :- </td>
                        <td style="border: 2px solid black; "><?=$student->gender;?></td>
                        <td style="border: 2px solid black;">Aadhaar No :- </td>
                        <td style="border: 2px solid black;"><?=$student->adhaar;?></td>
                    </tr>
                </table>
             </div>
              <div class="card-footer clearfix">
              
              </div>
            </div>
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
  <div class="modal fade text-left" id="showModal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel21" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel21">......</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              
          </div>
          <!-- <div class="modal-footer">
              <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
          </div> -->
      </div>
  </div>
</div>


<div class="modal fade text-left" id="showModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel21" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel21">......</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              
          </div>
          <!-- <div class="modal-footer">
              <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
          </div> -->
      </div>
  </div>
</div>
  
<script>
$('#showModal-xl').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var recipient = button.data('whatever') 
    var data_url  = button.data('url') 
    var modal = $(this)
    $('#showModal-xl .modal-title').text(recipient)
    $('#showModal-xl .modal-body').load(data_url);
})

$('#showModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var recipient = button.data('whatever') 
    var data_url  = button.data('url') 
    var modal = $(this)
    $('#showModal .modal-title').text(recipient)
    $('#showModal .modal-body').load(data_url);
})

$(document).on('click','[data-dismiss="modal"]', function(event) {
    $('#showModal .modal-body').html('');
    $('#showModal .modal-body').text('');
})



</script>