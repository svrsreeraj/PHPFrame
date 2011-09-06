<?php /* Smarty version 2.6.19, created on 2011-01-15 01:18:01
         compiled from dealOrderSearch.tpl */ ?>

			<tr>
				<td>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
							<td>O.ID</td>	
							<td>
							<input type="text" size="6" name="txt_orderId" maxlength="25" id="txt_orderId" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_orderId']; ?>
" />
							</td>
							<td>Cust. ID/email</td>	
							<td>
							<input type="text" size="14" name="txt_customerId" maxlength="30" id="txt_customerId" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_customerId']; ?>
" />
							</td>
							<td>Vend. ID/email</td>	
							<td>
							<input type="text" size="14" name="txt_vendorId" maxlength="30" id="txt_vendorId" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_vendorId']; ?>
" />
							</td>
							<td>
							<input name="runningAction" type="hidden" value="<?php echo $this->_tpl_vars['obj']->currentAction; ?>
" />
							<input name="actionvar" type="submit" class="butsubmit" value="Search" />
							&nbsp;
							<input name="actionvar" type="submit" class="butsubmit" value="Reset" />
							</td>
							<td>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('csv','',true); ?>
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
								<td>Pay status</td>
								<td>
									<select name="sel_pay_status">
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_pay_status'] == "-1"): ?> selected="selected" <?php endif; ?> value="-1">All</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_pay_status'] == @GLB_DEAL_PAID): ?> selected="selected" <?php endif; ?> <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_pay_status'] == ""): ?> selected="selected" <?php endif; ?>value="<?php echo @GLB_DEAL_PAID; ?>
">Paid</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_pay_status'] == @GLB_DEAL_NOT_PAID): ?> selected="selected" <?php endif; ?>  value="<?php echo @GLB_DEAL_NOT_PAID; ?>
">Not Paid</option>
									</select>
								</td>
								<td>Redeemed Status</td>
								<td>
									<select name="sel_redeem_option">
										<option value="">All</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_redeem_option'] == @GLB_COUPON_REDEEMED): ?> selected="selected" <?php endif; ?> value="<?php echo @GLB_COUPON_REDEEMED; ?>
">Redeemed</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_redeem_option'] == @GLB_COUPON_NOT_REDEEMED): ?> selected="selected" <?php endif; ?> value="<?php echo @GLB_COUPON_NOT_REDEEMED; ?>
">Not Redeemed</option>
									</select>
								</td>
								<td>Coupon status</td>
								<td>
									<select name="sel_coupon_status">
										<option value="">All</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_coupon_status'] == @GLB_COUPON_INACTIVE): ?> selected="selected" <?php endif; ?> value="<?php echo @GLB_COUPON_INACTIVE; ?>
">Pending</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_coupon_status'] == @GLB_COUPON_ACTIVE): ?> selected="selected" <?php endif; ?> value="<?php echo @GLB_COUPON_ACTIVE; ?>
">Active</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_coupon_status'] == @GLB_COUPON_EXPIRED): ?> selected="selected" <?php endif; ?> value="<?php echo @GLB_COUPON_EXPIRED; ?>
">Expired</option>
									</select>

								</td>
													
							</tr>							
							<tr>
								<td>Deal Category</td>
								<td><?php echo $this->_tpl_vars['actionReturn']['searchdata']['cat_combo']; ?>
</td>
								<td>Sub Category</td>
								<td id="id_search_subcat"><?php echo $this->_tpl_vars['actionReturn']['searchdata']['subcat_combo']; ?>
</td>
								<td>Sales Agent</td>
								<td><?php echo $this->_tpl_vars['actionReturn']['searchdata']['sales_combo']; ?>
</td>
						
							</tr>
							<tr>
								<td>Order From</td>
								<td><input type="text" name="txt_order_from"  id="txt_order_from"  class="dateTextBox" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_order_from']; ?>
" readonly="" /></td>
								<td>Order To</td>
								<td><input type="text" name="txt_order_to"  id="txt_order_to" class="dateTextBox" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_order_to']; ?>
" readonly=""/></td>
								<td>Deal ID</td>
								<td><input type="text" name="txt_dealId"  id="txt_dealId" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_dealId']; ?>
" size="8"/></td>
								
							</tr>
							<tr>
								<td>Pay Option</td>
								<td>
									<select name="sel_pay_option" style="width:100px;">
										<option value="">All</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_pay_option'] == @GLB_DEAL_PAY_SCREDIT): ?> selected="selected" <?php endif; ?> value="<?php echo @GLB_DEAL_PAY_SCREDIT; ?>
