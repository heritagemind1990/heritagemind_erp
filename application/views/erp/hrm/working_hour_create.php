
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            role:"required",
            role:{
                required:true,
            }
            
        },
        messages: {
            school:"Please select school",
            role: {
                required : "Please select roles ",
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
                <label class="control-label">Select School:</label>
                <select name="school" id="" class="form-control">
                    <option selected="true" disabled="disabled" value="">--Select School--</option>
                    <?php foreach($school as $s){?>
                    <option value="<?=$s->id;?>"><?=$s->name;?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Select Roles:</label>
                <select name="role" id="" class="form-control">
                    <option selected="true" disabled="disabled" value="">--Select Roles--</option>
                    <?php foreach($role as $r){?>
                    <option value="<?=$r->id;?>"><?=$r->role_name;?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Start Time:</label>
                <input type="time" name="start_time" class="form-control">
            </div>
        </div>   
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">End Time:</label>
                <input type="time" name="end_time" class="form-control">
            </div>
        </div>      
     </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Submit</button>
</div>
<?php }else{?>
    <div class="modal-body">
    <div class="row">
    <div class="col-6">
            <div class="form-group">
            <label class="control-label">Select School:</label>
                <select name="school" id="" class="form-control">
                    <option selected="true" disabled="disabled" value="">--Select School--</option>
                    <?php foreach($school as $s){?>
                    <option value="<?=$s->id;?>" <?php if($att->school_id==$s->id){echo "selected";} ;?>  ><?=$s->name;?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Select Roles:</label>
                <select name="role" id="" class="form-control">
                    <?php foreach($role as $r){?>
                    <option value="<?=$r->id;?>"  <?php if($att->role_id==$r->id){echo "selected";} ;?> ><?=$r->role_name;?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Start Time:</label>
                <input type="time" name="start_time" class="form-control" value="<?=$att->start_time;?>">
            </div>
        </div>   
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">End Time:</label>
                <input type="time" name="end_time" class="form-control" value="<?=$att->end_time;?>">
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

