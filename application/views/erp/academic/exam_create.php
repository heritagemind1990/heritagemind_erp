<?php  if($total_data==0){?>
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            date:"required",
            marks:"required",
            title:{
                required:true,
                remote:"<?=$remote?>"
            }
            
        },
        messages: {
            date:"Please Select Exam Conduct Date",
            marks:"Please Enter Maximum Marks",
            title: {
                required : "Please Enter Exam Title Name",
                remote : "This Exam Title Already Exist!"
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
            date:"required",
            marks:"required",
            title:{
                required:true,
            }
            
        },
        messages: {
            date:"Please Select Exam Conduct Date",
            marks:"Please Enter Maximum Marks",
            title: {
                required : "Please Enter Exam Title Name",
            }
        }
    }); 
});
</script>

    <?php }?>
    <form class="form ajaxsubmit validate-form submit reload-tb" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
    <?php  if($total_data==0){?>
    <div class="modal-body">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label class="control-label">Exam Title Name:</label>
                <input type="text" name="title" class="form-control" placeholder="Enter Exam Title Name">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Maximum Marks:</label>
                <input type="number" class="form-control" name="marks"  placeholder="Enter Maximum Number of Exam">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Exam Conduct Date:</label>
                <input type="date" class="form-control" name="date" >
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
                <label class="control-label">Exam Title:</label>
                <input type="text" name="title" class="form-control" value="<?=$exam->title;?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Maximum Marks:</label>
                <input type="number" class="form-control" name="marks" value="<?=$exam->max_marks;?>" >
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Exam Conduct date:</label>
                <input type="date" class="form-control" name="date" value="<?=$exam->conduct_date;?>">
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

