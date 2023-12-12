
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            file:{
                required:true,
            }
            
        },
        messages: {
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
        <div class="col-12">
            <div class="form-group">
                <label class="control-label">Select File:</label>
                <input type="file" name="file" class="form-control" >
            </div>
        </div>
     </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Update</button>
</div>

</form>

