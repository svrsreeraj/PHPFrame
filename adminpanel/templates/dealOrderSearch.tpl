
			<tr>
				<td>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
							<td>O.ID</td>	
							<td>
							<input type="text" size="6" name="txt_orderId" maxlength="25" id="txt_orderId" value="{$actionReturn.searchdata.txt_orderId}" />
							</td>
							<td>Cust. ID/email</td>	
							<td>
							<input type="text" size="14" name="txt_customerId" maxlength="30" id="txt_customerId" value="{$actionReturn.searchdata.txt_customerId}" />
							</td>
							<td>Vend. ID/email</td>	
							<td>
							<input type="text" size="14" name="txt_vendorId" maxlength="30" id="txt_vendorId" value="{$actionReturn.searchdata.txt_vendorId}" />
							</td>
							<td>
							<input name="runningAction" type="hidden" value="{$obj->currentAction}" />
							<input name="actionvar" type="submit" class="butsubmit" value="Search" />
							&nbsp;
							<input name="actionvar" type="submit" class="butsubmit" value="Reset" />
							</td>
							<td>
								<a href="{$obj->getLink('csv','',true)}&runningAction={$obj->currentAction}" class="Second_link" title="Export to CSV">
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
										<option {if $actionReturn.searchdata.sel_pay_status=="-1"} selected="selected" {/if} value="-1">All</option>
										<option {if $actionReturn.searchdata.sel_pay_status==$smarty.const.GLB_DEAL_PAID} selected="selected" {/if} {if $actionReturn.searchdata.sel_pay_status==""} selected="selected" {/if}value="{$smarty.const.GLB_DEAL_PAID}">Paid</option>
										<option {if $actionReturn.searchdata.sel_pay_status==$smarty.const.GLB_DEAL_NOT_PAID} selected="selected" {/if}  value="{$smarty.const.GLB_DEAL_NOT_PAID}">Not Paid</option>
									</select>
								</td>
								<td>Redeemed Status</td>
								<td>
									<select name="sel_redeem_option">
										<option value="">All</option>
										<option {if $actionReturn.searchdata.sel_redeem_option==$smarty.const.GLB_COUPON_REDEEMED} selected="selected" {/if} value="{$smarty.const.GLB_COUPON_REDEEMED}">Redeemed</option>
										<option {if $actionReturn.searchdata.sel_redeem_option==$smarty.const.GLB_COUPON_NOT_REDEEMED} selected="selected" {/if} value="{$smarty.const.GLB_COUPON_NOT_REDEEMED}">Not Redeemed</option>
									</select>
								</td>
								<td>Coupon status</td>
								<td>
									<select name="sel_coupon_status">
										<option value="">All</option>
										<option {if $actionReturn.searchdata.sel_coupon_status==$smarty.const.GLB_COUPON_INACTIVE} selected="selected" {/if} value="{$smarty.const.GLB_COUPON_INACTIVE}">Pending</option>
										<option {if $actionReturn.searchdata.sel_coupon_status==$smarty.const.GLB_COUPON_ACTIVE} selected="selected" {/if} value="{$smarty.const.GLB_COUPON_ACTIVE}">Active</option>
										<option {if $actionReturn.searchdata.sel_coupon_status==$smarty.const.GLB_COUPON_EXPIRED} selected="selected" {/if} value="{$smarty.const.GLB_COUPON_EXPIRED}">Expired</option>
									</select>

								</td>
													
							</tr>							
							<tr>
								<td>Deal Category</td>
								<td>{$actionReturn.searchdata.cat_combo}</td>
								<td>Sub Category</td>
								<td id="id_search_subcat">{$actionReturn.searchdata.subcat_combo}</td>
								<td>Sales Agent</td>
								<td>{$actionReturn.searchdata.sales_combo}</td>
						
							</tr>
							<tr>
								<td>Order From</td>
								<td><input type="text" name="txt_order_from"  id="txt_order_from"  class="dateTextBox" value="{$actionReturn.searchdata.txt_order_from}" readonly="" /></td>
								<td>Order To</td>
								<td><input type="text" name="txt_order_to"  id="txt_order_to" class="dateTextBox" value="{$actionReturn.searchdata.txt_order_to}" readonly=""/></td>
								<td>Deal ID</td>
								<td><input type="text" name="txt_dealId"  id="txt_dealId" value="{$actionReturn.searchdata.txt_dealId}" size="8"/></td>
								
							</tr>
							<tr>
								<td>Pay Option</td>
								<td>
									<select name="sel_pay_option" style="width:100px;">
										<option value="">All</option>
										<option {if $actionReturn.searchdata.sel_pay_option==$smarty.const.GLB_DEAL_PAY_SCREDIT} selected="selected" {/if} value="{$smarty.const.GLB_DEAL_PAY_SCREDIT}">Site credit Only</option>
										<option {if $actionReturn.searchdata.sel_pay_option==$smarty.const.GLB_DEAL_PAY_GATEWAY} selected="selected" {/if} value="{$smarty.const.GLB_DEAL_PAY_GATEWAY}">Payment Gateway Only</option>
										<option {if $actionReturn.searchdata.sel_pay_option==$smarty.const.GLB_DEAL_PAY_BOTH} selected="selected" {/if} value="{$smarty.const.GLB_DEAL_PAY_BOTH}">Both</option>
									</select>
								</td>
								<td>Application</td>
								<td>
									{$actionReturn.searchdata.cat_application}
								</td>
								<td>Coupon Shared</td>
								<td>
									<select name="sel_coupon_shared">
										<option value="">All</option>
										<option {if $actionReturn.searchdata.sel_coupon_shared=="shared"} selected="selected" {/if} value="shared">Shared</option>
										<option {if $actionReturn.searchdata.sel_coupon_shared=="notshared"} selected="selected" {/if} value="notshared">Not Shared</option>
									</select>

								</td>

							</tr>
							<tr>
								<td>Amount From </td>
								<td>
										<select name="sel_amount_field_from" style="width:120px; " >
											<option value="">Amount From</option>
											<option {if $actionReturn.searchdata.sel_amount_field_from=="o.unit_price"} 		selected="selected" {/if} value="o.unit_price">Unit Price</option>
											<option {if $actionReturn.searchdata.sel_amount_field_from=="o.total_amount"}		selected="selected" {/if} value="o.total_amount">Total Amount</option>
											<option {if $actionReturn.searchdata.sel_amount_field_from=="o.paid_sitecredit"} 	selected="selected" {/if} value="o.paid_sitecredit">Site Credit Amount</option>
											<option {if $actionReturn.searchdata.sel_amount_field_from=="o.paid_cardamount"} 	selected="selected" {/if} value="o.paid_cardamount">Card Amount</option>
	
											<option {if $actionReturn.searchdata.sel_amount_field_from=="d.site_comm_rate"} 	selected="selected" {/if} value="d.site_comm_rate">Admin Comm. rate(%)</option>
											<option {if $actionReturn.searchdata.sel_amount_field_from=="d.site_commision"} 	selected="selected" {/if} value="d.site_commision">Admin Commission</option>
											<option {if $actionReturn.searchdata.sel_amount_field_from=="d.vendor_comm_rate"} 	selected="selected" {/if} value="d.vendor_comm_rate">Vendor Comm. rate(%)</option>
											<option {if $actionReturn.searchdata.sel_amount_field_from=="d.vendor_commision"} 	selected="selected" {/if} value="d.vendor_commision">Vendor Commission</option>
											<option {if $actionReturn.searchdata.sel_amount_field_from=="d.sales_comm_rate"} 	selected="selected" {/if} value="d.sales_comm_rate">Sales Comm. rate(%)</option>
											<option {if $actionReturn.searchdata.sel_amount_field_from=="d.sales_commision"} 	selected="selected" {/if} value="d.sales_commision">Sales Commission</option>
										</select>
								</td>
								<td><span title="Greater than or equal to" style="font-size:16px;font-weight:bold">> =</span></td>
								<td colspan="3">
									<input type="text" name="txt_amount_field_from" id="txt_amount_field_from" value="{$actionReturn.searchdata.txt_amount_field_from}"  class="nummberOnly"  maxlength="10" size="10" />
								</td>
								
							</tr>
							<tr>
								<td>	Amount To	</td>
								<td>
										<select name="sel_amount_field_to" style="width:120px; ">
											<option value="">Amount To</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="o.unit_price"} 		selected="selected" {/if} value="o.unit_price">Unit Price</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="o.total_amount"}		selected="selected" {/if} value="o.total_amount">Total Amount</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="o.paid_sitecredit"} 	selected="selected" {/if} value="o.paid_sitecredit">Site Credit Amount</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="o.paid_cardamount"} 	selected="selected" {/if} value="o.paid_cardamount">Card Amount</option>
	
											<option {if $actionReturn.searchdata.sel_amount_field_to=="d.site_comm_rate"} 	selected="selected" {/if} value="d.site_comm_rate">Admin Comm. rate(%)</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="d.site_commision"} 	selected="selected" {/if} value="d.site_commision">Admin Commission</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="d.vendor_comm_rate"} selected="selected" {/if} value="d.vendor_comm_rate">Vendor Comm. rate(%)</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="d.vendor_commision"} selected="selected" {/if} value="d.vendor_commision">Vendor Commission</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="d.sales_comm_rate"} 	selected="selected" {/if} value="d.sales_comm_rate">Sales Comm. rate(%)</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="d.sales_commision"} 	selected="selected" {/if} value="d.sales_commision">Sales Commission</option>
										</select>
								</td>
								<td><span title="Less than or equal to"  style="font-size:16px;font-weight:bold">< =</span></td>
								<td colspan="3">
									<input type="text" name="txt_amount_field_to" id="txt_amount_field_to" class="nummberOnly" value="{$actionReturn.searchdata.txt_amount_field_to}" maxlength="10" size="10" />
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
						{if $actionReturn.searchdata.txt_dealId!=""	&&	$actionReturn.data.0.dealname!=""}
							<td  style="padding:4px 0px 4px 0px"><strong>Deal</strong> : {$actionReturn.data.0.dealname}</td>
						{/if}
						{if $actionReturn.searchdata.txt_vendorId!=""	&&	$actionReturn.data.0.vendorname!=""}
							<td  style="padding:4px 0px 4px 0px"><strong>Vendor</strong> : {$actionReturn.data.0.vendorname}</td>
						{/if}
						{if $actionReturn.searchdata.sel_apps!=""	&&	$actionReturn.data.0.application!=""}
							<td  style="padding:4px 0px 4px 0px"><strong>Application</strong> : {$actionReturn.data.0.application}</td>
						{/if}
						{if $actionReturn.searchdata.deal_cat!=""	&&	$actionReturn.data.0.category!=""}
							<td  style="padding:4px 0px 4px 0px"><strong>Deal Category</strong> : {$actionReturn.data.0.category}</td>
						{/if}
						{if $actionReturn.searchdata.deal_sub_cat!=""	&&	$actionReturn.data.0.sub_cat!=""}
							<td  style="padding:4px 0px 4px 0px"><strong>Deal Subcategory</strong> : {$actionReturn.data.0.sub_cat}</td>
						{/if}
						{if $actionReturn.searchdata.txt_customerId!=""	&&	$actionReturn.data.0.customerfname!=""}
							<td  style="padding:4px 0px 4px 0px"><strong>Customer</strong> : {$actionReturn.data.0.customerfname} {$actionReturn.data.0.customerlname}</td>
						{/if}
						{if $actionReturn.searchdata.sales_agents!=""	&&	$actionReturn.data.0.s_agent_fname!=""}
							<td  style="padding:4px 0px 4px 0px"><strong>Sales Agent</strong> : {$actionReturn.data.0.s_agent_fname} {$actionReturn.data.0.s_agent_lname}</td>
						{/if}
						{if $actionReturn.searchdata.txt_order_from!=""}
							<td  style="padding:4px 0px 4px 0px"><strong>Date From</strong> : {$actionReturn.searchdata.txt_order_from}</td>
						{/if}
						{if $actionReturn.searchdata.txt_order_to!=""}
							<td  style="padding:4px 0px 4px 0px"><strong>Date To</strong> : {$actionReturn.searchdata.txt_order_to}</td>
						{/if}
					</tr>
				</table>   
			</td>
			</tr>

