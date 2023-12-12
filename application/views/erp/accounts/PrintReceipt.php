
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper pt-4 pb-5">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?=$title;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url();?>accounts-data">Account</a></li>
              <li class="breadcrumb-item active"><?=$title;?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
      <div class="col-12">
        <!-- receipt section  -->
         <center>
         <input type="button" onclick="printDiv('printableArea')" value="Print Receipt" class="btn btn-lg btn-danger mb-5" />
         </center>
          <div id="printableArea" class="pt-4">
             <?php $i=1; foreach ( $rs as $r)
						{
						 if($r->IsActive==1)
						  {
						   $IsActive="( Cancelled )";
						  } else {
						   $IsActive="";
						    }
						    
						?>
              <table width="100%" style="width:100%; margin-top:-15px; background-color:#ffffff;">
               <tr><td colspan="2"><img src="<?=base_url();?>images/receipt.png" width="100%" height="220px" class="pt-3">
               <hr></td></tr>
                <tr><td><div class="col-xs-12 col-sm-12 col-md-12 pl-3">
                    <address style="color:#000000;">
                        <strong style="font-size:18px;"><?=$r->student_name;?></strong>
                        <br>
                        Father's Name: <?=$r->father;?>
                        <br>
                        Mother's Name: <?=$r->mother;?>
                        <br>
                        Class <?=$r->class_name;?>
                        <br>
                        Section <?=$r->section_name;?>
                        
                    </address>
                </div></td> 
                <td><div class="col-xs-12 col-sm-12 col-md-12 text-right pr-3">
                    <p style="color:#000000;">
                        <em>Receipt #: <?=$r->receiptno;?></em><br>
                        <em>Student-Id: <?=$r->enrollment;?></em><br>
                        <em>Date: <?=date("d M, Y", strtotime($r->submitted_date));?></em>
                    </p>
                </div></td></tr>
              </table>
                <table class=" " style="width:100%; border:1px;  background-color:#ffffff;" width="100%">
                  
                    <thead >
                        <tr style="color:#000000; font-size:14px;">
                            <th class="text-left">&nbsp;&nbsp;&nbsp;&nbsp;Particulars</th>
                            <th class="text-right">Amount&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
    			        $TFee=0;
    			        $sql2 = "SELECT * FROM `fee_submitted`  WHERE receiptno='".$r->receiptno."' ";
                        $query = $this->db->query($sql2);
                         $rs2 =  $query->result();
                        foreach ( $rs2 as $r2)
		                {
		                  $TFee=$TFee+$r2->submitted_fee;  
		                 $Quarter= $r2->quarter; 
		                 $QMonthname= $r2->qmonthname; 
		                 
		                 $sql4 = "SELECT count(*) as ju FROM `fee_submitted`  WHERE `enrollment`='".$r->enrollment."' and `qmonthname` LIKE '%july%' ";
                         $query1 = $this->db->query($sql4);
                         $rs4 =  $query1->result();
                        foreach ( $rs4 as $r4)
		                {
		                    $juno=$r4->ju;
		                }
		                 if($juno>0)
		                 {
		                     $PName='Tution Fee, Term Charges';
		                 } else {
		                     $PName='Tution Fee';
		                 }
		                 if($Quarter==1)
		                 {
		                     $PNameMonth='April';
		                 } else if($Quarter==2){
		                     $PNameMonth='April, May';
		                 } else if($Quarter==3){
		                     $PNameMonth='April, May, June';
		                 } else if($Quarter==4){
		                     $PNameMonth='April, May, June, July';
		                 } else if($Quarter==5){
		                     $PNameMonth='April, May, June, July, August';
		                 } else if($Quarter==6){
		                     $PNameMonth='April, May, June, July, August, September';
		                 } else if($Quarter==7){
		                     $PNameMonth='April, May, June, July, August, September, October';
		                 } else if($Quarter==8){
		                     $PNameMonth='April, May, June, July, August, September, October, November';
		                 } else if($Quarter==9){
		                     $PNameMonth='April, May, June, July, August, September, October, November, December';
		                 } else if($Quarter==10){
		                     $PNameMonth='April, May, June, July, August, September, October, November, December, January';
		                 } else if($Quarter==11){
		                     $PNameMonth='April, May, June, July, August, September, October, November, December, January, February';
		                 } else if($Quarter==12){
		                     $PNameMonth='April, May, June, July, August, September, October, November, December, January, February, March';
		                 }
		                ?>
		                  <tr style="color:#000000;">
                          <td class="text-left"><em>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $PName; ?> ( <?php echo $QMonthname;?> )</em></td><td class="text-right " >Rs. <?=$r2->submitted_fee;?> &nbsp;&nbsp;&nbsp;&nbsp;</td>
                          </tr>
                          <?php if($r2->fine>0) { ?>
                          <tr style="color:#000000;">
                          <td class="text-left"><em>&nbsp;&nbsp;&nbsp;&nbsp;Late Fee Charges: </em></td><td class="text-right " >Rs. <?=$r2->fine;?> &nbsp;&nbsp;&nbsp;&nbsp;</td>
                        </tr>
                        <?php } ?>
		                <?php
		                }
                        ?>
                        <tr style="color:#000000; font-size:18px; border:1px;">
                           
                            <td class="text-right text-danger" colspan="2">
                                <hr>
                                 <?php if($r2->fine>0) { $TFine=$r2->fine; } else { $TFine=0; }?>
                                <h5><?=$IsActive;?>  <strong>Total: Rs. <?=$TFee+$TFine;?> </strong>&nbsp;&nbsp;&nbsp;&nbsp;</h5></td>
                        </tr>
                        <tr style=" font-size:16px; ">
                            
                            <td class="text-right pb-5 pr-3" colspan="2" ><br>( Signature )</td>
                            
                        </tr>
                      
                    </tbody>
                </table>
               <hr style="height:1px;color:#333;background-color:#333; border-top: 1px dashed #000;" />
               <table width="100%" style="width:100%; margin-top:-15px; background-color:#ffffff;">
               <tr><td colspan="2"><img src="<?=base_url();?>images/receipt.png" width="100%" height="220px">
               <hr></td></tr>
                <tr><td><div class="col-xs-12 col-sm-12 col-md-12 pl-3">
                    <address style="color:#000000;">
                        <strong style="font-size:18px;"><?=$r->student_name;?></strong>
                        <br>
                        Father Name: <?=$r->father;?>
                        <br>
                        Mother's Name: <?=$r->mother;?>
                        <br>
                        Class <?=$r->class_name;?>
                        <br>
                        Section <?=$r->section_name;?>
                        
                    </address>
                </div></td> 
                <td><div class="col-xs-12 col-sm-12 col-md-12 text-right pr-3">
                    <p style="color:#000000;">
                        <em>Receipt #: <?=$r->receiptno;?></em><br>
                        <em>Student-Id: <?=$r->enrollment;?></em><br>
                        <em>Date: <?=date("d M, Y", strtotime($r->submitted_date));?></em>
                    </p>
                </div></td></tr>
            </table>
             <table class=" " style="width:100%; border:1px;  background-color:#ffffff;" width="100%">
               <thead > 
                <tr style="color:#000000; font-size:14px;">
                      <th class="text-left">&nbsp;&nbsp;&nbsp;&nbsp;Particulars</th>
                      <th class="text-right">Amount&nbsp;&nbsp;&nbsp;&nbsp;</th>
                       </tr>
                    </thead>
                    <tbody>
                        <?php
    			        $TFee=0;
    			        $sql2 = "SELECT * FROM `fee_submitted`  WHERE Receiptno='".$r->receiptno."' ";
                        $query = $this->db->query($sql2);
                         $rs2 =  $query->result();
                        foreach ( $rs2 as $r2)
		                {
		                  $TFee=$TFee+$r2->submitted_fee;  
		                 $Quarter= $r2->quarter; 
		                 $QMonthname= $r2->qmonthname; 
		                 
		                 $sql4 = "SELECT count(*) as ju FROM `fee_submitted`  WHERE `enrollment`='".$r->enrollment."' and `qmonthname` LIKE '%july%' ";
                         $query1 = $this->db->query($sql4);
                         $rs4 =  $query1->result();
                        foreach ( $rs4 as $r4)
		                {
		                    $juno=$r4->ju;
		                }
		                 if($juno>0)
		                 {
		                     $PName='Tution Fee, Term Charges';
		                 } else {
		                     $PName='Tution Fee';
		                 }
		                 if($Quarter==1)
		                 {
		                     $PNameMonth='April';
		                 } else if($Quarter==2){
		                     $PNameMonth='April, May';
		                 } else if($Quarter==3){
		                     $PNameMonth='April, May, June';
		                 } else if($Quarter==4){
		                     $PNameMonth='April, May, June, July';
		                 } else if($Quarter==5){
		                     $PNameMonth='April, May, June, July, August';
		                 } else if($Quarter==6){
		                     $PNameMonth='April, May, June, July, August, September';
		                 } else if($Quarter==7){
		                     $PNameMonth='April, May, June, July, August, September, October';
		                 } else if($Quarter==8){
		                     $PNameMonth='April, May, June, July, August, September, October, November';
		                 } else if($Quarter==9){
		                     $PNameMonth='April, May, June, July, August, September, October, November, December';
		                 } else if($Quarter==10){
		                     $PNameMonth='April, May, June, July, August, September, October, November, December, January';
		                 } else if($Quarter==11){
		                     $PNameMonth='April, May, June, July, August, September, October, November, December, January, February';
		                 } else if($Quarter==12){
		                     $PNameMonth='April, May, June, July, August, September, October, November, December, January, February, March';
		                 }
		                ?>
		                  <tr style="color:#000000;">
                          <td class="text-left"><em>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $PName; ?> ( <?php echo $QMonthname;?> )</em></td><td class="text-right " >Rs. <?=$r2->submitted_fee;?> &nbsp;&nbsp;&nbsp;&nbsp;</td>
                          </tr>
                          <?php if($r2->fine>0) { ?>
                          <tr style="color:#000000;">
                          <td class="text-left"><em>&nbsp;&nbsp;&nbsp;&nbsp;Late Fee Charges: </em></td><td class="text-right " >Rs. <?=$r2->fine;?> &nbsp;&nbsp;&nbsp;&nbsp;</td>
                        </tr>
                        <?php } ?>
		                <?php
		                }
                        ?>
                        <tr style="color:#000000; font-size:18px; border:1px;">
                         <td class="text-right text-danger" colspan="2">
                                <hr>
                                 <?php if($r2->fine>0) { $TFine=$r2->fine; } else { $TFine=0; }?>
                                <h5><?=$IsActive;?>  <strong>Total: Rs. <?=$TFee+$TFine;?> </strong>&nbsp;&nbsp;&nbsp;&nbsp;</h5></td>
                        </tr>
                        <tr style=" font-size:16px; ">
                            
                            <td class="text-right pr-3 pb-5" colspan="2" ><br>( Signature )</td>
                            
                        </tr>
                      
                    </tbody>
                </table>
                   <?php } ?>
                 </div>
               <center>
               <input type="button" onclick="printDiv('printableArea')" value="Print Receipt" class="btn btn-lg btn-danger mt-5" />
              </center>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <script>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
    
</script>