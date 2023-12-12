                 
                          <?php foreach($rows as $row): 
                            $data = $this->accounts_model->view_months_scheme($row->feeInstallmentId);?>
                              
                          <div class="row pt-3 pb-4 pl-3 pr-3">  
                                <div class="card-body table-responsive p-0 pb-2">
                                <span>Scheme Installment :- <b><?=$data->name;?></b></span>
                                <?php  echo '<span class="pl-3 pb-2">Calculating Months :- <b>'. date("F", mktime(0, 0, 0, $data->fee_start_month, 10)).'</b> to  <b>'.date("F", mktime(0, 0, 0, $data->fee_end_month, 10)).'</b></span>';?> &nbsp;&nbsp;<span>Session :- <b><?=$data->academic;?></b></span>
                                <table class="table table-hover text-nowrap  table-bordered">
                                    
                                    <tr>
                                        <th>Installments</th>
                                        <th style="width: 150px;">Months Info</th>
										<?php
                                        $fees = $this->accounts_model->getDataIDresult('fee_scheme_master',$row->feeInstallmentId);
										foreach ($fee_head as $head)
										{
                                            
											?>
											<th><?=$head->name;?></th>
											<?php
										}
										?>
										<th>Fee Start </th>
										<th>Fee End</th>
                                        <th>Action</th>
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
													<td style="width: 150px;"><input type="text" name="Months[]" class="form-control" placeholder="Months Info"  value="<?php echo date("F", mktime(0, 0, 0, $month, 10)); ?>"   style="width: 150px;" readonly/></td>
													<?php
													$j=1;
													foreach ($fee_head as $r)
													{
                                                        $rss = $this->accounts_model->get_rss($r->id,$i,$row->feeInstallmentId);
                                                       // echo $rss->id;
														?>
														<td>
															<input type="number" name="FIA<?=$r->id.$i.$j;?>" class="form-control change-indexing" placeholder="Rs." value="<?=$rss->amount?>" data="<?=$rss->id?>,fee_structure,id,amount" style="width:100px" <?php if($rss->is_locked=='LOCKED'){ echo 'readonly'; }else{}?>/>

														</td>
														<?php
														$j++;
													}
													?>
													<td><input type="date" name="FeeStartDate[]" class="form-control"  value="<?php echo  $first_day_this_month;?>" readonly ></td>
													<td><input type="date" name="FeeEndDate[]" class="form-control"  value="<?=$lastdate;?>" readonly ></td>
                                                    <td>
                                                    <a href="javascript:void(0)" onclick="_delete(this)" url="<?=$delete_url?><?=$row->feeInstallmentId?>" title="Delete" ><i class="fa-solid fa-trash"></i> </a>&nbsp;
                                                    </td>
												</tr>
												<?php
											}

										}
										?>
									</table>
                                </div>
							</div>
                            <!-- <div class="col-md-11 form-group"></div>
									<div class="col-md-1 form-group">
										<button type="submit" class="btn btn-primary">Submit</button>
									</div> -->
							</div>
                     <?php    endforeach;?>
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