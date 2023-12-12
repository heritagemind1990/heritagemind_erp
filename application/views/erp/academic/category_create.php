<?php  if($total_data==0){?>
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            fee:"required",
            seat:"required",
            name:{
                required:true,
                remote:"<?=$remote?>"
            }
            
        },
        messages: {
            fee:"Please Enter Fee Relax",
            seat:"Please Enter Reserve Seats",
            name: {
                required : "Please Enter Category  Name",
                remote : "This Category Already Exist!"
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
            fee:"required",
            seat:"required",
            name:{
                required:true,
            }
            
        },
        messages: {
            fee:"Please Enter Fee Relax",
            seat:"Please Enter Reserve Seats",
            name: {
                required : "Please Enter Category  Name",
            }
        }
    }); 
});
</script>

    <?php }?>
    <form class="form ajaxsubmit validate-form submit reload-tb" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
    <?php  if($total_data==0){?>
    <div class="modal-body">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label class="control-label">Category Name:</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Category Name">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Reserve Seats :</label>
                <input type="text" class="form-control" name="seat"  placeholder="Enter Reserve Seats">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Fee Relax :</label>
                <input type="text" class="form-control" name="fee"  placeholder="Enter Fee Relax">
            </div>
        </div>
     </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Add Holiday</button>
</div>
<?php }else{?>
    <div class="modal-body">
    <div class="row">
    <div class="col-12">
            <div class="form-group">
                <label class="control-label">Category Name:</label>
                <input type="text" name="name" class="form-control" value="<?=$category->name;?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Reserve Seats:</label>
                <input type="text" class="form-control" name="seat" value="<?=$category->reserve_seat;?>" >
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Fee Relax:</label>
                <input type="text" class="form-control" name="fee" value="<?=$category->fee_relax;?>">
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

