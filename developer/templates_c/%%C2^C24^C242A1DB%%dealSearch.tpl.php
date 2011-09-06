<?php /* Smarty version 2.6.19, created on 2011-02-21 15:21:25
         compiled from dealSearch.tpl */ ?>
			<tr>
				<td  align="right">&nbsp;</td>
			</tr>
			<tr>
				<td>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
							<td>Keyword</td>	
							<td>
							<input type="text" name="keyword" size="10" maxlength="25" id="id_keyword" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['keyword']; ?>
" />
							</td>							
							<td>Vendor ID/email</td>	
							<td>
							<input type="text" size="10" name="txt_vendorId" maxlength="25" id="txt_vendorId" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_vendorId']; ?>
" />
							</td>
							<td>
							<input name="actionvar" type="submit" class="butsubmit" value="Search" />
							
							&nbsp;
							<input name="actionvar" type="submit" class="butsubmit" value="Reset" />
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Add')): ?>
							&nbsp;<input name="actionvar" type="submit" class="butsubmit" value="Add New" />
							<?php endif; ?>

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
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_status'] == ""): ?> selected="selected" <?php endif; ?>   value="">All</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_status'] == @GLB_DEAL_PENDING): ?> selected="selected" <?php endif; ?>  value="<?php echo @GLB_DEAL_PENDING; ?>
">Under Review</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_status'] == @GLB_DEAL_ACCEPTED): ?> selected="selected" <?php endif; ?>  value="<?php echo @GLB_DEAL_ACCEPTED; ?>
">Approved & in Queue</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_status'] == @GLB_DEAL_REJECTED): ?> selected="selected" <?php endif; ?>  value="<?php echo @GLB_DEAL_REJECTED; ?>
">Rejected</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_status'] == @GLB_DEAL_LOCKED): ?> selected="selected" <?php endif; ?>   value="<?php echo @GLB_DEAL_LOCKED; ?>
">Locked for Voting</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_status'] == @GLB_DEAL_UNLOCKED): ?> selected="selected" <?php endif; ?>  value="<?php echo @GLB_DEAL_UNLOCKED; ?>
">Unlocked for Buying</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_status'] == @GLB_DEAL_LOCKED || $this->_tpl_vars['actionReturn']['searchdata']['sel_status'] == @GLB_DEAL_UNLOCKED): ?> selected="selected" <?php endif; ?>   value="<?php echo @GLB_DEAL_LOCKED; ?>
,<?php echo @GLB_DEAL_UNLOCKED; ?>
">Running</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_status'] == @GLB_DEAL_COOLDOWN): ?> selected="selected" <?php endif; ?>  value="<?php echo @GLB_DEAL_COOLDOWN; ?>
">In Cool Down</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_status'] == @GLB_DEAL_EXPIRED): ?> selected="selected" <?php endif; ?>  value="<?php echo @GLB_DEAL_EXPIRED; ?>
">Expired</option>
										</select>

								</td>
								<td>Application</td>
								<td><?php echo $this->_tpl_vars['actionReturn']['searchdata']['cat_application']; ?>
</td>								
								<td rowspan="7" style="vertical-align:top">
								<?php echo $this->_tpl_vars['actionReturn']['searchdata']['sel_opt_cat']; ?>

								</td>
							</tr>

							<tr>
								<td>Date From </td>
								<td>
										<select name="sel_date_field_from">
											<option value="">Date From</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_date_field_from'] == 'Added'): ?>			selected="selected" <?php endif; ?> value="Added">Added Date</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_date_field_from'] == 'Locked'): ?> 		selected="selected" <?php endif; ?> value="Locked">Locked Date</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_date_field_from'] == 'Unlocked'): ?>		selected="selected" <?php endif; ?> value="Unlocked">Unlocked Date</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_date_field_from'] == 'Cooldown'): ?>		selected="selected" <?php endif; ?> value="Cooldown">Cool Down Date</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_date_field_from'] == 'Expired'): ?>		selected="selected" <?php endif; ?> value="Expired">Expired Date</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_date_field_from'] == 'CouponExpiry'): ?> 	selected="selected" <?php endif; ?> value="CouponExpiry">Coupon Expiry Date</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_date_field_from'] == 'Updated'): ?> 		selected="selected" <?php endif; ?> value="Updated">Status Updated Date</option>
										</select>
								</td>
								<td><span title="Greater than or equal to" style="font-size:16px;font-weight:bold">> =</span></td>
								<td>
									<input type="text" name="txt_date_field_from" id="txt_date_field_from"  value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_date_field_from']; ?>
