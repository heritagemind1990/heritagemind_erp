<div class="row card-body">
    <div class="col-sm-4">
        <span>Barcode ID format : <b><?=$book_master->barcode_id;?></b></span>
    </div>
    <div class="col-sm-4">
        <span>ISBN No. format : <b><?=$book_master->isbn_no;?></b></span>
    </div>
    <div class="col-sm-4">
        <span>Total Books Quantity : <b><?=$book_master->qty;?></b></span>
    </div>
    <div class="col-sm-6">
        <span>Student Alloted Books Quantity : <b><?=$book_qty;?></b></span>
    </div>
    <div class="col-sm-6">
        <span>Remaining Books Quantity : <b><?=$book_master->qty-$book_qty;?></b></span>
    </div>
</div>
<div class="card-body table-responsive p-0 pb-2">
<table class="table table-hover text-nowrap  table-bordered">
<tr>
    <th>Sr.No</th>
    <th>Barcode ID</th>
    <th>ISBN Number</th>
</tr>
<?php $i=1;foreach($book as $b):?>
<tr>
    <td><?=$i;?></td>
    <td><?=$b->barcode_id;?></td>
    <td><?=$b->isbn_no;?></td>
</tr>
<?php $i++; endforeach;?>
</table>
</div>