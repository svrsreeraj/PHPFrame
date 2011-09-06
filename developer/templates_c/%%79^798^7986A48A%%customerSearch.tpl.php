<?php /* Smarty version 2.6.19, created on 2011-01-12 04:05:28
         compiled from customerSearch.tpl */ ?>
			<tr>
				<td  align="right">&nbsp;</td>
			</tr>
			<tr>
				<td>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
							<td>Keyword</td>	
							<td>
							<input type="text" name="keyword" maxlength="25" id="id_keyword" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['keyword']; ?>
" />
							</td>
							<td>Cust. ID/email</td>	
							<td>
							<input type="text" size="20" name="txt_customerId" maxlength="25" id="txt_customerId" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_customerId']; ?>
" />
							</td>
							<td>
							<input name="actionvar" type="submit" class="butsubmit" value="Search" />
							
							&nbsp;
							<input name="actionvar" type="submit" class="butsubmit" value="Reset" />
							</td>
							<td>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('getcsv','',true); ?>
&csv=csv" class="Second_link" title="Export to CSV">
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
								<td>Status</td>
								<td>
									<select name="sel_status">
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_status'] == ""): ?> selected="selected" <?php endif; ?> value="">All</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_status'] == '1'): ?> selected="selected" <?php endif; ?>  value="1">Active</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_status'] == '0'): ?> selected="selected" <?php endif; ?> value="0">Inactive</option>
									</select>

								</td>
								<td>Application</td>
								<td><?php echo $this->_tpl_vars['actionReturn']['searchdata']['cat_application']; ?>
</td>
								<td rowspan="6" style="vertical-align:top">
								<select name="sel_filter_users[]" multiple="multiple" style="width:170px;height:150px;">
									<optgroup label="Filter users">
										<option <?php if (in_array ( 'productive' , $this->_tpl_vars['actionReturn']['searchdata']['sel_filter_users'] )): ?> 	selected="selected"  <?php endif; ?> value="productive">Productive</option>
										<option <?php if (in_array ( 'ecom' , $this->_tpl_vars['actionReturn']['searchdata']['sel_filter_users'] )): ?> 		selected="selected"  <?php endif; ?> value="ecom">E-commerce</option>
										<option <?php if (in_array ( 'facebook' , $this->_tpl_vars['actionReturn']['searchdata']['sel_filter_users'] )): ?> 	selected="selected"  <?php endif; ?> value="facebook">Face Book</option>
									</optgroup>
									<optgroup label="Users have">
										<option <?php if (in_array ( 'votes' , $this->_tpl_vars['actionReturn']['searchdata']['sel_filter_users'] )): ?>		selected="selected"  <?php endif; ?> value="votes">Votes</option>
										<option <?php if (in_array ( 'sitepoints' , $this->_tpl_vars['actionReturn']['searchdata']['sel_filter_users'] )): ?> 	selected="selected"  <?php endif; ?> value="sitepoints">Site points</option>
<!--										<option <?php if (in_array ( 'sitecredit' , $this->_tpl_vars['actionReturn']['searchdata']['sel_filter_users'] )): ?> 	selected="selected"  <?php endif; ?> value="sitecredit">Site credits</option>
-->										<option <?php if (in_array ( 'referrals' , $this->_tpl_vars['actionReturn']['searchdata']['sel_filter_users'] )): ?>	selected="selected"  <?php endif; ?> value="referrals">Referrals</option>
									</optgroup>
								</select>
								</td>
								<td rowspan="6" style="vertical-align:top">
								<?php echo $this->_tpl_vars['actionReturn']['searchdata']['sel_opt_cat']; ?>

								</td>


								
							</tr>							
							<tr>
								<td>Country</td>
								<td><?php echo $this->_tpl_vars['actionReturn']['searchdata']['country_combo']; ?>
</td>
								<td>State</td>
								<td id="id_search_state"><?php echo $this->_tpl_vars['actionReturn']['searchdata']['state_combo']; ?>
</td>
						
							</tr>
							<tr>
								<td>Joined From</td>
								<td><input type="text" name="txt_join_from"  id="txt_join_from"  class="dateTextBox" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_join_from']; ?>
" readonly="" /></td>
								<td>Joined To</td>
								<td><input type="text" name="txt_join_to"  id="txt_join_to" class="dateTextBox" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_join_to']; ?>
