<div class="card-body table-responsive p-0 pb-2">
                <table class="table table-hover text-nowrap  table-bordered">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Section Name</th>
                    <th>Subject Name</th>
                    <th colspan="2" class="text-center">Action</th>
                  </tr>
                  </thead>  
                  <tbody>
                <?php $i=$page;foreach($rows as $r){
                     ?>
                  <tr>
                    <td><?=++$i;?></td>
                    <td><?=$r->section_name;?></td>
                    <td><?=$r->sub_name;?></td>
                 
                     <td>
                      <?php
                       $count = $this->erp_model->Counter('t_student_hw', array('sst_id'=>$r->id,'sub_id'=>$r->sub_id,'hw_date'=>date('Y-m-d'),'is_deleted'=>'NOT_DELETED','status'=>'1'));
                       ;
                       if($count==0){
                       ?>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Upload   Notes :-<?=$r->section_name?> ( <?=$r->sub_name?> )" data-url="<?=$new_url?><?=$r->id?>" title="Update" class="btn btn-sm btn-primary">
                    Upload Here..
                       </a>
                   <?php }else{?>
                    <a  class="btn btn-sm btn-success" onClick="notes()">
                    Already Uploaded
                       </a>
                    <?php }?>
                    </td>
                    <td>
                     <?php if($count==1){ ;?>   
                    <a  class="btn btn-sm btn-warning " href="<?=base_url();?>class-teacher-upload-hw/view_hw/<?=$r->id;?>">View Home Work</a>
                     <?php }else{?>
                        <a  class="btn btn-sm btn-warning " onClick="hw()">View Home Work</a>
                        <?php }?>
                   </td>
                  </tr>
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
      function notes()
      {
     
        alert_toastr("error","Today already uploaded this subject Home work");
      }
      function hw()
      {
     
        alert_toastr("error","Sorry Home WorK Not Uploaded");
      }
    </script>