
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
          <div class="col-sm-10"></div>
          <div class="col-sm-2">
          <a href="<?=base_url();?>teacher-data" class="btn btn-danger btn-sm" style="float:right !important"><i class="fas fa-backward"></i>   Back</a>
          </div>
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row card">
      <div class="col-sm-12 col-md-12 ">
<!-- <h1>Location Attendance</h1> -->
<div class="button pt-5 pl-5">
<div id="message"></div>

<form id="attendanceForm">
 <?php  $count = $this->student_model->Counter('staff_attendance', array('tea_id' => $_SESSION['MUserId'], 'punch_date' =>date('Y-m-d'),'status' =>'1','att_status' =>'1'));
 $rs = $this->teacher_model->get_att_today($_SESSION['MUserId']);
 
   if($count==0){?>
   <input type="hidden" id="att_id" value="">
    <button type="button" onclick="getCurrentLocation()" class="btn btn-primary btn-round"><i class="fa-solid fa-hand-pointer" style="font-size: 2rem;"></i>&nbsp;&nbsp;Punch In</button>
    <?php }elseif($count==1 && $rs->final==0){?>
      <input type="hidden" id="att_id" value="<?=$rs->id;?>">
    <button type="button" onclick="getCurrentLocation()" class="btn btn-primary btn-round"><i class="fa-solid fa-hand-pointer" style="font-size: 2rem;"></i>&nbsp;&nbsp;Punch Out<p>Punch In :- <?=_time($rs->punch_in);?></p></button>
     
    <?php }else{?>
       <button type="button" class="btn btn-primary btn-round"  style="font-size: 1.5rem;"><i class="fa-solid fa-face-smile"></i>&nbsp;&nbsp;Thanks</button>
      <?php }?>
    <br>
    <small id="locationError" style="color: red;"></small>
</form>
</div>
</div>
<div class="col-sm-12 col-md-12 ">
<div class="card-body table-responsive pb-4 pt-4 pl-4 pr-4 ">
  <table class="table table-hover text-nowrap  table-bordered">
  <thead>
  <tr>
  <th style="border: 2px solid black;">Teacher Name</th>
  <th style="border: 2px solid black;">Punch In</th>
  <th style="border: 2px solid black;">Punch Out</th>
  <th style="border: 2px solid black;">Punch Date</th>
  <th style="border: 2px solid black;">Total Hour</th>
  </tr>
  </thead>  
  <tbody>
    <tr>
      <td style="border: 2px solid black;"><?=$_SESSION['MName'];?></td>
      <td style="border: 2px solid black;"><?=@_time($rs->punch_in);?></td>
      <td style="border: 2px solid black;"><?=@_time($rs->punch_out);?></td>
      <td style="border: 2px solid black;"><?=@_date($rs->punch_date);?></td>
      <td style="border: 2px solid black;"><?=@time_diff($rs->punch_in,$rs->punch_out);?></td>
    </tr>
  </tbody>
  </table>
</div>
</div>
      </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<script>
    function getCurrentLocation() {
        var retVal = confirm("Are you sure mark a attendance in time ?");
         if (retVal == false) {
         }else{
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;

                    // Update input fields
                    $("#latitude").val(latitude);
                    $("#longitude").val(longitude);

                    // Submit attendance
                    submitAttendance(latitude, longitude);
                },
                function(error) {
                    $("#locationError").text("Error getting location: " + error.message);
                }
            );
        } else {
            $("#locationError").text("Geolocation is not supported by this browser.");
        }
    }
    }

    function submitAttendance(latitude, longitude) {
      var att_id = $("#att_id").val();
        $.ajax({
            type: "POST",
            url: "<?=base_url('submit_attendance'); ?>",
            data: { latitude: latitude, longitude: longitude,att_id:att_id },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                    title: "<i><?=$_SESSION['MName'];?></i>", 
                    html: "Attendance marked: <b>successfully !</b>",  
                    confirmButtonText: "OK", 
                    });
                  setTimeout(function(){
                   window.location.reload();
                  },  2000);
                    //$("#message").html(response.message).css('color', 'green');
                } else {
                    $("#message").html(response.message).css('color', 'red');
                }
            },
            error: function() {
                $("#message").html("Error submitting attendance.").css('color', 'red');
            }
        });
    }
</script>