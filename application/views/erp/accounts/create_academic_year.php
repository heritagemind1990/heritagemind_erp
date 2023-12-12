

<?php  if($total_data==0){?>
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            name:{
                required:true,
                remote:"<?=$remote?>"
            }
            
        },
        messages: {
            name: {
                required : "Please enter academic year range",
                remote : "Sorry !! this year  already exist."
            }
        }
    }); 
});
</script>
<?php }else{?>
    <script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            name:{
                required:true,
            }
            
        },
        messages: {
            name: {
                required : "Please enter academic year range",
            }
        }
    }); 
});
</script>
   <?php } ?>
    <form class="form ajaxsubmit validate-form submit reload-tb" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
    <?php  if($total_data==0){?>
    <div class="modal-body">
    <div class="row">
   
    <div class="col-12">
            <div class="form-group">
                <label class="control-label">Enter Academic Year Range<span class="text-danger">*</span> :</label>
                <input type="text" name="name" placeholder="Enter Academic Year Range Ex.2023-24" class="form-control">
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
        <div class="col-12">
            <div class="form-group">
                <label class="control-label">Enter Academic Year Range<span class="text-danger">*</span> :</label>
                <input type="text" name="name" value="<?=$year->name;?>" class="form-control">
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
