<div class="container-fluid">
<div class="card-body table-responsive p-0 pb-2">
 <table class="table table-hover text-nowrap  table-bordered">
  <thead>
    <th>Sr.No.</th>
    <th>Photo</th>
    <th>Driver Name</th>
    <th>Contact Number</th>
    <th>Email</th>
    <th>Address</th>
    <th>Status</th>
    <th>Action</th>
  </thead>
  <tbody>
    <?php 
     foreach($data as $d):   $id = $d->assign_id ; $driver_id = $d->driver_id?>
    <tr>
        <td>1.</td>
        <td><img src="<?=IMGS_URL.$d->photo;?>" alt="" height="80px" onerror="this.src='<?=base_url()?>assets/noimg/logo.jpg';"></td>
        <td><?=$d->name;?></td>
        <td><?=$d->mobile;?></td>
        <td><?=$d->email;?></td>
        <td><?=$d->address;?></td>
        <td class="text-center">
         <span class="changeStatus" data-toggle="change-status" value="<?=($d->status==1) ? 0 : 1?>" data="<?=$d->id?>,assgin_tr_route_driver,id,status" ><i class="<?=($d->status==1) ? 'fa-regular fa-circle-check' : 'fa-solid fa-circle-xmark'?>" title="Click for chenage status" style="color:<?=($d->status==1) ? 'green' :'red'?> "></i></span>
          </td>
        <td>
        <a href="javascript:void(0)" title="Update" id="edit_form_button">
                    <i class="fa-solid fa-pen-to-square"></i>
                       </a>&nbsp;
        </td>  
    </tr>
    <?php endforeach;?>
  </tbody>
 </table>
 <form action="">
 <div class="row mt-4 pb-5" id="add_form">
  <div class="col-10">
    <input type="hidden" name="" id="route" value="<?=$route->id;?>">
    <input type="hidden" name="" id="id" value="">
    <div class="form-group">
        <label for="">Select Driver</label>
        <select name="driver" id="driver" class="form-control">
            <option value="">--Select--</option>
            <?php foreach($driver as $dr):?>
             <option value="<?=$dr->id;?>"><?=$dr->name;?></option>
            <?php endforeach;?>
        </select>
    </div>
  </div>
  <div class="col-2">
    <div class="form-group">
        <button class="btn btn-primary mt-4" onclick="add_driver()"  type="button">Submit</button>
    </div>
  </div>
 </div>
 </form>
 <form action="">
 <div class="row mt-4 pb-5" id="update-form" style="display: none;">
  <div class="col-10">
    <input type="hidden" name="" class="route" id="route" value="<?=$route->id;?>">
    <input type="hidden" name="" class="id" id="id" value="<?=$id;?>">
    <div class="form-group">
        <label for="">Select Driver</label>
        <select name="driver" id="driver" class="form-control driver">
            <option value="">--Select--</option>
            <?php foreach($driver as $dr):?>
             <option value="<?=$dr->id;?>" <?php if($driver_id==$dr->id){echo "selected";} ;?> ><?=$dr->name;?></option>
            <?php endforeach;?>
        </select>
    </div>
  </div>
  <div class="col-2">
    <div class="form-group">
        <button class="btn btn-danger mt-4" onclick="update_driver()"  type="button">Update</button>
    </div>
  </div>
 </div>
 </form>
</div>

<script>
    $('#edit_form_button').click(function() {
    $('#update-form').show();
    $('#add_form').hide();
});
    
function add_driver()
{
    var route = $('#route').val();
    var driver = $('#driver').val();
    var id = $('#id').val();
    if(driver !=''){
   $.ajax({
    url: "<?php echo base_url('route-allocation/add_assig_driver_route'); ?>",
    method: "POST",
    data: {
        route:route,
        driver:driver,
        id:id
    },
    success: function(data){
        if(data=='Saved.')
        {
            alert_toastr("success","Saved.");
            setTimeout(function(){location.reload();},3000);
        }else if(data=='Updated.')
        {
            alert_toastr("success","Updated.");
            setTimeout(function(){location.reload();},1000);
        }else if(data=='Already Mapped.')
        {
            alert_toastr("error","Already Mapped.");
        }else
        {
            alert_toastr("error","Not Saved");
        }
       
    },
});
    }else
    {
        alert_toastr("error","Please select driver");
    }
}
function update_driver()
{
    var route = $('.route').val();
    var driver = $('.driver').val();
    var id = $('.id').val();
    if(driver !=''){
   $.ajax({
    url: "<?php echo base_url('route-allocation/add_assig_driver_route'); ?>",
    method: "POST",
    data: {
        route:route,
        driver:driver,
        id:id
    },
    success: function(data){
        if(data=='Saved.')
        {
            alert_toastr("success","Saved.");
            setTimeout(function(){location.reload();},3000);
        }else if(data=='Updated.')
        {
            alert_toastr("success","Updated.");
            setTimeout(function(){location.reload();},1000);
        }else if(data=='Already Mapped.')
        {
            alert_toastr("error","Already Mapped.");
        }else
        {
            alert_toastr("error","Not Saved");
        }
       
    },
});
    }else
    {
        alert_toastr("error","Please select driver");
    }
}
</script>