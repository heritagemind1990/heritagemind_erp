
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
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
                <div class="row ml-4 mb-3">
                  
                <h3 class="card-title float-left">
                <button class="float-right btn btn-primary btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Add <?=$title;?>" data-url="<?=$new_url?>" >Add Section</button>
                </h3>
                <h3 class="card-title float-right ml-2">
                <a href="<?=base_url();?>academic-data" class="btn btn-danger btn-sm"><i class="fas fa-backward"></i>   Back</a>
                </h3>
               
              </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
      <div class="col-12">
      <h4> <b>Standard List</b></h4>
            <div class="card">
           
              <!-- /.card-header -->
              <!-- <div class="container"> -->
           
              <?php $q=1;foreach($rs as $r){?>
              <div class=" mb-5">
               <div class="card-header">
              <div class="row"> 
              <div class="col-md-6"> 
              <h5 style="text:align:left"><b><?php //$q;?> :-  Standard Name:- <?php  echo $r->class_name ; ?> </b></h5></div>
                <div class="col-md-6"> 
              <h5 style="text:align:right"><b> Total Student :-  <?php  echo $r->no_of_seat ; ?> </b></h5> 
              </div></div>
              </div>
              <div class="card-body table-responsive p-0 pb-2">
                <table class="table table-hover text-nowrap  table-bordered">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Class / Standard </th>
                    <th>Section Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>  
                  <tbody>
                <?php 
                 $se = $this->academic_model->Select('section_master', '*', array( 'class_id'=>$r->id ,'is_deleted'=>'NOT_DELETED'  ));
                  $i=1;foreach($se as $s){?>
                  <tr>
                    <td><?=$i;?></td>
                    <td><?=$r->class_name;?></td>
                    <td><?=$s->section_name;?></td>
                    <td> <span class="changeStatus" data-toggle="change-status" value="<?=($s->status==1) ? 0 : 1?>" data="<?=$s->id?>,section_master,id,status" ><i class="<?=($s->status==1) ? 'fa-regular fa-circle-check' : 'fa-solid fa-circle-xmark'?>" title="Click for chenage status" style="color:<?=($s->status==1) ? 'green' :'red'?> "></i></span>
                    </td> <td>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update  ( Section :-<?=$s->section_name?>)" data-url="<?=$update_url?><?=$s->id?>" title="Update">
                    <i class="fa fa-edit"></i>
                       </a>&nbsp;&nbsp;
                    <a href="javascript:void(0)" onclick="_delete(this)" url="<?=$delete_url?><?=$s->id?>" title="Delete" ><i class="fa-solid fa-trash"></i> </a>&nbsp;
                   
                   </td>
                  </tr>
                  <?php $i++;}?>
                  </tbody>
                </table>
              </div>
              </div>
              <?php $q++ ;}?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
      <!-- </div> -->
      </div><!-- /.container-fluid -->
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