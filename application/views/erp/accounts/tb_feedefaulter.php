               <div class="card-body table-responsive p-0 pb-2">
                <table class="table table-hover text-nowrap  table-bordered" id="tbl_exporttable_to_xls">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Student ID</th>
                    <th>SRNO</th>
                    <th>Student Name</th>
                    <th>Father's Name</th>
                    <th>Father's No.</th>
                    <th>Address</th>
                    <!-- <th>Month</th> -->
                    <th  style="width:150px;">Monthly Fee Status</th>
                  </tr>
                  </thead>  
                  <tbody>
                <?php $i=$page;foreach($rows as $r){
                   
                    ?>
                  <tr>
                    <td><?=++$i;?></td>
                    <td><?=$r->stu_id;?></td>
                    <td><?=$r->enrollment;?></td>
                    <td><?=$r->fname.' '.$r->lname;?></td>
                    <td><?=$r->father;?></td>
                    <td><?=$r->mother;?></td>
                    <td><?=$r->address;?></td>
                    <!-- <td><?php // echo  $month_name = date("F", mktime(0, 0, 0, $month, 10));;?></td> -->
                   <?php  
                      $feestatus = $this->accounts_model->getfeestatus($r->id);
                    ?>
                    <td style="width:150px;"><?php if(!empty($feestatus)){ echo "<span class='text-success'><b>Paid this month : </b>  "; foreach($feestatus as $status): echo $status->qmonthname;endforeach;'</span>';}else{echo "<span class='text-danger'> Not Paid Any Month</span>";} ?></td>
                  </tr>
                 
                  <?php  }?>
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