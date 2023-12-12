
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            fname:"required",
            father:"required",
            mother:"required",
            enrollment:"required",
            address:"required",
            fmobile:"required",
            gender:"required",
            dob:"required",
            category:"required",
            roll:"required",
            aadhaar:"required",
            lname:{
                required:true,
            }
            
        },
        messages: {
            fname:"Please Enter First Name",
            father:"Please Enter Father's Name",
            mother:"Please Enter Mother's Name",
            enrollment:"Please Enter Enrollment",
            address:"Please Enter Address",
            fmobile:"Please Enter Mobile Number",
            gender:"Please Select gender",
            category:"Please Select category",
            dob:"Please Select Date of Birth",
            roll:"Please Enter Roll No",
            aadhaar:"Please Enter aadhaar No",
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
    <div class="col-3">
            <div class="form-group">
                <label class="control-label">Enrollment / Sr. No <sup>*</sup> :</label>
                <input type="text" name="enrollment" class="form-control" value="<?=$student->enrollment;?>">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label class="control-label">Roll No. <sup>*</sup> :</label>
                <input type="text" class="form-control" name="roll" value="<?=$student->roll_no;?>">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label class="control-label">First Name <sup>*</sup> :</label>
                <input type="text" name="fname" class="form-control" value="<?=$student->fname;?>">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label class="control-label">Last Name <sup>*</sup> :</label>
                <input type="text" class="form-control" name="lname" value="<?=$student->lname;?>">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label class="control-label">Father's Name <sup>*</sup> :</label>
                <input type="text" class="form-control" name="father" value="<?=$student->father;?>">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label class="control-label">Mother's Name <sup>*</sup> :</label>
                <input type="text" class="form-control" name="mother" value="<?=$student->mother;?>">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label class="control-label">Select Category <sup>*</sup> :</label>
                <select class="form-control" name="category" >
                <option selected="true" disabled="disabled" value="">--SELECT CATEGORY--</option>
                <?php foreach($category as $cat){?>
                <option value="<?=$cat->id;?>" <?php if($cat->id==$student->category_id){echo "selected";} ;?>><?=$cat->name;?></option>
                <?php }?>
                </select>
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label class="control-label">Mobile number  :</label>
                <input type="number" class="form-control" name="mobile" value="<?=$student->mobile;?>">
            </div>
        </div>

        <div class="col-3">
            <div class="form-group">
                <label class="control-label">Father's number <sup>*</sup> :</label>
                <input type="number" class="form-control" name="fmobile"  value="<?=$student->father_no;?>">
            </div>
        </div>
        
         <div class="col-3">
            <div class="form-group">
                <label class="control-label">Gender <sup>*</sup> :</label><br>
                <input type="radio" name="gender" value="male" id="radio"<?php if($student->gender=='MALE'){echo "checked";};?>> Male
               <input type="radio" name="gender" value="female" id="radio" <?php if($student->gender=='FEMALE'){echo "checked";};?>> Female

            </div>
        </div>
         <div class="col-3">
            <div class="form-group">
                <label class="control-label">Date of Birth <sup>*</sup> :</label>
               <?php  $excel_date =$student->dob;    
                                 //Convert excel date to mysql db date
                                $unix_date = ($excel_date - 25569) * 86400;
                                $excel_date = 25569 + ($unix_date / 86400);
                                $unix_date = ($excel_date - 25569) * 86400;
                                //Insert below to sql
                                 $added_date = gmdate("Y-m-d", $unix_date); ?>
                <input type="date" class="form-control" name="dob"  value="<?php echo $added_date; ?>">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label class="control-label">Aadhaar Number <sup>*</sup> :</label>
                <input type="number" class="form-control" name="aadhaar"  value="<?=$student->adhaar;?>">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label class="control-label">Father's Aadhaar  :</label>
                <input type="number" class="form-control" name="paadhaar"  value="<?=$student->parents_aadhaar;?>">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label class="control-label">Email Address :</label>
                <input type="email" class="form-control" name="email"  value="<?=$student->email;?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Address <sup>*</sup> :</label>
                <textarea class="form-control" name="address"><?=$student->address;?></textarea>
            </div>
        </div>
        <hr style="border: 2px solid black;width:100%;">
        <div class="col-12">
        <span>If Applicable conseccion then select Student</span>
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
                              <div id="stu_id" class="search-result-box shadow-sm border-0 w-100 d-none">
		            	     </div>
                            
                        </div>
            </div>
        </div>
        <div class="col-4 ">
            <div class="form-group">
                <label>Present Consecceion</label>
                <input type="text" class="form-control" value="<?php foreach($concession as $c){ $consid=$c->id; if($c->id==$student->concession_id){echo $c->title;} ;}  ?> <?php if($student->concession_id !=0) {;?>of <?php }?> <?php foreach($rs as $r){  if($r->id==$student->brother_id){ $subBrotherId=$r->brother_id; echo $r->fname.' '.$r->lname ;
                           ?> <?php if($subBrotherId !=''){echo ',';}else{?>or  <?php }
                           $se = $this->admission_model->Select('student_master', '*', array('brother_id'=>$student->id ,'type'=>'REGISTERED' ));
                           foreach($se as $s)
                           { 
                             $subbrother = $s->id;
                             if($s->gender=='MALE'){echo 'Sister of ' ;}else{ echo 'Brother of ';};echo ''.$s->fname.'  '.$s->lname.'';
                           }
                           $se = $this->admission_model->Select('student_master', '*', array('id'=>$subBrotherId ,'type'=>'REGISTERED' ));
                           foreach($se as $s)
                           { 
                             $subbrother = $s->id;
                             if($s->gender=='MALE'){echo 'Sister of ' ;}else{ echo 'Brother of ';};echo ''.$s->fname.'  '.$s->lname.'';
                           }
                      
                        } 
                        
                    
                         ;};?> 
                        <?php 
                        if($student->concession_id !=0)
                        {

                        }else{
                      $se = $this->admission_model->Select('student_master', '*', array('brother_id'=>$student->id ,'type'=>'REGISTERED' ));
                      foreach($se as $s)
                      { 
                        $subbrother = $s->id;
                        if($s->gender=='MALE'){echo 'Brother of ' ;}else{ echo 'Sister of ';};echo ''.$s->fname.'  '.$s->lname.'';
                         ?> or  <?php $se = $this->admission_model->Select('student_master', '*', array('brother_id'=>$subbrother ,'type'=>'REGISTERED' ));
                        foreach($se as $s)
                        { 
                          $subbrother = $s->id;
                          if($s->gender=='MALE'){echo 'Sister of ' ;}else{ echo 'Brother of ';};echo ''.$s->fname.'  '.$s->lname.'';
                        }
                      }}  
                        ;?>"
                        readonly/>
            </div>
        </div>
        <hr style="border: 2px solid black;width:100%;">
        <div class="col-12">
            <span>If Student Left then select YES else select NO</span>
            <select name="left" id="" class="form-control">
                
                <option value="1" <?php  if($student->IsLeft==1){echo "selected";}?>  >YES</option>
                <option value="0" <?php  if($student->IsLeft==0){echo "selected";}?> >NO</option>
            </select>
        </div>
        </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger  waves-light" ><i id="loader" class=""></i>Save</button>
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