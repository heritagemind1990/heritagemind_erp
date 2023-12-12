
<div class="card-body table-responsive pt-3 pb-3 pl-3 pr-3">
        <h3 class="float-right pr-5">Section  : <?=$section_name->section_name ?? '';?></h3>
        <table class="table table-hover text-nowrap  table-bordered " >
            <thead>
                <tr style="border:3px solid black" class="bg-info">
                    <th style="width: 100px;border:2px solid black">Day / Period</th>
                    <?php
                    $daysOfWeek = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
                    foreach($period as $p):?>
                    <th style="border:2px solid black;text-align:center">
                   <?php 
                    $number = $p->period;
                    $romanNumeral = intToRoman($number);
                    echo  $romanNumeral;
                    ?>
                    </th>
                    <?php  endforeach;?>
                </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < count($daysOfWeek); $i++) {
             $day_no =     $dayNumber = $i + 1;?>
                <tr style="border:2px solid black">
                    <th style="border:3px solid black" class="bg-info">
                    <?php    echo $daysOfWeek[$i] ;?>
                    </th>
                   <?php  foreach($period as $p):
                     if($section ==''){?>
                      <th  style="border:2px solid black;height:90px;max-height:150px">
                    </th>
                     <?php }elseif($count = $this->erp_model->Counter('student_time_table', array('day_no'=>$day_no,'section'=>$section,'period_id'=>$p->period))==1){?>
                        <th   style="border:2px solid black;height:90px;max-height:150px;width:150px" class="bg-primary">
                        <?php $time = $this->teacher_model->view_time_table($day_no,$section,$p->period) ;?>
                        <?=$time->sub_name;?> <br> By <?=$time->teacher_name;?> <i class="fa-solid fa-arrow-right"></i> <?=$time->room_name;?>  <br><?php echo _time($time->start_time).' - '._time($time->end_time);?>
                        
                       </th> 
                 
                        <?php }else{?>
                    <th style="border:2px solid black;height:90px;max-height:150px" >
                    </th>
                    <?php };?>
                <?php endforeach;?>
                </tr>
        
                   <?php }?>
            </tbody>
        </table>
      </div>

<script type="text/javascript">


function check_section()
{
    alert_toastr("error","Sorry !! Please select section then view your time table.");
}
</script>

      <?php 
      function intToRoman($num) {
        $values = array(
            1000, 900, 500, 400,
            100, 90, 50, 40,
            10, 9, 5, 4, 1
        );
        $roman_numerals = array(
            'M', 'CM', 'D', 'CD',
            'C', 'XC', 'L', 'XL',
            'X', 'IX', 'V', 'IV', 'I'
        );
    
        $result = '';
    
        for ($i = 0; $i < count($values); $i++) {
            while ($num >= $values[$i]) {
                $result .= $roman_numerals[$i];
                $num -= $values[$i];
            }
        }
    
        return $result;
    }?>