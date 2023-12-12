
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            class:"required",
            file:{
                required:true,
            }
            
        },
        messages: {
            class:"Please select standard / class",
            file: {
                required : "Please Select excel format",
            }
        }
    }); 
});
</script>
  <div class="wrapper">
    <form class="form ajaxsubmit validate-form submit reload-page" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
   
    <div class="modal-body">
    <div class="row mt-3">
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Select Excel <sup>*</sup> :</label>
                <input type="file" name="file" class="form-control" required accept=".xls, .xlsx">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Select Standard / Class <sup>*</sup> :</label>
                <select name="class" id="" class="form-control">
                    <option selected="true" disabled="disabled" value="">--Select Standard / Class--</option>
                    <?php foreach($class as $c){?>
                    <option value="<?=$c->id;?>"><?=$c->class_name;?></option>
                    <?php }?>
                </select>
            </div>
        </div>
</div>
<div class="modal-footer mt-5">
    <button type="reset" class="btn btn-default waves-effect btn-sm" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger btn-sm waves-light" ><i id="loader" class=""></i>Import Excel</button>
</div>

</form>
</div>
<style>
     #radio
    {
        font-size: 3rem;
        margin-left: 3rem;
    }
</style>
