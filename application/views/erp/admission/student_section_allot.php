
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
              <li class="breadcrumb-item"><a href="<?=base_url();?>admission-data">Admission</a></li>
              <li class="breadcrumb-item active"><?=$title;?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main Content -->
<div class="container-fluid">
    <div class="card pt-3  pl-3 pb-5 pr-3">
      <div class="row">
        <div class="col-12 mb-1">
        <form class="form" action="<?=base_url('admission-section-allot');?>" method="post"   id="student">
            <label for="">Select Standard / Class</label>
            <select name="class_id" id="" class="form-control" onchange="submit_form('student')">
                <option selected="true" disabled="disabled" value="">--Select--</option>
                <?php foreach($class as $c){?>
                <option value="<?=$c->id;?>" <?php if( $c->id == $class_id) { echo 'selected';}?> ><?=$c->class_name;?></option>
                <?php }?>
            </select>
            <button type="submit" id="btn_sub"style="display:none"></button>
        </form>
        </div>
        <script>
         
        function submit_form(id){
             document.getElementById("btn_sub").click();
        }
    </script>
        <div class="col-6">
           <form class="form ajaxsubmit validate-form submit reload-page" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
              <div class="card-body">
              <p><b> Student Details</b></p>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th width="10px">Student Name</th>
                      <th width="20px">Student ID</th>
                      <th style="width: 50px">Select All    <input id="select-all" type="checkbox" style="width: 20px;height:20px;"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;foreach($stu as $s){?>
                    <tr>
                      <td><?=$i;?></td>
                      <td><?=$s->fname;?></td>
                      <td><?=$s->stu_id;?></td>
                      <td><input type="checkbox" id="<?=$s->id;?>" name="stu_id[]" value="<?=$s->id;?>" 
                       style="width: 22px;height: 22px;float:right" ></td>
                    </tr>
                    <?php $i++; }?>
                  </tbody>
                </table>
              </div>
          </div>
        <div class="col-6 mt-4">
        <label for="">Select Section </label>
            <select name="section" id="" class="form-control">
                <option selected="true" disabled="disabled" value="">--Select--</option>
                <?php foreach($section as $c){?>
                <option value="<?=$c->id;?>"><?=$c->section_name;?></option>
                <?php }?>
            </select>
        </div>
        <div class="col-5"></div>
       <div class="col-2">
        <input type="submit" class="btn btn-primary btn-sm">
       </div>
       <div class="col-5"></div>
     </form>
      </div> 
    </div>
</div>

  </div>
  <!-- /.content-wrapper -->
  
<div class="modal fade text-left" id="showModal-xl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel21" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel21">......</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              
          </div>
          <!-- <div class="modal-footer">
              <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
          </div> -->
      </div>
  </div>
</div>


<div class="modal fade text-left" id="showModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel21" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel21">......</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              
          </div>
          <!-- <div class="modal-footer">
              <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
          </div> -->
      </div>
  </div>
</div>
<script>
   document.getElementById('select-all').onclick = function() {
    var checkboxes = document.getElementsByName('stu_id[]');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
}
  </script> 
<script>
$('#showModal-xl').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var recipient = button.data('whatever') 
    var data_url  = button.data('url') 
    var modal = $(this)
    $('#showModal-xl .modal-title').text(recipient)
    $('#showModal-xl .modal-body').load(data_url);
})

$('#showModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var recipient = button.data('whatever') 
    var data_url  = button.data('url') 
    var modal = $(this)
    $('#showModal .modal-title').text(recipient)
    $('#showModal .modal-body').load(data_url);
})

$(document).on('click','[data-dismiss="modal"]', function(event) {
    $('#showModal .modal-body').html('');
    $('#showModal .modal-body').text('');
})




</script>
        
