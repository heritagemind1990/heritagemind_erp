<div class="card-body table-responsive p-0 pb-2">
                <table class="table table-hover text-nowrap  table-bordered">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Class</th>
                    <th>Section</th>
                    <th>Father's Name</th>
                    <th>Father's No</th>
                    <th>Address</th>
                    <th>Leave Date</th>
                    <th>Reason</th>
                    <th>Approved Status</th>
                    <th>Approved Remark</th>
                    <th>Approved By</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php $i=$page;foreach($rows as $r){?>
                  <tr>
                    <td><?=++$i;?></td>
                    <td><?=$r->stu_id;?></td>
                    <td><?=$r->fname.' '.$r->lname;?></td>
                    <td><?=$r->class_name;?></td>
                    <td><?=$r->section_name;?></td>
                    <td><?=$r->father;?></td>
                    <td><?=$r->father_no;?></td>
                    <td><?=$r->address;?></td>
                    <td><?php  $d = date_create($r->leave_date);   echo date_format($d,"j F\, Y"); ;?></td>
                    <td><?=$r->reason;?></td>
                    <td><?php if($r->approval_status=='APPROVED'){echo '<button class="btn btn-sm btn-success">APPROVED</button>';}elseif($r->approval_status=='PENDING'){echo '<button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#exampleModal'.$i.'">PENDING</button>';}elseif($r->approval_status=='REJECTED'){echo '<button class="btn btn-sm btn-danger">REJECTED</button>';} ;?></td>
                    <td><?=$r->approved_remark;?></td>
                    <td><?=$r->teacher_name;?></td>
                  </tr>
                    <div class="modal fade" id="exampleModal<?=$i;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <form class="form ajaxsubmit validate-form submit reload-tb" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><?=$r->fname.' '.$r->lname;?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="leave_id" value="<?=$r->id;?>">
                                <div class="form-group">
                                    <label for="">Select Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="PENDING" <?php if($r->approval_status=='PENDING'){echo "selected";} ;?> >PENDING</option>
                                        <option value="APPROVED"   <?php if($r->approval_status=='APPROVED'){echo "selected";} ;?> >APPROVED</option>
                                        <option value="REJECTED"  <?php if($r->approval_status=='REJECTED'){echo "selected";} ;?> >REJECTED</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 remarks" style="display: none;">
                                <div class="form-group">
                                    <label for="">Enter Remark</label>
                                    <textarea name="remark" class="form-control remark"></textarea>
                                </div>
                            </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                            <button id="btnsubmit" type="submit" class="btn btn-primary btn-sm waves-light" ><i id="loader" class=""></i>Update</button>
                        </div>
                        </form>
                        </div>
                    </div>
                    </div>
                  <?php }?>
                  </tbody>
                </table>
              </div>
                       <div class="row pb-3 pl-2 pr-2 ">
        <div class="col-md-6 text-left ">
            <span>Showing <?= (@$rows) ? $page+1 : 0 ?> to <?=$i?> of <?=$total_rows?> entries</span>
        </div>
        <div class="col-md-6 text-right ">
            <?=$links?>
        </div>
    </div>

    <script>
        $('select').on('change', function() {
        var status = ( this.value );
        if(status=='REJECTED'){
            $(".remarks").show();
        }else
        {
            $(".remarks").hide(); 
        }
         });
         
    </script>