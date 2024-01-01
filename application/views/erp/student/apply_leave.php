
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            date:"required",
            reason:{
                required:true,
            }
            
        },
        messages: {
            date:"Please select leave date",
            reason: {
                required : "Please enter reason",
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
                <label class="control-label">Select Date:</label>
                <input type="date" name="date" class="form-control" value="<?=date('Y-m-d');?>">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label class="control-label">Reason:</label>
                <textarea class="form-control" name="reason" placeholder="Enter reason"></textarea>
            </div>
        </div> 
        </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Apply</button>
</div>

</form>

