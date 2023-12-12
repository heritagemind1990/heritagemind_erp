
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
                <h5 class="modal-title" id="customerDetailModalLabel">Student Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered table-secondary">
                        <tr>
                                <th>Standard / CLass</th>
                                <td><?php echo $student->class_name ;?></td>
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
                                echo $student->dob; 
                                 $excel_date =$student->dob;    
                                 //Convert excel date to mysql db date
                                $unix_date = ($excel_date - 25569) * 86400;
                                $excel_date = 25569 + ($unix_date / 86400);
                                $unix_date = ($excel_date - 25569) * 86400;
                                //Insert below to sql
                                echo $added_date = gmdate("d/m/Y", $unix_date); ?></td>
                            </tr>
                            <tr>
                                <th>Father's No</th>
                                <td><?php echo $student->father_no ?? ''; ?></td>
                            </tr>
                            <tr>
                                <th>Category </th>
                                <td><?php echo $student->category_name ?? ''; ?></td>
                            </tr>
                            <tr>
                                <th>Concession</th>
                                <?php $se = $this->admission_model->Select('concession_master', '*', array('id'=>$student->concession_id)); ?>
                                <td><?php  foreach($se as $s){echo $s->title;} ; ?></td>
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
                                <th>Enquiry Date</th>
                                <td><?php echo date('d M Y h:i A', strtotime($student->added)); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <form class="form ajaxsubmit validate-form submit reload-page" action="<?=base_url('enquiry-master/student_approve');?>" method="post" enctype= multipart/form-data>
   <input type="hidden" name="student_id" id="" value="<?=$student->id;?>">
   <div class="row mt-3">
       <div class="col-6">
           <div class="form-group">
               <label class="control-label">Student Photo <sup>*</sup> :</label>
               <input type="file" name="doc" class="form-control" required>
           </div>
       </div>
       <div class="col-6">
           <div class="form-group">
               <label class="control-label">Email Address :</label>
               <input type="email" class="form-control" name="email" placeholder="Enter Email Address">
           </div>
       </div>
       <div class="col-6">
           <div class="form-group">
               <label class="control-label">Enrollment Number / Sr No :</label>
               <input type="text" class="form-control" name="enroll" placeholder="Enter Enrollment / Sr No.">
           </div>
       </div>
       <div class="col-6">
           <div class="form-group">
               <label class="control-label">Roll No. <sup>*</sup> :</label>
               <input type="text" class="form-control" name="roll" placeholder="Enter Roll Number">
           </div>
       </div>
       <div class="col-6">
           <div class="form-group">
               <label class="control-label">Student Aadhaar  <sup>*</sup>  :</label>
               <input type="number" class="form-control" name="aadhaar" placeholder="Enter Student Aadhaar Number">
           </div>
       </div>

       <div class="col-6">
           <div class="form-group">
               <label class="control-label">Father's Aadhdar :</label>
               <input type="number" class="form-control" name="paadhaar" placeholder="Enter Father's Number">
           </div>
       </div>
       </div>
<div class="modal-footer">
   <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
   <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Approved </button>
</div>

</form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            doc:"required",
            roll:"required",
            aadhaar:"required",
            
        },
        messages: {
            doc:"Please Select Student Photo",
            roll:"Please Enter Roll Number",
            aadhaar:"Please Enter Student Aadhaar Number",
        }
    }); 
});
</script>
