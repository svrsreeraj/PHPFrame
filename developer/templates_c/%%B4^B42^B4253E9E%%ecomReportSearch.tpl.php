<?php /* Smarty version 2.6.19, created on 2011-01-17 02:47:32
         compiled from ecomReportSearch.tpl */ ?>
			<tr>
				<td  align="right">&nbsp;</td>
			</tr>
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
								<td>Ship Country</td>
								<td><?php echo $this->_tpl_vars['actionReturn']['searchdata']['ship_country']; ?>
</td>
								<td>Ship State</td>
								<td id="id_search_ship_state"><?php echo $this->_tpl_vars['actionReturn']['searchdata']['ship_state']; ?>
</td>
									<td>Pay status</td>
								<td>
									<select name="sel_pay_status">
										<option value="">All</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_pay_status'] == @GLB_DEAL_PAID): ?> selected="selected" <?php endif; ?>  value="<?php echo @GLB_DEAL_PAID; ?>
">Paid</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_pay_status'] == @GLB_DEAL_NOT_PAID): ?> selected="selected" <?php endif; ?>  value="<?php echo @GLB_DEAL_NOT_PAID; ?>
">Not Paid</option>
									</select>

								</td>
							</tr>							
							<tr>
								<td>Product Category</td>
								<td><?php echo $this->_tpl_vars['actionReturn']['searchdata']['prod_cat']; ?>
</td>
								<td>Products</td>
								<td id="id_search_products"><?php echo $this->_tpl_vars['actionReturn']['searchdata']['product']; ?>
</td>
								<td>Application</td>
								<td>
									<?php echo $this->_tpl_vars['actionReturn']['searchdata']['cat_application']; ?>

								</td>						
							</tr>
							<tr>
								<td>Order From</td>
								<td><input type="text" name="txt_order_from"  id="txt_order_from"  class="dateTextBox" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_order_from']; ?>
" readonly="" /></td>
								
								<td>Order To</td>
								<td><input type="text" name="txt_order_to"  id="txt_order_to" class="dateTextBox" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_order_to']; ?>
" readonly=""/></td>
								<td>Delivered Status</td>
								<td>
									<select name="sel_deliver_option" style="width:80px;">
										<option value="">All</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_deliver_option'] == @GLB_DEAL_PAID): ?> selected="selected" <?php endif; ?> value="<?php echo @GLB_DEAL_PAID; ?>
">Delivered</option>
										<option <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_deliver_option'] == @GLB_DEAL_NOT_PAID): ?> selected="selected" <?php endif; ?> value="<?php echo @GLB_DEAL_NOT_PAID; ?>
">Not Delivered</option>
									</select>
								</td>
							</tr>
						
							<tr>
								<td>Points From</td>
								<td><span title="Greater than or equal to" style="font-size:16px;font-weight:bold">> = </span><input type="text" name="txt_amount_field_from" id="txt_amount_field_from" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_amount_field_from']; ?>
"  class="nummberOnly"  maxlength="10" size="10" /></td>
								<td>Points To</td>
								<td><span title="Less than or equal to"  style="font-size:16px;font-weight:bold">< = </span><input type="text" name="txt_amount_field_to" id="txt_amount_field_to" class="nummberOnly" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_amount_field_to']; ?>
" maxlength="10" size="10" /></td>
								<td colspan="2"></td>
							</tr>
						
						</table>
					</div>
				</td>
			</tr>
			
			<tr>
			<td style="padding-bottom:10px;padding-top:10px;">
				<table class="listTableChangeColor" cellpadding="0" cellspacing="0" width="100%" border="0">
					<tr>
						<?php if ($this->_tpl_vars['actionReturn']['searchdata']['txt_customerId'] != "" && $this->_tpl_vars['actionReturn']['data']['0']['fullname'] != ""): ?>
							<td  style="padding:4px 0px 4px 0px"><strong>Customer Name</strong> :<?php echo $this->_tpl_vars['actionReturn']['data']['0']['fullname']; ?>
</td>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_ship_country'] != "" && $this->_tpl_vars['actionReturn']['data']): ?>
							<td  style="padding:4px 0px 4px 0px"><strong>Ship Country</strong> : <?php echo $this->_tpl_vars['obj']->Getsearchname('country',$this->_tpl_vars['actionReturn']['searchdata']['sel_ship_country']); ?>
</td>
						<?php endif; ?>
												<?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_prod_cat'] != "" && $this->_tpl_vars['actionReturn']['data']): ?>
							<td  style="padding:4px 0px 4px 0px"><strong>Product Category</strong> : <?php echo $this->_tpl_vars['obj']->Getsearchname('productcat',$this->_tpl_vars['actionReturn']['searchdata']['sel_prod_cat']); ?>
</td>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_product'] != "" && $this->_tpl_vars['actionReturn']['data']): ?>
							<td  style="padding:4px 0px 4px 0px"><strong>Product</strong> : <?php echo $this->_tpl_vars['obj']->Getsearchname('product',$this->_tpl_vars['actionReturn']['searchdata']['sel_product']); ?>
</td>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['searchdata']['txt_order_from'] != "" && $this->_tpl_vars['actionReturn']['data']): ?>
							<td  style="padding:4px 0px 4px 0px"><strong>Date From</strong> : <?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_order_from']; ?>
</td>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['searchdata']['txt_order_to'] != "" && $this->_tpl_vars['actionReturn']['data']): ?>
							<td  style="padding:4px 0px 4px 0px"><strong>Date To</strong> : <?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_order_to']; ?>
</td>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_apps'] != "" && $this->_tpl_vars['actionReturn']['data']): ?>
							<td  style="padding:4px 0px 4px 0px"><strong>Application</strong> : <?php echo $this->_tpl_vars['obj']->Getsearchname('apps',$this->_tpl_vars['actionReturn']['searchdata']['sel_apps']); ?>
</td>
						<?php endif; ?>
					</tr>
				</table>   
			</td>
			</tr>
