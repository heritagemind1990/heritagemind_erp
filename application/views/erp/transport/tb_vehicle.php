<div class="card-body table-responsive p-0 pb-2">
                <table class="table table-hover text-nowrap  table-bordered">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Vehicle Name</th>
                    <th>Owner Name</th>
                    <th>Owner Email</th>
                    <th>Owner Mobile</th>
                    <th>Vehicle Number</th>
                    <th>Vehicle Registration No.</th>
                    <th>Vehicle Children Capacity</th>
                    <th>Insurance Renew date</th>
                    <th>Joining Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i=$page;foreach($rows as $t){?>
                  <tr>
                    <td><?=++$i;?></td>
                    <td><img src="<?php echo IMGS_URL.$t->vehicle_photo ;?>" alt="" height="50px">
                        <p class="pt-1"><?=$t->vehicle_name;?></p></td>
                    <td><?=$t->owner_name;?></td>
                    <td><?=$t->owner_email;?></td>
                    <td><?=$t->owner_mobile_no;?></td>
                    <td><?=$t->vehicle_no;?></td>
                    <td><?=$t->vehicle_reg_no;?></td>
                    <td><?=$t->vehicle_child_capacity;?></td>
                    <td><?=$t->insurance_renew_date;?></td>
                    <td><?=$t->join_date;?></td>
                 
                       <td class="text-center">
                       <span class="changeStatus" data-toggle="change-status" value="<?=($t->status==1) ? 0 : 1?>" data="<?=$t->id?>,transport_vehicle,id,status" ><i class="<?=($t->status==1) ? 'fa-regular fa-circle-check' : 'fa-solid fa-circle-xmark'?>" title="Click for chenage status" style="color:<?=($t->status==1) ? 'green' :'red'?> "></i></span>
                   </td>
                    <td>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Details (<?=$t->vehicle_name?>)" data-url="<?=$update_url?><?=$t->id?>" title="Update">
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