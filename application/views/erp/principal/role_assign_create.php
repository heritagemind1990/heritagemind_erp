
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            role:"required",
            user:{
                required:true,
            }
            
        },
        messages: {
            role:"Please select roles",
            user: {
                required : "Please select teacher ",
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
                <label class="control-label">Select Teacher:</label>
                <select name="user" id="" class="form-control">
                    <option selected="true" disabled="disabled" value="">--Select Teacher--</option>
                    <?php foreach($teacher as $t){?>
                    <option value="<?=$t->id;?>"><?=$t->name;?></option>
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
     </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Roles Assign</button>
</div>
<?php }else{?>
    <div class="modal-body">
    <div class="row">
    <div class="col-6">
            <div class="form-group">
                <label class="control-label">Select Teacher:</label>
                <select name="user" id="" class="form-control">
                    <?php foreach($teacher as $t){?>
                    <option value="<?=$t->id;?>"  <?php if($roles->user_id==$t->id){echo "selected";} ;?>  ><?=$t->name;?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Select Roles:</label>
                <select name="role" id="" class="form-control">
                    <?php foreach($role as $r){?>
                    <option value="<?=$r->id;?>"  <?php if($roles->role_id==$r->id){echo "selected";} ;?> ><?=$r->role_name;?></option>
                    <?php }?>
                </select>
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