" class="dateTextBox"  readonly="" maxlength="10" size="10" />
								</td>
							</tr>
							<tr>
								<td>Date To</td>
								<td>
										<select name="sel_date_field_to">
											<option value="">Date To</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_date_field_to'] == 'Added'): ?> 			selected="selected" <?php endif; ?> value="Added">Added Date</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_date_field_to'] == 'Locked'): ?> 			selected="selected" <?php endif; ?> value="Locked">Locked Date</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_date_field_to'] == 'Unlocked'): ?>			selected="selected" <?php endif; ?> value="Unlocked">Unlocked Date</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_date_field_to'] == 'Cooldown'): ?>			selected="selected" <?php endif; ?> value="Cooldown">Cool Down Date</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_date_field_to'] == 'Expired'): ?>			selected="selected" <?php endif; ?> value="Expired">Expired Date</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_date_field_to'] == 'CouponExpiry'): ?> 	selected="selected" <?php endif; ?> value="coupon_expiry_date">Coupon Expiry Date</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_date_field_to'] == 'Updated'): ?> 			selected="selected" <?php endif; ?> value="Updated">Status Updated Date</option>
											</select>
								</td>
								<td><span title="Less than or equal to"  style="font-size:16px;font-weight:bold">< =</span></td>
								<td>
									<input type="text" name="txt_date_field_to" id="txt_date_field_to" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_date_field_to']; ?>
" class="dateTextBox"  readonly=""  maxlength="10" size="10" />
								</td>
							</tr>
							<tr>
								<td>Value From </td>
								<td>
										<select name="sel_amount_field_from">
											<option value="">Value From</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == 'Votes'): ?> 				selected="selected" <?php endif; ?> value="Votes">Votes</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == 'Unlockvote'): ?> 			selected="selected" <?php endif; ?> value="Unlockvote">Unlock Vote Limit</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == 'Total_Quantity'): ?>		selected="selected" <?php endif; ?> value="Total_Quantity">Total Quantity</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == 'Sold_Quantity'): ?>		selected="selected" <?php endif; ?> value="Sold_Quantity">Sold Quantity</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == 'Balance_Quantity'): ?>		selected="selected" <?php endif; ?> value="Balance_Quantity">Balance Quantuty</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == 'Price'): ?> 				selected="selected" <?php endif; ?> value="Price">Deal Price</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == 'Cost'): ?> 				selected="selected" <?php endif; ?> value="Cost">Deal Cost</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == 'Offer'): ?> 				selected="selected" <?php endif; ?> value="Offer">Offer Rate(%)</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == 'Vendor_Commission'): ?> 	selected="selected" <?php endif; ?> value="Vendor_Commission">Vendor Commision(%)</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == 'Site_Commission'): ?> 		selected="selected" <?php endif; ?> value="Site_Commission">Site Commision(%)</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == 'Agent_Commission'): ?> 	selected="selected" <?php endif; ?> value="Agent_Commission">Agent Commision(%)</option>
										</select>
								</td>
								<td><span title="Greater than or equal to" style="font-size:16px;font-weight:bold">> =</span></td>
								<td>
									<input type="text" name="txt_amount_field_from" id="txt_amount_field_from" class="nummberOnly" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_amount_field_from']; ?>
