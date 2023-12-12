
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
    <div id="spinner-div" class="pt-5">
    <div class="spinner-border text-primary" role="status">
    </div>
</div>
        <div class="col-sm-12 pt-2">
            <div class="card pt-3 pb-3 pl-4 pr-4">
                <div class="row">
                    <div class="col-sm-6">
                      <label for="">Select Section : </label>
                      <select name="section" id="section" class="form-control">
                        <option value="">--Select Section--</option>
                        <?php foreach($sections as $s):?>
                        <option value="<?=$s->id;?>"><?=$s->section_name;?></option>
                        <?php endforeach ;?>
                      </select>
                    </div>
                    <div class="col-sm-6">
                    <label for="">Select Month : </label>
                    <select id="Attmonth" class="form-control" >
                    <option>--Select Month--</option>  
                    <option value="01" <?php if($Attmonth==1) { echo "selected";} ?>>January</option>
                    <option value="02" <?php if($Attmonth==2) { echo "selected";} ?>>February</option>
                    <option value="03" <?php if($Attmonth==3) { echo "selected";} ?>>March</option>
                    <option value="04" <?php if($Attmonth==4) { echo "selected";} ?>>April</option>
                    <option value="05" <?php if($Attmonth==5) { echo "selected";} ?>>May</option>
                    <option value="06" <?php if($Attmonth==6) { echo "selected";} ?>>June</option>
                    <option value="07" <?php if($Attmonth==7) { echo "selected";} ?>>July</option>
                    <option value="08" <?php if($Attmonth==8) { echo "selected";} ?>>August</option>
                    <option value="09" <?php if($Attmonth==9) { echo "selected";} ?>>September</option>
                    <option value="10" <?php if($Attmonth==10) { echo "selected";} ?>>October</option>
                    <option value="11" <?php if($Attmonth==11) { echo "selected";} ?>>November</option>
                    <option value="12" <?php if($Attmonth==12) { echo "selected";} ?>>December</option>
                    </select>
                    </div>
                    <div class="col-md-12 pt-3 text-center">
            <button type="buton" onclick="markPresent()" class="btn btn-primary">Submit</button>
           </div>  
           </div>
         </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content datas" style="display:none">
      <div class="container-fluid">
      <div class="row">
      <div class="col-12">
            <div class="card">
              <div class="card-header">
              <h3 class="card-title float-right ml-2">
                 <button onclick="ExportToExcel('xlsx')" class="btn btn-success btn-sm mr-2">Export table to excel</button>
                <a href="<?=base_url();?>teacher-data" class="btn btn-danger btn-sm"><i class="fas fa-backward"></i>   Back</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-content collapse show" id="tb" >
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
         XLSX.writeFile(wb, fn || ('Student Attendance Report.' + (type || 'xlsx')));
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
        $(".datas").show();
        var section = $("#section").val();
        var Attmonth = $("#Attmonth").val();
        // alert(Attmonth);
        $.ajax({
            url:"<?= base_url(); ?>teacher-student-attendance-register/tb",
            method:"POST",
            data:{section:section,Attmonth:Attmonth},
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