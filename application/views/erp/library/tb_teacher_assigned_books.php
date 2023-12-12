<div class="card-body table-responsive p-0 pb-2">
                <table class="table table-hover text-nowrap  table-bordered">
                  <thead>
                  <tr>
                    <th>Sr No.</th>
                    <th>Teacher Name</th>
                     <th>Section</th>
                     <th>Books name</th>
                     <th>Total Days </th>
                    <th>Status</th>
                    <th>If Teacher Return</th>
                  </tr>
                  </thead>  
                  <tbody>
                <?php $i=$page;foreach($rows as $r){?>
                  <tr>
                    <td><?=++$i;?></td>
                    <td><?=$r->teacher_name;?></td>
                    <td><?=$r->section_name;?></td>
                    <td><?=$r->book_name;?></td>
                    <td><?=$r->days;?> Days</td>
                    <td> <?php if($r->teacher_given=='YES'){echo "<span class='text-danger'>Teacher Given</span>";}elseif($r->teacher_return=='YES'){echo "<span class='text-success'>Teacher Return</span>";};?> </td>
                    <td>
                        <input type="hidden" id="row" value="YES" >
                        <select name="return" id="" class="form-control" onchange="teacher_return(<?=$r->id;?>)">
                            <option value="YES">YES</option>
                            <option value="NO" selected>NO</option>
                        </select>
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

    <script>
   function teacher_return(bvalue)
   {
    var row = $('#row').val();
        $.ajax({
            url: "<?php echo base_url('teacher-assigned-books/tb'); ?>",
            method: "POST",
            data: {
                teacher_return:row,
                id:bvalue,
            },
            success: function(data){
                $("#tb").html(data);
               
            },
        });
        
   }
    </script>