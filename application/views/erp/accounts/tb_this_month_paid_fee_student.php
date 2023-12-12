
            <div class="card-body table-responsive p-0 pb-2 pt-4">
                <table class="table table-hover text-nowrap  table-bordered" id="tbl_exporttable_to_xls">
                  <thead>
                  <tr>
                    <th>Sr.No.</th>
                    <th>ReceiptNo</th>
                    <th>Enrollment</th>
                    <th>SrNo </th>
                    <th>Student</th>
                    <th>Section</th>
                    <th>Paid Fees</th>
                    <th>Late Fee</th>
                    <th>Submitted Date</th>
                    <th>Payment Mode</th>
                    <th>Status</th>
                  </tr>
                  </thead>  
                  <tbody>
                <?php $finalTotal =  $TFee = $TFine=0;$i=1;foreach($rows as $r){?>
                  <tr>
                    <td><?=$i;?></td>
                    <td><a href="<?=base_url('fee-PrintReceipt/'.$r->receiptno);?>" target="_blank"><?=$r->receiptno;?></a></td>
                    <td><?=$r->enrollment;?></td>
                    <td><?=$r->srno;?></td>
                    <td><?=$r->student_name;?></td>
                    <td><?=$r->section_name;?></td>
                    <td><?=$r->submitted_fee;?></td>
                    <td><?=$r->fine;?></td>
                    <td><?=date("d M, Y", strtotime($r->submitted_date));?></td>
                    <td><?php if($r->payment_mode==0){echo "Cash";}elseif($r->payment_mode==1){echo "Online";} ;?></td>
                    <td><?php if($r->IsActive==0){echo "Approve";}else{echo "Failed";} ;?></td>
                  </tr>
                  <?php 
                   $TFee = $TFee+$r->submitted_fee;
                   $TFine = $TFine+$r->fine;
                   $finalTotal = $TFee + $TFine;
                  ?>
                  <?php $i++; }?>
                  <tr>
                    <td style="border-bottom:2px solid black;border-top:2px solid black;border-left:none;border-right:none;"></td>
                    <td style="border-bottom:2px solid black;border-top:2px solid black;border-left:none;border-right:none;"></td>
                    <td style="border-bottom:2px solid black;border-top:2px solid black;border-left:none;border-right:none;"></td>
                    <td style="border-bottom:2px solid black;border-top:2px solid black;border-left:none;border-right:none;"></td>
                    <td style="border-bottom:2px solid black;border-top:2px solid black;border-left:none;border-right:none;"></td>
                    <th style="border-bottom:2px solid black;border-top:2px solid black;border-left:none;border-right:2px solid black;">Total :</th>
                    <th style="border-bottom:2px solid black;border-top:2px solid black;border-left:none;border-right:2px solid black;">Rs  <?php echo number_format($TFee,2,".",",");?></th>
                    <th style="border-bottom:2px solid black;border-top:2px solid black;border-left:none;border-right:none;">Rs  <?php echo number_format($TFine,2,".",",");?></th>
                    <td style="border-bottom:2px solid black;border-top:2px solid black;border-left:none;border-right:none;"></td>
                    <td style="border-bottom:2px solid black;border-top:2px solid black;border-left:none;border-right:none;"></td>
                    <td style="border-bottom:2px solid black;border-top:2px solid black;border-left:none;border-right:none;"></td>
                  </tr>
                  <tr>
                    <td style="border-bottom:2px solid black;border-top:2px solid black;border-left:none;border-right:none;"></td>
                    <td style="border-bottom:2px solid black;border-top:2px solid black;border-left:none;border-right:none;"></td>
                    <td style="border-bottom:2px solid black;border-top:2px solid black;border-left:none;border-right:none;"></td>
                    <td style="border-bottom:2px solid black;border-top:2px solid black;border-left:none;border-right:none;"></td>
                    <td style="border-bottom:2px solid black;border-top:2px solid black;border-left:none;border-right:none;"></td>
                    <th style="border-bottom:2px solid black;border-top:2px solid black;border-left:none;border-right:none;">Final Total :</th>
                    <th style="border-bottom:2px solid black;border-top:2px solid black;border-left:none;border-right:none;">Rs  <?php echo number_format($TFee+$TFine,2,".",",");?></th>
                    <td style="border-bottom:2px solid black;border-top:2px solid black;border-left:none;border-right:none;"></td>
                    <td style="border-bottom:2px solid black;border-top:2px solid black;border-left:none;border-right:none;"></td>
                    <td style="border-bottom:2px solid black;border-top:2px solid black;border-left:none;border-right:none;"></td>
                    <td style="border-bottom:2px solid black;border-top:2px solid black;border-left:none;border-right:none;"></td>
                  </tr>
                  </tbody>
                </table>
              </div>