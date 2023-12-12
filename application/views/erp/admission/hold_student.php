
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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
            <div class="card-header">
              <h3 class="card-title float-right">
                <a href="<?=base_url();?>admission-system" class="btn btn-danger btn-sm"><i class="fas fa-backward"></i>   Back</a>
                </h3>
                <div class="card-title float-left">
                <form autocomplete="off" class="form dynamic-tb-search" action="<?=$tb_url?>" method="POST" enctype="multipart/form-data" tagret-tb="#tb">
         <div class="row justify-content-center">
             <div class="col-md-12">
                 <div class="form-group mb-0">
                     <label for="name">Search</label>
                     <input type="text" class="form-control input-sm" name="tb-search" id="tb-search" value="<?php if($search!='null'){echo $search;}?>" placeholder="Search..." />
                 </div>
             </div>
         </div>
                </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-content collapse show" id="tb">
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div id="modal-div"></div>
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


$(document).on('click', '.pag-link', function(event){
            document.body.scrollTop = 0; 
            document.documentElement.scrollTop = 0;
            // var search = $('#tb-search').val();
            var FormData = $('.dynamic-tb-search').serialize();
            $.post($(this).attr('href'),FormData)
            .done(function(data){
                $('#tb').html(data);
            })
            return false;
        })

        var timer;
        var timeout = 800;
        $(document).on('keyup', '#tb-search', function(event){
            clearTimeout(timer);
            timer = setTimeout(function(){
                var search  = $('#tb-search').val();
                // console.log(search);
                var tbUrl = $('[name="tb"]').val();
                $.post(tbUrl,{search:search})
                .done(function(data){
                    $('#tb').html(data);
                })
            }, timeout);

            return false;
        })

$(document).on('change input','.dynamic-tb-search',function(event) {
    $(this).submit();
});

$(document).on('click','.dynamic-tb-search [type=reset]',function(event) {
    $('.dynamic-tb-search')[0].reset();
    setTimeout(function() {
        $('.dynamic-tb-search').submit();
    }, 100);
    
});
$(document).on('submit','.dynamic-tb-search',function(event) {
    $this = $(this);

    $.ajax({
      url: $this.attr("action"),
      type: $this.attr("method"),
      data:  new FormData(this),
      processData: false,
      contentType: false,
      success: function(data){
        // console.log(data);
        // return false;
        // data = JSON.parse(data);
        $($this.attr("tagret-tb")).html(data);
        
        // alert_toastr(data.res,data.msg);
      }
    })
    return false;
})
</script>
<script>
     function toggleCommentBox(status) {
        if(status == 'REJECTED' || status == 'ONHOLD') {
            $('#rejected_comment_div').removeClass('d-none');
        } else {
            $('#rejected_comment_div').addClass('d-none');
        }
    }
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
                            loadtb();
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
<script>
    function display_details(stu_id, send_url) {
        $.ajax({
            url: send_url,
            method: "POST",
            data: {
                id: stu_id
            },
            success: function(data) {
                const dataArr = JSON.parse(data);
                if (dataArr.status) {
                    $('#modal-div').html(dataArr.data);
                    $('#customerDetailModal').modal('show');
                } else {
                    alert(dataArr.message);
                }
            }
        });
    }

    </script>