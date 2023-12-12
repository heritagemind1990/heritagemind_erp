
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            period:"required",
            section:{
                required:true,
            }
            
        },
        messages: {
            period:"Please enter period number",
            section: {
                required : "Please select section",
            }
        }
    }); 
});
</script>
    <form class="form ajaxsubmit validate-form submit reload-tb" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
    <?php  if($total_data==0){?>
    <div class="modal-body">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Select Section:</label>
                <select name="section" id="" class="form-control">
                    <option value="">--Select Section--</option>
                    <?php foreach($section as $s):?>
                   <option value="<?=$s->id;?>"><?=$s->section_name;?></option>
                        <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Enter Period:</label>
                <input type="number" class="form-control" name="period" placeholder="Enter period number">
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
                <label class="control-label">Select Section:</label>
                <select name="section" id="" class="form-control">
                    <option value="">--Select Section--</option>
                    <?php foreach($section as $s):?>
                   <option value="<?=$s->id;?>" <?php if($s->id==$data->section_id){echo "selected";} ;?>><?=$s->section_name;?></option>
                        <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Enter Period:</label>
                <input type="number" class="form-control" name="period" value="<?=$data->period;?>">
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

