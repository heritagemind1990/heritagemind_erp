
    <form class="form" method="post" id="Form_option11">
   
    <div class="modal-body">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Select Section:</label>
                <select name="class" class="form-control" onchange="submit_form('Form_option11')" >
                    <option value="">--Select section--</option>
                    <?php  
                     $i = 1 ;foreach($section as $s){  ?>
                
                    <option value="<?php echo $s->id ; ?>"<?php if(isset($_POST['section']) && $_POST['section']==$s->id) { echo "selected"; } ?> >
                    <?php echo $s->section_name ; ?>
                   </option>
                <?php $i++ ;} ?>
                </select>
               <button type="button" id="section_btn"style="display:none"></button>
            </div>
        </div>
       
  
            <?php echo isset($_POST['section']);?>
        </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
</div>
    </form>
    <script>
        function submit_form(id){
             document.getElementById("section_btn").click();
        }
    </script> 
