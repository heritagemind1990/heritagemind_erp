
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            route_id:"required",
            sub_route_id:"required",
            stu_id:"required",
           
            
        },
        messages: {
            route_id:"Please select route ",
             sub_route_id:"Please select sub route",
            stu_id:"Please select student",
           
        }
    }); 
});
</script>

<?php if($total_data==0){?>
    <form class="ajaxsubmit validate-form reload-tb" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
<div class="modal-body">
    <div class="row">
        <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Select Route:</label>
                    <select class="form-control" style="width:100%;" name="route_id" id="route_id" onchange="fetch_route(this.value)">
                    <option value="">Select Route</option>
                    <?php foreach ($route as $r) { ?>
                    <option value="<?php echo $r->id; ?>">
                        <?php echo $r->start_route; ?> - <?php echo $r->end_route; ?>
                    </option>
                    <?php } ?>
                    </select>
                </div>
            
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Sub Route:</label>
                    <select class="form-control sub_route_id" style="width:100%;" name="sub_route_id" id="sub_route_id">
                    
                    </select>
                </div>
            </div>
        <div class="col-6"> 
            <div class="form-group">
                <label class="control-label">Select Student<span class="text-danger">*</span> : </label>
                <select name="stu_id" class="form-control">
                    <option >--Select Student--</option>
                    <?php foreach($student as $s):?>
                    <option value="<?=$s->id;?>"><?=$s->fname.' '.$s->lname;?> ( <?=$s->stu_id;?> )</option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
       
       
        </div>
 
        

</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Add</button>
</div></form>
<?php  }else {?>
    <form class="ajaxsubmit validate-form reload-tb" action="<?=$update_url?>" method="post" enctype= multipart/form-data>
    <div class="modal-body">
    <div class="row">
    <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Select Route:</label>
                    <select class="form-control" style="width:100%;" name="route_id" id="route_id" onchange="fetch_route(this.value)">
                    <option value="">Select Route</option>
                    <?php foreach ($route as $r) { ?>
                    <option value="<?php echo $r->id; ?>" <?php if($data->route_id==$r->id){echo "selected";} ;?>>
                        <?php echo $r->start_route; ?> - <?php echo $r->end_route; ?>
                    </option>
                    <?php } ?>
                    </select>
                </div>
            
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">Sub Route:</label>
                    <select class="form-control sub_route_id" style="width:100%;" name="sub_route_id" id="sub_route_id">
                    <?php  $sub = $this->transport_model->get_sub_route($data->sub_route_id);?>
                    <option value="<?=$sub->id;?>"><?php echo $sub->pick_up.' - '.$sub->drop_off ;?></option>
                    </select>
                </div>
            </div>
        <div class="col-6"> 
            <div class="form-group">
                <label class="control-label">Select Student<span class="text-danger">*</span> : </label>
                <select name="stu_id" class="form-control">
                    <option >--Select Student--</option>
                    <?php foreach($student as $s):?>
                    <option value="<?=$s->id;?>" <?php if($data->student_id==$s->id){echo "selected";} ;?> ><?=$s->fname.' '.$s->lname;?> ( <?=$s->stu_id;?> )</option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Update</button>
</div>
</form>
    <?php  }?>

    <script type="text/javascript">
   function fetch_route(route_id)
   {
    $.ajax({
        url: "<?php echo base_url('student-route-map/fetch_sub_route'); ?>",
        method: "POST",
        data: {
            route_id:route_id
        },
        success: function(data){
            $(".sub_route_id").html(data);
        },
    });
   }
</script>