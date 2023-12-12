
    <script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            route_id:"required",
            pick_up:"required",
            drop_off:"required",
            pick_up_time:"required",
            stop_time:"required",
            fees:"required",
           
            
        },
        messages: {
            route_id:"Please select route ",
             pick_up:"Please enter pick up point",
            drop_off:"Please enter drop off point",
            pick_up_time:"Please select pick up time",
            stop_time:"Please select vehicle stop time",
            fees:"Please enter vehicle fees",
           
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
                <label class="control-label">Select Route<span class="text-danger">*</span> : </label>
                <select name="route_id" class="form-control">
                 <option  >--Select Route--</option>
                 <?php foreach($route as $r){?>
                  <option value="<?=$r->id;?>" ><?=$r->start_route.' - '.$r->end_route;?></option>
                 <?php }?>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Pick Up Point<span class="text-danger">*</span> : </label>
                <input type="text" name="pick_up" class="form-control" placeholder="Enter Pick Up Point">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Drop Off Point<span class="text-danger">*</span> : </label>
                <input type="text" class="form-control" name="drop_off" placeholder="Enter Drop off Point" >
            </div>
        </div>
         <div class="col-6">
            <div class="form-group">
                <label class="control-label">Pick Up Time<span class="text-danger">*</span> : </label>
                <input type="time" class="form-control" name="pick_up_time">
            </div>
        </div>
          <div class="col-6">
            <div class="form-group">
                <label class="control-label">Vehicle Stop Time ( min )<span class="text-danger">*</span> : </label>
                <input type="number" class="form-control" name="stop_time">
            </div>
        </div>
         <div class="col-6">
            <div class="form-group">
                <label class="control-label">Fees in Month<span class="text-danger">*</span> : </label>
                <input type="number" class="form-control" name="fees" value="0">
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
                <label class="control-label">Select Route<span class="text-danger">*</span> : </label>
                <select name="route_id" class="form-control">
                 <option  >--Select Route--</option>
                 <?php foreach($route as $r){?>
                  <option value="<?=$r->id;?>" <?php if($sub_route->route_id==$r->id){echo "selected";} ;?>><?=$r->start_route.' - '.$r->end_route;?></option>
                 </select><?php }?>
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Pick Up Point<span class="text-danger">*</span> : </label>
                <input type="text" name="pick_up" class="form-control" value="<?=$sub_route->pick_up;?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Drop Off Point<span class="text-danger">*</span> : </label>
                <input type="text" class="form-control" name="drop_off" value="<?=$sub_route->drop_off;?>" >
            </div>
        </div>
         <div class="col-6">
            <div class="form-group">
                <label class="control-label">Pick Up Time<span class="text-danger">*</span> : </label>
                <input type="time" class="form-control" name="pick_up_time" value="<?=$sub_route->pick_up_time;?>">
            </div>
        </div>
          <div class="col-6">
            <div class="form-group">
                <label class="control-label">Vehicle Stop Time ( min )<span class="text-danger">*</span> : </label>
                <input type="number" class="form-control" name="stop_time" value="<?=$sub_route->stop_time;?>">
            </div>
        </div>
         <div class="col-6">
            <div class="form-group">
                <label class="control-label">Fees in Month<span class="text-danger">*</span> : </label>
                <input type="number" class="form-control" name="fees" value="<?=$sub_route->fees;?>">
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
