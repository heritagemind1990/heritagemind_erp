
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
              <li class="breadcrumb-item"><a href="<?=base_url();?>accounts-data">Account</a></li>
              <li class="breadcrumb-item active"><?=$title;?></li>
            </ol>
          </div><!-- /.col -->
          <div class="col-sm-11"></div>
           <div class="col-sm-1 ">
           <a href="<?=base_url();?>accounts-data" class="btn btn-danger btn-sm"><i class="fas fa-backward"></i>   Back</a>
           </div>
           <div id="spinner-div" class="pt-5">
    <div class="spinner-border text-primary" role="status">
    </div>
</div>
          <div class="col-sm-12">
          <h5 class="text-center"><?=$this->session->flashdata('Msg');?></h5>
          <form class="form ajaxsubmit5 validate-form submit reload-tb" action="<?= base_url(); ?>fee-collection/tb" method="post" enctype= multipart/form-data>
           <div class="col-lg-12 form-group  ">
		   <label for=" "><b style="color:#000000;">Select Month:</b> ( <span class="text-danger">Please select atleast one month then click submit button</span> )</label>
           <div class="form-content bg-info">
           <hr style="border: 1px solid green;">
           <b style="color:#000000;" class="pl-3 pt-5">
		       <input type="checkbox" id="month1" name="month1" value="1" style="width:20px;height:20px"> April
           <input type="checkbox" id="month2"  name="month2" value="2" style="width:20px;height:20px"> May
           <input type="checkbox" id="month3"  name="month3" value="3" style="width:20px;height:20px"> June
           <input type="checkbox" id="month4"  name="month4" value="4" style="width:20px;height:20px"> July
           <input type="checkbox" id="month5"  name="month5" value="5" style="width:20px;height:20px"> August
           <input type="checkbox" id="month6" name="month6" value="6" style="width:20px;height:20px"> September
           <input type="checkbox" id="month7" name="month7" value="7" style="width:20px;height:20px"> October
           <input type="checkbox" id="month8" name="month8" value="8" style="width:20px;height:20px"> November
           <input type="checkbox" id="month9" name="month9" value="9" style="width:20px;height:20px"> December
           <input type="checkbox" id="month10" name="month10" value="10" style="width:20px;height:20px"> January
           <input type="checkbox" id="month11" name="month11" value="11" style="width:20px;height:20px"> February
           <input type="checkbox" id="month12" name="month12" value="12" style="width:20px;height:20px;"> March
           </b>
           <hr style="border: 1px solid green;">
           </div>
           </div>
            <div class="col-lg-5 form-group  ">
           <input type="text" class="form-control" placeholder="Enter Enrollment Number / Student ID / SRNO" name="enrollment" id="enrollment" required>
			     </div>
           <div class="col-lg-5 form-group">
            <select name="scheme" id="" class="form-control" required>
              <option value="">--Select Fee Scheme--</option>
              <?php foreach($scheme as $s):?>
              <option value="<?=$s->id;?>"><?=$s->name;?> Installment</option>
              <?php endforeach;?>
            </select>
			     </div>
			<div class="col-md-2 form-group">
           	<button type="submit" class="btn btn-primary" >Submit</button>
			</div>
			</div>
			</form>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content datas" style="display: none;">
      <div class="container-fluid">
      <div class="row">
      <div class="col-12">
              <div class="card-content collapse show" id="tb">
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
      </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  </div>
  <!-- /.content-wrapper -->

<input type="hidden" name="tb" value="<?=$tb_url?>">
<script>
  $("document").ready(function(){
    setTimeout(function(){
        $(".text-center").remove();
    }, 4000 ); // 5 secs

});
function loadtb(url=null){
    if (url!=null) {
        var tbUrl = url;
    }
    else{
        var tbUrl = $('[name="tb"]').val();
    }

    if (tbUrl!='') {
        $('#tb').load(tbUrl);
    }
}

loadtb();

</script>
<script>
  $(document).on("submit", '.ajaxsubmit5', function(event) {
    $(".datas").show();
    $('#spinner-div').show();
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
           // alert("Helo");
            $.ajax({
                url: $this.attr("action"),
                type: $this.attr("method"),
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data){
                  $('#spinner-div').hide();
                  if(!$this.hasClass("load-tb")) {
                   $('#tb').html(data);
                 }
                  
                }
                
            })
        }
    }, 100);

    return false;
})

</script>

<style>
  #spinner-div {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top:50%;
  left: 4%;
  text-align: center;
  background-color: rgba(255, 255, 255, 0.8);
  z-index: 2;
}
</style>
