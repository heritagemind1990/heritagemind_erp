
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper pt-4 pb-5">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?=$title;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url();?>teacher-data">Teacher</a></li>
              <li class="breadcrumb-item active"><?=$title;?></li>
            </ol>
          </div><!-- /.col -->

          <div class="col-sm-12 pt-2">
            <div class="card pt-3 pb-3 pl-4 pr-4">
            <form method="post" enctype="multipart/form-data" action="<?=base_url('student-attendance');?>">
                <div class="row">
                    <div class="col-sm-6">
                      <label for="">Select Section : </label>
                      <select name="section" id="" class="form-control">
                        <option value="">--Select Section--</option>
                        <?php foreach($sections as $s):?>
                        <option value="<?=$s->id;?>"><?=$s->section_name;?></option>
                        <?php endforeach ;?>
                      </select>
                    </div>
                    <div class="col-sm-6">
                    <label for="">Select Date : </label>
                    <input type="date" class="form-control" id="attDateNew" name="attDate" value="<?=$date;?>">
                    </div>
                    <div class="col-md-12 pt-3 text-center">
						<button type="submit" onclick="markPresent()" class="btn btn-primary">Submit</button>
					 </div>
                    </form>
                     <?php if($section >=1){;?>     
             <div class="col-12 pt-4 pb-4 ">
          <div class="card-body table-responsive p-0 pb-2">
            <table class="table table-hover text-nowrap  table-bordered">
              <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Section</th>
                    <th>Enrollment / SRNO</th>
                    <th>Student Name</th>
                    <th>Attendance</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($student as $st):?>
                <tr>
                    <td><?=$st->stu_id;?></td>
                    <td><?=$st->section_name;?></td>
                    <td><?=$st->enrollment;?></td>
                    <td><?=$st->fname.' '.$st->lname;?></td>
                    <td>
                     <?php
    $p_att = $this->db->query("select attendance from student_attendance WHERE student_id='".$st->id."' AND section='".$section."' AND date='".$_POST['attDate']."'")->result_array();
     ?>
<input type="checkbox" id="studentAbsent<?=$st->id;?>" 
onchange="studentAbsent('<?=$st->id;?>' ,'<?=$section;?>')" name="vehicle1" 
value="Car" <?php if(!empty($p_att)){if($p_att[0]['attendance'] == 1){?>checked="checked"<?php }} ?> style="height:20px;width:20px">
        <label for="studentAbsent<?=$st->id;?>"></label>
                </td>
                <script>
              function studentAbsent(stu_id , section){
              var date = $("#attDateNew").val(); 
              
            var section = '<?=$section;?>';             
            var dataString = '&date='+date+'&section='+section+'&stu_id='+stu_id;
            // alert(dataString);
            $.ajax({
           type: 'POST',
           url: '<?php echo base_url(); ?>student-attendance/studentAbsent',
           data:dataString,
           beforeSend:function(){
         return confirm("Are you sure? change this attendance");
      },        
           success: function (response) {
               var data = JSON.parse(response);
               $('.'+data.res).html(data.msg);
               if (data.errors) {
                        $.each(data.errors,function(key,value){
                            $this.find(`[name="${key}"]`).parents(`.form-group`).find(`.error`).text(value);
                        })
                    }
                    alert_toastr(data.res,data.msg);
           }
       }); 
        }
                    </script>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
          </div>
          </div>
          <?php }?>
                </div>
            </div>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<body onload="studentPresent()">   
</body>
  </div>
  <!-- /.content-wrapper -->
  
  <script>
    function studentPresent(){

     var date = $("#attDateNew").val(); 
  
      var section = '<?=$section;?>';
      var dataString = '&date='+date+'&section='+section;
      
       $.ajax({
           type: 'POST',
           url: '<?php echo base_url(); ?>student-attendance/studentPresent',
           data:dataString,  
           success: function (response) {
               var data = JSON.parse(response);
               $('.'+data.res).html(data.msg);
               if (data.errors) {
                        $.each(data.errors,function(key,value){
                            $this.find(`[name="${key}"]`).parents(`.form-group`).find(`.error`).text(value);
                        })
                    }
                    alert_toastr(data.res,data.msg);
           }
       }); 
        }
        </script>
        