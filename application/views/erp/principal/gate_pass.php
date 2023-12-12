
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
              <li class="breadcrumb-item active">Create Gate Pass</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <hr style="border: 1px solid black;">
        <div class="row">
            <div class="col-md-4">
             <h6>Student Name : <b><?=$student->fname.' '.$student->lname;?></b></h6>  
            </div>
            <div class="col-md-4">
            <h6>Student ID : <b><?=$student->stu_id;?></b></h6> 
            </div>
            <div class="col-md-4">
            <h6>Student SRNo :  <b><?=$student->enrollment;?></b></h6> 
            </div>
            <div class="col-md-4">
            <h6>Father's No : <b><?=$student->section_name;?></b></h6> 
            </div>
            <div class="col-md-4">
            <h6>Father's Name : <b><?=$student->father;?></b></h6> 
            </div>
            <div class="col-md-4">
            <h6>Mother's Name : <b><?=$student->mother;?></b></h6> 
            </div>
           
        </div>
        <hr style="border: 1px solid black;">
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
              <h3 class="card-title float-right">
                <a href="" class="btn btn-sm btn-primary mr-2" data-toggle="modal" data-target="#modal-lg">Create Gate Pass</a>
                <a href="<?=base_url();?>principal-student-gate-pass" class="btn btn-danger btn-sm"><i class="fas fa-backward"></i>   Back</a>
             </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-content collapse show" id="tb">
              <div class="card-body table-responsive p-0 pb-2">
                <table class="table table-hover text-nowrap  table-bordered" id="data-table">
                  <thead>
                  <tr>
                    <th>Sr.No.</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Reason</th>
                    <th>Date</th>
                    <th>Address</th>
                    <th>Created By</th>
                    <th>Approved Status</th>
                    <th>Created BY</th>
                    <th>Action</th>

                  </tr>
                  </thead>  
                  <tbody>
                    <?php $i=0;foreach($rows as $row):  $type = $row->type;?>
                    <tr>
                        <td><?=++$i;?></td>
                        <td><?=$row->stu_id;?></td>
                        <td><?=$row->fname.' '.$row->lname;?></td>
                        <td><?=$row->reason;?></td>
                        <td><?=$row->date;?></td>
                        <td><?=$row->address;?></td>
                        <td><?=$row->type;?></td>
                        <td>
                        <span class="changeStatus" data-toggle="change-status" value="<?=($row->principal_check==1) ? 0 : 1?>" data="<?=$row->id?>,student_gate_pass,id,principal_check" ><i class="<?=($row->principal_check==1) ? 'fa-regular fa-circle-check' : 'fa-solid fa-circle-xmark'?>" title="Click for chenage status" style="color:<?=($row->principal_check==1) ? 'green' :'red'?> "></i></span>
                        </td>
                      <td><?php if($row->type=='teacher'){echo "Teacher";}elseif($row->type=='class_teacher'){echo "Class Teacher";}elseif($row->type=='section_head'){echo "Section Head";}elseif($row->type=='principal'){echo "Principal";}else{echo "Student";} ;?></td>
                        <td>
                       <?php if($row->type=='principal'){ ?>
                      <a href="javascript:void(0)" onclick="_delete(this)" url="<?=$delete_url?><?=$row->id?>" title="Delete" ><i class="fa-solid fa-trash"></i> </a>
                    <?php }else{?>
                        <a style="color:blue" onclick="gatepass()" ><i class="fa-solid fa-trash"></i> </a>
                        <?php }?>
                        </td>
                    </tr>
                   <?php endforeach;?>
                  </tbody>
                </table>
              </div>
                </div>
              <!-- /.card-body -->
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
  <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          <form class="form ajaxsubmit validate-form submit reload-page" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
            <div class="modal-header">
              <h4 class="modal-title"><?=$student->fname.' '.$student->lname;?> ( <?=$student->stu_id;?> )</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-6">
                    <input type="hidden" name="stu_id" id="" value="<?=$student->id;?>">
                    <label for="">Enter Reason</label>
                    <input type="text" name="reason" id="" class="form-control" placeholder="Enter Gate Pass Creation Reason">
                </div>
                <div class="col-6">
                    <label for="">Creation Date</label>
                    <input type="date" name="date" id="" class="form-control" value="<?=date('Y-m-d');?>" readonly>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Create</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <script type="text/javascript">
        function gatepass()
        {
            alert_toastr("error","Sorry you are not deleted this gate pass because gate pass created by <?=$type;?>");
        }
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            reason:"required",
            
        },
        messages: {
            reason:"Enter Gate Pass Creation Reason",
        }
    }); 
});
</script>     