
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            fromdate:"required",
            todate:"required",
            events:{
                required:true,
            }
            
        },
        messages: {
            fromdate:"Please Enter From Date",
            todate:"Please Enter To Date",
            events: {
                required : "Please Enter Events Name",
            }
        }
    }); 
});
</script>

    <form class="form ajaxsubmit validate-form submit reload-tb" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
    <?php  if($total_data==0){?>
    <div class="modal-body">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label class="control-label">Events Name:</label>
                <input type="text" name="events" class="form-control" placeholder="Enter Events  Name">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">From Date:</label>
                <input type="date" class="form-control" name="fromdate" >
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">To Date:</label>
                <input type="date" class="form-control" name="todate" >
            </div>
        </div>
     </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Add Holiday</button>
</div>
<?php }else{?>
    <div class="modal-body">
    <div class="row">
    <div class="col-12">
            <div class="form-group">
                <label class="control-label">Events Name:</label>
                <input type="text" name="events" class="form-control" value="<?=$holiday->events_name;?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">From Date:</label>
                <input type="date" class="form-control" name="fromdate" value="<?=$holiday->from_date;?>" >
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">To Date:</label>
                <input type="date" class="form-control" name="todate" value="<?=$holiday->to_date;?>">
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

