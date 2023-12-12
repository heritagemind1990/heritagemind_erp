<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            email:"required",
            joindata:"required",
            name:{
                required:true,
            }
            
        },
        messages: {
            joindata:"Please Enter Join Date",
            email:"Please Enter Email",
            name: {
                required : "Please enter name.",
            }
        }
    }); 
});
</script>


<?php if($total_data==0){?>
    <form class="ajaxsubmit validate-form reload-page" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
<div class="modal-body">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Teacher Name:</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Name">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">S/O:</label>
                <input type="text" name="fname" class="form-control" placeholder="Enter Father Name">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Mobile Number:</label>
                <input type="number" class="form-control" name="number" placeholder="Enter Mobile Number" >
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Email Address</label>
              <input type="email" class="form-control" name="email" placeholder="Enterb Email Address">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Address:</label>
                <input type="text" class="form-control" name="address" placeholder="Enter Address">
            </div> 
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Pan Number</label>
                <input type="text" class="form-control" name="pannumber" placeholder="Enter Pan Number">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Aadhaar Number</label>
                <input type="number" class="form-control" name="aadhaar" placeholder="Enter Aadhaar Number">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Joining Date</label>
                <input type="date" class="form-control" name="joindata" placeholder="Enter Aadhaar Number">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Teachers Qualification</label>
                <input type="text" class="form-control" name="teacherqualification" placeholder="Enter Teachers Qualification">
            </div>
        </div>
            
        </div>
 
        

</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Add</button>
</div></form>
<?php }else {?>
    <form class="ajaxsubmit validate-form reload-page" action="<?=$update_url?>" method="post" enctype= multipart/form-data>
    <div class="modal-body">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Teacher Name:</label>
                <input type="text" name="name" class="form-control" value="<?=$teacher->name;?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">S/O:</label>
                <input type="text" name="fname" class="form-control"  value="<?=$teacher->father_name;?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Mobile Number:</label>
                <input type="number" class="form-control" name="number" value="<?=$teacher->phone;?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Email Address</label>
              <input type="email" class="form-control" name="email"  value="<?=$teacher->email;?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Address:</label>
                <input type="text" class="form-control" name="address"  value="<?=$teacher->address;?>">
            </div> 
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Pan Number</label>
                <input type="text" class="form-control" name="pannumber" value="<?=$teacher->pan;?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Aadhaar Number</label>
                <input type="number" class="form-control" name="aadhaar"  value="<?=$teacher->adhaar;?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Joining Date</label>
                <input type="date" class="form-control" name="joindata"  value="<?=$teacher->joindate;?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Teachers Qualification</label>
                <input type="text" class="form-control" name="teacherqualification"  value="<?=$teacher->teaching_qualification;?>">
            </div>
        </div>
            
        </div>
 
        

</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Add</button>
</div>
</form>
    <?php }?>

            
