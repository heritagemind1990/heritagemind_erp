
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            photo:{
                required:true,
            }
            
        },
        messages: {
            photo: {
                required : "Please Select Parent's Aadhaar",
            }
        }
    }); 
});
</script>
  <div class="wrapper">
    <form class="form ajaxsubmit validate-form submit reload-page" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
   
    <div class="modal-body">
    <div class="row mt-3">
        <div class="col-12">
            <div class="form-group">
                <label class="control-label">Select Parent's Aadhaar <sup>*</sup> :</label>
                <input type="file" name="photo" class="form-control" >
            </div>
        </div>
        </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect btn-sm" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger btn-sm waves-light" ><i id="loader" class=""></i>Add Parent's Aadhaar</button>
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
