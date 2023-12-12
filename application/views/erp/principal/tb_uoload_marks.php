<div class="card-body table-responsive p-0 pb-2">
                <table class="table table-hover text-nowrap  table-bordered">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Section Name</th>
                    <th>Teacher Name</th>
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
                    <td><?=$r->teacher_name;?></td>
                    <td><?=$r->sub_name;?></td>
                     <td>
                    <a  class="btn btn-sm btn-success" href="<?=base_url('principal-student-marks-upload/marks_upload/'.$r->id);?>">
                    Upload Here..
                       </a>
                    </td>
                    <td> 
                    <a  class="btn btn-sm btn-warning " href="<?=base_url();?>principal-student-marks-upload/view_marks/<?=$r->id;?>">View Marks</a>
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
      function hw()
      {
     
        alert_toastr("error","Sorry This Subject Marks Not Uploaded");
      }
    </script>