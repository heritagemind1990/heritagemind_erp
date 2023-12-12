
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
              <li class="breadcrumb-item"><a href="<?=base_url();?>academic-data">Academic</a></li>
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
              <div class="card-header">
                <h3 class="card-title float-left">
                <button class="float-right btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Add <?=$title;?>" data-url="<?=$new_url?>" >Student Section Allot</button>
                </h3>
               
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="tb">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Class / Standard </th>
                    <th>Total No of Seats</th>
                    <th>Total No of Reserved Seats</th>
                    <th>Action</th>
                  </tr>
                  </thead>  
                  <tbody>
                <?php $i=1;foreach($rs as $r){?>
                  <tr>
                    <td><?=$i;?></td>
                    <td><?=$r->class_name;?></td>
                    <td><?=$r->no_of_seat;?></td>
                    <td><?=$r->reserve_seats;?></td>
                    <td> <span class="changeStatus" data-toggle="change-status" value="<?=($r->status==1) ? 0 : 1?>" data="<?=$r->id?>,class_master,id,status" ><i class="<?=($r->status==1) ? 'fa-regular fa-circle-check' : 'fa-solid fa-circle-xmark'?>" title="Click for chenage status" style="color:<?=($r->status==1) ? 'green' :'red'?> "></i></span>
                    &nbsp;&nbsp;
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update  ( Section Allot :-<?=$r->class_name?>)" data-url="<?=$update_url?><?=$r->id?>" title="Update">
                    <i class="fa fa-edit"></i>
                       </a>&nbsp;&nbsp;
                    <a href="javascript:void(0)" onclick="_delete(this)" url="<?=$delete_url?><?=$r->id?>" title="Delete" ><i class="fa-solid fa-trash"></i> </a>&nbsp;
                   
                   </td>
                  </tr>
                  <?php $i++;}?>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Sr No.</th>
                    <th>Class / Standard </th>
                    <th>Total No of Seats</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
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




$(document).on('click','[data-toggle="change-status"]', function(event) {
            var t = $(this).parent();
            var data =  $(this).attr('data');
            var value =  $(this).attr('value');
            Swal.fire({
                  toast:true,
                  type: 'warning',
                  title: 'You want to change status ?',
                  timer:3000,
                  showConfirmButton: true,
                  showCancelButton: true,
                  confirmButtonText: `Yes`,
                  cancelButtonText: `No`,
                }).then((result) => {
                    if(result.value==true){

                         $.post('<?=base_url()?>change_status/',{data:data,value:value})
                         .done(function(data){
                                console.log(data);   
                                t.html(data);
                            })
                        .fail(function() {
                            alert_toastr("error","error");
                          })
                    }
                }).catch(swal.noop);
            return false;
            
        })
        
 

</script>
<script>
       
    $(document).on("submit", '.ajaxsubmit', function(event) {
    var table=$('#example1').val();
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
                    console.log(data);
                    data = JSON.parse(data);
                    $('.'+data.res).html(data.msg);
                    if (data.res=='success') {
       
                       
                        if(!$this.hasClass("update-form")) {
                            $('[type="reset"]').click();
                        }
                        if ($this.hasClass("reload-tb")) {
                          setTimeout(function() {
                                window.location.reload();
                            }, 1);
                        }
                        if ($this.hasClass("reload-page")) {
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        }
                        if ($this.hasClass("tb")) {
                            setTimeout(function() {
                                window.location.reload();
                            }, 10);
                        }
                       
                    }
                    if (data.errors) {
                        $.each(data.errors,function(key,value){
                            $this.find(`[name="${key}"]`).parents(`.form-group`).find(`.error`).text(value);
                        })
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