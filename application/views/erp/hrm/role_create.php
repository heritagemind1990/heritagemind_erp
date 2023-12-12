
    <script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            name:{
                required:true,
            }
            
        },
        messages: {
            name: {
                required : "Please Enter Role Name",
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
                <label class="control-label">Role Name:</label>
                <input type="text" name="name" class="form-control" value="<?=$role->role_name;?>">
            </div>
        </div>
     </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Update Role</button>
</div>

</form>

