<div class="card-body table-responsive p-0 pb-2">
                <table class="table table-hover text-nowrap  table-bordered">
                  <thead>
                    <tr>
                      <th>Sr.No.</th>
                      <th>Student ID</th>
                      <th>Enrollment / Sr No.</th>
                      <th>Section</th>
                      <th>Name</th>
                      <th>Father's Name</th>
                      <th>Mother's Name</th>
                      <th>Farher's No.</th>
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
                      <td><?php echo $s->fname.'  '.$s->lname;?></td>
                      <td><?=$s->father;?></td>
                      <td><?=$s->mother;?></td>
                      <td><?=$s->father_no;?></td>
                      <td><a href="<?=base_url('student-update-master/update/'.$s->id);?>" class="btn btn-primary btn-sm">Update </a></td>
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