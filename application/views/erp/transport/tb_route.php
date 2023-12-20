<div class="card-body table-responsive p-0 pb-2">
                <table class="table table-hover text-nowrap  table-bordered">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Start Route</th>
                    <th>End Route</th>
                    <th>Assign Driver</th>
                    <th>Assign Conductor</th>
                    <th>Assign Vehicle</th>
                    <th class="text-center">Total Student</th>
                    <th class="text-center">Sub Route</th>
                    <th class="text-center">Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i=$page;foreach($rows as $t){?>
                  <tr>
                    <td><?=++$i;?></td>
                    <td><?=$t->start_route;?></td>
                    <td><?=$t->end_route;?></td>
                    <td class="text-center">
                      <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal-xl" data-whatever=" Route (<?=$t->start_route.' - '.$t->end_route;?>)" data-url="<?=$assign_tr_route_driver?><?=$t->id?>" title="Update" style="font-size: 1.6rem;font-weight: bold;">
                    <i class="fa-solid fa-plus"></i>
                       </a>
                    </td>
                    <td class="text-center">
                      <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal-xl" data-whatever=" Route (<?=$t->start_route.' - '.$t->end_route;?>)" data-url="<?=$assign_tr_route_conductor?><?=$t->id?>" title="Update" style="font-size: 1.6rem;font-weight: bold;">
                    <i class="fa-solid fa-plus"></i>
                       </a>
                    </td>
                    <td class="text-center">
                      <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal-xl" data-whatever=" Route (<?=$t->start_route.' - '.$t->end_route;?>)" data-url="<?=$assign_tr_route_vehicle?><?=$t->id?>" title="Update" style="font-size: 1.6rem;font-weight: bold;">
                    <i class="fa-solid fa-plus"></i>
                       </a>
                    </td>
                    <!--  -->
                    <?php    $count = $this->erp_model->Counter('transport_student', array('route_id'=>$t->id,'is_deleted'=>'NOT_DELETED','status'=>'1'));?>
                    <td class="text-center">
                      <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal-xl" data-whatever="View All Student  (<?=$t->start_route.' - '.$t->end_route;?>)" data-url="<?=$view_student_route?><?=$t->id?>" title="Update" class="btn  btn-primary">
                      <?php echo $count;?>
                       </a>
                    </td>
                    <td class="text-center">
                      <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal-xl" data-whatever=" Route (<?=$t->start_route.' - '.$t->end_route;?>)" data-url="<?=$view_sub_route?><?=$t->id?>" title="Update" style="font-size: 1.6rem;font-weight: bold;">
                    <i class="fa-solid fa-plus"></i>
                       </a>
                    </td>
                       <td class="text-center">
                       <span class="changeStatus" data-toggle="change-status" value="<?=($t->status==1) ? 0 : 1?>" data="<?=$t->id?>,transport_route,id,status" ><i class="<?=($t->status==1) ? 'fa-regular fa-circle-check' : 'fa-solid fa-circle-xmark'?>" title="Click for chenage status" style="color:<?=($t->status==1) ? 'green' :'red'?> "></i></span>
                   </td>
                    <td>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Details (<?=$t->start_route.' - '.$t->end_route;?>)" data-url="<?=$update_url?><?=$t->id?>" title="Update">
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