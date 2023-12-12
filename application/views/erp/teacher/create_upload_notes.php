
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
                <input type="hidden" name="sst_id" value="<?=$map->id;?>">
                <input type="hidden" name="sec_id" value="<?=$map->section_id;?>">
                <input type="hidden" name="sub_id" value="<?=$map->sub_id;?>">
                <input type="hidden" name="tea_id" value="<?=$map->tea_id;?>">
                <input type="hidden" name="sub_name" value="<?=$map->sub_name;?>">
                <label class="control-label">Select File:</label>
                <input type="file" name="file" class="form-control" >
            </div>
        </div>
     </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Upload</button>
</div>

</form>

