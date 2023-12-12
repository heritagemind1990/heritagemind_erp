
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            hw:"required",
            file:{
                required:true,
            }
            
        },
        messages: {
            hw:"Please enter Home work",
            file: {
                required : "Please select file",
            }
        }
    }); 
});
</script>
    <form class="form ajaxsubmit validate-form submit reload-tb" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
 
    <div class="modal-body">
    <div class="row">
        <input type="hidden" name="student_id" value="<?=$_SESSION['MUserId'];?>">
        <input type="hidden" name="sec_id" value="<?=$hw->sec_id;?>">
          <div class="col-12">
            <div class="form-group">
                <label class="control-label">Select File:</label>
                <input type="file" name="file" class="form-control" >
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label class="control-label">Enter Home Work:</label>
                <textarea name="hw" class="form-control" placeholder="Enter Home Work"></textarea>
            </div>
        </div>
     </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Upload</button>
</div>

</form>

