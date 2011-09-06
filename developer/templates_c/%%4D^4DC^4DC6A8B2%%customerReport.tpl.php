<?php /* Smarty version 2.6.19, created on 2011-01-01 12:22:08
         compiled from customerReport.tpl */ ?>

		<tr>
			<td>
			
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
								<td>Order From</td>	
								<td>
									<input type="text" name="txt_order_from"  id="txt_order_from"  class="dateTextBox" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_order_from']; ?>
" readonly="" />
								</td>
								<td>Order to</td>	
								<td>
									<input type="text" name="txt_order_to"  id="txt_order_to" class="dateTextBox" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_order_to']; ?>
" readonly=""/>
								</td>
								<td>
									<input name="runningAction" type="hidden" value="<?php echo $this->_tpl_vars['obj']->currentAction; ?>
" />
									<input name="actionvar" type="submit" class="butsubmit" value="Search" />
									&nbsp;
									<input name="actionvar" type="submit" class="butsubmit" value="Reset" />
								</td>
								<td>
									<a href="<?php echo $this->_tpl_vars['obj']->getLink('getcsv','',true); ?>
&runningAction=<?php echo $this->_tpl_vars['obj']->currentAction; ?>
" class="Second_link" title="Export to CSV">
									<img src="images/csv.png" border="0" alt="Export to CSV" width="25" height="25" />
									</a>
								</td>
								<td>
									<a href="javascript:;" id="id_search_link" title="Advanced search">
										<img src="images/search.png" border="0" width="16" height="16" />
									</a>
								</td>
						</tr>
				</table>
			</td>
		</tr>
		<tr>
				<td>
				<div id="id_search_block" class="cls_search_block">
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
							<tr>
								<td>Country</td>
								<td>
									<?php echo $this->_tpl_vars['actionReturn']['searchdata']['ship_country']; ?>

								</td >	
								<td rowspan="3" style="vertical-align:top">
										<select name="sel_filter_users[]" multiple="multiple" style="width:170px;height:75px;">
											<optgroup label="Filter users">
												<option <?php if (in_array ( 'productive' , $this->_tpl_vars['actionReturn']['searchdata']['sel_filter_users'] )): ?> 	selected="selected"  <?php endif; ?> value="productive">Productive</option>
												<option <?php if (in_array ( 'ecom' , $this->_tpl_vars['actionReturn']['searchdata']['sel_filter_users'] )): ?> 		selected="selected"  <?php endif; ?> value="ecom">E-commerce</option>
												<option <?php if (in_array ( 'facebook' , $this->_tpl_vars['actionReturn']['searchdata']['sel_filter_users'] )): ?> 	selected="selected"  <?php endif; ?> value="facebook">Face Book</option>
											</optgroup>
										</select>
								</td>		
							</tr>	
								
							<tr>
								<td>
									Ship State
								</td>
								<td id="id_search_ship_state">
										<?php echo $this->_tpl_vars['actionReturn']['searchdata']['ship_state']; ?>

								</td>
							</tr>						
							<tr>
								<td>
									Application
								</td>
								<td>
									<?php echo $this->_tpl_vars['actionReturn']['searchdata']['cat_application']; ?>

								</td>
							</tr>
					</table>  
				</div>					
				</td>
		 </tr>