" readonly=""/></td>
								
							</tr>
							<tr>
								<td>	Value From 	</td>
								<td>
										<select name="sel_amount_field_from">
											<option value="">Value From</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == 'votes'): ?> 			selected="selected" <?php endif; ?> value="votes">Votes</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == 'points'): ?>			selected="selected" <?php endif; ?> value="points">Total Ponits</option>
<!--											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == 'sitecredits'): ?>		selected="selected" <?php endif; ?> value="sitecredits">Site Credits</option>
-->											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == 'referrals'): ?>		selected="selected" <?php endif; ?> value="referrals">Referrals</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == 'deals'): ?> 			selected="selected" <?php endif; ?> value="deals">Deal Purchsed</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == 'ecom'): ?> 			selected="selected" <?php endif; ?> value="ecom">E-com Purchsed</option>
										</select>
								</td>
								<td><span title="Greater than or equal to" style="font-size:16px;font-weight:bold">> =</span></td>
								<td>
									<input type="text" name="txt_amount_field_from" id="txt_amount_field_from" class="nummberOnly" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_amount_field_from']; ?>
" maxlength="10" size="10" />
								</td>
							</tr>
							<tr>
								<td>	Value To	</td>
								<td>
										<select name="sel_amount_field_to">
											<option value="">Value To</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == 'votes'): ?> 			selected="selected" <?php endif; ?> value="votes">Votes</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == 'points'): ?>			selected="selected" <?php endif; ?> value="points">Total Ponits</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == 'sitecredits'): ?>	selected="selected" <?php endif; ?> value="sitecredits">Site Credits</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == 'referrals'): ?>		selected="selected" <?php endif; ?> value="referrals">Referrals</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == 'deals'): ?> 			selected="selected" <?php endif; ?> value="deals">Deal Purchsed</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == 'ecom'): ?> 			selected="selected" <?php endif; ?> value="ecom">E-com Purchsed</option>
										</select>
								</td>
								<td><span title="Less than or equal to"  style="font-size:16px;font-weight:bold">< =</span></td>
								<td>
									<input type="text" name="txt_amount_field_to" id="txt_amount_field_to" class="nummberOnly" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_amount_field_to']; ?>
" maxlength="10" size="10" />
								</td>
								
							</tr>
						</table>
					</div>
				</td>
			</tr>
			
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr class="listTableChangeColor">
			<td>
				<table cellpadding="0" cellspacing="0" width="100%" border="0">
					<tr>
						<?php if ($this->_tpl_vars['actionReturn']['searchdata']['txt_dealId'] != "" && $this->_tpl_vars['actionReturn']['data']['0']['dealname'] != ""): ?>
							<td  style="padding:4px 0px 4px 0px"><strong>Deal</strong> : <?php echo $this->_tpl_vars['actionReturn']['data']['0']['dealname']; ?>
</td>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['searchdata']['txt_vendorId'] != "" && $this->_tpl_vars['actionReturn']['data']['0']['vendorname'] != ""): ?>
							<td  style="padding:4px 0px 4px 0px"><strong>Vendor</strong> : <?php echo $this->_tpl_vars['actionReturn']['data']['0']['vendorname']; ?>
</td>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['searchdata']['txt_customerId'] != "" && $this->_tpl_vars['actionReturn']['data']['0']['customerfname'] != ""): ?>
							<td  style="padding:4px 0px 4px 0px"><strong>Customer</strong> : <?php echo $this->_tpl_vars['actionReturn']['data']['0']['customerfname']; ?>
 <?php echo $this->_tpl_vars['actionReturn']['data']['0']['customerlname']; ?>
</td>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['searchdata']['sales_agents'] != "" && $this->_tpl_vars['actionReturn']['data']['0']['s_agent_fname'] != ""): ?>
							<td  style="padding:4px 0px 4px 0px"><strong>Sales Agent</strong> : <?php echo $this->_tpl_vars['actionReturn']['data']['0']['s_agent_fname']; ?>
 <?php echo $this->_tpl_vars['actionReturn']['data']['0']['s_agent_lname']; ?>
</td>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['searchdata']['txt_order_from'] != ""): ?>
							<td  style="padding:4px 0px 4px 0px"><strong>Date From</strong> : <?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_order_from']; ?>
</td>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['searchdata']['txt_order_to'] != ""): ?>
							<td  style="padding:4px 0px 4px 0px"><strong>Date To</strong> : <?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_order_to']; ?>
</td>
						<?php endif; ?>
					</tr>
				</table>   
			</td>
			</tr>

			<tr>
				<td>&nbsp;</td>
			</tr>