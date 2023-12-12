
<div class="card-body table-responsive p-0 pb-2 pt-4">
                <table class="table table-hover text-nowrap  table-bordered" id="tbl_exporttable_to_xls">
                  <thead>
                  <tr>
                    <th>Sr.No.</th>
                    <th>Student ID</th>
                    <th>Enrollment</th>
                    <th>Section </th>
                    <th>Student Name</th>
                    <th>Roll No</th>
                    <th>Father</th>
                    <th>Mother</th>
                    <th>Address</th>
                    <th>Fee Status</th>
                  </tr>
                  </thead>  
                  <tbody>
                <?php //echo $retrieved_ids;
                 $i=1;foreach($rows as $r){?>
                  <tr>
                    <td><?=$i;?></td>
                    <td><?=$r->stu_id;?></td>
                    <td><?=$r->enrollment;?></td>
                    <td><?=$r->section_name;?></td>
                    <td><?=$r->fname;?> <?=$r->lname;?></td>
                    <td><?=$r->roll_no;?></td>
                    <td><?=$r->father;?></td>
                    <td><?=$r->mother;?></td>
                    <td><?=$r->address;?></td>
                    <td><p class="text-danger">Unpaid</p></td>
                  </tr>
                  <?php $i++; }?>
                  </tbody>
                </table>
              </div>