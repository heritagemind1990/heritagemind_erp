
    <script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            fname:"required",
            father:"required",
            mother:"required",
            class_id:"required",
            address:"required",
            fmobile:"required",
            gender:"required",
            dob:"required",
            category:"required",
            lname:{
                required:true,
            }
            
        },
        messages: {
            fname:"Please Enter First Name",
            father:"Please Enter Father's Name",
            mother:"Please Enter Mother's Name",
            class_id:"Please Select Standard",
            address:"Please Enter Address",
            fmobile:"Please Enter Mobile Number",
            gender:"Please Select gender",
            category:"Please Select category",
            dob:"Please Select Date of Birth",
            lname: {
                required : "Please Enter Last Name",
            }
        }
    }); 
});
</script>
  <div class="wrapper">
    <form class="form ajaxsubmit validate-form submit reload-page" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
   
    <div class="modal-body">
    <div class="row mt-3">
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">First Name <sup>*</sup> :</label>
                <input type="text" name="fname" class="form-control" placeholder="Enter First Name :">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Last Name <sup>*</sup> :</label>
                <input type="text" class="form-control" name="lname" placeholder="Enter Last Name">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Father's Name <sup>*</sup> :</label>
                <input type="text" class="form-control" name="father" placeholder="Enter Father's Name">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Mother's Name <sup>*</sup> :</label>
                <input type="text" class="form-control" name="mother" placeholder="Enter Mother's Name">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Select Standard / Class <sup>*</sup> :</label>
                <select class="form-control" name="class_id" >
                <option selected="true" disabled="disabled" value="">--SELECT STANDARD--</option>
                <?php foreach($class as $c){?>
                <option value="<?=$c->id;?>"><?=$c->class_name;?></option>
                <?php }?>
                </select>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Select Category <sup>*</sup> :</label>
                <select class="form-control" name="category" >
                <option selected="true" disabled="disabled" value="">--SELECT CATEGORY--</option>
                <?php foreach($category as $cat){?>
                <option value="<?=$cat->id;?>"><?=$cat->name;?></option>
                <?php }?>
                </select>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Mobile number  :</label>
                <input type="number" class="form-control" name="mobile" placeholder="Enter Mobile Number">
            </div>
        </div>

        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Father's number <sup>*</sup> :</label>
                <input type="number" class="form-control" name="fmobile" placeholder="Enter Mobile Number">
            </div>
        </div>
        
         <div class="col-4">
            <div class="form-group">
                <label class="control-label">Gender <sup>*</sup> :</label><br>
                <input type="radio" name="gender" value="male" id="radio"> Male
               <input type="radio" name="gender" value="female" id="radio"> Female

            </div>
        </div>
         <div class="col-4">
            <div class="form-group">
                <label class="control-label">Date of Birth <sup>*</sup> :</label>
                <input type="date" class="form-control" name="dob" >
            </div>
        </div>
    
        <div class="col-8">
            <div class="form-group">
                <label class="control-label">Address <sup>*</sup> :</label>
                <textarea class="form-control" name="address"></textarea>
            </div>
        </div>
        <hr style="border: 2px solid black;width:100%;">
        <div class="col-12">
        <h4>If applicable to conseccion</h4>
        </div>
       
        <div class="col-4">
            <div class="form-group">
               
                <label class="control-label">Select Concession type <span></span> :</label>
                <select class="form-control" name="concession" >
                <option selected="true" disabled="disabled" value="">--SELECT CONCESSION--</option>
                <?php foreach($concession as $con){?>
                <option value="<?=$con->id;?>"><?=$con->title;?></option>
                <?php }?>
                </select>
            </div>
        </div>
        <div class="col-4 ">
            <div class="form-group">
                <label class="control-label">Search Student <span></span> :</label>
                <div class="search-style-2">
                                <input type="text" placeholder="Search for items ..." id="search-box"  class="form-control"/>
                                
                            <select name="stu_id" id="" class="form-control">

                                <option id="result"></option>
                            </select>
                            <!-- <input type="text" name="stu_id" id="stu_id"> -->
                              <div id="stu_id" class="search-result-box shadow-sm border-0 w-100 d-none">
		            	     </div>
                            
                        </div>
            </div>
        </div>
     
        </div>
</div>
<div class="modal-footer mt-5">
    <button type="reset" class="btn btn-default waves-effect btn-sm" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger btn-sm waves-light" ><i id="loader" class=""></i>Add Enquiry</button>
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
<script type="text/javascript">

	var spinner = `<div class="text-left"><div class="spinner-border spinner-border-sm" role="status">
			  <span class="sr-only"></span>
			</div> </div>`;

	toastr.options = {
	  "positionClass": "toast-bottom-right"
	}

	$(document).ready(function(){
        console.log('<?=base_url()?>admission/autocompleteData');
		// sercher script
		$("#search-box").keyup(function(){
	        if($( "#search-box" ).val() == '')
	        {
	            $("#result").fadeOut();
	            return
	        }
			$.ajax({
				url: '<?=base_url()?>admission/autocompleteData',
				method: 'POST',
				datatype: 'json',
				data: {search:$( "#search-box" ).val()},
				success: function (data) {
				var ele = '';
				$.each(JSON.parse(data), function(index,value){
                   // alert(value.fname);die();
				    ele = ele + `<option value="${value.id}" >${value.fname}</option>`;
                    ele = ele + `<input type="hidden" name="stu_id" value="${value.id}" >`;
                    
				});
				$("#result").fadeIn();
				$('#result').html(ele);
                $('#stu_id').html(ele);
				$("#main-body").click(function(){
				    $("#result").fadeOut();
				    return
				 });
				}
			});
		});

    })
    </script>