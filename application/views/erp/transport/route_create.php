
    <script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            start:"required",
            end:{
                required:true,
            }
            
        },
        messages: {
            start:"Please enter route start location",
            end: {
                required : "Please enter route end location",
            }
        }
    }); 
});
</script>

<?php if($total_data==0){?>
    <form class="ajaxsubmit validate-form reload-tb" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
<div class="modal-body">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Start Route<span class="text-danger">*</span> : </label>
                <input type="text" name="start" class="form-control" placeholder="Enter Start Route Location">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">End Ruote<span class="text-danger">*</span> : </label>
                <input type="text" class="form-control" name="end" placeholder="Enter End Route Location" >
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
    <div class="col-6">
            <div class="form-group">
                <label class="control-label">Start Route<span class="text-danger">*</span> : </label>
                <input type="text" name="start" class="form-control" value="<?=$route->start_route;?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">End Ruote<span class="text-danger">*</span> : </label>
                <input type="text" class="form-control" name="end" value="<?=$route->end_route;?>" >
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
