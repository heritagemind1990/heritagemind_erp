
<label  for="" style="color:#000000;">Select Section</label>
<?php
if(!empty($rs)){
foreach ($rs as $r)
{
	?>
	<br><input type="checkbox" value="<?=$r->id;?>" name="Section[]" checked="checked"><?=$r->section;?>
		
	<?php
	} }else{
?>
<br><p class="text-danger">No section found in this standard.</p>
<?php }?>