
<div class="card-body table-responsive pt-3 pb-3 pl-3 pr-3">
        <h3 class="float-left pl-2">SET TIME TABLE :</h3>
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
                      <th  style="border:2px solid black;height:90px;max-height:150px" onclick="check_section()">
                    </th>
                     <?php }elseif($count = $this->erp_model->Counter('student_time_table', array('day_no'=>$day_no,'section'=>$section,'period_id'=>$p->period))==1){?>
                        <th   style="border:2px solid black;height:90px;max-height:150px;width:150px" class="bg-primary">
                        <?php $time = $this->principal_model->view_time_table($day_no,$section,$p->period) ;?>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Time Table:-<?=$time->sub_name?>" data-url="<?=$update_url?><?=$time->id?>" title="Update" class="float-right btn btn-sm btn-primary">
                        <i class="fa-solid fa-pen-to-square"></i>
                       </a>
                        <?=$time->sub_name;?> <br> By <?=$time->teacher_name;?> <i class="fa-solid fa-arrow-right"></i> <?=$time->room_name;?>  <br><?php echo _time($time->start_time).' - '._time($time->end_time);?>
                        
                       </th> 
                 
                        <?php }else{?>
                    <th data-toggle="modal" data-target="#modal-primary" style="border:2px solid black;height:90px;max-height:150px" onclick="add_time_table(<?=$day_no.','.$p->period;?>)">
                    </th>
                    <?php };?>
                <?php endforeach;?>
                </tr>
        
                <div class="modal" id="modal-primary">
                <div class="modal-dialog  modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h6 class="modal-title">Set Time Table ( <?=date('d-m-Y');?> )</h6>
                    <button type="button" class="close closebtn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="day" name="day">
                        <input type="hidden" id="period" name="period">
                        <input type="hidden" id="section" name="section" value="<?=$section;?>">
                        <div class="col-12 form-group">
                            <label for="">Select Room : </label>
                            <select name="room" id="room" class="form-control">
                                <option value="">--Select Room--</option>
                                <?php foreach($room as $rr):?>
                                <option value="<?=$rr->id;?>"><?=$rr->name;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                          <div class="col-12 form-group">
                            <label for="">Select Section Subject & teacher : </label>
                            <select name="sstid" id="sstid" class="form-control">
                                <option value="">--Select sectiom subject & teacher--</option>
                                <?php foreach($sst as $ss):?>
                                <option value="<?=$ss->id;?>"><?=$ss->section_name.' ( '.$ss->sub_name.' BY :- '.$ss->teacher_name.' )';?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-6 form-gourp">
                            <label for="">Select Period Start Time</label>
                            <input type="time" id="start_time" class="form-control">
                        </div>
                        <div class="col-6 form-gourp">
                            <label for="">Select Period End Time</label>
                            <input type="time" id="end_time" class="form-control">
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light btn-sm bg-danger" data-dismiss="modal">Close</button>
                    <button type="button" onclick="submit_att()" class="btn btn-outline-light btn-sm bg-warning">  Save  </button>
                    </div>
                </div>
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
                   <?php }?>
            </tbody>
        </table>
      </div>

<script type="text/javascript">
function submit_att()
{
    var room = $("#room").val();
    var sstid = $("#sstid").val();
    var day = $("#day").val();
    var period = $("#period").val();
    var section =$("#section").val();
    var stime = $("#start_time").val();
    var etime = $("#end_time").val();
    if(day==1)
    {
        dayname = 'Monday';
    }else if(day==2){
        dayname = 'Tueasday';
    }
    else if(day==3){
        dayname = 'Wednesday';
    }else if(day==4){
        dayname = 'Thursday';
    }else if(day==5){
        dayname = 'Friday';
    }else if(day==6){
        dayname = 'Saturday';
    }else if(day==7){
        dayname = 'Sunday';
    };
    if(room =='' || sstid =='')
    {
        alert_toastr("error","Sorry !! Please fill all fields.");
    }
    else
    {
        $.ajax({
            url: "<?php echo base_url('principal-section-time-table/save'); ?>",
            method: "POST",
            data: {
                room:room,sstid:sstid,period:period,day_no:day,dayname:dayname,section:section,stime:stime,etime:etime,
            },
            success: function(data){
                    console.log(data);
                    data = JSON.parse(data);
                    $('.'+data.res).html(data.msg);
                    if (data.res=='success') {
                        function reloadPage() {
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                    reloadPage();
                    }
                    if (data.errors) {
                        $.each(data.errors,function(key,value){
                            $this.find(`[name="${key}"]`).parents(`.form-group`).find(`.error`).text(value);
                        })
                    }
                    alert_toastr(data.res,data.msg);
                }
        });
    }
}



function check_section()
{
    alert_toastr("error","Sorry !! Please select section then set your time table.");
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
<script>
    function add_time_table(day_no,period)
    {
        $("#day").val(day_no);
        $("#period").val(period);
    }
</script>