<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            file:"required",
            noticetype:"required",
            fromdate:"required",
            todate:"required",
            title:{
                required:true,
            }
            
        },
        messages: {
            file:"Please Select File",
            noticetype:"Please Select Notice Type",
            fromdate:"Please Select From Date",
            todate:"Please Select To Date",
            title: {
                required : "Please Enter Title Name",
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
                <label class="control-label">Title:</label>
                <input type="text" name="title" class="form-control" placeholder="Enter Title">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Upload file:</label>
                <input type="file" name="doc" class="form-control">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">From Date:</label>
                <input type="date" class="form-control" name="fromdate">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">To Date</label>
              <input type="date" class="form-control" name="todate" >
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Notice type:</label>
                <select name="noticetype" id="" class="form-control">
                    <option>--SELECT NOTICE TYPE--</option>
                    <option value="School">School</option>
                    <option value="Student">Student</option>
                    <option value="Teacher">Teacher</option>
                    <option value="Parent">Parent</option>
                    <option value="Class_Teacher">Class Teacher</option>
                    <option value="Section_Head">Section Head</option>
                    <option value="Principal">Principal</option>
                    <option value="Hr">HR</option>
                    <option value="Library">Library</option>
                    <option value="Account">Accounts</option>
                    <option value="Transport">Transport</option>
                    <option value="Admission">Admission</option>
                    <option value="Academic">Academic</option>
                    <option value="All">All</option>
                </select>
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
                <label class="control-label">Title:</label>
                <input type="text" name="title" value="<?=$notice->title;?>" class="form-control">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Upload file:</label>
                <input type="file" name="doc" class="form-control">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">From Date:</label>
                <input type="date" class="form-control" name="fromdate" value="<?=$notice->from_date;?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">To Date</label>
              <input type="date" class="form-control" name="todate"  value="<?=$notice->to_date;?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Notice type:</label>
                <select name="noticetype" id="" class="form-control">
                    <option value="<?=$notice->notice_type;?>"><?=$notice->notice_type;?></option>
                    <option value="School">School</option>
                    <option value="Student">Student</option>
                    <option value="Teacher">Teacher</option>
                    <option value="Parent">Parent</option>
                    <option value="All">All</option>
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

