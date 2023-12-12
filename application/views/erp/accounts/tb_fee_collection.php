<form action="<?=base_url();?>Accounts/PayonlineProcess" method="post" onsubmit="return confirm('Are you sure you want to submit this fee ?');">
   <div class="content card ml-2 mr-2">
    <div class="row pt-2 pb-4 pl-3 pr-3" >
    <div class="col-sm-6 bg-info pt-2" style="border-top:2px solid black ;border-bottom:2px solid black ;border-left:2px solid black ;border-right:2px solid white ;">
    <label><b><u>STUDENT DETAILS :</u></b></label>
    <hr style="border: 1px solid black;">
    <div class="card-body table-responsive p-0 pb-5">
    <table class="table table-hover text-nowrap  table-bordered" style="border:2px solid black;">
      <thead>
        <tr>
            <th style="border:2px solid black;">STUDENT ID : </th>
            <th style="border:2px solid black;"><?=$student->stu_id ?? '';?></th>
            <input type="hidden" name="stu_id" value="<?=$student->stu_id ?? '';?>">
        </tr>
        <tr>    
             <th style="border:2px solid black;">ENROLLMENT NUMBER : </th>
            <th style="border:2px solid black;"><?=$student->stu_id ?? '';?></th>
            <input type="hidden" name="enrollment" value="<?=$student->stu_id ?? '';?>">
            <input type="hidden" name="student_id" id="" value="<?=$student->id;?>">
        </tr>
        <tr>    
            <th style="border:2px solid black;">SR.NO. : </th>
            <th style="border:2px solid black;"><?=$student->enrollment ?? '';?></th>
            <input type="hidden" name="srno" value="<?=$student->enrollment ?? '';?>">
        </tr>   
        <tr>
            <th style="border:2px solid black;">STUDENT NAME : </th>
            <th style="border:2px solid black;"><?=$student->fname ?? '' ;?>  <?=$student->lname ?? '';?></th>
            <input type="hidden" name="name" value="<?=$student->fname ?? '' ;?>  <?=$student->lname ?? '';?>">
        </tr>   
        <tr>
            <th style="border:2px solid black;">FATHER'S NAME : </th>
            <th style="border:2px solid black;"><?=$student->father ?? '';?></th>
        </tr>   
        <tr>
            <th style="border:2px solid black;">CLASS : </th>
            <th style="border:2px solid black;"><?=$student->class_name ?? '';?></th>
            <input type="hidden" name="class_name" value="<?=$student->class_name ?? '';?>">
            <input type="hidden" name="class_id" value="<?=$student->class_id ?? '';?>">
        </tr>   
        <tr>
            <th style="border:2px solid black;">SECTION : </th>
            <th style="border:2px solid black;"><?=$student->section_name ?? '';?></th>
            <input type="hidden" name="section_name" value="<?=$student->section_name ?? '';?>">
            <input type="hidden" name="sec_id" value="<?=$student->sec_id ?? '';?>">
        </tr>
        <tr>
            <th style="border:2px solid black;">ADDRESS : </th>
            <th style="border:2px solid black;"><?=$student->address ?? '';?></th>
        </tr>
      </thead>
    </table>
    </div>
    </div>
    <div class="col-sm-6  bg-info pt-2" style="border-top:2px solid black ;border-bottom:2px solid black ;border-left:2px solid white ;border-right:2px solid black ;">
    <label><b><u>FEES  DETAILS :</u></b></label>
    <label class="float-right"><b>DATE :- <?=date('d-m-Y : h:i:s');?></b></label>
    <hr style="border: 1px solid black;">
    <span>
    <?php
    if($month1==1)
    { ?> <input type="hidden" name="month1" value="4">
   <?php  }
    if($month2==2 )
    { ?> <input type="hidden" name="month2" value="5">
   <?php  }
    if($month3==3 )
    { ?> <input type="hidden" name="month3" value="6">
   <?php  }
    if($month4==4 )
    { ?> <input type="hidden" name="month4" value="7">
   <?php  }
    if($month5==5 )
    { ?> <input type="hidden" name="month5" value="8">
   <?php  }
    if($month6==6 )
    { ?> <input type="hidden" name="month6" value="9">
   <?php  }
    if($month7==7 )
    { ?> <input type="hidden" name="month7" value="10">
   <?php  }
    if($month8==8 )
    { ?> <input type="hidden" name="month8" value="11">
   <?php  }
    if($month9==9 )
    { ?> <input type="hidden" name="month9" value="12">
   <?php  }
    if($month10==10 )
    { ?> <input type="hidden" name="month10" value="1">
   <?php  }
    if($month11==11 )
    { ?> <input type="hidden" name="month11" value="2">
   <?php  }
    if($month12==12 )
    { ?> <input type="hidden" name="month12" value="3">
   <?php  }
     if($month1==1) {  $MO1="April";  } else { $month1=0; }
     if($month2==2) {  $MO2="May";  } else { $month2=0; }
     if($month3==3) {  $MO3="June"; } else { $month3=0; }
     if($month4==4) {  $MO4="July"; } else { $month4=0; }
     if($month5==5) {  $MO5="August"; } else { $month5=0; }
     if($month6==6) {  $MO6="September"; } else { $month6=0; }
     if($month7==7) {  $MO7="October"; } else { $month7=0; }
     if($month8==8) {  $MO8="November"; } else { $month8=0; }
     if($month9==9) {  $MO9="December"; } else { $month9=0; }
     if($month10==10) {  $MO10="January"; } else { $month10=0; }
     if($month11==11) {  $MO11="February"; } else { $month11=0; }
     if($month12==12) {  $MO12="March"; } else { $month12=0; }
     ?>
    </span>
    <input type="hidden" value="<?=$scheme;?>" name="installment">
    <div class="card-body table-responsive p-0 pb-5">
    <table class="table table-hover text-nowrap  table-bordered" style="border:2px solid black;">
      <thead>
      <?php
        $TFee=0;
        $Qtr=0;
        $Monthname='';
        $rs2 = $this->accounts_model->get_fee($student->class_id,$student->sec_id,$month1,$month2,$month3,$month4,$month5,$month6,$month7,$month8,$month9,$month10,$month11,$month12,$scheme);
        foreach ( $rs2 as $r2)
		{
		  $TFee=$TFee+$r2->amount;
		 if($r2->name=='TUTION FEE')
		 {
		   $Qtr=$Qtr+1;
		 }
		 
		   $FInstal=$r2->feeInstallment;
		  
		if($FInstal==1) {  $MO="April";  } 
        if($FInstal==2) {  $MO="May";  } 
        if($FInstal==3) {  $MO="June"; } 
        if($FInstal==4) {  $MO="July"; } 
        if($FInstal==5) {  $MO="August"; } 
        if($FInstal==6) {  $MO="September"; } 
        if($FInstal==7) {  $MO="October"; } 
        if($FInstal==8) {  $MO="November"; } 
        if($FInstal==9) {  $MO="December"; } 
        if($FInstal==10) {  $MO="January"; } 
        if($FInstal==11) {  $MO="February"; } 
        if($FInstal==12) {  $MO="March"; } 
        if($r2->name=='TUTION FEE'){
            $Monthname2= $r2->monthname;
          $Monthname=$Monthname.' '.$Monthname2; 
        }
        
		?>
		  <tr>
          <th style="border:2px solid black;"><?=$r2->name;?> (<?=$MO;?>)</th><th style="border:2px solid black;">Rs. <?=$r2->amount;?> /-</th>
          </tr>
		<?php
		}
        ?>
        <tr style="font-size:18px; color:red;">
            <?php
            $paymentDate = date('Y-m-d');
            $paymentDate=date('Y-m-d', strtotime($paymentDate));
            $contractDateBegin = date('Y-m-d', strtotime("2023-04-01"));
            $contractDateEnd = date('Y-m-d', strtotime("2023-04-15"));
                
            if (($paymentDate >= $contractDateBegin) && ($paymentDate <= $contractDateEnd)){
                $TFine=0;
                $Fineremark="NA";
            }else{
                $date1=date_create("2023-07-30");
                $date2=date_create(date('Y-m-d'));
                $diff=date_diff($date1,$date2);
                $Nodays=$diff->format("%a");
                $rsf = $this->accounts_model->get_year();
                foreach ( $rsf as $rf)
        		{
        		    $FPerDay=$rf->fine_per_day;
        		    $FMax=$rf->max_fine;
        		    
        		    $TFine=$FPerDay*$Nodays;
        		    if($TFine>100)
        		    {
        		        $TFine=100;
        		    } else {
        		        $TFine=$TFine;
        		    }
        		    $Fineremark="Fine Deposited";
        		}
                 
            }
            ?>
            <tr style="font-size:18px; color:#004006;">
          <th style="border:2px solid black;">Total Amount: </th><th style="border:2px solid black;">Rs. <?=$TFee;?> /-</th>
          </tr>
          <tr  style="font-size:18px; color:red;">
          <th style="border:2px solid black;">Late Fee Charges: Rs.</th><th style="border:2px solid black;"> <input type="number" name="tfine" value="<?=$TFine;?>" required class="form-control">
          <br>
          <input type="text" name="remarkfine" value="<?=$Fineremark;?>" class="form-control" required></th>
          </tr>
      </thead>
    </table>
    <input type="hidden" name="tmonth" value="<?=$Monthname;?>">
    <input type="hidden" name="Quarter" value="<?=$Qtr;?>">
    <input type="hidden" name="TotalFee" value="<?=$TFee;?>">
     <input type="radio" name="paytype" value="0" style="font-size:2rem;" required> Cash 
     <input type="radio" name="paytype" value="1" required> Online 
      <button class="col-sm-4 btn btn-primary btn-lg btn-block float-right mt-3 btn-sm" type="submit">Pay Now</button>
    </div>
    </div>
 </div>    
</div>
</form>