" maxlength="10" size="10" />
								</td>
							</tr>
							<tr>
								<td>Value To</td>
								<td>
										<select name="sel_amount_field_to">
											<option value="">Value To</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == 'Votes'): ?> 					selected="selected" <?php endif; ?> value="Votes">Votes</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == 'Unlockvote'): ?> 			selected="selected" <?php endif; ?> value="Unlockvote">Unlock Vote Limit</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == 'Total_Quantity'): ?>			selected="selected" <?php endif; ?> value="Total_Quantity">Total Quantity</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == 'Sold_Quantity'): ?>			selected="selected" <?php endif; ?> value="Sold_Quantity">Sold Quantity</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == 'Balance_Quantity'): ?>		selected="selected" <?php endif; ?> value="Balance_Quantity">Balance Quantuty</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == 'Price'): ?> 					selected="selected" <?php endif; ?> value="Price">Deal Price</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == 'Cost'): ?> 					selected="selected" <?php endif; ?> value="Cost">Deal Cost</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == 'Offer'): ?> 					selected="selected" <?php endif; ?> value="Offer">Offer Rate(%)</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == 'Vendor_Commission'): ?> 		selected="selected" <?php endif; ?> value="Vendor_Commission">Vendor Commision(%)</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == 'Site_Commission'): ?> 		selected="selected" <?php endif; ?> value="Site_Commission">Site Commision(%)</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == 'Agent_Commission'): ?> 		selected="selected" <?php endif; ?> value="Agent_Commission">Agent Commision(%)</option>
										</select>
								</td>
								<td><span title="Less than or equal to"  style="font-size:16px;font-weight:bold">< =</span></td>
								<td>
									<input type="text" name="txt_amount_field_to" id="txt_amount_field_to" class="nummberOnly" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_amount_field_to']; ?>
" maxlength="10" size="10" />
								</td>
								
							</tr>
							<tr>								
								<td>Deal ID</td>	
								<td>
								<input type="text" size="15" name="txt_dealId" maxlength="25" id="txt_vendorId" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_dealId']; ?>
" />
								</td>
								<td><?php if ($this->_tpl_vars['actionReturn']['searchdata']['sales_combo']): ?>Sales Agent<?php endif; ?></td>
								<td><?php if ($this->_tpl_vars['actionReturn']['searchdata']['sales_combo']): ?><?php echo $this->_tpl_vars['actionReturn']['searchdata']['sales_combo']; ?>
<?php endif; ?></td>
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
						<?php if ($this->_tpl_vars['actionReturn']['searchdata']['txt_dealId'] != "" && $this->_tpl_vars['actionReturn']['data']['0']['name'] != ""): ?>
							<td  style="padding:4px 0px 4px 0px"><strong>Deal</strong> : <?php echo $this->_tpl_vars['actionReturn']['data']['0']['name']; ?>
</td>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['searchdata']['txt_vendorId'] != "" && $this->_tpl_vars['actionReturn']['data']['0']['business_name'] != ""): ?>
							<td  style="padding:4px 0px 4px 0px"><strong>Vendor</strong> : <?php echo $this->_tpl_vars['actionReturn']['data']['0']['business_name']; ?>
</td>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['searchdata']['sales_agents'] != "" && $this->_tpl_vars['actionReturn']['data']['0']['s_agent_fname'] != ""): ?>
							<td  style="padding:4px 0px 4px 0px"><strong>Sales Agent</strong> : <?php echo $this->_tpl_vars['actionReturn']['data']['0']['s_agent_fname']; ?>
 <?php echo $this->_tpl_vars['actionReturn']['data']['0']['s_agent_lname']; ?>
</td>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_date_field_from'] != "" && $this->_tpl_vars['actionReturn']['searchdata']['txt_date_field_from'] != ""): ?>
							<td  style="padding:4px 0px 4px 0px"><strong><?php echo $this->_tpl_vars['actionReturn']['searchdata']['sel_date_field_from']; ?>
 Date From</strong> : <?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_date_field_from']; ?>
</td>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_date_field_to'] != "" && $this->_tpl_vars['actionReturn']['searchdata']['txt_date_field_to'] != ""): ?>
							<td  style="padding:4px 0px 4px 0px"><strong><?php echo $this->_tpl_vars['actionReturn']['searchdata']['sel_date_field_to']; ?>
 Date To</strong> : <?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_date_field_to']; ?>
</td>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] != "" && $this->_tpl_vars['actionReturn']['searchdata']['txt_amount_field_from'] != ""): ?>
							<td  style="padding:4px 0px 4px 0px"><strong><?php echo $this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from']; ?>
  From</strong> : <?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_amount_field_from']; ?>
</td>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] != "" && $this->_tpl_vars['actionReturn']['searchdata']['txt_amount_field_to'] != ""): ?>
							<td  style="padding:4px 0px 4px 0px"><strong><?php echo $this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to']; ?>
 To</strong> : <?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_amount_field_to']; ?>
</td>
						<?php endif; ?>
					</tr>
				</table>   
			</td>
			</tr>

			<tr>
				<td>&nbsp;</td>
			</tr>