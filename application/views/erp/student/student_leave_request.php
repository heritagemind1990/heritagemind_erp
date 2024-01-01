
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
              <li class="breadcrumb-item"><a href="<?=base_url();?>student-dashboard">Student</a></li>
              <li class="breadcrumb-item active"><?=$title;?></li>
            </ol>
          </div><!-- /.col -->
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content datas">
      <div class="container-fluid">
      <div class="row">
      <div class="col-11">
      </div>
      <div class="col-1 mb-2">
      <a href="<?=base_url();?>student-dashboard" class="btn btn-danger btn-sm"><i class="fas fa-backward"></i>   Back</a>
     </div>
     <!-- Title Media and Actions Card -->
     <div class="col-4">
        <div class="card pmd-card">
            <div class="card-body d-flex flex-row">
                <div class="media-body">
                    <h4 class="card-subtitle">Student Details</h4>
                    <hr style="margin-top: -0.1rem;border:1px solid green">
                      <span>Name :- <b><?=$student->fname.' '.$student->lname;?></b></span><br>
                      <span>Class :- <b><?=$student->class_name;?></b></span><br>
                      <span>Section :- <b><?=$student->section_name;?></b></span><br>
                      <span>Address :- <b><?=$student->address;?></b></span>
                </div>
                <img class="ml-3 mt-4" src="<?=IMGS_URL.$student->self_img;?>"  onerror="this.src='<?=base_url('assets/users/');?>noimg.png';"  width="80" height="80">
            </div>
        </div>
     </div>
     <div class="col-8">
        <div class="card pmd-card">
             <div class="card-body d-flex flex-row">
                <div class="media-body">
                    <h4 class="card-subtitle mb-5 ">  <button class="btn btn-sm btn-primary float-right" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Apply for Leave ( <?=$_SESSION['MName'];?> )" data-url="<?=$new_url?>" >Apply for Leave</button></h4>
                    <hr style="margin-top: -0.1rem;border:1px solid green">
                    <div class="card-body table-responsive p-0 pb-2">
                <table class="table table-hover text-nowrap  table-bordered">
                  <thead>
                  <tr>
                    <th>Leave Date</th>
                    <th>Reason</th>
                    <th>Approved Status</th>
                    <th>Approved Remark</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($leave as $l):?>
                  <tr>
                    <td><?=_date($l->leave_date);?></td>
                    <td><?=$l->reason;?></td>
                    <td><?php if($l->approval_status=='APPROVED'){echo '<button class="btn btn-sm btn-success">APPROVED</button>';}elseif($l->approval_status=='PENDING'){echo '<button class="btn btn-sm btn-warning">PENDING</button>';}elseif($l->approval_status=='REJECTED'){echo '<button class="btn btn-sm btn-danger">REJECTED</button>';} ;?></td>
                    <td><?=$l->approved_remark;?></td>
                  </tr>
                  <?php endforeach;?>
                  </tbody>
                </table>
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