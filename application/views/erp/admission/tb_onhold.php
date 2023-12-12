<div class="card-body table-responsive p-0 pb-5">
                <table class="table table-hover text-nowrap  table-bordered">
                  <thead>
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
                  </thead>
                  <tbody>
                  <?php $i=$page;foreach($rows as $data){?>
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
                               <form class="form ajaxsubmit validate-form submit reload-page" action="<?=base_url('hold-student/student_status');?>" method="post" enctype="multipart/form-data" >
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
              <div class="row pb-3 pl-2 pr-2 pt-2">
        <div class="col-md-6 text-left ">
            <span>Showing <?= (@$rows) ? $page+1 : 0 ?> to <?=$i?> of <?=$total_rows?> entries</span>
        </div>
        <div class="col-md-6 text-right ">
            <?=$links?>
        </div>
    </div>