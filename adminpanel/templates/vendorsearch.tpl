<td>
				<!--search starts here-->
				<form action="" name="fromName" method="post" enctype="multipart/form-data">

					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
						<td> <strong> {$actionReturn.spage->startingRow} - {$actionReturn.spage->endingRow}  </strong> of <strong>{$actionReturn.spage->totcnt} </strong> </td>							

														
							<td>
							Keyword <input type="text" name="keyword" maxlength="25" id="id_keyword" value="{$actionReturn.searchdata.keyword}" />
							</td>
							<td>
							ID/Email  <input type="text" name="userId" maxlength="25" id="userId" value="{$actionReturn.searchdata.userId}" size="20"/>
							</td>
							<td>
							<input name="actionvar" type="submit" class="butsubmit" value="Search" />
							</td>
							<td>
							<input name="actionvar" type="submit" class="butsubmit" value="Reset" />
							</td>
							<td>
							<a href="{$obj->getLink('getcsv','',true)}&csv=csv" class="Second_link" title="Export to CSV">
								<img src="images/csv.png" border="0" alt="Export to CSV" width="25" height="25" />
								</a>
							</td>
							<td><a href="javascript:;" id="id_search_link">
									<img src="images/search.png" border="0" width="16" height="16" />
								</a>
								</td>
						</tr>
					</table>
					<div id="id_search_block" class="cls_search_block">
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
							<tr>
							<td>
							Joined From
							</td>
							<td>
							<input type="text" value="{$actionReturn.searchdata.txt_join_from}" name="txt_join_from" class="dateTextBox" id="txt_join_from" readonly="" />
							</td>
							<td>
							Joined To
							</td>
							<td>
							<input type="text" value="{$actionReturn.searchdata.txt_join_to}" name="txt_join_to" class="dateTextBox"  id="txt_join_to" readonly="" />
							</td>
							
							<td   rowspan="4"  style="vertical-align:top">
							&nbsp;&nbsp;&nbsp;&nbsp;<select name="sel_filter_users[]" multiple="multiple" style="width:170px;height:135px;">
								
								<optgroup label="Deals">
										<option {if in_array("running", $actionReturn.searchdata.sel_filter_users)} 	selected="selected"  {/if} value="running">Running Deals</option>
										<option {if in_array("queud", $actionReturn.searchdata.sel_filter_users)} 		selected="selected"  {/if} value="queud">Queud Deals</option>
										<option {if in_array("review", $actionReturn.searchdata.sel_filter_users)} 	selected="selected"  {/if} value="review">Under Review Deals</option>
										<option {if in_array("cooldown", $actionReturn.searchdata.sel_filter_users)} 		selected="selected"  {/if} value="cooldown">Cooldown Deals</option>
										<option {if in_array("sold", $actionReturn.searchdata.sel_filter_users)} 	selected="selected"  {/if} value="sold">Sold Deals</option>
										<option {if in_array("locked", $actionReturn.searchdata.sel_filter_users)} 		selected="selected"  {/if} value="locked">Locked Deals</option>
										<option {if in_array("unlocked", $actionReturn.searchdata.sel_filter_users)} 		selected="selected"  {/if} value="unlocked">Unlocked Deals</option>

							  </optgroup>
								</select>
							</td>
							<td   rowspan="4"  style="vertical-align:top">
							&nbsp;&nbsp;&nbsp;&nbsp;<select name="sel_filter_users2[]" multiple="multiple" style="width:170px;height:135px;">
								
							<optgroup label="Payments">
										<option {if in_array("pending", $actionReturn.searchdata.sel_filter_users2)} 	selected="selected"  {/if} value="pending">Pending payments</option>
										<option {if in_array("reciving", $actionReturn.searchdata.sel_filter_users2)} 		selected="selected"  {/if} value="reciving">Recived paymnets</option>
									</optgroup>
									<optgroup label="Updates">
										<option {if in_array("email_update", $actionReturn.searchdata.sel_filter_users2)} 	selected="selected"  {/if} value="email_update">Email_update</option>
										<option {if in_array("sms_update", $actionReturn.searchdata.sel_filter_users2)} 		selected="selected"  {/if} value="sms_update">SMS Updates</option>
									</optgroup>
								</select>
							</td>
							</tr>
							<tr>
								<td>Sales Agent
							</td>
							<td>
									{$actionReturn.searchdata.searchCombo}
								</td>
								<td>
								Status
							</td>
							<td>
								<select name="sel_status">
								<option value="0" {if $actionReturn.searchdata.sel_status==0} selected="selected" {/if} >All</option>
								<option value="1" {if $actionReturn.searchdata.sel_status==1} selected="selected" {/if} >Active</option>
								<option value="2" {if $actionReturn.searchdata.sel_status==2} selected="selected" {/if}>Inactive</option>
								</select>
						</td>
							</tr>
							<tr>
								<td>Country
							</td>
							<td width="100">
								{$actionReturn.searchdata.sel_search_country}
							</td>
							<td>State</td>
							<td id="id_search_state">{$actionReturn.searchdata.state_combo}</td>
							</tr>
							<tr>
							<td>
								Application
							</td>
							<td colspan="3">
							<select name="sel_application">
								<option value="0" {if $actionReturn.searchdata.sel_application==0} selected="selected" {/if} >All</option>
								<option value="1" {if $actionReturn.searchdata.sel_application==1} selected="selected" {/if} >Web</option>
								<option value="2" {if $actionReturn.searchdata.sel_application==2} selected="selected" {/if}>Iphone</option>
								<option value="3" {if $actionReturn.searchdata.sel_application==3} selected="selected" {/if}>Android</option>
								<option value="4" {if $actionReturn.searchdata.sel_application==4} selected="selected" {/if}>FaceBook</option>
							</select>
							</td>
							</tr>
							</table>
					
					</div>
					</form>
				</td>