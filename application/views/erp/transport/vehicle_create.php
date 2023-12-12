<?php if($total_data==0){?>
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            oemail:"required",
            omobile:"required",
            vname:"required",
            reg_no:"required",
            capacity:"required",
            vnumber:"required",
            joindate:"required",
            insurance_renew_date:"required",
            pic:"required",
            oname:{
                required:true,
            }
            
        },
        messages: {
            omobile:"Please enter owner mobile number",
            vname:"Please enter vehicle number",
            reg_no:"Please enter vehicle registration number",
            capacity:"Please enter vehicle children capacity",
            vnumber:"Please enter vehicle number",
            joindate:"Please select join date",
            insurance_renew_date:"Please enter insurance renew date",
            pic:"Please select vehicle pic",
            oemail:"Please enter owner email address",
            oname: {
                required : "Please enter owner name.",
            }
        }
    }); 
});
</script>
<?php } else{ ?>
    <script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            oemail:"required",
            omobile:"required",
            vname:"required",
            reg_no:"required",
            capacity:"required",
            vnumber:"required",
            joindate:"required",
            insurance_renew_date:"required",
            oname:{
                required:true,
            }
            
        },
        messages: {
            omobile:"Please enter owner mobile number",
            vname:"Please enter vehicle number",
            reg_no:"Please enter vehicle registration number",
            capacity:"Please enter vehicle children capacity",
            vnumber:"Please enter vehicle number",
            joindate:"Please select join date",
            insurance_renew_date:"Please enter insurance renew date",
            oemail:"Please enter owner email address",
            oname: {
                required : "Please enter owner name.",
            }
        }
    }); 
});
</script>

<?php }?>

<?php if($total_data==0){?>
    <form class="ajaxsubmit validate-form reload-tb" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
<div class="modal-body">
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Ornwer Name<span class="text-danger">*</span> : </label>
                <input type="text" name="oname" class="form-control" placeholder="Enter Owner Name">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Owner Mobile Number<span class="text-danger">*</span> : </label>
                <input type="number" class="form-control" name="omobile" placeholder="Enter Owner Mobile Number" >
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label"> Owner Email Address<span class="text-danger">*</span> : </label>
              <input type="email" class="form-control" name="oemail" placeholder="Enter Owner Email Address">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Vehicle Name<span class="text-danger">*</span> : </label>
                <input type="text" name="vname" class="form-control" placeholder="Enter Vehicle Name">
            </div>
        </div>
     
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Vehicle Registration Number<span class="text-danger">*</span> : </label>
                <input type="text" class="form-control" name="reg_no" placeholder="Enter Vehicle Registration Number">
            </div> 
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Vehicle Children Capacity<span class="text-danger">*</span> : </label>
                <input type="text" class="form-control" name="capacity" placeholder="Enter Vehicle Children Capacity">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Vehicle Number<span class="text-danger">*</span> : </label>
                <input type="text" class="form-control" name="vnumber" placeholder="Enter Vehicle Number">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Joining Date<span class="text-danger">*</span> : </label>
                <input type="date" class="form-control" name="joindate" >
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label"> Insurance Renew Date<span class="text-danger">*</span> : </label>
                <input type="date" class="form-control" name="insurance_renew_date" placeholder="Enter Insurance Renew Date ">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label"> Vehicle Photo<span class="text-danger">*</span> : </label>
                <input type="file" class="form-control" name="pic" placeholder="Enter State">
            </div>
        </div>
        </div>
 
        

</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Add</button>
</div></form>
<?php }else {?>
    <form class="ajaxsubmit validate-form reload-tb" action="<?=$update_url?>" method="post" enctype= multipart/form-data>
    <div class="modal-body">
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Ornwer Name<span class="text-danger">*</span> : </label>
                <input type="text" name="oname" class="form-control" value="<?=$vehicle->owner_name;?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Owner Mobile Number<span class="text-danger">*</span> : </label>
                <input type="number" class="form-control" name="omobile" value="<?=$vehicle->owner_mobile_no;?>" >
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label"> Owner Email Address<span class="text-danger">*</span> : </label>
              <input type="email" class="form-control" name="oemail" value="<?=$vehicle->owner_email;?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Vehicle Name<span class="text-danger">*</span> : </label>
                <input type="text" name="vname" class="form-control" value="<?=$vehicle->vehicle_name;?>">
            </div>
        </div>
     
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Vehicle Registration Number<span class="text-danger">*</span> : </label>
                <input type="text" class="form-control" name="reg_no" value="<?=$vehicle->vehicle_reg_no;?>">
            </div> 
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Vehicle Children Capacity<span class="text-danger">*</span> : </label>
                <input type="text" class="form-control" name="capacity" value="<?=$vehicle->vehicle_child_capacity;?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Vehicle Number<span class="text-danger">*</span> : </label>
                <input type="number" class="form-control" name="vnumber" value="<?=$vehicle->vehicle_no;?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Joining Date<span class="text-danger">*</span> : </label>
                <input type="date" class="form-control" name="joindate" value="<?=$vehicle->join_date;?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label"> Insurance Renew Date<span class="text-danger">*</span> : </label>
                <input type="date" class="form-control" name="insurance_renew_date" value="<?=$vehicle->insurance_renew_date;?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label"> Vehicle Photo<span class="text-danger">*</span> : </label>
                <input type="file" class="form-control" name="pic" placeholder="Enter State">
            </div>
        </div>
        </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Update</button>
</div>
</form>
    <?php }?>
