<?php  if($total_data==0){?>
<script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            section:"required",
            author:"required",
            publisher:"required",
            category:"required",
            isbn_no:"required",
            barcode_id:"required",
            price:"required",
            qty:"required",
            desc:"required",
            img:"required",
            language:"required",
            name:{
                required:true,
                remote:"<?=$remote?>"
            }
            
        },
        messages: {
            section:"Please select section",
            author:"Please select author",
            publisher:"Please select publisher",
            category:"Please select book id",
            isbn_no:"Please enter book ISBN number format",
            barcode_id:"Please enter book barcode ID format",
            price:"Please enter book price",
            qty:"Please enter book quantity",
            desc:"Please enter book description",
            img:"Please select book image",
            language:"Please enter book language",
            name: {
                required : "Please Enter Book Name",
                remote : "Book  Already Exist!"
            }
        }
    }); 
});
</script>
<?php }else{?>
    <script type="text/javascript">
$(document).ready(function() {
    $(".validate-form").validate({
        rules: {
            language:"required",
            section:"required",
            author:"required",
            publisher:"required",
            category:"required",
            isbn_no:"required",
            barcode_id:"required",
            price:"required",
            qty:"required",
            desc:"required",
            name:{
                required:true,
            }
            
        },
        messages: {
            section:"Please select section",
            author:"Please select author",
            publisher:"Please select publisher",
            category:"Please select book id",
            isbn_no:"Please enter book ISBN number format",
            barcode_id:"Please enter book barcode ID format",
            price:"Please enter book price",
            qty:"Please enter book quantity",
            desc:"Please enter book description",
            language:"Please enter book language",
            name: {
                required : "Please Enter Book Name",
            }
        }
    }); 
});
</script>
   <?php } ?>
    <form class="form ajaxsubmit validate-form submit reload-tb" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
    <?php  if($total_data==0){?>
    <div class="modal-body">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Book Name<span class="text-danger">*</span>:</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Book  Name">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Select Section<span class="text-danger">*</span>:</label>
                <select name="section" id="" class="form-control">
                    <option >--Select Section--</option>
                    <?php foreach($section as $sec):?>
                       <option value="<?=$sec->id;?>"><?=$sec->section_name;?></option>
                     <?php endforeach;?>   
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Select Author<span class="text-danger">*</span>:</label>
                <select name="author" id="" class="form-control">
                    <option >--Select Author--</option>
                    <?php foreach($author as $aut):?>
                       <option value="<?=$aut->id;?>"><?=$aut->name;?></option>
                     <?php endforeach;?>   
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Select Publisher<span class="text-danger">*</span>:</label>
                <select name="publisher" id="" class="form-control">
                    <option >--Select Publisher--</option>
                    <?php foreach($publisher as $pub):?>
                       <option value="<?=$pub->id;?>"><?=$pub->name;?></option>
                     <?php endforeach;?>   
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Select Books Category<span class="text-danger">*</span>:</label>
                <select name="category" id="" class="form-control">
                    <option >--Select Books Category--</option>
                    <?php foreach($categpry as $cat):?>
                       <option value="<?=$cat->id;?>"><?=$cat->name;?></option>
                     <?php endforeach;?>   
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">ISBN Number<span class="text-danger">*</span>:</label>
                <input type="text" name="isbn_no" class="form-control" placeholder="Enter ISBN Number Format">
            </div>
        </div>
        <!-- <div class="col-6">
            <div class="form-group">
                <label class="control-label">Books ID<span class="text-danger">*</span>:</label>
                <input type="text" name="book_id" class="form-control" placeholder="Enter Books ID">
            </div>
        </div> -->
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Barcode ID<span class="text-danger">*</span>:</label>
                <input type="text" name="barcode_id" class="form-control" placeholder="Enter Barcode ID Format">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Price<span class="text-danger">*</span>:</label>
                <input type="number" name="price" class="form-control" placeholder="Enter Book Price">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Quantity<span class="text-danger">*</span>:</label>
                <input type="number" name="qty" class="form-control" placeholder="Enter Book Quantity">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Book Image<span class="text-danger">*</span>:</label>
                <input type="file" name="img" class="form-control" >
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Book Language<span class="text-danger">*</span>:</label>
                <input type="text" name="language" class="form-control" placeholder="Enter Book Language">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">book Description<span class="text-danger">*</span>:</label>
                <textarea name="desc" class="form-control" placeholder="Enter Book Description"></textarea>
            </div>
        </div>
        </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Add</button>
</div>
<?php }else{?>
    <div class="modal-body">
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Book Name<span class="text-danger">*</span>:</label>
                <input type="text" name="name" value="<?=$book->name;?>" class="form-control">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Select Section<span class="text-danger">*</span>:</label>
                <select name="section" id="" class="form-control">
                    <option >--Select Section--</option>
                    <?php foreach($section as $sec):?>
                       <option value="<?=$sec->id;?>" <?php if($book->section_id==$sec->id){echo "selected";};?> ><?=$sec->section_name;?></option>
                     <?php endforeach;?>   
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Select Author<span class="text-danger">*</span>:</label>
                <select name="author" id="" class="form-control">
                    <option >--Select Author--</option>
                    <?php foreach($author as $aut):?>
                       <option value="<?=$aut->id;?>"   <?php if($book->author_id==$aut->id){echo "selected";};?>   ><?=$aut->name;?></option>
                     <?php endforeach;?>   
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Select Publisher<span class="text-danger">*</span>:</label>
                <select name="publisher" id="" class="form-control">
                    <option >--Select Publisher--</option>
                    <?php foreach($publisher as $pub):?>
                       <option value="<?=$pub->id;?>" <?php if($book->publisher_id==$pub->id){echo "selected";};?>  ><?=$pub->name;?></option>
                     <?php endforeach;?>   
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Select Books Category<span class="text-danger">*</span>:</label>
                <select name="category" id="" class="form-control">
                    <option >--Select Books Category--</option>
                    <?php foreach($categpry as $cat):?>
                       <option value="<?=$cat->id;?>" <?php if($book->category_id==$cat->id){echo "selected";};?>  ><?=$cat->name;?></option>
                     <?php endforeach;?>   
                </select>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">ISBN Number<span class="text-danger">*</span>:</label>
                <input type="text" name="isbn_no" class="form-control" value="<?=$book->isbn_no;?>" readonly>
            </div>
        </div>
        <!-- <div class="col-6">
            <div class="form-group">
                <label class="control-label">Books ID<span class="text-danger">*</span>:</label>
                <input type="text" name="book_id" class="form-control"  value="<?//=$book->book_id;?>">
            </div>
        </div> -->
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Barcode ID<span class="text-danger">*</span>:</label>
                <input type="text" name="barcode_id" class="form-control"  value="<?=$book->barcode_id;?>" readonly>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Price<span class="text-danger">*</span>:</label>
                <input type="number" name="price" class="form-control"  value="<?=$book->price;?>">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Quantity<span class="text-danger">*</span>:</label>
                <input type="number" name="qty" class="form-control"  value="<?=$book->qty;?>" readonly>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">Book Language<span class="text-danger">*</span>:</label>
                <input type="text" name="language" class="form-control" value="<?=$book->language;?>">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <label class="control-label">Book Image<span class="text-danger">*</span>:</label>
                <input type="file" name="img" class="form-control" value="<?=$book->img;?>">
                <input type="hidden" name="imgname" id="" value="<?=$book->img;?>">
            </div>
        </div>
        <div class="col-2 mt-4">
            <img src="<?php echo IMGS_URL.$book->img ;?>" alt="" height="40px" width="100%" class="mt-2">
        </div>
        <div class="col-6">
            <div class="form-group">
                <label class="control-label">book Description<span class="text-danger">*</span>:</label>
                <textarea name="desc" class="form-control" ><?=$book->description;?></textarea>
            </div>
        </div>
        </div>
</div>
<div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Update</button>
</div>
    <?php }?>
</form>

