
<style>
    .table .table td,
    .table .table th {
        border: 1px solid #f3f1f1;
    }


</style>

    

<div class="modal fade" id="customerDetailModal" tabindex="-1" role="dialog" aria-labelledby="customerDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mr-5" id="customerDetailModalLabel">Student (<?php echo $student->fname ?? ''; ?> <?php echo $student->lname ?? ''; ?>) Details</h5>
               <center> <input type="button" class="btn btn-danger btn-sm" onclick="printDiv('printableArea')" value="Print" / ></center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body" id="printableArea" >
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered table-secondary">
                            <tr>
                                <th>Student Photo</th>
                                <td><img src="<?php echo IMGS_URL.$student->self_img ?? ''; ?>" alt="" height="70px"></td>
                            </tr>
                            <tr>
                                <th>Standard / CLass</th>
                                <td><?php echo $student->class_name ?? ''; ?></td>
                            </tr>
                            <tr>
                                <th>Student ID</th>
                                <td><?php echo $student->stu_id ?? ''; ?></td>
                            </tr>
                            <tr>
                                <th>Student Enrollment / Sr No.</th>
                                <td><?php echo $student->enrollment ?? ''; ?></td>
                            </tr>
                            <tr>
                                <th>Roll No.</th>
                                <td><?php echo $student->roll_no ?? ''; ?></td>
                            </tr>
                            <tr>
                                <th>Full Name</th>
                                <td><?php echo $student->fname ?? ''; ?> <?php echo $student->lname ?? ''; ?></td>
                            </tr>
                            <tr>
                                <th>Father's Name</th>
                                <td><?php echo $student->father ?? ''; ?></td>
                            </tr>
                            <tr>
                                <th>Mother's Name</th>
                                <td><?php echo $student->mother ?? ''; ?></td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td><?php echo $student->gender ?? ''; ?></td>
                            </tr>
                            <tr>
                                <th>D.O.B</th>
                                <td><?php 
                                 $excel_date =$student->dob;    
                                 //Convert excel date to mysql db date
                                $unix_date = ($excel_date - 25569) * 86400;
                                $excel_date = 25569 + ($unix_date / 86400);
                                $unix_date = ($excel_date - 25569) * 86400;
                                //Insert below to sql
                                echo $added_date = gmdate("d/m/Y", $unix_date); ?></td>
                            </tr>
                            <tr>
                                <th>Student Aadhaar</th>
                                <td><?php echo $student->adhaar ?? ''; ?></td>
                            </tr>
                            <tr>
                                <th>Student No</th>
                                <td><?php echo $student->mobile ?? ''; ?></td>
                            </tr>
                            <tr>
                                <th>Father's No</th>
                                <td><?php echo $student->father_no ?? ''; ?></td>
                            </tr>
                            <tr>
                                <th>If Email</th>
                                <td><?php echo $student->email ?? ''; ?></td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td><?php echo $student->address ?? ''; ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><?php echo $student->type ?? ''; ?></td>
                            </tr>
                            <tr>
                                <th>Registration Date</th>
                                <td><?php echo date('d M Y h:i A', strtotime($student->updated)); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <input type="button" class="btn btn-danger btn-sm" onclick="printDiv('printableArea')" value="Print" />
            </div>
        </div>
    </div>
</div>

<script>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
