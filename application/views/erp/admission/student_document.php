<div class="content-wrapper pt-4 pb-5">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?=$title;?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?=$title;?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card ">
              <div class="card-header">
              <h4 class="card-title float-left">
                Name :- <?=$student->fname.' '.$student->lname;?>
                </h4>
                <h4 class="card-title float-left ml-5">
                Student ID:- <?=$student->stu_id;?>
                </h4>
                <h3 class="card-title float-right">
                <a href="<?=base_url();?>student-document-master" class="btn btn-danger btn-sm"><i class="fas fa-backward"></i>   Back</a>
                </h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-2 card">
                    <label for="" class="text-center">Student Photo</label>
                    <?php if($student->self_img  !=''){?>
                    <a href="<?php echo IMGS_URL.$student->self_img ;?>" download="<?php echo IMGS_URL.$student->self_img ;?>"><i class="fa-solid fa-download" download></i></a>
                    <?php }else{?>
                      <span><i  class="fa-solid fa-download" download></i></span>
                      <?php }?>
                    <a  data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery" download>
                    <img src="<?php echo IMGS_URL.$student->self_img ;?>" class="img-fluid mb-2 " style="height:200px;width:100%"/>
                    </a>
                    <?php if($student->self_img ==''){?>
                    <button class="float-right btn-sm btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Add Photo" data-url="<?=$add_photo?>" >Add Photo</button>
                    <?php }else{?>
                      <button class="float-right btn-sm btn btn-danger" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Photo" data-url="<?=$add_photo?>" >Update Photo</button>
                    <?php } ;?>
                  </div>
                  <div class="col-sm-2 card">
                  <label for=""  class="text-center">Student Aadhaar</label>
                  <?php if($student->doc_id  !=''){?>
                  <a href="<?php echo IMGS_URL.$student->doc_id ;?>" download="<?php echo IMGS_URL.$student->doc_id ;?>"><i class="fa-solid fa-download" download></i></a>
                  <?php }else{?>
                    <span><i  class="fa-solid fa-download" download></i></span>
                      <?php }?>
                    <a  data-toggle="lightbox" data-title="sample 2 - black" data-gallery="gallery">
                    <img src="<?php echo IMGS_URL.$student->doc_id ;?>" class="img-fluid mb-2" style="height:200px;width:100%"/>
                    </a>
                    <?php if($student->doc_id=='')
                    {?>
                    <button class="float-right btn-sm btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Add Student Aadhaar" data-url="<?=$student_aadhaar?>" >Add student Aadhaar</button>
                    <?php }else{?>
                      <button class="float-right btn-sm btn btn-danger" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Student Aadhaar" data-url="<?=$student_aadhaar?>" >Update student Aadhaar</button>
                    <?php }?>
                  </div>
                  <div class="col-sm-2 card">
                  <label for=""  class="text-center">Student Birth Certificate</label>
                  <?php if($student->birth_certificate  !=''){?>
                  <a href="<?php echo IMGS_URL.$student->birth_certificate ;?>" download="<?php echo IMGS_URL.$student->birth_certificate ;?>"><i class="fa-solid fa-download" download></i></a>
                  <?php }else{?>
                    <span><i  class="fa-solid fa-download" download></i></span>
                      <?php }?>
                    <a  data-toggle="lightbox" data-title="sample 3 - red" data-gallery="gallery">
                      <img src="<?php echo IMGS_URL.$student->birth_certificate ;?>" class="img-fluid mb-2" style="height:200px;width:100%"/>
                    </a>
                    <?php if($student->birth_certificate=='')
                    {?>
                    <button class="float-right btn-sm btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Add Birth Certificate" data-url="<?=$birth_certificate?>" >Add Birth Certificate</button>
                    <?php }else{?>
                      <button class="float-right btn-sm btn btn-danger" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Birth Certificate" data-url="<?=$birth_certificate?>" >Update Birth Certificate</button>
                      <?php }?>
                  </div>
                  <div class="col-sm-2 card">
                  <label for=""  class="text-center">Student TC</label>
                  <?php if($student->tc  !=''){?>
                  <a href="<?php echo IMGS_URL.$student->tc ;?>" download="<?php echo IMGS_URL.$student->tc ;?>"><i class="fa-solid fa-download" download></i></a>
                  <?php }else{?>
                    <span><i  class="fa-solid fa-download" download></i></span>
                      <?php }?>
                    <a data-toggle="lightbox" data-title="sample 4 - red" data-gallery="gallery">
                      <img src="<?php echo IMGS_URL.$student->tc ;?>" class="img-fluid mb-2" style="height:200px;width:100%"/>
                    </a>
                    <?php if($student->tc=='')
                    {?>
                    <button class="float-right btn-sm btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Add TC" data-url="<?=$tc_url;?>" >Add TC</button>
                    <?php }else{?>
                      <button class="float-right btn-sm btn btn-danger" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update TC" data-url="<?=$tc_url?>" >Update TC</button>
                      <?php }?>
                  </div>
                  <div class="col-sm-2 card">
                  <label for=""  class="text-center">Student Report Card</label>
                  <?php if($student->report_card  !=''){?>
                  <a href="<?php echo IMGS_URL.$student->report_card ;?>" download="<?php echo IMGS_URL.$student->report_card ;?>"><i class="fa-solid fa-download" download></i></a>
                  <?php }else{?>
                    <span><i  class="fa-solid fa-download" download></i></span>
                      <?php }?>
                    <a  data-toggle="lightbox" data-title="sample 5 - black" data-gallery="gallery">
                      <img src="<?php echo IMGS_URL.$student->report_card ;?>" class="img-fluid mb-2" style="height:200px;width:100%"/>
                    </a>
                    <?php if($student->report_card=='')
                    {?>
                    <button class="float-right btn-sm btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Add Report Card" data-url="<?=$report_card?>" >Add Report Card</button>
                    <?php }else{?>
                      <button class="float-right btn-sm btn btn-danger" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Report Card" data-url="<?=$report_card?>" >Update Report Card</button>
                      <?php }?>
                  </div>
                  <div class="col-sm-2 card">
                  <label for=""  class="text-center">Student Parent's Aadhaar</label>
                  <?php if($student->parent_aadhaar_file  !=''){?>
                  <a href="<?php echo IMGS_URL.$student->parent_aadhaar_file ;?>" download="<?php echo IMGS_URL.$student->parent_aadhaar_file ;?>"><i class="fa-solid fa-download" download></i></a>
                  <?php }else{?>
                    <span><i  class="fa-solid fa-download" download></i></span>
                      <?php }?>
                    <a  data-toggle="lightbox" data-title="sample 6 - white" data-gallery="gallery">
                      <img src="<?php echo IMGS_URL.$student->parent_aadhaar_file ;?>"  class="img-fluid mb-2" style="height:200px;width:100%"/>
                    </a>
                    <?php if($student->report_card=='')
                    {?>
                    <button class="float-right btn-sm btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Add Parent's Aadhaar" data-url="<?=$parent_aadhaar?>" >Add Parent's Aadhaar</button>
                    <?php }else{?>
                      <button class="float-right btn-sm btn btn-danger" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Parent's Aadhaar" data-url="<?=$parent_aadhaar?>" >Update Parent's Aadhaar</button>
                   <?php  }?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
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