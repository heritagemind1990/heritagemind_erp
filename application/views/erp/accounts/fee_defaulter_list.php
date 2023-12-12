
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
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
      <div class="col-12">
            <div class="card">
              <div class="card-header bg-info">
              <h3 class="card-title float-right mt-1 ml-2">
              <button onclick="ExportToExcel('xlsx')" class="btn btn-success btn-sm mr-2">Export table to excel</button>
                <a href="<?=base_url();?>accounts-data" class="btn btn-danger btn-sm"><i class="fas fa-backward"></i>   Back</a>
                </h3>
                <div class="card-title float-left">
                <form autocomplete="off" class="form dynamic-tb-search" action="<?=$tb_url?>" method="POST" enctype="multipart/form-data" tagret-tb="#tb">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="form-group mb-0">
                         <select name="section" id="" class="form-control">
                            <option value="">--select section--</option>
                            <?php foreach($section as $s):?>
                             <option value="<?=$s->id;?>"><?=$s->section_name;?></option>
                            <?php endforeach;?>    
                         </select>   
                        </div>
                    </div>
                </div>
                </form>
                </div>
                <h3 class="card-title text-center mt-1 ml-2 pt-1">
                    Please select section and month then view fee defaulter list
                </h3>
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
         XLSX.writeFile(wb, fn || ('Fee Defaulter  Report.' + (type || 'xlsx')));
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
  
