<div class="card-body table-responsive pb-5">
                <table class="table table-hover text-nowrap  table-bordered">
                  <thead>
                  <tr>
                    <th>Sr.No</th>
                    <th>Student ID</th>
                    <th>Enrollment/Sr No.</th>
                    <th>Section</th>
                    <th>Student Name</th>
                    <th>Father's Name</th>
                    <th>Mother's Name</th>
                    <th>Father's No.</th>
                    <th>D.O.B</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i=$page;foreach($rows as $s){?>
                  <tr>
                    <td><?=++$i;?></td>
                    <td><?=$s->stu_id;?></td>
                    <td><?=$s->enrollment;?></td>
                    <td><?=$s->section_name;?></td>
                    <td><?php echo $s->fname.' '.$s->lname;?></td>
                    <td><?=$s->father;?></td>
                    <td><?=$s->mother;?></td>
                    <td><?=$s->father_no;?></td>
                    <td><?php 
                   $excel_date =$s->dob;    
                   //Convert excel date to mysql db date
                  $unix_date = ($excel_date - 25569) * 86400;
                  $excel_date = 25569 + ($unix_date / 86400);
                  $unix_date = ($excel_date - 25569) * 86400;
                  //Insert below to sql
                  echo $added_date = gmdate("d/m/Y", $unix_date); ?></td>
                    <td> <button class="btn btn-danger btn-sm" onclick="return display_details(<?php echo $s->id; ?>, '<?php echo base_url('view-register-student/view-more') ?>')">View More</button></td>
                  </tr>
                  <?php };?>
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