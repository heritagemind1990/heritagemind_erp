                                   <?php
										foreach ($fee_scheme as $scheme)
										{
										  echo '<span class="pl-3 pb-2">Calculating Months :- <b>'. date("F", mktime(0, 0, 0, $scheme->fee_start_month, 10)).'</b> to  <b>'.date("F", mktime(0, 0, 0, $scheme->fee_end_month, 10)).'</b></span>';
										}?>
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
										foreach ($fee_scheme as $scheme)
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