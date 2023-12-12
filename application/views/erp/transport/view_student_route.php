
<div class="modal-body">
<div class="row">
      <div class="card-body table-responsive p-0 pb-2">
       <table class="table table-hover text-nowrap  table-bordered">
       <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Route</th>
                    <th>Sub Route</th>
                    <th>Student Name</th>
                    <th>Student ID</th>
                    <th>Student Section</th>
                    <th>Student Address</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;foreach($rows as $t){?>
                  <tr>
                    <td><?=$i;?></td>
                    <td><?=$t->start_route.' - '.$t->end_route;?></td>
                    <td><?=$t->pick_up.' - '.$t->drop_off;?></td>
                    <td><?=$t->fname.' '.$t->lname;?></td>
                    <td><?=$t->stu_id;?></td>
                    <td><?=$t->section_name;?></td>
                    <td><?=$t->address;?></td>
                  </tr>
   
                  <?php  $i++; }?>
                  </tbody>
      </table>
    </div>
</div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect btn-sm" data-dismiss="modal">Close</button>
</div>