">Site credit Only</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_pay_option'] == @GLB_DEAL_PAY_GATEWAY): ?> selected="selected" <?php endif; ?> value="<?php echo @GLB_DEAL_PAY_GATEWAY; ?>
">Payment Gateway Only</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_pay_option'] == @GLB_DEAL_PAY_BOTH): ?> selected="selected" <?php endif; ?> value="<?php echo @GLB_DEAL_PAY_BOTH; ?>
">Both</option>
									</select>
								</td>
								<td>Application</td>
								<td>
									<?php echo $this->_tpl_vars['actionReturn']['searchdata']['cat_application']; ?>

								</td>
								<td>Coupon Shared</td>
								<td>
									<select name="sel_coupon_shared">
										<option value="">All</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_coupon_shared'] == 'shared'): ?> selected="selected" <?php endif; ?> value="shared">Shared</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_coupon_shared'] == 'notshared'): ?> selected="selected" <?php endif; ?> value="notshared">Not Shared</option>
									</select>

								</td>

							</tr>
							<tr>
								<td>Amount From </td>
								<td>
										<select name="sel_amount_field_from" style="width:120px; " >
											<option value="">Amount From</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == "o.unit_price"): ?> 		selected="selected" <?php endif; ?> value="o.unit_price">Unit Price</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == "o.total_amount"): ?>		selected="selected" <?php endif; ?> value="o.total_amount">Total Amount</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == "o.paid_sitecredit"): ?> 	selected="selected" <?php endif; ?> value="o.paid_sitecredit">Site Credit Amount</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == "o.paid_cardamount"): ?> 	selected="selected" <?php endif; ?> value="o.paid_cardamount">Card Amount</option>
	
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == "d.site_comm_rate"): ?> 	selected="selected" <?php endif; ?> value="d.site_comm_rate">Admin Comm. rate(%)</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == "d.site_commision"): ?> 	selected="selected" <?php endif; ?> value="d.site_commision">Admin Commission</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == "d.vendor_comm_rate"): ?> 	selected="selected" <?php endif; ?> value="d.vendor_comm_rate">Vendor Comm. rate(%)</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == "d.vendor_commision"): ?> 	selected="selected" <?php endif; ?> value="d.vendor_commision">Vendor Commission</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == "d.sales_comm_rate"): ?> 	selected="selected" <?php endif; ?> value="d.sales_comm_rate">Sales Comm. rate(%)</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_from'] == "d.sales_commision"): ?> 	selected="selected" <?php endif; ?> value="d.sales_commision">Sales Commission</option>
										</select>
								</td>
								<td><span title="Greater than or equal to" style="font-size:16px;font-weight:bold">> =</span></td>
								<td colspan="3">
									<input type="text" name="txt_amount_field_from" id="txt_amount_field_from" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_amount_field_from']; ?>
"  class="nummberOnly"  maxlength="10" size="10" />
								</td>
								
							</tr>
							<tr>
								<td>	Amount To	</td>
								<td>
										<select name="sel_amount_field_to" style="width:120px; ">
											<option value="">Amount To</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == "o.unit_price"): ?> 		selected="selected" <?php endif; ?> value="o.unit_price">Unit Price</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == "o.total_amount"): ?>		selected="selected" <?php endif; ?> value="o.total_amount">Total Amount</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == "o.paid_sitecredit"): ?> 	selected="selected" <?php endif; ?> value="o.paid_sitecredit">Site Credit Amount</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == "o.paid_cardamount"): ?> 	selected="selected" <?php endif; ?> value="o.paid_cardamount">Card Amount</option>
	
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == "d.site_comm_rate"): ?> 	selected="selected" <?php endif; ?> value="d.site_comm_rate">Admin Comm. rate(%)</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == "d.site_commision"): ?> 	selected="selected" <?php endif; ?> value="d.site_commision">Admin Commission</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == "d.vendor_comm_rate"): ?> selected="selected" <?php endif; ?> value="d.vendor_comm_rate">Vendor Comm. rate(%)</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == "d.vendor_commision"): ?> selected="selected" <?php endif; ?> value="d.vendor_commision">Vendor Commission</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == "d.sales_comm_rate"): ?> 	selected="selected" <?php endif; ?> value="d.sales_comm_rate">Sales Comm. rate(%)</option>
											<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_amount_field_to'] == "d.sales_commision"): ?> 	selected="selected" <?php endif; ?> value="d.sales_commision">Sales Commission</option>
										</select>
								</td>
								<td><span title="Less than or equal to"  style="font-size:16px;font-weight:bold">< =</span></td>
								<td colspan="3">
									<input type="text" name="txt_amount_field_to" id="txt_amount_field_to" class="nummberOnly" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_amount_field_to']; ?>
" maxlength="10" size="10" />
								</td>
								
							</tr>
						</table>
					</div>
				</td>
			</tr>
			
			<tr>
			<td style="padding-bottom:10px;padding-top:10px;">
				<table class="listTableChangeColor" cellpadding="0" cellspacing="0" width="100%" border="0">
					<tr>
						<?php if ($this->_tpl_vars['actionReturn']['searchdata']['txt_dealId'] != "" && $this->_tpl_vars['actionReturn']['data']['0']['dealname'] != ""): ?>
							<td  style="padding:4px 0px 4px 0px"><strong>Deal</strong> : <?php echo $this->_tpl_vars['actionReturn']['data']['0']['dealname']; ?>
</td>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['searchdata']['txt_vendorId'] != "" && $this->_tpl_vars['actionReturn']['data']['0']['vendorname'] != ""): ?>
							<td  style="padding:4px 0px 4px 0px"><strong>Vendor</strong> : <?php echo $this->_tpl_vars['actionReturn']['data']['0']['vendorname']; ?>
</td>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_apps'] != "" && $this->_tpl_vars['actionReturn']['data']['0']['application'] != ""): ?>
							<td  style="padding:4px 0px 4px 0px"><strong>Application</strong> : <?php echo $this->_tpl_vars['actionReturn']['data']['0']['application']; ?>
</td>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['searchdata']['deal_cat'] != "" && $this->_tpl_vars['actionReturn']['data']['0']['category'] != ""): ?>
							<td  style="padding:4px 0px 4px 0px"><strong>Deal Category</strong> : <?php echo $this->_tpl_vars['actionReturn']['data']['0']['category']; ?>
</td>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['searchdata']['deal_sub_cat'] != "" && $this->_tpl_vars['actionReturn']['data']['0']['sub_cat'] != ""): ?>
							<td  style="padding:4px 0px 4px 0px"><strong>Deal Subcategory</strong> : <?php echo $this->_tpl_vars['actionReturn']['data']['0']['sub_cat']; ?>
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
