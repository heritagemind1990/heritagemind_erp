
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper pt-4 pb-5">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <form action="<?=base_url('student-marksheet');?>" method="POST">
        <div class="row mb-2">
          <div class="col-sm-6">
           <h1 class="m-0"><?=$title;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
         <li class="breadcrumb-item"><a href="<?=base_url();?>principal-data">Principal</a></li>
        <li class="breadcrumb-item active"><?=$title;?></li>
        </ol>
          </div><!-- /.col -->
         
          <div class="col-sm-4 mt-3">
          <label for="">Select Section</label>
          <select name="section_id" id="" class="form-control" required>
          <option value="">--Select Section--</option>
          <?php foreach($section as $se):?>
          <option value="<?=$se->id;?>" <?php if($section_id==$se->id){echo "selected";} ;?>  ><?=$se->section_name;?></option>
         <?php endforeach;?>    
          </select>
          </div>
          <div class="col-sm-3 mt-3">
          <label for="">Select Exam</label>
          <select name="exam_id" id="" class="form-control" required>
          <option value="">--Select Exam--</option>
          <?php foreach($exam as $ex):?>
          <option value="<?=$ex->id;?>"  <?php if($exam_id==$ex->id){echo "selected";} ;?>  ><?=$ex->title;?></option>
         <?php endforeach;?>    
          </select>
          </div>
          <div class="col-sm-3 mt-3">
          <label for="">Select Marksheet print out date</label>
            <input type="date" class="form-control" name="date" value="<?=$date;?>" required>
          </div>
          <div class="col-sm-2 mt-4">
           <button type="submit" class="btn btn-primary mt-3">Submit</button>
          </div>
        </div><!-- /.row -->
        </form>
        <hr style="border: 1px solid green;">
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" style="display:<?php if(!empty($section_id)){echo "inline" ;}else{echo "none";} ;?>;">
      <div class="container-fluid">
        <div class="row">
            <div class="col-sm-11">
            <h4 class="box-title" style=" color:red;">First check it very carefully (PDF) and after that you need to take print out</h4>
            </div>
            <div class="col-sm-1">
            <input type="button" class="btn btn-danger btn-sm mb-5" onClick="PrintDiv();" name="Print" value="Print">
            </div>
          <div class="col-12">
          <!-- marksheet -->
         
          <div class="container" id="divprint" style="width:100%;height:100%;border:2px solid #B2BABB">
          <?php foreach($student as $stu):?>
          <div class="row">
          <div class="well col-xs-10 col-sm-10 col-md-12 col-xs-offset-1 col-sm-offset-1 col-md-offset-3" >
           <table width="100%" style="width:100%; margin-top:-5px; color:#000000; font-size:16px;margin-bottom:0.8rem" border="0">
               <tr style="width:100%;">
               <td colspan="4" style="width:100%;">
               <img src="<?=base_url('images/marksheet.png');?>" width="100%">
               <center><font size='+1' color="#000000" style="margin-top:13px;"><b style="text-transform:uppercase;"><?=$exam_data->title;?> MARKSHEET (SESSION 2023-24)</b></font></center>
               </td></tr>
               <tr style="width:100%;">
               <td colspan="4"><hr></td></tr>
               
               <tr style="width:100%;">
               <td style="font-size:16px;" >  Name: <b style="text-transform: capitalize;"><?=$stu->fname.' '.$stu->lname;?></b></td>
               <td style="font-size:16px;" > Class: <b><?=$stu->class_name;?></b></td>
                <td style="font-size:16px;" > 
               Section: <b><?=$stu->section_name;?></b> </td> 
               <td rowspan="3"></td> 
               </tr>
               <tr style="width:100%;">
               <td style="font-size:16px;" > Roll Number. <b><?=$stu->roll_no;?></b></td> 
               <td style="font-size:16px;" > 
               Scholar No.: <b><?=$stu->enrollment;?></b> </td>
               <td style="font-size:16px;" > Father's Name <b><?=$stu->father;?></b></td>
               </tr>
            </table>
            <div style=" background: url('<?=base_url();?>assets/img/m_water_logo.png ') no-repeat;  background-position:center 100%;">
            <table width="100%" style="width:100%; margin-top:0px; color:#000000; font-size:14px;" border="2px">
            <caption style="color:#000000; text-align:left;"><b>Scholastic Area : Part 1</b> </caption>
            <tr style="font-size:14px; background-color:#E2E2E2;" >
            <th rowspan="2">&nbsp;&nbsp;SUBJECT</th>
            <?php $totalexam = $this->principal_model->get_total_exam($exam_id);
             foreach($totalexam as $texam):?>
            <th colspan="2" style="text-align:center;"><?php  echo $texam->title;?></th>
            <?php endforeach;?>
            </tr>
          
            <tr style="font-size:14px; background-color:#E2E2E2;" >
            <?php $maxmarkss = $TExam = 0 ;foreach($totalexam as $texam):
              $countexam =  $this->erp_model->Counter('exam_master', array('id'=>$texam->id));
              $TExam =$TExam +$countexam;
             
              
              ?>
            <th style="text-align:center;">M.M.</th>
            <th style="text-align:center;">O.T.</th>
            <?php endforeach;?>
            </tr>
           
            <?php $Tstumark1 = $Tstumark2 = $Tstumark3 =$Tstumark4 = 0; $i=0; foreach($sst_data as $sst): //echo count($sst->sub_name);?>
             <tr>
              <td>&nbsp;&nbsp;<b><?=$sst->sub_name;?></b></td>
              <?php 
              foreach($totalexam as $texam): 
                $mark = $this->principal_model->get_student_marks($stu->id,$section_id,$sst->id,$texam->id); 
                $stumark =  $mark->marks ?? 'NA';
               
               if($texam->id==1)
               {
                 $finalnum1 =  $Tstumark1 += $stumark;
               }
               elseif($texam->id==2)
               {
                $finalnum2= $Tstumark2 += $stumark;
               }
               elseif($texam->id==3)
               {
                $finalnum3 = $Tstumark3 += $stumark;
               }
               elseif($texam->id==4)
               {
                $finalnum4 = $Tstumark4 += $stumark;
               }
              ?>
              <td style="text-align:center;"><?=$texam->max_marks;?></td>
              <td style="text-align:center;"><?=$stumark;?></td>
              <?php endforeach; ?>
            </tr>
            <?php $i++ ;endforeach; $totalsub =  $i;?>
            <tr style="background-color:#E2E2E2;">
            <td>&nbsp;&nbsp;<b>Total</b></td>
            <?php foreach($totalexam as $texam):
            $totalmm = $texam->max_marks*$totalsub;
          
                ?>
            <td style="text-align:center;"><b><?=$totalmm;?></b></td>
            <td style="text-align:center;"><b><?php if($texam->id==1){echo $Tstumark1;}elseif($texam->id==2){echo $Tstumark2; }elseif($texam->id==3){echo $Tstumark3; }elseif($texam->id==4){echo $Tstumark4; }?></b></td>
            <?php 
            if($texam->id==1)
            {
               $per1 = round((($finalnum1/$totalmm)*100),2) ;
            }elseif($texam->id==2)
            {
               $per2 = round((($finalnum2/$totalmm)*100),2) ;
            }
            elseif($texam->id==3)
            {
               $per3 = round((($finalnum3/$totalmm)*100),2) ;
            }
            elseif($texam->id==4)
            {
               $per4 = round((($finalnum4/$totalmm)*100),2) ;
            }
            ?>
            <?php endforeach;?>
            </tr>
             <tr>
              <td >&nbsp;&nbsp;<b>Percentage: &nbsp;&nbsp;</b></td>
              <?php foreach($totalexam as $texam):?>
              <td style="text-align:center;" colspan="2" >&nbsp;&nbsp;<b><?php if($texam->id==1){echo $per1;}elseif($texam->id==2){echo $per2; }elseif($texam->id==3){echo $per3; }elseif($texam->id==4){echo $per4; } ;?> %</b></td>
              <?php endforeach;?>
            </tr>
               <tr>
                <td >&nbsp;&nbsp;<b>Attendance: &nbsp;&nbsp;</b></td>
                <?php foreach($totalexam as $texam):?>
                <td style="text-align:center;" colspan="2" >&nbsp;&nbsp;<b>20</b></td>
                <?php endforeach;?>
              </tr>
               <tr>
                <td >&nbsp;&nbsp;<b>Date: &nbsp;&nbsp;</b></td>
                <td style="text-align:center;" colspan="<?=$TExam*2;?>" >&nbsp;&nbsp;<b><?=$newDate = date("d", strtotime($date));?><sup>th</sup><?=$newDate = date(" M Y ", strtotime($date));?></b> </td>
              </tr>
            </table>
            <br>
			<table border="2px"  width="100%" style="width:100%; margin-top:0px; color:#000000;">
			<caption style="color:#000000; text-align:left;"><b>Co Scholastic Area : Part 2</b> </caption>
			<tr style=" height:0px; "><th style="font-weight:bold;font-size:17px; background-color:#E2E2E2;" colspan="4">&nbsp;&nbsp;LEARNING SKILLS</th><th style="font-weight:bold;font-size:17px; background-color:#E2E2E2;" colspan="6">&nbsp;&nbsp;PERSONALITY DEVELOPMENT</th></tr>
			<tr style=" height:0px;"><td style="font-weight:bold;">&nbsp;&nbsp;English Writing</td><td style="text-align:center; font-weight:bold;">A</td><td style="font-weight:bold;">&nbsp;&nbsp;Art & Craft</td><td style="text-align:center; font-weight:bold;">D</td><td style="font-weight:bold;">&nbsp;&nbsp;Regularity</td><td style="text-align:center; font-weight:bold;">D</td><td style="font-weight:bold;">&nbsp;&nbsp;Discipline</td><td style="text-align:center; font-weight:bold;">E</td><td style="font-weight:bold;">&nbsp;&nbsp;Spoken English</td><td style="text-align:center; font-weight:bold;">C</td></tr>
			<tr style=" height:0px;"><td style="font-weight:bold;">&nbsp;&nbsp;Hindi Writing</td><td style="text-align:center; font-weight:bold;">B</td><td style="font-weight:bold;">&nbsp;&nbsp;Reading</td><td style="text-align:center; font-weight:bold;">A</td><td style="font-weight:bold;">&nbsp;&nbsp;Punctuality</td><td style="text-align:center; font-weight:bold;">D</td><td style="font-weight:bold;">&nbsp;&nbsp;Personal Hygiene</td><td style="text-align:center; font-weight:bold;">A</td><td style="font-weight:bold;">&nbsp;&nbsp;Health & Physical</td><td style="text-align:center; font-weight:bold;">B</td></tr>
			</table><br><br>
            <table border="2px"  width="100%" style="width:100%; margin-top:0px; color:#000000;">
			<caption style="color:#000000; text-align:left;"><b>Co Scholastic Area : Part 2</b> </caption>
			<tr ><td style="font-weight:bold;" >&nbsp;&nbsp;GRADE</td><td style="font-weight:bold;" >&nbsp;&nbsp;A</td><td style="font-weight:bold;" >&nbsp;&nbsp;B</td><td style="font-weight:bold;" >&nbsp;&nbsp;C</td></tr>
			<tr ><td style="font-weight:bold;" >&nbsp;&nbsp;ACHIEVEMENT</td><td style="font-weight:bold;" >&nbsp;&nbsp;Outstanding</td><td style="font-weight:bold;" >&nbsp;&nbsp;Very Good</td><td style="font-weight:bold;" >&nbsp;&nbsp;Fair</td></tr>
			</table>
            <br><br>
            <table width="100%" style="width:100%; margin-top:0px; color:#000000;font-size:14px;" border="0px">
           <tr style="height:30px;"><th style="text-align:left;" colspan="3">Remark: Good<br><br></th></tr>
          <br><br><br><br>
          <tr ><th style="text-align:left;"></th><th style="text-align:center;"><img src="http://mariampublicschool.in/assets/img/psign.jpeg" style="width:120px; height:40px;"></th> <th style="text-align:right;"></th></tr>
          <tr style="height:20px;"><th style="text-align:left;">Class Teacher's Signature</th><th style="text-align:center;">Principal's Signature</th> <th style="text-align:right;">Parent's Signature</th></tr>
          </table>
          <br><br>
          <table width="100%" style="width:100%; margin-top:0px; color:#000000; font-size:16px;" border="0px">
               <tr><td><p>&nbsp;&nbsp;<b>Promotion Rules</b><br>
              &nbsp;&nbsp;1. Promotion will depend on the child's performance throughout the year.<br>
              &nbsp;&nbsp;2. The minimum attendance required is 75%.<br>
              &nbsp;&nbsp;3. The Principal's decision with regard to promotion will be final.<br>
              &nbsp;&nbsp;4. Passing marks given once on medical grounds will not be given again. <br>
              </p></td></tr>
          
             </table>
             <br><br>
          </div>
          </div>
          </div>
          <?php endforeach;?>
          </div>
        
          <!-- /marksheet -->
          <!-- /.col -->
        </div>
        <div class="col-sm-11">
            </div>
            <div class="col-sm-1 mt-5">
            <input type="button" class="btn btn-danger btn-sm mb-5" onClick="PrintDiv();" name="Print" value="Print All">
            </div>
        <!-- /.row -->
      </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
     function PrintDiv() {
     var contents = document.getElementById("divprint").innerHTML;
     var frame1 = document.createElement('iframe');
     frame1.name = "frame1";
     frame1.style.position = "absolute";
     frame1.style.top = "-1000000px";
     document.body.appendChild(frame1);
     var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
     frameDoc.document.open();
     frameDoc.document.write('<html><link rel=\"stylesheet\" href=\"" type=\"text/css\"/><head><title>&nbsp;</title>');
     frameDoc.document.write('<style media="print">    @page {  size: auto;  margin: 2 10;  font-size:8pt;   width:100%;   } table { border: 1; font-size:12px; width:95%;   border-collapse: collapse;  } </style></head><body style="font-size:8px;"><center>');
     frameDoc.document.write(contents);
     frameDoc.document.write('</center></body></html>');
     frameDoc.document.close();
     setTimeout(function () {
         window.frames["frame1"].focus();
         window.frames["frame1"].print();
         document.body.removeChild(frame1);
     }, 500);
     return false;
         }
     </script>