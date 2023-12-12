<div class="card-body table-responsive p-0 pb-2">
                <table class="table table-hover text-nowrap  table-bordered">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Title</th>
                    <th>Valid From</th>
                    <th>Valid Up To</th>
                    <th>Type</th>
                    <th>File</th>
                  </tr>
                  </thead>
                  <tbody>
                <?php $i=$page;foreach($rows as $r){?>
                  <tr>
                    <td><?=++$i;?></td>
                    <td><?=$r->title;?></td>
                    <td><?php  $d = date_create($r->from_date);   echo date_format($d,"j F\, Y"); ;?></td>
                    <td><?php  $d = date_create($r->to_date);   echo date_format($d,"j F\, Y"); ;?></td>
                    <td><?=$r->notice_type;?></td>
                    <td><a href="<?php echo IMGS_URL.$r->notice_doc ;?>" target="_blank"><i class="fa fa-download" style="color:blue"></i></a></td>
                    
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