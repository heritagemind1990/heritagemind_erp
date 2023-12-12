
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            start_time:"required",
            end_time:"required",
            sstid:"required",
            room:{
                required:true,
            }
            
        },
        messages: {
            start_time:"Please select start time",
            end_time:"Please select end time",
            sstid:"Please Select section subject teacher",
            room: {
                required : "Please select room",
            }
        }
    }); 
});
</script>
    <form class="form ajaxsubmit validate-form submit reload-page" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
   
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="timeid" value="<?=$data->id;?>">
                        <div class="col-12 form-group">
                            <label for="">Select Room : </label>
                            <select  name="room" class="form-control">
                                <option value="">--Select Room--</option>
                                <?php foreach($room as $rr):?>
                                <option value="<?=$rr->id;?>" <?php if($data->room_no==$rr->id){echo "selected";} ;?>><?=$rr->name;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                          <div class="col-12 form-group">
                            <label for="">Select Section Subject & teacher : </label>
                            <select name="sstid" class="form-control">
                                <option value="">--Select sectiom subject & teacher--</option>
                                <?php foreach($sst as $ss):?>
                                <option value="<?=$ss->id;?>" <?php if($data->sst_id==$ss->id){echo "selected";} ;?>><?=$ss->section_name.' ( '.$ss->sub_name.' BY :- '.$ss->teacher_name.' )';?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-6 form-gourp">
                            <label for="">Select Period Start Time</label>
                            <input type="time" name="start_time" class="form-control" value="<?=$data->start_time;?>">
                        </div>
                        <div class="col-6 form-gourp">
                            <label for="">Select Period End Time</label>
                            <input type="time" name="end_time" class="form-control"  value="<?=$data->end_time;?>">
                        </div>
                    </div>
                    </div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Update</button>
</div>

</form>

