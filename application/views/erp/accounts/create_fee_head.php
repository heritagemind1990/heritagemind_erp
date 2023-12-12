<?php  if($total_data==0){?>
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            feetype:"required",
            name:{
                required:true,
                remote:"<?=$remote?>"
            }
            
        },
        messages: {
            feetype:"Please select fee type",
            name: {
                required : "Please enter fee head",
                remote : "Sorry !! this fee head already exist."
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
            feetype:"required",
            name:{
                required:true,
            }
            
        },
        messages: {
            feetype:"Please select fee head",
            name: {
                required : "Please enter fee type",
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
                <label class="control-label">Select Fee Type<span class="text-danger">*</span> :</label>
                <select name="feetype" id="" class="form-control">
                    <option value="">--Select Fee Type--</option>
                    <?php foreach($feetype as $fee):?>
                    <option value="<?=$fee->id;?>"><?=$fee->name;?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
    <div class="col-6">
            <div class="form-group">
                <label class="control-label">Fee Head<span class="text-danger">*</span> :</label>
                <input type="text" name="name" placeholder="Enter fee head" class="form-control">
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
                <label class="control-label">Select Fee Type<span class="text-danger">*</span> :</label>
                <select name="feetype" id="" class="form-control">
                    <option value="">--Select Fee Type--</option>
                    <?php foreach($feetype as $fee):?>
                    <option value="<?=$fee->id;?>" <?php if($feehead->feetype==$fee->id){echo "selected";} ;?> ><?=$fee->name;?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Fee Head<span class="text-danger">*</span> :</label>
                <input type="text" name="name" value="<?=$feehead->name;?>" class="form-control">
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

