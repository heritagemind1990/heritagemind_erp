
    <script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            sub:"required",
            name:{
                required:true,
            }
            
        },
        messages: {
            sub:"Please Select Subject",
            name: {
                required : "Please Enter Topic Name",
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
                <label class="control-label">Select Subject :</label>
                <select name="sub" id="" class="form-control">
                    <option value="">--Select Subject--</option>
                    <?php foreach($subject as $s){?>
                    <option value="<?=$s->id;?>"><?=$s->name;?></option>
                        <?php }?>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Topic Name:</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Topic Name">
            </div>
        </div>
     </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Add Topic</button>
</div>
<?php }else{?>
    <div class="modal-body">
    <div class="row">
        <div class="col-6">
    <div class="form-group">
                <label class="control-label">Select Subject :</label>
                <select name="sub" id="" class="form-control">
                    <?php foreach($subject as $s){?>
                    <option value="<?=$s->id;?>" <?php if($s->id==$topic->sub_id){echo "selected";} ;?>><?=$s->name;?></option>
                        <?php }?>
                </select>
            </div>
        </div>
    <div class="col-6">
            <div class="form-group">
                <label class="control-label">Topic Name:</label>
                <input type="text" name="name" class="form-control" value="<?=$topic->topic_name;?>">
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

