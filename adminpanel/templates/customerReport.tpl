
		<tr>
			<td>
			
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
								<td>Order From</td>	
								<td>
									<input type="text" name="txt_order_from"  id="txt_order_from"  class="dateTextBox" value="{$actionReturn.searchdata.txt_order_from}" readonly="" />
								</td>
								<td>Order to</td>	
								<td>
									<input type="text" name="txt_order_to"  id="txt_order_to" class="dateTextBox" value="{$actionReturn.searchdata.txt_order_to}" readonly=""/>
								</td>
								<td>
									<input name="runningAction" type="hidden" value="{$obj->currentAction}" />
									<input name="actionvar" type="submit" class="butsubmit" value="Search" />
									&nbsp;
									<input name="actionvar" type="submit" class="butsubmit" value="Reset" />
								</td>
								<td>
									<a href="{$obj->getLink('getcsv','',true)}&runningAction={$obj->currentAction}" class="Second_link" title="Export to CSV">
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
									{$actionReturn.searchdata.ship_country}
								</td >	
								<td rowspan="3" style="vertical-align:top">
										<select name="sel_filter_users[]" multiple="multiple" style="width:170px;height:75px;">
											<optgroup label="Filter users">
												<option {if in_array("productive", $actionReturn.searchdata.sel_filter_users)} 	selected="selected"  {/if} value="productive">Productive</option>
												<option {if in_array("ecom", $actionReturn.searchdata.sel_filter_users)} 		selected="selected"  {/if} value="ecom">E-commerce</option>
												<option {if in_array("facebook", $actionReturn.searchdata.sel_filter_users)} 	selected="selected"  {/if} value="facebook">Face Book</option>
											</optgroup>
										</select>
								</td>		
							</tr>	
								
							<tr>
								<td>
									Ship State
								</td>
								<td id="id_search_ship_state">
										{$actionReturn.searchdata.ship_state}
								</td>
							</tr>						
							<tr>
								<td>
									Application
								</td>
								<td>
									{$actionReturn.searchdata.cat_application}
								</td>
							</tr>
					</table>  
				</div>					
				</td>
		 </tr>


