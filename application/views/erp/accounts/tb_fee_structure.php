                  
                 <form class="form ajaxsubmit validate-form submit reload-tb" action="<?=$action_url?>" method="post" enctype= multipart/form-data>
                           <div class="row pt-1 pb-4 pl-3 pr-3">            
								<div class="col-lg-6 form-group">
                                    <label  for="" style="color:#000000;">Fee Installment</label>
                                        <select class="form-control" name="Feeinst" id="Feeinst" required>
                                            <option value="">Fee Installment</option>
                                            <?php
                                            foreach ($fees_scheme as $scheme)
                                            {
                                                $schemeid = $scheme->id;
                                                ?>
                                                class<option value="<?=$scheme->id;?>" <?php if($Feeinstid==$scheme->id) { echo "selected"; } ?> ><?=$scheme->name;?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                </div>
									<div class="col-lg-6 form-group">
                                    <label  for="" style="color:#000000;">Select Standard</label>
                                        <select class="form-control" name="Standard" id="Standard" >
                                            <option value="">Select Standard</option>
                                            <?php
                                            foreach ($class as $c)
                                            {
                                                ?>
                                                class<option value="<?=$c->id;?>" ><?=$c->class_name;?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <!-- <?php //echo $Feeinstid;?>
                                    <span>Calculating Months :- <b>A to B</b></span> -->
                                </div>
                                <div class="col-lg-6 form-group  " id="section_list">
                                </div>
                                <div class="col-lg-12 form-group" id="school_list">
                                <div class="card-body table-responsive p-0 pb-2">
                                <table class="table table-hover text-nowrap  table-bordered">
                                    
                                    <tr>
                                        <th>Installments</th>
                                        <th style="width: 150px;">Months Info</th>
										<?php
										foreach ($fee_head as $head)
										{
											?>
											<th><?=$head->name;?></th>
											<?php
										}
										?>
										<th>Fee Start </th>
										<th>Fee End</th>
									</tr>
                                    
										<?php
										foreach ($fees as $scheme)
										{
											$feeInstallment = $scheme->name;
											for ($i=1;$i<=$feeInstallment;$i++)
											{
                                                $old_date_timestamp = strtotime($scheme->added);
                                                $new_date = date('Y', $old_date_timestamp); 
												$month = $scheme->fee_start_month+$i-1;
												if($month==1)
												{
													$months = '0'.$month;
												}elseif($month==2)
												{
													$months = '0'.$month;
												}
												elseif($month==3)
												{
													$months = '0'.$month;
												}
												elseif($month==4)
												{
													$months = '0'.$month;
												}
												elseif($month==5)
												{
													$months = '0'.$month;
												}
												elseif($month==6)
												{
													$months = '0'.$month;
												}
												elseif($month==7)
												{
													$months = '0'.$month;
												}
												elseif($month==8)
												{
													$months = '0'.$month;
												}
												elseif($month==9)
												{
													$months = '0'.$month;
												}
												elseif($month==10)
												{
													$months = $month;
												}
												elseif($month==11)
												{
													$months = $month;
												}
												elseif($month==12)
												{
													$months = $month;
												}
											 	$first_day_this_month = date($new_date.'-'.$months.'-01');// hard-coded '01' for first day
											 	$last_day_this_month  = date($new_date.'-'.$months.'-t');// hard-coded for last day
												  $datestring = $new_date.'-'.$months.'-01'; 
  
												 // Converting string to date 
												 $date = strtotime($datestring); 
													
												 // Last date of current month. 
												  $lastdate = (date("Y-m-t", $date )); 
												?>
												<tr>
													<td><b><?=$i;?></b></td>
													<td style="width: 150px;"><input type="text" name="Months[]" class="form-control" placeholder="Months Info"  value="<?php echo date("F", mktime(0, 0, 0, $month, 10)); ?>"   style="width: 150px;"/></td>
													<?php
													$j=1;
													foreach ($fee_head as $r)
													{
														?>
														<td>
															<input type="number" name="FIA<?=$r->id.$i.$j;?>" class="form-control" placeholder="Rs."/>

														</td>
														<?php
														$j++;
													}
													?>
													<td><input type="date" name="FeeStartDate[]" value="<?php echo  $first_day_this_month;?>" required></td>
													<td><input type="date" name="FeeEndDate[]" value="<?=$lastdate;?>" required></td>
												</tr>
												<?php
											}

										}
										?>
									</table>
                                </div>
							</div>
                            <div class="col-md-11 form-group"></div>
									<div class="col-md-1 form-group">
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>
							</div>
						</form>
<script>
    $(document).ready(function () {
        $('#Standard').on('change',function () {
            var Feeinst = $("#Feeinst").val();
           var C = this.value;
           if(Feeinst !=''){
            $.ajax({
               url:'<?=base_url('fee-structure/section_list/');?>',
               method:'POST',
               data:{'C':C},
               success:function (res) {
                   
                   $('#section_list').html(res);
               }
           })
        }else
        {
            alert_toastr('error','Sorry !! Please select fee installment then select standard.');
        }
        });
    });

</script>

<script>
    $(document).ready(function () {
        $('#Feeinst').on('change',function () {
            
           var F = this.value;
           
            $.ajax({
               url:'<?=base_url('fee-structure/school_list/');?>',
               method:'POST',
               data:{'F':F},
               success:function (res) {
                   
                   $('#school_list').html(res);
               }
           })
        });
    });

</script>