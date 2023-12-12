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

<form class="ajaxsubmit validate-form reload-page" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
<div class="modal-body">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Account Holder Name:</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Account Holder Name">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Bank Name:</label>
                <input type="text" name="bankname" class="form-control" placeholder="Enter Bank Name">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Account  Number:</label>
                <input type="number" class="form-control" name="accountnumber" placeholder="Enter Account Number" >
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">IFSC Code</label>
              <input type="email" class="form-control" name="ifsccode" placeholder="Enterb IFSC Code">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Self Photo</label>
                <input type="file" class="form-control" name="selffile">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Aadhaar File:</label>
                <input type="file" class="form-control" name="aadhaarfile" >
            </div> 
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Pan File</label>
                <input type="file" class="form-control" name="panfile">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Bank Passbook File</label>
                <input type="file" class="form-control" name="bankfile" >
            </div>
        </div>
        
            
        </div>
 
        

</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Add</button>
</div></form>

            
