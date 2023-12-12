<div class="card-body table-responsive p-0 pb-5">
                <table class="table table-hover text-nowrap  table-bordered">
                  <thead>
                  <tr>
                    <th>Sr.No</th>
                    <th>Standard / Class</th>
                    <th>Full Name</th>
                    <th>Father's Name</th>
                    <th>Mother's Name</th>
                    <th>Address</th>
                    <th>D.O.B</th>
                    <th>Rejected Remark</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $i=$page;foreach($rows as $r){?>
                  <tr>
                    <td><?=$i;?></td>
                    <td><?=$r->class_name;?></td>
                    <td><?=$r->fname;?>  <?=$r->lname;?></td>
                    <td><?=$r->father;?></td>
                    <td><?=$r->mother;?></td>
                    <td><?=$r->address;?></td>
                    <td><?php 
                                 $excel_date =$r->dob;    
                                 //Convert excel date to mysql db date
                                $unix_date = ($excel_date - 25569) * 86400;
                                $excel_date = 25569 + ($unix_date / 86400);
                                $unix_date = ($excel_date - 25569) * 86400;
                                //Insert below to sql
                                echo $added_date = gmdate("d/m/Y", $unix_date); ?></td>
                    <td><?=$r->remark;?></td> 
                    <td><button class="btn btn-danger btn-sm"> <?=$r->type;?></button></td>           
                  </tr>
                  <?php $i++ ;}?>
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