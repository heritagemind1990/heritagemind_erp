<?php  if($total_data==0){?>
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            noofseats:"required",
            class_name:{
                required:true,
                remote:"<?=$remote?>"
            }
            
        },
        messages: {
            noofseats:"Please Enter No Of Seats",
            class_name: {
                required : "Please Enter Class / Standard Name",
                remote : "This Class Already Exist!"
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
            noofseats:"required",
            class_name:{
                required:true,
            }
            
        },
        messages: {
            noofseats:"Please Enter No Of Seats",
            class_name: {
                required : "Please Enter Class / Standard Name",
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
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Class / Standard Name:</label>
                <input type="text" name="class_name" class="form-control" placeholder="Enter Class / Standard  Name">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">No Of Seats:</label>
                <input type="number" class="form-control" name="noofseats" placeholder="Enter No Of Seats">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">If Reserve Seats:</label>
                <input type="number" class="form-control" name="reserveseat" value="0">
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
                <label class="control-label">Class / Standard Name:</label>
                <input type="text" name="class_name" value="<?=$class->class_name;?>" class="form-control">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">No Of Seats:</label>
                <input type="number" class="form-control" name="noofseats" value="<?=$class->no_of_seat;?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">If Reserve Seats:</label>
                <input type="number" class="form-control" name="reserveseat" value="<?=$class->reserve_seats;?>">
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

