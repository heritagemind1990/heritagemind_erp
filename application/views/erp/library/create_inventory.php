<form class="form ajaxsubmit validate-form submit reload-tb" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
    <div class="modal-body pb-5">
    <div class="row">
    <div class="card-body table-responsive p-0 pb-2">
        <h5>Current Inventory</h5>
         <table class="table table-hover text-nowrap  table-bordered">
           <tr>
            <th>Sr.No</th>
            <th>Quantity</th>
            <th>Price</th>
           </tr>
           <tr>
            <td>1.</td>
            <td><?=$book->qty;?></td>
            <td><?=$book->price;?></td>
           </tr>
         </table>
    </div>  
    <div class="col-md-6 form-group">
     <a onclick="fetch_add('Add')" class="btn btn-sm btn-primary text-white ">Add Inventory</a>
    <div class="form-group pt-4" id="add_input">
    </div>
    </div>
    <div class="col-md-6 form-group">
    <a onclick="fetch_sub('Sub')" class="btn btn-sm btn-primary text-white">Subtract Inventory</a>
    <div class="form-group pt-4" id="sub_input">
    </div>
    </div>   
    </div>
    </div>
    <div class="modal-footer">
    <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
    <button id="btnsubmit" type="submit" class="btn btn-danger waves-light" ><i id="loader" class=""></i>Update</button>
</div>
</form>
<script>
    function fetch_add(value)
    {
        var results = document.querySelector('#add_input')
        var input = document.createElement('input') //create input
        var label = document.createElement("label"); //create label
        var adds = $('.adds').length;
        var subs = $('.subs').length;
        if(adds==0 && subs==0)
        {
        if(value=='Add')
        {
        label.innerText = 'Add Inventory' ;
        input.type = "number";
        input.value = "<?=$book->qty;?>"; //add a placeholder
        input.className = "form-control adds input-selector";
        input.name = "add"; // set the CSS class
        input.id="numner";
        input.addEventListener('keypress',isNumber);
        results.appendChild(label); //append label
        results.appendChild(document.createElement("br"));
        results.appendChild(input); //append input
        results.appendChild(document.createElement("br"));
        }else
        {
            results.remove(); 
        }
    }
    else
        {
            results.remove(); 
        }
        
    }
    
    function fetch_sub(value)
    {
        var results = document.querySelector('#sub_input')
        var input = document.createElement('input') //create input
        var label = document.createElement("label"); //create label
        var subs = $('.subs').length;
        var adds = $('.adds').length;
        if(subs==0 && adds==0)
        {
        if(value=='Sub')
        {
        label.innerText = 'Subtract Inventory' ;
        input.type = "number";
        input.value = "<?=$book->qty;?>"; //add a placeholder
        input.className = "form-control subs input-selector";
        input.name = "sub"; // set the CSS class
        input.id="number";
        input.addEventListener('keypress',isNumber);
        results.appendChild(label); //append label
        results.appendChild(document.createElement("br"));
        results.appendChild(input); //append input
        results.appendChild(document.createElement("br"));
        }else
        {
            results.remove(); 
        }
    }else
        {
            results.remove(); 
        }
        
    }
  
    function isNumber(event) {
      var allowed = "";
      if (event.target.value.includes(".")) {
        allowed = "0123456789";
      } else {
        allowed = "0123456789.";
      }
      if (!allowed.includes(event.key)) {
        event.preventDefault();
      }
      }
      
    //   document.getElementById('number').addEventListener('keypress',isNumber);
  
</script>