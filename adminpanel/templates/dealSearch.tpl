			<tr>
				<td  align="right">&nbsp;</td>
			</tr>
			<tr>
				<td>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
							<td>Keyword</td>	
							<td>
							<input type="text" name="keyword" size="10" maxlength="25" id="id_keyword" value="{$actionReturn.searchdata.keyword}" />
							</td>							
							<td>Vendor ID/email</td>	
							<td>
							<input type="text" size="10" name="txt_vendorId" maxlength="25" id="txt_vendorId" value="{$actionReturn.searchdata.txt_vendorId}" />
							</td>
							<td>
							<input name="actionvar" type="submit" class="butsubmit" value="Search" />
							
							&nbsp;
							<input name="actionvar" type="submit" class="butsubmit" value="Reset" />
							{if $obj->permissionCheck("Add")}
							&nbsp;<input name="actionvar" type="submit" class="butsubmit" value="Add New" />
							{/if}

							</td>
							<td>
								<a href="{$obj->getLink('getcsv','',true)}&csv=csv" class="Second_link" title="Export to CSV">
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
										<option {if $actionReturn.searchdata.sel_status==""} selected="selected" {/if}   value="">All</option>
										<option {if $actionReturn.searchdata.sel_status==$smarty.const.GLB_DEAL_PENDING} selected="selected" {/if}  value="{$smarty.const.GLB_DEAL_PENDING}">Under Review</option>
										<option {if $actionReturn.searchdata.sel_status==$smarty.const.GLB_DEAL_ACCEPTED} selected="selected" {/if}  value="{$smarty.const.GLB_DEAL_ACCEPTED}">Approved & in Queue</option>
										<option {if $actionReturn.searchdata.sel_status==$smarty.const.GLB_DEAL_REJECTED} selected="selected" {/if}  value="{$smarty.const.GLB_DEAL_REJECTED}">Rejected</option>
										<option {if $actionReturn.searchdata.sel_status==$smarty.const.GLB_DEAL_LOCKED} selected="selected" {/if}   value="{$smarty.const.GLB_DEAL_LOCKED}">Locked for Voting</option>
										<option {if $actionReturn.searchdata.sel_status==$smarty.const.GLB_DEAL_UNLOCKED} selected="selected" {/if}  value="{$smarty.const.GLB_DEAL_UNLOCKED}">Unlocked for Buying</option>
										<option {if $actionReturn.searchdata.sel_status==$smarty.const.GLB_DEAL_LOCKED || $actionReturn.searchdata.sel_status==$smarty.const.GLB_DEAL_UNLOCKED} selected="selected" {/if}   value="{$smarty.const.GLB_DEAL_LOCKED},{$smarty.const.GLB_DEAL_UNLOCKED}">Running</option>
										<option {if $actionReturn.searchdata.sel_status==$smarty.const.GLB_DEAL_COOLDOWN} selected="selected" {/if}  value="{$smarty.const.GLB_DEAL_COOLDOWN}">In Cool Down</option>
										<option {if $actionReturn.searchdata.sel_status==$smarty.const.GLB_DEAL_EXPIRED} selected="selected" {/if}  value="{$smarty.const.GLB_DEAL_EXPIRED}">Expired</option>
										</select>

								</td>
								<td>Application</td>
								<td>{$actionReturn.searchdata.cat_application}</td>								
								<td rowspan="7" style="vertical-align:top">
								{$actionReturn.searchdata.sel_opt_cat}
								</td>
							</tr>

							<tr>
								<td>Date From </td>
								<td>
										<select name="sel_date_field_from">
											<option value="">Date From</option>
											<option {if $actionReturn.searchdata.sel_date_field_from=="Added"}			selected="selected" {/if} value="Added">Added Date</option>
											<option {if $actionReturn.searchdata.sel_date_field_from=="Locked"} 		selected="selected" {/if} value="Locked">Locked Date</option>
											<option {if $actionReturn.searchdata.sel_date_field_from=="Unlocked"}		selected="selected" {/if} value="Unlocked">Unlocked Date</option>
											<option {if $actionReturn.searchdata.sel_date_field_from=="Cooldown"}		selected="selected" {/if} value="Cooldown">Cool Down Date</option>
											<option {if $actionReturn.searchdata.sel_date_field_from=="Expired"}		selected="selected" {/if} value="Expired">Expired Date</option>
											<option {if $actionReturn.searchdata.sel_date_field_from=="CouponExpiry"} 	selected="selected" {/if} value="CouponExpiry">Coupon Expiry Date</option>
											<option {if $actionReturn.searchdata.sel_date_field_from=="Updated"} 		selected="selected" {/if} value="Updated">Status Updated Date</option>
										</select>
								</td>
								<td><span title="Greater than or equal to" style="font-size:16px;font-weight:bold">> =</span></td>
								<td>
									<input type="text" name="txt_date_field_from" id="txt_date_field_from"  value="{$actionReturn.searchdata.txt_date_field_from}" class="dateTextBox"  readonly="" maxlength="10" size="10" />
								</td>
							</tr>
							<tr>
								<td>Date To</td>
								<td>
										<select name="sel_date_field_to">
											<option value="">Date To</option>
											<option {if $actionReturn.searchdata.sel_date_field_to=="Added"} 			selected="selected" {/if} value="Added">Added Date</option>
											<option {if $actionReturn.searchdata.sel_date_field_to=="Locked"} 			selected="selected" {/if} value="Locked">Locked Date</option>
											<option {if $actionReturn.searchdata.sel_date_field_to=="Unlocked"}			selected="selected" {/if} value="Unlocked">Unlocked Date</option>
											<option {if $actionReturn.searchdata.sel_date_field_to=="Cooldown"}			selected="selected" {/if} value="Cooldown">Cool Down Date</option>
											<option {if $actionReturn.searchdata.sel_date_field_to=="Expired"}			selected="selected" {/if} value="Expired">Expired Date</option>
											<option {if $actionReturn.searchdata.sel_date_field_to=="CouponExpiry"} 	selected="selected" {/if} value="coupon_expiry_date">Coupon Expiry Date</option>
											<option {if $actionReturn.searchdata.sel_date_field_to=="Updated"} 			selected="selected" {/if} value="Updated">Status Updated Date</option>
											</select>
								</td>
								<td><span title="Less than or equal to"  style="font-size:16px;font-weight:bold">< =</span></td>
								<td>
									<input type="text" name="txt_date_field_to" id="txt_date_field_to" value="{$actionReturn.searchdata.txt_date_field_to}" class="dateTextBox"  readonly=""  maxlength="10" size="10" />
								</td>
							</tr>
							<tr>
								<td>Value From </td>
								<td>
										<select name="sel_amount_field_from">
											<option value="">Value From</option>
											<option {if $actionReturn.searchdata.sel_amount_field_from=="Votes"} 				selected="selected" {/if} value="Votes">Votes</option>
											<option {if $actionReturn.searchdata.sel_amount_field_from=="Unlockvote"} 			selected="selected" {/if} value="Unlockvote">Unlock Vote Limit</option>
											<option {if $actionReturn.searchdata.sel_amount_field_from=="Total_Quantity"}		selected="selected" {/if} value="Total_Quantity">Total Quantity</option>
											<option {if $actionReturn.searchdata.sel_amount_field_from=="Sold_Quantity"}		selected="selected" {/if} value="Sold_Quantity">Sold Quantity</option>
											<option {if $actionReturn.searchdata.sel_amount_field_from=="Balance_Quantity"}		selected="selected" {/if} value="Balance_Quantity">Balance Quantuty</option>
											<option {if $actionReturn.searchdata.sel_amount_field_from=="Price"} 				selected="selected" {/if} value="Price">Deal Price</option>
											<option {if $actionReturn.searchdata.sel_amount_field_from=="Cost"} 				selected="selected" {/if} value="Cost">Deal Cost</option>
											<option {if $actionReturn.searchdata.sel_amount_field_from=="Offer"} 				selected="selected" {/if} value="Offer">Offer Rate(%)</option>
											<option {if $actionReturn.searchdata.sel_amount_field_from=="Vendor_Commission"} 	selected="selected" {/if} value="Vendor_Commission">Vendor Commision(%)</option>
											<option {if $actionReturn.searchdata.sel_amount_field_from=="Site_Commission"} 		selected="selected" {/if} value="Site_Commission">Site Commision(%)</option>
											<option {if $actionReturn.searchdata.sel_amount_field_from=="Agent_Commission"} 	selected="selected" {/if} value="Agent_Commission">Agent Commision(%)</option>
										</select>
								</td>
								<td><span title="Greater than or equal to" style="font-size:16px;font-weight:bold">> =</span></td>
								<td>
									<input type="text" name="txt_amount_field_from" id="txt_amount_field_from" class="nummberOnly" value="{$actionReturn.searchdata.txt_amount_field_from}" maxlength="10" size="10" />
								</td>
							</tr>
							<tr>
								<td>Value To</td>
								<td>
										<select name="sel_amount_field_to">
											<option value="">Value To</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="Votes"} 					selected="selected" {/if} value="Votes">Votes</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="Unlockvote"} 			selected="selected" {/if} value="Unlockvote">Unlock Vote Limit</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="Total_Quantity"}			selected="selected" {/if} value="Total_Quantity">Total Quantity</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="Sold_Quantity"}			selected="selected" {/if} value="Sold_Quantity">Sold Quantity</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="Balance_Quantity"}		selected="selected" {/if} value="Balance_Quantity">Balance Quantuty</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="Price"} 					selected="selected" {/if} value="Price">Deal Price</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="Cost"} 					selected="selected" {/if} value="Cost">Deal Cost</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="Offer"} 					selected="selected" {/if} value="Offer">Offer Rate(%)</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="Vendor_Commission"} 		selected="selected" {/if} value="Vendor_Commission">Vendor Commision(%)</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="Site_Commission"} 		selected="selected" {/if} value="Site_Commission">Site Commision(%)</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="Agent_Commission"} 		selected="selected" {/if} value="Agent_Commission">Agent Commision(%)</option>
										</select>
								</td>
								<td><span title="Less than or equal to"  style="font-size:16px;font-weight:bold">< =</span></td>
								<td>
									<input type="text" name="txt_amount_field_to" id="txt_amount_field_to" class="nummberOnly" value="{$actionReturn.searchdata.txt_amount_field_to}" maxlength="10" size="10" />
								</td>
								
							</tr>
							<tr>								
								<td>Deal ID</td>	
								<td>
								<input type="text" size="15" name="txt_dealId" maxlength="25" id="txt_vendorId" value="{$actionReturn.searchdata.txt_dealId}" />
								</td>
								<td>{if $actionReturn.searchdata.sales_combo}Sales Agent{/if}</td>
								<td>{if $actionReturn.searchdata.sales_combo}{$actionReturn.searchdata.sales_combo}{/if}</td>
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
						{if $actionReturn.searchdata.txt_dealId!=""	&&	$actionReturn.data.0.name!=""}
							<td  style="padding:4px 0px 4px 0px"><strong>Deal</strong> : {$actionReturn.data.0.name}</td>
						{/if}
						{if $actionReturn.searchdata.txt_vendorId!=""	&&	$actionReturn.data.0.business_name!=""}
							<td  style="padding:4px 0px 4px 0px"><strong>Vendor</strong> : {$actionReturn.data.0.business_name}</td>
						{/if}
						{if $actionReturn.searchdata.sales_agents!=""	&&	$actionReturn.data.0.s_agent_fname!=""}
							<td  style="padding:4px 0px 4px 0px"><strong>Sales Agent</strong> : {$actionReturn.data.0.s_agent_fname} {$actionReturn.data.0.s_agent_lname}</td>
						{/if}
						{if $actionReturn.searchdata.sel_date_field_from!=""  && $actionReturn.searchdata.txt_date_field_from!=""}
							<td  style="padding:4px 0px 4px 0px"><strong>{$actionReturn.searchdata.sel_date_field_from} Date From</strong> : {$actionReturn.searchdata.txt_date_field_from}</td>
						{/if}
						{if $actionReturn.searchdata.sel_date_field_to!="" && $actionReturn.searchdata.txt_date_field_to!=""}
							<td  style="padding:4px 0px 4px 0px"><strong>{$actionReturn.searchdata.sel_date_field_to} Date To</strong> : {$actionReturn.searchdata.txt_date_field_to}</td>
						{/if}
						{if $actionReturn.searchdata.sel_amount_field_from!="" && $actionReturn.searchdata.txt_amount_field_from!=""}
							<td  style="padding:4px 0px 4px 0px"><strong>{$actionReturn.searchdata.sel_amount_field_from}  From</strong> : {$actionReturn.searchdata.txt_amount_field_from}</td>
						{/if}
						{if $actionReturn.searchdata.sel_amount_field_to!="" && $actionReturn.searchdata.txt_amount_field_to!=""}
							<td  style="padding:4px 0px 4px 0px"><strong>{$actionReturn.searchdata.sel_amount_field_to} To</strong> : {$actionReturn.searchdata.txt_amount_field_to}</td>
						{/if}
					</tr>
				</table>   
			</td>
			</tr>

			<tr>
				<td>&nbsp;</td>
			</tr>
