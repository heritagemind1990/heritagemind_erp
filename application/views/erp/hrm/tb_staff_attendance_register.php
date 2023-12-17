<div class="card-body table-responsive p-0 pb-2">
                <table class="table table-hover text-nowrap  table-bordered" id="tbl_exporttable_to_xls">
                  <thead>
                  <tr>
                    <th>Sr.no.</th>
                    <th>Role Name</th>
                    <th>Name</th>
                    <th>Punch In</th>
                    <th>Punch Out</th>
                    <th>punch Date</th>
                    <th>Average In Time</th>
                    <th>Average Out Time</th>
                    <th>Total Hours</th>
                  </tr>
                  </thead>  
                  <tbody>
                 <?php  $i=1; foreach($rows as $row):
                
                    ?>
                 <tr>
                <td><?=$i;?></td>
                <td><?=$row->role_name;?></td>
                <td><?=$row->name;?></td>
                <td><?=$row->punch_in;?></td>
                <td><?=$row->punch_out;?></td>
                <td><?=$row->punch_date;?></td>
                <td><?php if($row->punch_in !='' && $row->start_time !=''){ echo late_time($row->start_time,$row->punch_in) ;}else{ echo "<button class='btn btn-warning'>Not Punch In</button>";};?></td>
                <td><?php if($row->punch_out !='' && $row->end_time !=''){ echo over_time($row->end_time,$row->punch_out) ;}else{ echo "<button class='btn btn-warning'>Not Punch In</button>";};?></td>
                <th><?php if($row->punch_in !='' && $row->punch_out !=''){ echo time_diff($row->punch_in,$row->punch_out) ;}else{ echo "00:00:00";};?> Hours</th>
                 </tr> 
                 <?php $i++; endforeach;?>  
                
                  </tbody>
                </table>
                </div>