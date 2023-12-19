
<div class="container mt-4">
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
        </table>
         </div>
    </div>
</div>
