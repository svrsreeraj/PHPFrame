			<tr>
				<td  align="right">&nbsp;</td>
			</tr>
			<tr>
				<td>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
							<td>Keyword</td>	
							<td>
							<input type="text" name="keyword" maxlength="25" id="id_keyword" value="{$actionReturn.searchdata.keyword}" />
							</td>
							<td>Cust. ID/email</td>	
							<td>
							<input type="text" size="20" name="txt_customerId" maxlength="25" id="txt_customerId" value="{$actionReturn.searchdata.txt_customerId}" />
							</td>
							<td>
							<input name="actionvar" type="submit" class="butsubmit" value="Search" />
							
							&nbsp;
							<input name="actionvar" type="submit" class="butsubmit" value="Reset" />
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
										<option {if $actionReturn.searchdata.sel_status==""} selected="selected" {/if} value="">All</option>
										<option {if $actionReturn.searchdata.sel_status=="1"} selected="selected" {/if}  value="1">Active</option>
										<option {if $actionReturn.searchdata.sel_status=="0"} selected="selected" {/if} value="0">Inactive</option>
									</select>

								</td>
								<td>Application</td>
								<td>{$actionReturn.searchdata.cat_application}</td>
								<td rowspan="6" style="vertical-align:top">
								<select name="sel_filter_users[]" multiple="multiple" style="width:170px;height:150px;">
									<optgroup label="Filter users">
										<option {if in_array("productive", $actionReturn.searchdata.sel_filter_users)} 	selected="selected"  {/if} value="productive">Productive</option>
										<option {if in_array("ecom", $actionReturn.searchdata.sel_filter_users)} 		selected="selected"  {/if} value="ecom">E-commerce</option>
										<option {if in_array("facebook", $actionReturn.searchdata.sel_filter_users)} 	selected="selected"  {/if} value="facebook">Face Book</option>
									</optgroup>
									<optgroup label="Users have">
										<option {if in_array("votes", $actionReturn.searchdata.sel_filter_users)}		selected="selected"  {/if} value="votes">Votes</option>
										<option {if in_array("sitepoints", $actionReturn.searchdata.sel_filter_users)} 	selected="selected"  {/if} value="sitepoints">Site points</option>
<!--										<option {if in_array("sitecredit", $actionReturn.searchdata.sel_filter_users)} 	selected="selected"  {/if} value="sitecredit">Site credits</option>
-->										<option {if in_array("referrals", $actionReturn.searchdata.sel_filter_users)}	selected="selected"  {/if} value="referrals">Referrals</option>
									</optgroup>
								</select>
								</td>
								<td rowspan="6" style="vertical-align:top">
								{$actionReturn.searchdata.sel_opt_cat}
								</td>


								
							</tr>							
							<tr>
								<td>Country</td>
								<td>{$actionReturn.searchdata.country_combo}</td>
								<td>State</td>
								<td id="id_search_state">{$actionReturn.searchdata.state_combo}</td>
						
							</tr>
							<tr>
								<td>Joined From</td>
								<td><input type="text" name="txt_join_from"  id="txt_join_from"  class="dateTextBox" value="{$actionReturn.searchdata.txt_join_from}" readonly="" /></td>
								<td>Joined To</td>
								<td><input type="text" name="txt_join_to"  id="txt_join_to" class="dateTextBox" value="{$actionReturn.searchdata.txt_join_to}" readonly=""/></td>
								
							</tr>
							<tr>
								<td>	Value From 	</td>
								<td>
										<select name="sel_amount_field_from">
											<option value="">Value From</option>
											<option {if $actionReturn.searchdata.sel_amount_field_from=="votes"} 			selected="selected" {/if} value="votes">Votes</option>
											<option {if $actionReturn.searchdata.sel_amount_field_from=="points"}			selected="selected" {/if} value="points">Total Ponits</option>
<!--											<option {if $actionReturn.searchdata.sel_amount_field_from=="sitecredits"}		selected="selected" {/if} value="sitecredits">Site Credits</option>
-->											<option {if $actionReturn.searchdata.sel_amount_field_from=="referrals"}		selected="selected" {/if} value="referrals">Referrals</option>
											<option {if $actionReturn.searchdata.sel_amount_field_from=="deals"} 			selected="selected" {/if} value="deals">Deal Purchsed</option>
											<option {if $actionReturn.searchdata.sel_amount_field_from=="ecom"} 			selected="selected" {/if} value="ecom">E-com Purchsed</option>
										</select>
								</td>
								<td><span title="Greater than or equal to" style="font-size:16px;font-weight:bold">> =</span></td>
								<td>
									<input type="text" name="txt_amount_field_from" id="txt_amount_field_from" class="nummberOnly" value="{$actionReturn.searchdata.txt_amount_field_from}" maxlength="10" size="10" />
								</td>
							</tr>
							<tr>
								<td>	Value To	</td>
								<td>
										<select name="sel_amount_field_to">
											<option value="">Value To</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="votes"} 			selected="selected" {/if} value="votes">Votes</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="points"}			selected="selected" {/if} value="points">Total Ponits</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="sitecredits"}	selected="selected" {/if} value="sitecredits">Site Credits</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="referrals"}		selected="selected" {/if} value="referrals">Referrals</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="deals"} 			selected="selected" {/if} value="deals">Deal Purchsed</option>
											<option {if $actionReturn.searchdata.sel_amount_field_to=="ecom"} 			selected="selected" {/if} value="ecom">E-com Purchsed</option>
										</select>
								</td>
								<td><span title="Less than or equal to"  style="font-size:16px;font-weight:bold">< =</span></td>
								<td>
									<input type="text" name="txt_amount_field_to" id="txt_amount_field_to" class="nummberOnly" value="{$actionReturn.searchdata.txt_amount_field_to}" maxlength="10" size="10" />
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
						{if $actionReturn.searchdata.txt_dealId!=""	&&	$actionReturn.data.0.dealname!=""}
							<td  style="padding:4px 0px 4px 0px"><strong>Deal</strong> : {$actionReturn.data.0.dealname}</td>
						{/if}
						{if $actionReturn.searchdata.txt_vendorId!=""	&&	$actionReturn.data.0.vendorname!=""}
							<td  style="padding:4px 0px 4px 0px"><strong>Vendor</strong> : {$actionReturn.data.0.vendorname}</td>
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

			<tr>
				<td>&nbsp;</td>
			</tr>
