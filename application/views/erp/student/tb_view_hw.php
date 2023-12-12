<div class="card-body table-responsive p-0 pb-2">
                <table class="table table-hover text-nowrap  table-bordered">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Section Name</th>
                    <th>Subject Name</th>
                    <th>Uploaded file</th>
                    <th>Home Work</th>
                    <th>Home Work Date</th>
                    <th>Submit HW</th>
                    <th>Teacher Check</th>
                    <th>Teacher Name</th>
                    <th>Parent Check</th>

                  </tr>
                  </thead>  
                  <tbody>
                <?php $i=$page;foreach($rows as $r){
                     ?>
                  <tr>
                    <td><?=++$i;?></td>
                    <td><?=$r->section_name;?></td>
                    <td><?=$r->sub_name;?></td>
                    <td><a href="<?php echo IMGS_URL.$r->hw_file ;?>" target="_blank"><i class="fa fa-download" style="color:blue"></i></a></td>
                    <td><?=$r->home_work;?></td>
                    <td><?php  $d = date_create($r->hw_date);   echo date_format($d,"j F\, Y"); ;?></td>
                    <td> 
                      <?php   $count = $this->student_model->Counter('stu_hw_submit', array('hw_id'=>$r->id,'sec_id'=>$r->sec_id,'hw_submit_date'=>date('Y-m-d'),'is_deleted'=>'NOT_DELETED','status'=>'1'));
                       if($count==0){?>
                      <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Submit Home Work :-<?=$r->section_name?> ( <?=$r->sub_name?> )" data-url="<?=$submit_url?><?=$r->id?>" title="Update" class="btn btn-sm btn-primary">
                    Submit Home Work
                       </a>
                       <?php }else{?>
                        <a  class="btn btn-sm btn-warning " onClick="hw()">Already Submitted</a>
                       <?php }?>
                     </td>
                      <td>
                      <?php $count1 = $this->erp_model->Counter('stu_hw_submit', array('student_id'=>$_SESSION['MUserId'],'hw_submit_date'=>$r->hw_date));
                      if($count1==1){?>
                      <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-lg<?=$i;?>">Checked</a>
                      <?php }else{?>
                        <a class="btn btn-sm btn-primary" >Not Checked</a>
                      <?php };?>
                    </td>
                    <td><?=$r->tea_name;?></td>
                     <td><input type="checkbox" id="check" value="1" style="width:20px;height: 20px;" onclick="check('1')" <?php if ($r->parent_status==1){echo "checked";} {
                       // code...
                     } ;?>>
                      <input type="hidden" id="student_id" value="<?=$_SESSION['MUserId'];?>">
                      <input type="hidden" id="hw_date" value="<?=$r->hw_date;?>"></td>
                  </tr>
                      <div class="modal fade closebtn" id="modal-lg<?=$i;?>">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title"><?=$r->fname.' '.$r->lname;?> ( <?=$r->stu_id;?> )</h4>
                      
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="row pt-3 pb-3">
                        <div class="col-md-12">
                          <textarea name="remark" id="" class="form-control" placeholder="Enter Remark" readonly><?=$r->teacher_check;?></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
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
        function hw()
      {
     
        alert_toastr("error","Sorry!! You are already submitted home work ");
      }
      function check(check) {
        var student_id = $('#student_id').val();
        var hw_date = $('#hw_date').val();
          $.ajax({
                url: '<?=base_url('student-home-work/parent-check');?>',
                type: 'POST',
                data: {check:check,hw_date:hw_date,student_id:student_id},
                success: function(data){
                    console.log(data);
                    data = JSON.parse(data);
                    $('.'+data.res).html(data.msg);
                    if (data.res=='success') {
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        
                    }
                    if (data.errors) {
                        $.each(data.errors,function(key,value){
                            $this.find(`[name="${key}"]`).parents(`.form-group`).find(`.error`).text(value);
                        })
                    }
                    alert_toastr(data.res,data.msg);
                }
                
            })
      }
    </script>