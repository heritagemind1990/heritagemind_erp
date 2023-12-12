
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
              <li class="breadcrumb-item"><a href="<?=base_url();?>accounts-data">Accounts</a></li>
              <li class="breadcrumb-item active">Student Fee Collection Report</li>
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
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
              <h3 class="card-title float-right">
              <button onclick="ExportToExcel('xlsx')" class="btn btn-success btn-sm mr-2">Export table to excel</button>
                <a href="<?=base_url();?>accounts-data" class="btn btn-danger btn-sm"><i class="fas fa-backward"></i>   Back</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-content collapse show" >
                 <div class="card-body table-responsive p-0 pb-2 pt-4">
                <table class="table table-hover text-nowrap  table-bordered" id="tbl_exporttable_to_xls">
                  <thead>
                  <tr>
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
                </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
              
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  
  <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script type="text/javascript">
function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('tbl_exporttable_to_xls');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('Fee Collection Report.' + (type || 'xlsx')));
    }
</script>