<div class="card-body table-responsive p-0 pb-2">
                <table class="table table-hover text-nowrap  table-bordered">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Name</th>
                    <th>S / O</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Joining Date</th>
                    <th>Documents</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $i=$page;foreach($rows as $t){?>
                  <tr>
                    <td><?=++$i;?></td>
                    <td><?=$t->name;?></td>
                    <td><?=$t->father_name;?></td>
                    <td><?=$t->mobile;?></td>
                    <td><?=$t->email;?></td>
                    <td><?=$t->address;?></td>
                    <td><?=$t->joindate;?></td>
                    <td class="text-center">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Upload Document (<?=$t->name?>)" data-url="<?=$upload_doc_url?><?=$t->id?>" title="Update">
                    <i class="fa-solid fa-book"></i>
                       </a>
                       &nbsp;&nbsp;&nbsp;
                       <a data-toggle="modal" data-target="#modal-lg<?php echo $i;?>" href="#"><i class="far fa-eye"></i></a>
                       
                   </td>
                       <td class="text-center">
                       <span class="changeStatus" data-toggle="change-status" value="<?=($t->status==1) ? 0 : 1?>" data="<?=$t->id?>,transport_conductors,id,status" ><i class="<?=($t->status==1) ? 'fa-regular fa-circle-check' : 'fa-solid fa-circle-xmark'?>" title="Click for chenage status" style="color:<?=($t->status==1) ? 'green' :'red'?> "></i></span>
                   </td>
                    <td>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update Details (<?=$t->name?>)" data-url="<?=$update_url?><?=$t->id?>" title="Update">
                    <i class="fa-solid fa-pen-to-square"></i>
                       </a>&nbsp;
                    <a href="javascript:void(0)" onclick="_delete(this)" url="<?=$delete_url?><?=$t->id?>" title="Delete" ><i class="fa-solid fa-trash"></i> </a>&nbsp;
                 
                      </td>
                  </tr>
                  
      <div class="modal fade" id="modal-lg<?php echo $i;?>">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Document Details ( <?=$t->name;?> )</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <div class="row">
              <div class="col-6 form-group">
                <label for="">Account Holder Name</label>
               <input type="text" class="form-control" value="<?=$t->account_holder_name;?>" readonly>
              </div>
              <div class="col-6 form-group">
                <label for="">Bank Name</label>
               <input type="text" class="form-control" value="<?=$t->bank_name;?>" readonly>
              </div>
              <div class="col-6 form-group">
                <label for="">Account Number</label>
               <input type="text" class="form-control" value="<?=$t->account_number;?>" readonly>
              </div>
              <div class="col-6 form-group">
                <label for="">IFSC Code</label>
               <input type="text" class="form-control" value="<?=$t->ifsc_code;?>" readonly>
              </div>
                <div class="col-12 form-group">
                <label for="">Branch Name</label>
               <input type="text" class="form-control" value="<?=$t->branch_name;?>" readonly>
              </div>
              <hr style="border: 2px solid black;width:100%">
        <div class="col-3">
         <span>Self Photo</span> &nbsp;&nbsp;  
         <?php if($t->photo  !=''){?>
           <a href="<?php echo IMGS_URL.$t->photo ;?>" download="<?php echo IMGS_URL.$t->photo ;?>"><i class="fa-solid fa-download" download></i></a>
             <?php }else{?>
             <span><i  class="fa-solid fa-download" download></i></span>
           <?php }?>
        <div class="card">
            <img src="<?php echo IMGS_URL.$t->photo ;?>" alt="" height="100px">
        </div>
        </div>
        <div class="col-3">
        <span>Aadhaar File</span> &nbsp;&nbsp;  
         <?php if($t->aadhaar_file  !=''){?>
           <a href="<?php echo IMGS_URL.$t->aadhaar_file ;?>" download="<?php echo IMGS_URL.$t->aadhaar_file ;?>"><i class="fa-solid fa-download" download></i></a>
             <?php }else{?>
             <span><i  class="fa-solid fa-download" download></i></span>
           <?php }?>   
        <div class="card">
            <img src="<?php echo IMGS_URL.$t->aadhaar_file ;?>" alt="" height="100px">
        </div>
        </div>
        <div class="col-3">
        <span>Pan File</span>   &nbsp;&nbsp;  
         <?php if($t->pan_photo  !=''){?>
           <a href="<?php echo IMGS_URL.$t->pan_photo ;?>" download="<?php echo IMGS_URL.$t->pan_photo ;?>"><i class="fa-solid fa-download" download></i></a>
             <?php }else{?>
             <span><i  class="fa-solid fa-download" download></i></span>
           <?php }?>   
        <div class="card">
            <img src="<?php echo IMGS_URL.$t->pan_photo ;?>" alt="" height="100px">
        </div>
        </div>
        <div class="col-3">
        <span>Bank Passbook</span>  &nbsp;&nbsp;  
         <?php if($t->bank_passbook  !=''){?>
           <a href="<?php echo IMGS_URL.$t->bank_passbook ;?>" download="<?php echo IMGS_URL.$t->bank_passbook ;?>"><i class="fa-solid fa-download" download></i></a>
             <?php }else{?>
             <span><i  class="fa-solid fa-download" download></i></span>
           <?php }?>    
        <div class="card">
            <img src="<?php echo IMGS_URL.$t->bank_passbook ;?>" alt="" height="100px">
        </div>
        </div>
         <div class="col-3">
        <span>DL File</span>  &nbsp;&nbsp;  
         <?php if($t->dl_photo  !=''){?>
           <a href="<?php echo IMGS_URL.$t->dl_photo ;?>" download="<?php echo IMGS_URL.$t->dl_photo ;?>"><i class="fa-solid fa-download" download></i></a>
             <?php }else{?>
             <span><i  class="fa-solid fa-download" download></i></span>
           <?php }?>    
        <div class="card">
            <img src="<?php echo IMGS_URL.$t->dl_photo ;?>" alt="" height="100px">
        </div>
        </div>
            </div>
            </div>
            <div class="modal-footer justify-content-between">
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
                  <?php  }?>
                  </tbody>
                </table>
              </div>
              <div class="row pb-3 pl-2 pr-2 ">
        <div class="col-md-6 text-left ">
            <span>Showing <?= (@$rows) ? $page+1 : 0 ?> to <?=$i?> of <?=$total_rows?> entries</span>
        </div>
        <div class="col-md-6 text-right ">
            <?=$links?>
        </div>
    </div>