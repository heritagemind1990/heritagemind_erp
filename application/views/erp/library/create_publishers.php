<?php  if($total_data==0){?>
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            mobile:"required",
            name:{
                required:true,
                remote:"<?=$remote?>"
            }
            
        },
        messages: {
            mobile:"Please Enter Mobile Number",
            name: {
                required : "Please Enter Publisher",
                remote : "Publisher Already Exist!"
            }
        }
    }); 
});
</script>
<?php }else{?>
    <script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            mobile:"required",
            name:{
                required:true,
            }
            
        },
        messages: {
            mobile:"Please Enter Mobile Number",
            name: {
                required : "Please Enter Publisher ",
            }
        }
    }); 
});
</script>
   <?php } ?>
    <form class="form ajaxsubmit validate-form submit reload-tb" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
    <?php  if($total_data==0){?>
    <div class="modal-body">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Publisher Name<span class="text-danger">*</span>:</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Publisher  Name">
            </div>
        </div>
         <div class="col-6">
            <div class="form-group">
                <label class="control-label">Mobile<span class="text-danger">*</span>:</label>
                <input type="text" name="mobile" placeholder="Enter Mobile Name" class="form-control">
            </div>
        </div>
         <div class="col-6">
            <div class="form-group">
                <label class="control-label">Country:</label>
                <input type="text" name="country" value="India" class="form-control">
            </div>
        </div>
         <div class="col-6">
            <div class="form-group">
                <label class="control-label">State:</label>
                <input type="text" name="state" placeholder="Enter State Name" class="form-control">
            </div>
        </div>
         <div class="col-6">
            <div class="form-group">
                <label class="control-label">City:</label>
                <input type="text" name="city" placeholder="Enter City Name" class="form-control">
            </div>
        </div>
          <div class="col-6">
            <div class="form-group">
                <label class="control-label">Pincode:</label>
                <input type="number" name="pincode" placeholder="Enter Pincode " class="form-control">
            </div>
        </div>
         <div class="col-12">
            <div class="form-group">
                <label class="control-label">Address:</label>
                <textarea name="address" placeholder="Enter Address " class="form-control"></textarea>
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
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Publisher Name<span class="text-danger">*</span>:</label>
                <input type="text" name="name" value="<?=$publishers->name;?>" class="form-control">
            </div>
        </div>
       <div class="col-6">
            <div class="form-group">
                <label class="control-label">Mobile<span class="text-danger">*</span>:</label>
                <input type="text" name="mobile" value="<?=$publishers->mobile;?>" class="form-control">
            </div>
        </div>
         <div class="col-6">
            <div class="form-group">
                <label class="control-label">Country:</label>
                <input type="text" name="country" value="<?=$publishers->country;?>" class="form-control">
            </div>
        </div>
         <div class="col-6">
            <div class="form-group">
                <label class="control-label">State:</label>
                <input type="text" name="state" value="<?=$publishers->state;?>" class="form-control">
            </div>
        </div>
         <div class="col-6">
            <div class="form-group">
                <label class="control-label">City:</label>
                <input type="text" name="city" value="<?=$publishers->city;?>" class="form-control">
            </div>
        </div>
          <div class="col-6">
            <div class="form-group">
                <label class="control-label">Pincode:</label>
                <input type="number" name="pincode" value="<?=$publishers->pincode;?>" class="form-control">
            </div>
        </div>
         <div class="col-12">
            <div class="form-group">
                <label class="control-label">Address:</label>
                <textarea name="address" placeholder="Enter Address " class="form-control"><?=$publishers->address;?></textarea>
            </div>
        </div>
        </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Update</button>
</div>
    <?php }?>
</form>

