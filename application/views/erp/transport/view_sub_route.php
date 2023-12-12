
<div class="modal-body">
<div class="row">
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
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;foreach($rows as $t){?>
                  <tr>
                    <td><?=$i;?></td>
                    <td><?=$t->start_route.' - '.$t->end_route;?></td>
                    <td><?=$t->pick_up;?></td>
                    <td><?=$t->drop_off;?></td>
                    <td><?=$t->pick_up_time;?></td>
                    <td><?=$t->stop_time;?> Min</td>
                    <td><?=$t->fees;?></td>
                  </tr>
   
                  <?php $i++; }?>
                  </tbody>
      </table>
    </div>
</div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect btn-sm" data-dismiss="modal">Close</button>
</div>

