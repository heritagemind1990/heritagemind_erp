
    <form class="form ajaxsubmit validate-form submit reload-page" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
  <div class="container" id="modalInput" style="height: 100%;">
  <div class="rows" id="modaloutput"></div>
    <div class="rows" id="modalremain"></div>
    <div class="modal-body">
    <div class="row mt-3" >
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Select Standard :</label>
                <select name="class_id" id="" class="form-control"  onchange="show_total($(this).find(':selected').attr('data-id'))">
                    <option value="">--SELECT CLASS / STANDARD--</option>
                    <?php foreach($class as $c){?>
                    <option value="<?=$c->id;?>" data-id="<?=$c->no_of_seat;?>" ><?=$c->class_name;?></option>
                    <?php }?>
                </select>
            </div>
        </div>
        <div class="col-md-6 form-group" id="p1"></div>
   <div class="row" id="all_new_sec"></div>
        
        </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Add Section</button>
</div>
</div>

</form>
<input type="hidden" id="all_t">
<script>
    function show_total(t){
        document.getElementById("all_t").value = t;
        var remain = t/100*10;
        var totals = t-remain;
        if ($("#stu_numbers").length > 0){
        document.getElementById("stu_numbers").remove();
        }
        if(t > 0){
            
$("#modalInput").prepend('<div id="stu_numbers" class="btn btn-success mb-2 col-md-12"><table border=2  class="table table-hover text-white"><tr><th>Total Seats</th><th>Resereved Seats</th><th>Remaining Seats</th></tr><tr><td>'+t+'</td><td>'+remain+'</td><td>'+totals+'</td></tr></table></div>');


document.getElementById("p1").innerHTML = '<label><b>Enter Number of Section</b></label><input type="text" id="sec_wanted" onkeyup="setSection()" class="form-control" >';
        }
   
    }
</script>
<script>
    function setSection(){
        var total = document.getElementById("all_t").value ; 
        var sec = document.getElementById("sec_wanted").value ;
      var remain = total/100*10;
        var totals = total-remain;
        var no_of_student = totals / sec ;
        
        document.getElementById("all_new_sec").innerHTML = '';
      for (let i = 0; i < sec; i++) {
          if(i==0){
$("#all_new_sec").append('<div class="col-md-6"><input type="text" name="name_sec[]"class="form-control" placeholder="Enter Section Name" required="required"></div><div class="col-md-6"><input type="number" class="form-control" name="no_of_stu[]" value="'+no_of_student+'" ></div></div>');
      
          }else{
$("#all_new_sec").append('<div class="col-md-6"><br><input type="text" name="name_sec[]"class="form-control" placeholder="Enter Section Name" required="required"></div><div class="col-md-6"><br><input type="number" class="form-control" name="no_of_stu[]" value="'+no_of_student+'" ></div></div>');
    
          }
          }
          $("#all_new_sec").append('<hr>');
        // alert(no_of_sec) ;
        
    }
</script>