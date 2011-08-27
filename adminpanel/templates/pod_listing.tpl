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
								<td style="width:100px; float:left;">Country</td>
								<td name="sel_country">{$actionReturn.country}</td>
								<td>State</td>
								<td id="id_search_state" name= "sel_state" style="width:100px; float:left;" >{$actionReturn.state}</td>
						
							</tr>
							<tr>
								<td>Joined From</td>
								<td><input type="text" name="txt_join_from"  id="txt_join_from"  class="dateTextBox" value="{$actionReturn.searchdata.txt_join_from}" readonly="" /></td>
								<td>Joined To</td>
								<td><input type="text" name="txt_join_to"  id="txt_join_to" class="dateTextBox" value="{$actionReturn.searchdata.txt_join_to}" readonly=""/></td>
								
							</tr>
							<tr>
								<td>Payment From </td>
								<td><input type="text" name="payment_from" id="payment_from"    class="dateTextBox" value="{}" /></td>
								<td>Payment To</td>
								<td><input type="text" name="payment_to"  id="payment_to" class="dateTextBox" value="{}" /></td>
								
							</tr>
							
						</table>
					</div>
				</td>
			</tr>
			
			<tr>
				<td>&nbsp;</td>
			</tr>
	

			<tr>
				<td>&nbsp;</td>
			</tr>
