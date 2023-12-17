
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
              <li class="breadcrumb-item"><a href="<?=base_url();?>hrm-data">Hrm</a></li>
              <li class="breadcrumb-item active"><?=$title;?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div id="spinner-div" class="pt-5">
    <div class="spinner-border text-primary" role="status">
    </div>
</div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
      <div class="col-12">
            <div class="card">
              <div class="card-header bg-info">
              <div class="row">
              <!-- <h3 class="card-title float-right ml-2">
               
                </h3> -->
              
                <div class="col-md-3 col-sm-3">
                <select name="role" id="role" class="form-control">
                    <option value="">--Select Role--</option>
                    <?php foreach($roles as $r):?>
                    <option value="<?=$r->id;?>" <?php if(isset($_POST['role'])==$r->id){echo "selected";} ;?>><?=$r->role_name;?></option>
                     <?php endforeach;?>   
                </select>
                </div>
                <div class="col-md-3 col-sm-3">
                 <input type="date" name="date" id="date" class="form-control" value="<?=date('Y-m-d')?>">
                </div>
                <div class="col-md-3 col-sm-3">
                   <input type="button" onclick="markPresent()" class="btn  btn-primary" value="Submit">
                </div>
                <div class="col-md-2 col-sm-2">
                <button onclick="ExportToExcel('xlsx')" class="btn btn-warning ">Export table to excel</button>
                </div>
                <div class="col-md-1 col-sm-1">
                <a href="<?=base_url();?>hrm-data" class="btn btn-danger "><i class="fas fa-backward"></i>   Back</a>
                </div>
                </div>
              </div>
              <!-- /.card-header -->
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
  <!-- /.content-wrapper -->
  
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script type="text/javascript">
function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('tbl_exporttable_to_xls');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('Staff Role & Day Wise Attendance Report.' + (type || 'xlsx')));
    }
</script>
 <script>
        function printTable() {
            window.print();
        }
    </script>
  <input type="hidden" name="tb" value="<?=$tb_url?>">
<script>

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
  function markPresent()
    {
      $('#spinner-div').show();
        var role = $("#role").val();
        var date = $("#date").val();
        // alert(Attmonth);
        $.ajax({
            url:"<?= base_url(); ?>staff-attendance-register/tb",
            method:"POST",
            data:{role:role,date:date},
            success:function(data)
            {
              $('#spinner-div').hide();
                $("#tb").html(data);
            }
        }) ;
    }
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