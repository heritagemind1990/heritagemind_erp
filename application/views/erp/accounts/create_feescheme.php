

<?php  if($total_data==0){?>
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            academic:"required",
            start_month:"required",
            end_month:"required",
            per_fine:"required",
            max_fine:"required",
            name:{
                required:true,
                remote:"<?=$remote?>"
            }
            
        },
        messages: {
            academic:"Please select academic year range",
            start_month:"Please select fee start month",
            end_month:"Please select end start month",
            per_fine:"Please enter fine day",
            max_fine:"Please enter maximum fine",
            name: {
                required : "Please enter installment range",
                remote : "Sorry !! this installment  already exist."
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
             academic:"required",
            start_month:"required",
            end_month:"required",
            per_fine:"required",
            max_fine:"required",
            name:{
                required:true,
            }
            
        },
        messages: {
             academic:"Please select academic year range",
            start_month:"Please select fee start month",
            end_month:"Please select end start month",
            per_fine:"Please enter fine day",
            max_fine:"Please enter maximum fine",
            name: {
                required : "Please enter installment range",
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
                <label class="control-label">Select Academic Year<span class="text-danger">*</span> :</label>
                <select class="form-control" name="academic">
                    <option>--Select academic year--</option>
                    <?php foreach($year as $y):?>
                    <option value="<?=$y->id;?>"><?=$y->name;?></option>
                <?php endforeach;?>
                </select>
            </div>
        </div>
         <div class="col-6">
            <div class="form-group">
                <label class="control-label">Fee Installment<span class="text-danger">*</span> :</label>
                <input name="name" type="number" class="form-control" placeholder="Enter Installment Number">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Fee Start Month<span class="text-danger">*</span> :</label>
                 <select class="form-control" name="start_month">
                    <option>--Select starting month--</option>
                           <option value="01" <?php if( $curmonth=='1') { echo "selected";} ?> >January</option>
                           <option value="02" <?php if( $curmonth=='2') { echo "selected";} ?> >February</option>
                           <option value="03" <?php if( $curmonth=='3') { echo "selected";} ?> >March</option>
                           <option value="04" <?php if( $curmonth=='4') { echo "selected";} ?> >April</option>
                           <option value="05" <?php if( $curmonth=='5') { echo "selected";} ?> >May</option>
                           <option value="06" <?php if( $curmonth=='6') { echo "selected";} ?> >June</option>
                           <option value="07" <?php if( $curmonth=='7') { echo "selected";} ?> >July</option>
                           <option value="08" <?php if( $curmonth=='8') { echo "selected";} ?> >August</option>
                           <option value="09" <?php if( $curmonth=='9') { echo "selected";} ?> >September</option>
                           <option value="10"<?php if( $curmonth=='10') { echo "selected";} ?> >October</option>
                           <option value="11"<?php if( $curmonth=='11') { echo "selected";} ?> >November</option>
                           <option value="12"<?php if( $curmonth=='12') { echo "selected";} ?> >December</option>
                </select>
            </div>
        </div>
         <div class="col-6">
            <div class="form-group">
                <label class="control-label">Fee End Month<span class="text-danger">*</span> :</label>
                 <select class="form-control" name="end_month">
                    <option>--Select ending month--</option>
                           <option value="01" <?php if( $curmonth=='1') { echo "selected";} ?> >January</option>
                           <option value="02" <?php if( $curmonth=='2') { echo "selected";} ?> >February</option>
                           <option value="03" <?php if( $curmonth=='3') { echo "selected";} ?> >March</option>
                           <option value="04" <?php if( $curmonth=='4') { echo "selected";} ?> >April</option>
                           <option value="05" <?php if( $curmonth=='5') { echo "selected";} ?> >May</option>
                           <option value="06" <?php if( $curmonth=='6') { echo "selected";} ?> >June</option>
                           <option value="07" <?php if( $curmonth=='7') { echo "selected";} ?> >July</option>
                           <option value="08" <?php if( $curmonth=='8') { echo "selected";} ?> >August</option>
                           <option value="09" <?php if( $curmonth=='9') { echo "selected";} ?> >September</option>
                           <option value="10"<?php if( $curmonth=='10') { echo "selected";} ?> >October</option>
                           <option value="11"<?php if( $curmonth=='11') { echo "selected";} ?> >November</option>
                           <option value="12"<?php if( $curmonth=='12') { echo "selected";} ?> >December</option>
                </select>
            </div>
        </div>
         <div class="col-6">
            <div class="form-group">
                <label class="control-label">Fine Per Day<span class="text-danger">*</span> :</label>
                <input name="per_fine" type="number" class="form-control" value="0">
            </div>
        </div>
         <div class="col-6">
            <div class="form-group">
                <label class="control-label">Maximum Fine<span class="text-danger">*</span> :</label>
                <input name="max_fine" type="number" class="form-control" value="0">
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
                <label class="control-label">Select Academic Year<span class="text-danger">*</span> :</label>
                <select class="form-control" name="academic">
                    <option>--Select academic year--</option>
                    <?php foreach($year as $y):?>
                    <option value="<?=$y->id;?>" <?php if($scheme->academic_year==$y->id){echo "selected";} ;?>><?=$y->name;?></option>
                <?php endforeach;?>
                </select>
            </div>
        </div>
         <div class="col-6">
            <div class="form-group">
                <label class="control-label">Fee Installment<span class="text-danger">*</span> :</label>
                <input name="name" type="number" class="form-control" value="<?=$scheme->name;?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Fee Start Month<span class="text-danger">*</span> :</label>
                 <select class="form-control" name="start_month">
                    <option>--Select starting month--</option>
                           <option value="01" <?php if( $scheme->fee_start_month=='1') { echo "selected";} ?> >January</option>
                           <option value="02" <?php if( $scheme->fee_start_month=='2') { echo "selected";} ?> >February</option>
                           <option value="03" <?php if( $scheme->fee_start_month=='3') { echo "selected";} ?> >March</option>
                           <option value="04" <?php if( $scheme->fee_start_month=='4') { echo "selected";} ?> >April</option>
                           <option value="05" <?php if( $scheme->fee_start_month=='5') { echo "selected";} ?> >May</option>
                           <option value="06" <?php if( $scheme->fee_start_month=='6') { echo "selected";} ?> >June</option>
                           <option value="07" <?php if( $scheme->fee_start_month=='7') { echo "selected";} ?> >July</option>
                           <option value="08" <?php if( $scheme->fee_start_month=='8') { echo "selected";} ?> >August</option>
                           <option value="09" <?php if( $scheme->fee_start_month=='9') { echo "selected";} ?> >September</option>
                           <option value="10"<?php if( $scheme->fee_start_month=='10') { echo "selected";} ?> >October</option>
                           <option value="11"<?php if( $scheme->fee_start_month=='11') { echo "selected";} ?> >November</option>
                           <option value="12"<?php if( $scheme->fee_start_month=='12') { echo "selected";} ?> >December</option>
                </select>
            </div>
        </div>
         <div class="col-6">
            <div class="form-group">
                <label class="control-label">Fee End Month<span class="text-danger">*</span> :</label>
                 <select class="form-control" name="end_month">
                    <option>--Select ending month--</option>
                           <option value="01" <?php if( $scheme->fee_end_month=='1') { echo "selected";} ?> >January</option>
                           <option value="02" <?php if( $scheme->fee_end_month=='2') { echo "selected";} ?> >February</option>
                           <option value="03" <?php if( $scheme->fee_end_month=='3') { echo "selected";} ?> >March</option>
                           <option value="04" <?php if( $scheme->fee_end_month=='4') { echo "selected";} ?> >April</option>
                           <option value="05" <?php if( $scheme->fee_end_month=='5') { echo "selected";} ?> >May</option>
                           <option value="06" <?php if( $scheme->fee_end_month=='6') { echo "selected";} ?> >June</option>
                           <option value="07" <?php if( $scheme->fee_end_month=='7') { echo "selected";} ?> >July</option>
                           <option value="08" <?php if( $scheme->fee_end_month=='8') { echo "selected";} ?> >August</option>
                           <option value="09" <?php if( $scheme->fee_end_month=='9') { echo "selected";} ?> >September</option>
                           <option value="10"<?php if( $scheme->fee_end_month=='10') { echo "selected";} ?> >October</option>
                           <option value="11"<?php if( $scheme->fee_end_month=='11') { echo "selected";} ?> >November</option>
                           <option value="12"<?php if( $scheme->fee_end_month=='12') { echo "selected";} ?> >December</option>
                </select>
            </div>
        </div>
         <div class="col-6">
            <div class="form-group">
                <label class="control-label">Fine Per Day<span class="text-danger">*</span> :</label>
                <input name="per_fine" type="number" class="form-control" value="<?=$scheme->fine_per_day;?>">
            </div>
        </div>
         <div class="col-6">
            <div class="form-group">
                <label class="control-label">Maximum Fine<span class="text-danger">*</span> :</label>
                <input name="max_fine" type="number" class="form-control" value="<?=$scheme->max_fine;?>">
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
