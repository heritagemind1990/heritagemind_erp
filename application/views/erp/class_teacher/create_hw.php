
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            topic:"required",
            hw:"required",
            date:"required",
            file:{
                required:true,
            }
            
        },
        messages: {
            topic:"Please Select Topic Name",
            hw:"Please Enter Home Work",
            date:"Please Select date",
            file: {
                required : "Please select file",
            }
        }
    }); 
});
</script>
    <form class="form ajaxsubmit validate-form submit reload-tb" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
    <input type="hidden" name="sst_id" value="<?=$map->id;?>">
                <input type="hidden" name="sec_id" value="<?=$map->section_id;?>">
                <input type="hidden" name="sub_id" value="<?=$map->sub_id;?>">
                <input type="hidden" name="sub_name" value="<?=$map->sub_name;?>">
    <div class="modal-body">
    <div class="row">
    <div class="col-4">
            <div class="form-group">
                <label class="control-label">Select Topic:</label>
               <select name="topic" id="" class="form-control">
                <option value="">--Select Topic--</option>
                <?php foreach($topic as $t){?>
                <option value="<?=$t->id;?>"><?=$t->topic_name;?></option>
                    <?php }?>
               </select>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Select File:</label>
                <input type="file" name="file" class="form-control" >
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Select Date:</label>
                <input type="date" name="date" class="form-control" value="<?=date('Y-m-d');?>" readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label class="control-label">Enter Home Work:</label>
                <textarea name="hw" class="form-control"  placeholder="Enter Home Work"></textarea>
            </div>
        </div>
     </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Upload</button>
</div>

</form>

