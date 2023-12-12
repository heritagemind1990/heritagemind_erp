          <div class="card-body table-responsive p-0 pb-2">
                <table class="table table-hover text-nowrap  table-bordered" id="tbl_exporttable_to_xls">
                  <thead>
                  <tr class="bg-info">
                    <th colspan="4" class="text-center">Student Details</th>
                    <th colspan="31" class="text-center">Date</th>
                  </tr>
                  <tr class="bg-primary">
                    <th>Sr.no.</th>
                    <th>Student Name</th>
                    <th>Student ID</th>
                    <th>Section</th>
                    <?php 
                    //echo $Attmonth;
                    $current_Month 	= $Attmonth;
                    $year 			= $Years;
                    $date = mktime(12, 0, 0, $current_Month, 1, $year);
                    $numberOfDays = cal_days_in_month(CAL_GREGORIAN, $current_Month, $year);
        	        for ($day = 1; $day <= $numberOfDays; $day++) {
                    $pdate = date('Y-m-' . sprintf("%02d", $day), $date);
                    $days =  date_format(date_create($pdate), "D");
                     echo '<th>'.sprintf("%02d", $day).'<br>'.$days.'</th>';
                    }
                    ?>

                  </tr>
                  </thead>  
                  <tbody>
                 <?php  $i=1; foreach($rows as $row):?>
                 <tr class="bg-warning">
                  <td><?=$i;?></td>
                 <td><?=$row->fname.' '.$row->lname;?></td>
                 <td><?=$row->stu_id;?></td>
                 <td><?=$row->section_name;?></td>  
                 <?php  for ($day = 1; $day <= $numberOfDays; $day++) {
                  $pdate = date('Y-m-' . sprintf("%02d", $day), $date);
                  $days =  date_format(date_create($pdate), "D");
                  $rs=$this->student_model->get_att($row->id,$pdate,$row->sec_id);
                   $count = $this->student_model->Counter('student_attendance', array('student_id' => $row->id, 'date' => $pdate,));
                  if($count >0){ 
                  foreach($rs as $r)
                  {
                    $dayname = date('D', strtotime($r->date));
                    $att = $r->attendance;
                  }
                }else
                {
                  $att='';
                }
                  echo '<th>'?><?php if($att==1){echo '<span style="color:green">P</span>' ;}elseif($att==0){echo '<span style="color:red">A</span>' ;}elseif($att==-1){echo '<span style="color:red">L</span>';} ;?><?php '</th>';

                  }
                 
                  ?>
                 
                 </tr> 
                 <?php $i++; endforeach;?>  
                
                  </tbody>
                </table>
                </div>