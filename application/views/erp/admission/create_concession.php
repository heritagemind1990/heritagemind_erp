<?php  if($total_data==0){?>
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            fee:"required",
            title:{
                required:true,
                remote:"<?=$remote?>"
            }
            
        },
        messages: {
            fee:"Please Enter Fee Relax",
            title: {
                required : "Please Enter Concession Title",
                remote : "This Concession Type Already Exist!"
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
            title:{
                required:true,
            }
            
        },
        messages: {
            fee:"Please Enter Fee Relax",
            title: {
                required : "Please Enter Concession Title",
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
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Title:</label>
                <input type="text" name="title" class="form-control" placeholder="Enter Concession Title ">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Fee Relax:</label>
                <input type="number" class="form-control" name="fee"  placeholder="Enter Fee Relax">
            </div>
        </div>
     </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Add Concession</button>
</div>
<?php }else{?>
    <div class="modal-body">
    <div class="row">
    <div class="col-6">
            <div class="form-group">
                <label class="control-label">Title:</label>
                <input type="text" name="title" class="form-control" value="<?=$fee->title;?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Maximum Marks:</label>
                <input type="number" class="form-control" name="fee" value="<?=$fee->fee_relax;?>" >
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

