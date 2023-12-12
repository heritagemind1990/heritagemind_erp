<div class="card-body table-responsive p-0 pb-2">
                <table class="table table-hover text-nowrap  table-bordered">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Category</th>
                    <th>Section</th>
                    <!-- <th>Barcode ID Format</th>
                    <th>SBN No Format</th> -->
                    <th>Language</th>
                    <th>Price</th>
                    <!-- <th>Qty</th> -->
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>  
                  <tbody>
                <?php $i=$page;foreach($rows as $r){?>
                  <tr>
                    <td><?=++$i;?></td>
                    <td>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="<?=$r->name?>" data-url="<?=$image_url?><?=$r->id?>" >
                    <img src="<?php echo IMGS_URL.$r->img ;?>" alt="" height="50px" width="50px">
                    </a></td>
                    <td><?=$r->name;?></td>
                    <td><?=$r->author_name;?></td>
                    <td><?=$r->pub_name;?></td>
                    <td><?=$r->cat_name;?></td>
                    <td><?=$r->section_name;?></td>
                    <!-- <td>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="<?=$r->name?>" data-url="<?=$isbn_url?><?=$r->id?>" >
                    <?=$r->barcode_id;?>
                    </a></td> -->
                    <!-- <td>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="<?=$r->name?>" data-url="<?=$isbn_url?><?=$r->id?>" >
                    <?=$r->isbn_no;?>
                    </a></td> -->
                    <td><?=$r->language;?></td>
                    <td><?=$r->price;?></td>
                    <!-- <td><?=$r->qty;?></td> -->
                    <td><?=$r->description;?></td>
                    <td> <span class="changeStatus" data-toggle="change-status" value="<?=($r->status==1) ? 0 : 1?>"   data="<?=$r->id?>,books_master,id,status" ><i class="<?=($r->status==1) ? 'fa-regular fa-circle-check' : 'fa-solid fa-circle-xmark'?>" title="Click for chenage status" style="color:<?=($r->status==1) ? 'green' :'red'?> "></i></span>
                    </td>
                    <td>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="Update  ( Book :-<?=$r->name?>)" data-url="<?=$update_url?><?=$r->id?>" title="Update">
                    <i class="fa fa-edit"></i>
                       </a>&nbsp;&nbsp;&nbsp;
                    <a href="javascript:void(0)" onclick="_delete(this)" url="<?=$delete_url?><?=$r->id?>" title="Delete" ><i class="fa-solid fa-trash"></i> </a><br>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever=" Inventory Book  (  :-<?=$r->name?>)" data-url="<?=$inventory_url?><?=$r->id?>" title="Update" class="btn btn-sm btn-primary">
                    Inventory
                       </a>
                       <a href="javascript:void(0)" data-toggle="modal" data-target="#showModal" data-whatever="<?=$r->name?>" class="btn btn-sm btn-warning ml-1" data-url="<?=$isbn_url?><?=$r->id?>" >
                   View
                    </a>
                   </td>
                  </tr>
                  <?php }?>
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