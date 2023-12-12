<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Heritage Mind School Software</title>
    <base href="<?php echo base_url(); ?>">
    <link rel="icon" type="image/x-icon" href="<?=base_url('assets/');?>photo/images/h.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url('assets/');?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url('assets/');?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="<?=base_url('assets/');?>dist/css/adminlte.min.css"> -->
  <link rel="stylesheet" href="<?=base_url('assets/');?>dist/css/adminlte.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <style>
    .login-page
    {
      background: url('images/bg_logo.png') no-repeat  center center fixed; 
     -webkit-background-size:cover;
     -moz-background-size: cover;
     -o-background-size: cover;
      background-size: cover;
    }
  </style>
</head>
<body class="hold-transition login-page">
  
<div class="login-box ">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary pt-5 pb-5 ">
       <center>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label id="inst-level" class="transition btn btn-primary active" onclick="transition_button('inst-level');">
                           School
                        </label>
                        <label id="teacher-level" class="transition btn btn-secondary" onclick="transition_button('teacher-level');">
                            Teacher
                        </label>
                        <label id="student-level" class="transition btn btn-secondary " onclick="transition_button('student-level');">
                            Student/Parent
                        </label>
                    </div>
                </center>
                     <script>
                    function transition_button(id){
                        $(".transition").attr('class', 'transition btn btn-secondary');
                        $("#"+id).attr('class', 'transition btn btn-primary');
                        switch(id){
                            case 'inst-level': $("#teacher-label-form").slideUp(); $("#student-label-form").slideUp(); $("#inst-label-form").fadeIn(); break;
                            case 'teacher-level': $("#student-label-form").slideUp(); $("#inst-label-form").slideUp(); $("#teacher-label-form").fadeIn(); break;
                            case 'student-level': $("#inst-label-form").slideUp(); $("#teacher-label-form").slideUp(); $("#student-label-form").fadeIn(); break;
                            default: break;
                        }
                    }
                </script>
    <div class="card-header text-center">
      <img src="<?=base_url('images/heritage3.png');?>" height="120px" width="150px">
      <!-- <a href="<?=base_url();?>" class="h1"><b>Heritage</b>Mind</a> -->
      
    </div>
    <!-- as a school -->
    <div class="card-body"  id="inst-label-form" >
    <h6 class="error text-center" style="color: red !important;"></h6> 
    <h6 class="success text-success text-center"></h6> 
      <p class="login-box-msg">Sign in to as a  School</p>
      <form id="inst_form" class="form ajaxsubmit" method="post" action="<?=base_url();?>inst-login">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Email" name="email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <input type="hidden" name="type" value="school">
          <div class="col-12">
            <button type="submit" id="instbtn" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>

    <!-- As a Teacher -->
    <div class="card-body" id="teacher-label-form" style="display: none;">
    <label class="error text-danger text-center"></label> 
    <label class="success text-success text-center"></label> 
      <p class="login-box-msg">Sign in to  as a Teacher</p>
      <form id="teacher_form"  method="post" class="form ajaxsubmit reload-page" action="<?=base_url();?>teacher-login">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Email" name="email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
<input type="hidden" name="type" value="teacher">
          <!-- /.col -->
          <div class="col-12 ">
            <button type="submit" id="teacherbtn" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>


    <!-- as a Student -->
    <div class="card-body" id="student-label-form"  style="display: none;" >
    <label class="error text-danger text-center"></label> 
    <label class="success text-success text-center"></label> 
      <p class="login-box-msg">Sign in to as a  Student / Parent</p>
      <form   id="student_form"  method="post" class="form ajaxsubmit reload-page" action="<?=base_url();?>student-login">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Enter Username " name="username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-mobile"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <input type="hidden" name="type" value="student">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" id="studentbtn" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?=base_url('assets/');?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url('assets/');?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/');?>dist/js/adminlte.min.js"></script>
<script>
 
  $(document).on("submit", '.ajaxsubmit', function(event) {
    //alert("Hello");
    event.preventDefault(); 
    $this = $(this);
    if ($this.hasClass("append")) {
        var append_data = $($this.attr('append-data')).val();
        $(this).append('<input type="hidden" name="append" value="'+append_data+'" /> ');

    }
    var form_data = new FormData(this);
    form_valid = true;

    if ($this.hasClass("validate-form")) {
        if ($this.valid()) {
            form_valid = true;
        }
        else{
            form_valid = true;
        }
    }

    setTimeout(function() {
        if (form_valid == true) {
            $.ajax({
                url: $this.attr("action"),
                type: $this.attr("method"),
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data){
                    console.log(data);
                    data = JSON.parse(data);
                    $('.'+data.res).html(data.msg);
                    if (data.res=='success') {
                      setTimeout(function() {
                            window.location.href = data.redirect_url;
                        }, 1000);
                    }
                    else
                    {
                      $(".error").html("Please enter correct details...");
                    }
                    alert_toastr(data.res,data.msg);
                    ///loadtb();
                }
                
            })
        }
    }, 100);

    return false;
})



</script>

</body>
</html>
