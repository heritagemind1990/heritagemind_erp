<div class="card-body table-responsive p-0 pb-2">
                <table class="table table-hover text-nowrap  table-bordered">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Events Name</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Total Days</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>  
                  <tbody>
                <?php $i=$page;foreach($rows as $r){
                        $date1 = new DateTime($r->from_date);
                        $date2 = new DateTime($r->to_date);
                        $interval = $date1->diff($date2);
                        $todaydays= $interval->days;
                     ?>
                  <tr>
                    <td><?=++$i;?></td>
                    <td><?=$r->events_name;?></td>
                    <td><?=$r->from_date;?></td>
                    <td><?=$r->to_date;?></td>
                    <td><?php if($todaydays==0){echo "1";}else{ echo $todaydays;}?> Days</td>
                    <td> <span class="changeStatus" data-toggle="change-status" value="<?=($r->status==1) ? 0 : 1?>" data="<?=$r->id?>,holiday_master,id,status" ><i class="<?=($r->status==1) ? 'fa-regular fa-circle-check' : 'fa-solid fa-circle-xmark'?>" title="Click for chenage status" style="color:<?=($r->status==1) ? 'green' :'red'?> "></i></span>
                    </td>
                    <td>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update  ( Holiday :-<?=$r->events_name?>)" data-url="<?=$update_url?><?=$r->id?>" title="Update">
                    <i class="fa fa-edit"></i>
                       </a>&nbsp;&nbsp;
                    <a href="javascript:void(0)" onclick="_delete(this)" url="<?=$delete_url?><?=$r->id?>" title="Delete" ><i class="fa-solid fa-trash"></i> </a>&nbsp;
                   
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