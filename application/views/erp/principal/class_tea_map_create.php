
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            teacher:"required",
            section:{
                required:true,
            }
            
        },
        messages: {
            teacher:"Please Select  Teacher",
            section: {
                required : "Please Select Section",
            }
        }
    }); 
});
</script>
    <form class="form ajaxsubmit validate-form submit reload-tb"  action="<?=$action_url?>" method="post" enctype= multipart/form-data>
    <?php  if($total_data==0){?>
    <div class="modal-body">
    <div class="row">
    <div class="col-6">
            <div class="form-group">
                <label class="control-label">Select Teacher:</label>
                <select name="teacher" id="" class="form-control">
                    <option value="">--select--</option>
                    <?php foreach($teacher as $t){?>
                    <option value="<?=$t->id;?>"><?=$t->name;?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Select Section  :</label>
                <select name="section" id="" class="form-control">
                    <option value="">--select--</option>
                    <?php foreach($section as $s){?>
                    <option value="<?=$s->id;?>"><?=$s->section_name;?></option>
                    <?php }?>
                </select>
            </div>
        </div>
     </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Save</button>
</div>
<?php }else{?>
    <div class="modal-body">
    <div class="row">
  
        <!--  -->
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Select Teacher:</label>
                <select name="teacher" id="" class="form-control">
                    <?php foreach($teacher as $t){?>
                    <option value="<?=$t->id;?>" <?php if($map->tea_id==$t->id){echo 'selected';} ;?>  ><?=$t->name;?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Select Section  :</label>
                <select name="section" id="" class="form-control">
                    <?php foreach($section as $s){?>
                    <option value="<?=$s->id;?>"  <?php if($map->section_id==$s->id){echo 'selected';} ;?>><?=$s->section_name;?></option>
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

