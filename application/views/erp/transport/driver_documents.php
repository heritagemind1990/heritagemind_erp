<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            bankname:"required",
            accountnumber:"required",
            ifsccode:"required",
            branch_name:"required",
            name:{
                required:true,
            }
            
        },
        messages: {
            branch_name:"Please enter branch name",
            bankname:"Please enter bank name",
            accountnumber:"Please enter account number",
            ifsccode:"Please enter ifsc code",
            name: {
                required : "Please enter account holder name.",
            }
        }
    }); 
});
</script>
<?php foreach($count as $c){  $row=$c->doc_type;};?>
<form class="ajaxsubmit validate-form reload-tb" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
<?php if($row==0){?>
<div class="modal-body">
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Account Holder Name:</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Account Holder Name">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Bank Name:</label>
                <input type="text" name="bankname" class="form-control" placeholder="Enter Bank Name">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Account  Number:</label>
                <input type="number" class="form-control" name="accountnumber" placeholder="Enter Account Number" >
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">IFSC Code</label>
              <input type="text" class="form-control" name="ifsccode" placeholder="Enterb IFSC Code">
            </div>
        </div>
         <div class="col-4">
            <div class="form-group">
                <label class="control-label">Branch Name</label>
              <input type="text" class="form-control" name="branch_name" placeholder="Enterb Branch Names">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Self Photo</label>
                <input type="file" class="form-control" name="pic">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Aadhaar File:</label>
                <input type="file" class="form-control" name="doc" >
            </div> 
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Pan File</label>
                <input type="file" class="form-control" name="doc1">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Bank Passbook File</label>
                <input type="file" class="form-control" name="doc2" >
            </div>
        </div>
          <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">DL File</label>
                <input type="file" class="form-control" name="doc3" >
            </div>
        </div>
            
        </div>
 
        

</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Add</button>
</div>
<?php }else{?>

    <div class="modal-body">
    <div class="row">
    <?php foreach($count as $c){?>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Account Holder Name:</label>
                <input type="text" name="name" class="form-control" value="<?=$c->account_holder_name;?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Bank Name:</label>
                <input type="text" name="bankname" class="form-control" value="<?=$c->bank_name;?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Account  Number:</label>
                <input type="number" class="form-control" name="accountnumber" value="<?=$c->account_number;?>" >
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">IFSC Code</label>
              <input type="text" class="form-control" name="ifsccode" value="<?=$c->ifsc_code;?>">
            </div>
        </div>
         <div class="col-4">
            <div class="form-group">
                <label class="control-label">Branch Name</label>
              <input type="text" class="form-control" name="branch_name" value="<?=$c->branch_name;?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Self Photo</label>
                <input type="file" class="form-control" name="pic">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Aadhaar File:</label>
                <input type="file" class="form-control" name="doc" >
            </div> 
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Pan File</label>
                <input type="file" class="form-control" name="doc1">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Bank Passbook File</label>
                <input type="file" class="form-control" name="doc2" >
            </div>
        </div>
         <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">DL File</label>
                <input type="file" class="form-control" name="doc3" >
            </div>
        </div>
        <hr style="border: 2px solid black;width:100%">
        <div class="col-3">
         <span>Self Photo</span>   
        <div class="card">
            <img src="<?php echo IMGS_URL.$c->photo ;?>" alt="" height="100px">
        </div>
        </div>
        <div class="col-3">
        <span>Aadhaar File</span>   
        <div class="card">
            <img src="<?php echo IMGS_URL.$c->aadhaar_file ;?>" alt="" height="100px">
        </div>
        </div>
        <div class="col-3">
        <span>Pan File</span>   
        <div class="card">
            <img src="<?php echo IMGS_URL.$c->pan_photo ;?>" alt="" height="100px">
        </div>
        </div>
        <div class="col-3">
        <span>Bank Passbook</span>   
        <div class="card">
            <img src="<?php echo IMGS_URL.$c->bank_passbook ;?>" alt="" height="100px">
        </div>
        </div>
          <div class="col-3">
        <span>DL File</span>   
        <div class="card">
            <img src="<?php echo IMGS_URL.$c->dl_photo ;?>" alt="" height="100px">
        </div>
        </div>
        <?php }?>
            
        </div>
 
        

</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Add</button>
</div>
<?php }?>
</form>

            
