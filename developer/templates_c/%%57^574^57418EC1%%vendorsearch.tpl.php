<?php /* Smarty version 2.6.19, created on 2010-12-30 14:20:50
         compiled from vendorsearch.tpl */ ?>
<td>
				<!--search starts here-->
				<form action="" name="fromName" method="post" enctype="multipart/form-data">

					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
						<td> <strong> <?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow; ?>
 - <?php echo $this->_tpl_vars['actionReturn']['spage']->endingRow; ?>
  </strong> of <strong><?php echo $this->_tpl_vars['actionReturn']['spage']->totcnt; ?>
 </strong> </td>							

														
							<td>
							Keyword <input type="text" name="keyword" maxlength="25" id="id_keyword" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['keyword']; ?>
" />
							</td>
							<td>
							ID/Email  <input type="text" name="userId" maxlength="25" id="userId" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['userId']; ?>
" size="20"/>
							</td>
							<td>
							<input name="actionvar" type="submit" class="butsubmit" value="Search" />
							</td>
							<td>
							<input name="actionvar" type="submit" class="butsubmit" value="Reset" />
							</td>
							<td>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('getcsv','',true); ?>
&csv=csv" class="Second_link" title="Export to CSV">
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
							<input type="text" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_join_from']; ?>
" name="txt_join_from" class="dateTextBox" id="txt_join_from" readonly="" />
							</td>
							<td>
							Joined To
							</td>
							<td>
							<input type="text" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_join_to']; ?>
" name="txt_join_to" class="dateTextBox"  id="txt_join_to" readonly="" />
							</td>
							
							<td   rowspan="4"  style="vertical-align:top">
							&nbsp;&nbsp;&nbsp;&nbsp;<select name="sel_filter_users[]" multiple="multiple" style="width:170px;height:135px;">
								
								<optgroup label="Deals">
										<option <?php if (in_array ( 'running' , $this->_tpl_vars['actionReturn']['searchdata']['sel_filter_users'] )): ?> 	selected="selected"  <?php endif; ?> value="running">Running Deals</option>
										<option <?php if (in_array ( 'queud' , $this->_tpl_vars['actionReturn']['searchdata']['sel_filter_users'] )): ?> 		selected="selected"  <?php endif; ?> value="queud">Queud Deals</option>
										<option <?php if (in_array ( 'review' , $this->_tpl_vars['actionReturn']['searchdata']['sel_filter_users'] )): ?> 	selected="selected"  <?php endif; ?> value="review">Under Review Deals</option>
										<option <?php if (in_array ( 'cooldown' , $this->_tpl_vars['actionReturn']['searchdata']['sel_filter_users'] )): ?> 		selected="selected"  <?php endif; ?> value="cooldown">Cooldown Deals</option>
										<option <?php if (in_array ( 'sold' , $this->_tpl_vars['actionReturn']['searchdata']['sel_filter_users'] )): ?> 	selected="selected"  <?php endif; ?> value="sold">Sold Deals</option>
										<option <?php if (in_array ( 'locked' , $this->_tpl_vars['actionReturn']['searchdata']['sel_filter_users'] )): ?> 		selected="selected"  <?php endif; ?> value="locked">Locked Deals</option>
										<option <?php if (in_array ( 'unlocked' , $this->_tpl_vars['actionReturn']['searchdata']['sel_filter_users'] )): ?> 		selected="selected"  <?php endif; ?> value="unlocked">Unlocked Deals</option>

							  </optgroup>
								</select>
							</td>
							<td   rowspan="4"  style="vertical-align:top">
							&nbsp;&nbsp;&nbsp;&nbsp;<select name="sel_filter_users2[]" multiple="multiple" style="width:170px;height:135px;">
								
							<optgroup label="Payments">
										<option <?php if (in_array ( 'pending' , $this->_tpl_vars['actionReturn']['searchdata']['sel_filter_users2'] )): ?> 	selected="selected"  <?php endif; ?> value="pending">Pending payments</option>
										<option <?php if (in_array ( 'reciving' , $this->_tpl_vars['actionReturn']['searchdata']['sel_filter_users2'] )): ?> 		selected="selected"  <?php endif; ?> value="reciving">Recived paymnets</option>
									</optgroup>
									<optgroup label="Updates">
										<option <?php if (in_array ( 'email_update' , $this->_tpl_vars['actionReturn']['searchdata']['sel_filter_users2'] )): ?> 	selected="selected"  <?php endif; ?> value="email_update">Email_update</option>
										<option <?php if (in_array ( 'sms_update' , $this->_tpl_vars['actionReturn']['searchdata']['sel_filter_users2'] )): ?> 		selected="selected"  <?php endif; ?> value="sms_update">SMS Updates</option>
									</optgroup>
								</select>
							</td>
							</tr>
							<tr>
								<td>Sales Agent
							</td>
							<td>
									<?php echo $this->_tpl_vars['actionReturn']['searchdata']['searchCombo']; ?>

								</td>
								<td>
								Status
							</td>
							<td>
								<select name="sel_status">
								<option value="0" <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_status'] == 0): ?> selected="selected" <?php endif; ?> >All</option>
								<option value="1" <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_status'] == 1): ?> selected="selected" <?php endif; ?> >Active</option>
								<option value="2" <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_status'] == 2): ?> selected="selected" <?php endif; ?>>Inactive</option>
								</select>
						</td>
							</tr>
							<tr>
								<td>Country
							</td>
							<td width="100">
								<?php echo $this->_tpl_vars['actionReturn']['searchdata']['sel_search_country']; ?>

							</td>
							<td>State</td>
							<td id="id_search_state"><?php echo $this->_tpl_vars['actionReturn']['searchdata']['state_combo']; ?>
</td>
							</tr>
							<tr>
							<td>
								Application
							</td>
							<td colspan="3">
							<select name="sel_application">
								<option value="0" <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_application'] == 0): ?> selected="selected" <?php endif; ?> >All</option>
								<option value="1" <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_application'] == 1): ?> selected="selected" <?php endif; ?> >Web</option>
								<option value="2" <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_application'] == 2): ?> selected="selected" <?php endif; ?>>Iphone</option>
								<option value="3" <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_application'] == 3): ?> selected="selected" <?php endif; ?>>Android</option>
								<option value="4" <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_application'] == 4): ?> selected="selected" <?php endif; ?>>FaceBook</option>
							</select>
							</td>
							</tr>
							</table>
					
					</div>
					</form>
				</td>