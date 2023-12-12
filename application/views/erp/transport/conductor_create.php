<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            email:"required",
            joindate:"required",
            state:"required",
            city:"required",
            pincode:"required",
            dl_type:"required",
            mobile:"required",
            fname:"required",
            qualification:"required",
            dl_number:"required",
            name:{
                required:true,
            }
            
        },
        messages: {
            state:"Please enter state name",
            city:"Please enter city name",
            pincode:"Please enter pincode ",
            dl_type:"Please select dl type",
            mobile:"Please enter mobile number",
            fname:"Please enter father's name",
            qualification:"Please enter qualification",
            dl_number:"Please enter dl number",
            joindate:"Please Enter Join Date",
            email:"Please Enter Email",
            name: {
                required : "Please enter name.",
            }
        }
    }); 
});
</script>


<?php if($total_data==0){?>
    <form class="ajaxsubmit validate-form reload-tb" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
<div class="modal-body">
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Driver Name<span class="text-danger">*</span> :</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Name">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">S/O<span class="text-danger">*</span> :</label>
                <input type="text" name="fname" class="form-control" placeholder="Enter Father Name">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Mobile Number<span class="text-danger">*</span> :</label>
                <input type="number" class="form-control" name="mobile" placeholder="Enter Mobile Number" >
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Email Address<span class="text-danger">*</span> :</label>
              <input type="email" class="form-control" name="email" placeholder="Enter Email Address">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Address<span class="text-danger">*</span> :</label>
                <input type="text" class="form-control" name="address" placeholder="Enter Address">
            </div> 
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Pan Number : </label>
                <input type="text" class="form-control" name="pan_number" placeholder="Enter Pan Number">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Aadhaar Number : </label>
                <input type="number" class="form-control" name="aadhaar" placeholder="Enter Aadhaar Number">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Joining Date<span class="text-danger">*</span> :</label>
                <input type="date" class="form-control" name="joindate" placeholder="Enter Aadhaar Number">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label"> Qualification<span class="text-danger">*</span> :</label>
                <input type="text" class="form-control" name="qualification" placeholder="Enter Driver Qualification">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label"> State<span class="text-danger">*</span> :</label>
                <input type="text" class="form-control" name="state" placeholder="Enter State">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label"> City<span class="text-danger">*</span> :</label>
                <input type="text" class="form-control" name="city" placeholder="Enter city">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Pincode<span class="text-danger">*</span> :</label>
                <input type="text" class="form-control" name="pincode" placeholder="Enter pincode">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Driver DL<span class="text-danger">*</span> :</label>
                <select name="dl_type" id="" class="form-control" onchange="fetch_dl(this.value)">
                    <option selected="true" disabled="disabled" value="">--Select--</option>
                    <option value="YES">YES</option>
                    <option value="NO">NO</option>
                </select>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group" id="dl_input">
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
                <label class="control-label">Driver Name:</label>
                <input type="text" name="name" class="form-control" value="<?=$driver->name;?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">S/O:</label>
                <input type="text" name="fname" class="form-control"  value="<?=$driver->father_name;?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Mobile Number:</label>
                <input type="number" class="form-control" name="mobile" value="<?=$driver->mobile;?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Email Address</label>
              <input type="email" class="form-control" name="email"  value="<?=$driver->email;?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Address:</label>
                <input type="text" class="form-control" name="address"  value="<?=$driver->address;?>">
            </div> 
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Pan Number</label>
                <input type="text" class="form-control" name="pan_number" value="<?=$driver->pan_number;?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Aadhaar Number</label>
                <input type="number" class="form-control" name="aadhaar"  value="<?=$driver->aadhaar;?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Joining Date</label>
                <input type="date" class="form-control" name="joindate"  value="<?=$driver->joindate;?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label"> Qualification</label>
                <input type="text" class="form-control" name="qualification"  value="<?=$driver->qualification;?>">
            </div>
        </div>
            <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label"> State<span class="text-danger">*</span> :</label>
                <input type="text" class="form-control" name="state" value="<?=$driver->state;?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label"> City<span class="text-danger">*</span> :</label>
                <input type="text" class="form-control" name="city" value="<?=$driver->city;?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Pincode<span class="text-danger">*</span> :</label>
                <input type="text" class="form-control" name="pincode" value="<?=$driver->pincode;?>" >
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label for="recipient-name" class="control-label">Driver DL<span class="text-danger">*</span> :</label>
                <select name="dl_type" id="" class="form-control" onchange="fetch_dl(this.value)">
                    <option selected="true" disabled="disabled" value="">--Select--</option>
                    <option value="YES" <?php if($driver->dl=='YES'){echo "selected";} ;?>>YES</option>
                    <option value="NO" <?php if($driver->dl=='NO'){echo "selected";} ;?>>NO</option>
                </select>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group" id="dl_input">
                <?php if($driver->dl=='YES'){?> <label>DL Number</label><input type="text" name="dl_number" class="form-control" value="<?=$driver->dl_number;?> "> <?php } ;?>
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

            
<script>
    function fetch_dl(value)
    {
        var results = document.querySelector('#dl_input')
        var input = document.createElement('input') //create input
        var label = document.createElement("label"); //create label
        
        if(value=='YES')
        {
        label.innerText = 'Enter DL Number' ;
        input.type = "text";
        input.placeholder = "Please enter DL number"; //add a placeholder
        input.className = "form-control";
        input.name = "dl_number"; // set the CSS class
        results.appendChild(label); //append label
        results.appendChild(document.createElement("br"));
        results.appendChild(input); //append input
        results.appendChild(document.createElement("br"));
        }else
        {
            results.remove(); 
        }
        
    }
</script>