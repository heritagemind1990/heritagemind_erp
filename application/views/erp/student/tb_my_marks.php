
<?php if($exams->student_showon==0){
     echo "<h3 class='text-danger text-center mt-4'>Sorry. Your result not allowed  / declear</h3>";
}else{?>
<div class="container mt-4 ">
    <div class="row">
         <div class="card col-md-12 pt-3 pb-5">
         <table id="table" width="100%">
            <tr>
                <th id="logo"><img src="<?=base_url('images/marksheet.png');?>" width="100%" height="150px"></th>
            </tr>
        </table>
        <hr style="width: 100%;color:black;border:0.001rem solid black">
        <div class="h3 text-center">Test Name</div>
        <hr style="width: 100%;color:black;border:0.001rem solid black">
        <table width="100%">
           <tr>
            <th class="pl-3">Name :- <?=$student->fname.' '.$student->lname;?></th>
            <th class="pl-3">Father's Name :- <?=$student->father;?></th>
            <th class="pl-3">Mother's Name :- <?=$student->mother;?></th>
            <th class="pl-3">Roll No :- <?=$student->roll_no?></th>
           </tr>
           <tr>
            <th class="pl-3">Class :- <?=$student->class_name;?></th>
            <th class="pl-3">Section:- <?=$student->section_name;?></th>
            <th class="pl-3">Session :- 2024-25</th>
           </tr>
        </table>
        <hr style="width: 100%;color:black;border:0.001rem solid black">
        <table width="100%" class="table">
           <tr class="bg-info" style="height: 40px;color:black">
            <th class="pl-3" style="color:black;width:450px;border:2px solid black">Subject</th>
            <th class="pl-3" style="color:black;border:2px solid black">Maximum Marks</th>
            <th class="pl-3" style="color:black;border:2px solid black">Obtained Marks</th>
           </tr>
           <?php $Tmarks = $Totalmm = 0; foreach($sst_data as $sst): ?>
            <?php 
                $mark = $this->principal_model->get_student_marks($student->id,$student->sec_id,$sst->id,1); 
                $stumark =  $mark->marks ?? 'NA';
               $Totalmm = $Totalmm + $exams->max_marks;
               $Tmarks = $Tmarks + $stumark;
               $per = round((($Tmarks/$Totalmm)*100),2)
              ?>
           <tr>
            <th class="pl-3" style="color:black;width:450px;border:2px solid black"><?=$sst->sub_name;?></th>
            <th class="pl-3" style="color:black;border:2px solid black"><?=$exams->max_marks;?></th>
            <th class="pl-3" style="color:black;border:2px solid black"><?=$stumark;?></th>
           </tr>
           <?php endforeach;?>
           <tr>
            <th class="pl-3" style="color:black;width:450px;border:2px solid black">Total</th>
            <th class="pl-3" style="color:black;border:2px solid black"><?=$Totalmm;?></th>
            <th class="pl-3" style="color:black;border:2px solid black"><?=$Tmarks;?></th>
           </tr>
           <tr>
              <td >&nbsp;&nbsp;<b>Percentage: &nbsp;&nbsp;</b></td>
              <td style="text-align:center;" colspan="2" >&nbsp;&nbsp;<b><?=$per;?> %</b></td>
            </tr>
               <tr>
                <td >&nbsp;&nbsp;<b>Attendance: &nbsp;&nbsp;</b></td>
                <td style="text-align:center;" colspan="2" >&nbsp;&nbsp;<b>20</b></td>
              </tr>
               <tr>
                <td >&nbsp;&nbsp;<b>Date: &nbsp;&nbsp;</b></td>
                <td style="text-align:center;" colspan="2" >&nbsp;&nbsp;<b><?=$newDate = date("d", strtotime(date('Y-m-d')));?><sup>th</sup><?=$newDate = date(" M Y ", strtotime(date('Y-m-d')));?></b> </td>
              </tr>
        </table>
			<table border="2px"  width="100%" >
			<tr><th style="font-weight:bold;font-size:17px; background-color:#E2E2E2;" colspan="4">&nbsp;&nbsp;LEARNING SKILLS</th><th style="font-weight:bold;font-size:17px; background-color:#E2E2E2;" colspan="6">&nbsp;&nbsp;PERSONALITY DEVELOPMENT</th></tr>
			<tr style=" height:0px;"><td style="font-weight:bold;">&nbsp;&nbsp;English Writing</td><td style="text-align:center; font-weight:bold;">A</td><td style="font-weight:bold;">&nbsp;&nbsp;Art & Craft</td><td style="text-align:center; font-weight:bold;">D</td><td style="font-weight:bold;">&nbsp;&nbsp;Regularity</td><td style="text-align:center; font-weight:bold;">D</td><td style="font-weight:bold;">&nbsp;&nbsp;Discipline</td><td style="text-align:center; font-weight:bold;">E</td><td style="font-weight:bold;">&nbsp;&nbsp;Spoken English</td><td style="text-align:center; font-weight:bold;">C</td></tr>
			<tr style=" height:0px;"><td style="font-weight:bold;">&nbsp;&nbsp;Hindi Writing</td><td style="text-align:center; font-weight:bold;">B</td><td style="font-weight:bold;">&nbsp;&nbsp;Reading</td><td style="text-align:center; font-weight:bold;">A</td><td style="font-weight:bold;">&nbsp;&nbsp;Punctuality</td><td style="text-align:center; font-weight:bold;">D</td><td style="font-weight:bold;">&nbsp;&nbsp;Personal Hygiene</td><td style="text-align:center; font-weight:bold;">A</td><td style="font-weight:bold;">&nbsp;&nbsp;Health & Physical</td><td style="text-align:center; font-weight:bold;">B</td></tr>
			</table><br><br>
            <table border="2px"  width="100%" >
			<tr ><td style="font-weight:bold;" >&nbsp;&nbsp;GRADE</td><td style="font-weight:bold;" >&nbsp;&nbsp;A</td><td style="font-weight:bold;" >&nbsp;&nbsp;B</td><td style="font-weight:bold;" >&nbsp;&nbsp;C</td></tr>
			<tr ><td style="font-weight:bold;" >&nbsp;&nbsp;ACHIEVEMENT</td><td style="font-weight:bold;" >&nbsp;&nbsp;Outstanding</td><td style="font-weight:bold;" >&nbsp;&nbsp;Very Good</td><td style="font-weight:bold;" >&nbsp;&nbsp;Fair</td></tr>
            <tr style="height:30px;"><th style="text-align:left;" colspan="3">Remark: Good</th></tr>
			</table>
         </div>
    </div>
</div>
<?php }?>