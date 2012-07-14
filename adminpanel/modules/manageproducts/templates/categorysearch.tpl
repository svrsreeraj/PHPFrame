<td>
		<form action="" name="fromName" method="post" enctype="multipart/form-data">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
			<tr>
				<td> <strong>{$actionReturn.spage->startingRow} - {$actionReturn.spage->endingRow}  </strong> of <strong>{$actionReturn.spage->totcnt} </strong> </td>							
				<td>
				Keyword </td><td><input type="text"  size="14" name="keyword" maxlength="25" id="id_keyword" value="{$actionReturn.searchdata.keyword}" />
				</td>
				<td>
				Category</td><td>{$actionReturn.cat_combo}
				</td>
				<td>
				<input name="actionvar" type="submit" class="butsubmit" value="Search" />
				</td>
				<td>
				<input name="actionvar" type="submit" class="butsubmit" value="Reset" />
				</td>
				<td>
				<input name="actionvar" type="submit" class="butsubmit" value="Add New" />
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
						<td>Quick Links
						<input type="checkbox" name="quick_links" value="1" {if $actionReturn.data.quick_links ==1} checked="checked"{/if} /> <br />
						</td>
					</tr>           		
				</table>
			</div>
			</form>
		</td>
	</tr>
		