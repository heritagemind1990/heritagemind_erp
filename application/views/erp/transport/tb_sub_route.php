<div class="card-body table-responsive p-0 pb-2">
                <table class="table table-hover text-nowrap  table-bordered">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Route</th>
                    <th>Pick Up Point</th>
                    <th>Drop off Point</th>
                    <th>Pick Up Time</th>
                    <th>Vehicle Stop time</th>
                    <th>Fees in Month</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i=$page;foreach($rows as $t){?>
                  <tr>
                    <td><?=++$i;?></td>
                    <td><?=$t->start_route.' - '.$t->end_route;?></td>
                    <td><?=$t->pick_up;?></td>
                    <td><?=$t->drop_off;?></td>
                    <td><?=$t->pick_up_time;?></td>
                    <td><?=$t->stop_time;?> Min</td>
                    <td><?=$t->fees;?></td>
                       <td class="text-center">
                       <span class="changeStatus" data-toggle="change-status" value="<?=($t->status==1) ? 0 : 1?>" data="<?=$t->id?>,transport_sub_route,id,status" ><i class="<?=($t->status==1) ? 'fa-regular fa-circle-check' : 'fa-solid fa-circle-xmark'?>" title="Click for chenage status" style="color:<?=($t->status==1) ? 'green' :'red'?> "></i></span>
                   </td>
                    <td>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Sub Route Map (<?=$t->start_route.' - '.$t->end_route;?>)" data-url="<?=$update_url?><?=$t->id?>" title="Update">
                    <i class="fa-solid fa-pen-to-square"></i>
                       </a>&nbsp;
                    <a href="javascript:void(0)" onclick="_delete(this)" url="<?=$delete_url?><?=$t->id?>" title="Delete" ><i class="fa-solid fa-trash"></i> </a>&nbsp;
                 
                      </td>
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