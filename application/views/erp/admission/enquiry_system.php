
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
              <h3 class="card-title float-left">
               <b><u>Enquiry :-</u></b> Approve / Rejected / OnHold
                </h3>
                <h3 class="card-title float-right">
                <a href="<?=base_url();?>enquiry-total" class="btn btn-danger"><i class="fas fa-backward"></i>   Back</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                     <tr>
                        <th>Sr.No.</th>
                        <th>Standard / Class</th>
                        <th>Full Name.</th>
                        <th>Father's Name</th>
                        <th>Mother's Name</th>
                        <th>Father's No.</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $i=1;foreach($classdata as $data){?>
                    <tr>
                        <td><?=$i;?>.</td>
                        <td><?=$data->class;?></td>
                        <td><?=$data->fname.''.$data->lname;?></td>
                        <td><?=$data->father;?></td>
                        <td><?=$data->mother;?></td>
                        <td><?=$data->father_no;?></td>
                        <td><?=$data->address;?></td>
                        <td><button class="btn btn-danger btn-sm"><?=$data->type;?></button></td>
                        <td>
                        <button class="btn btn-success" onclick="return display_details(<?php echo $data->id; ?>, '<?php echo base_url('enquiry-master/student-approve') ?>')">Approve</button><br>
                        <button class="btn btn-warning btn-sm mt-1" data-toggle="modal" data-target="#exampleModal1<?php echo $i;?>"><b> On hold / Reject</b></button><br>
          
                        <div class="modal fade" id="exampleModal1<?php echo $i;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">On Hold / Rejected</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                               <table class="table table-striped bg-info">
                                
                                 <tr>
                                    <th>Full Name</th>
                                    <td><?=$data->fname.'    '.$data->lname;?></td>
                                 </tr>
                                 <tr>
                                    <th>Current Status</th>
                                    <td><?=$data->type;?></td>
                                 </tr>
                               </table>
                               <form class="form ajaxsubmit validate-form submit reload-page" action="<?=base_url('enquiry-master/student_status');?>" method="post" enctype="multipart/form-data" >
                               <div class="row">
                                <input type="hidden" name="student_id" id="" value="<?=$data->id;?>">
                                    <div class="col-md-12">
                                        <label for="">Select Status</label>
                                        <select id="status" name="status" class="form-control" onchange="return toggleCommentBox(this.value);">
                                        <option value="">Select Status</option>
                                        <?php
                                        $statusArr = ['ONHOLD', 'REJECTED'];
                                        foreach ($statusArr as $status) {
                                            echo '<option value="' . $status . '" ' . ($status == $data->type ? "selected" : "") . '>' . $status . '</option>';
                                        }
                                        ?>
                                    </select>
                                    </div>
                                    <div class="form-group col-md-12 <?php echo $data->type == 'ONHOLD' ? '' : 'd-none'  ?> <?php echo $data->type == 'REJECTED' ? '' : 'd-none'  ?>" id="rejected_comment_div">
                                    <label for="rejected_comment">Remark</label>
                                    <textarea id="rejected_comment" name="remark" class="form-control"><?php echo $data->remark; ?></textarea>
                                </div>
                                </div>
                               
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="sunmit" class="btn btn-primary">Update</button>
                            </div>
                            </form>
                            </div>
                        </div>
                        </div>
                        </td>
                    </tr>
                    <?php $i++;}?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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
  <div id="modal-div"></div>
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
     function toggleCommentBox(status) {
        if(status == 'REJECTED' || status == 'ONHOLD') {
            $('#rejected_comment_div').removeClass('d-none');
        } else {
            $('#rejected_comment_div').addClass('d-none');
        }
    }
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
