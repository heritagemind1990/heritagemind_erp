<div class="card-body table-responsive p-0 pb-2">
                <table class="table table-hover text-nowrap  table-bordered">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Section Name</th>
                    <th>Subject Name</th>
                    <th>Uploaded file</th>
                    <th>Uploaded Date</th>
                  </tr>
                  </thead>  
                  <tbody>
                <?php $i=$page;foreach($rows as $r){
                     ?>
                  <tr>
                    <td><?=++$i;?></td>
                    <td><?=$r->section_name;?></td>
                    <td><?=$r->sub_name;?></td>
                    <td><a href="<?php echo IMGS_URL.$r->file ;?>" target="_blank"><i class="fa fa-download" style="color:blue"></i></a></td>
                    <td><?php  $d = date_create($r->date);   echo date_format($d,"j F\, Y"); ;?></td>
                  
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