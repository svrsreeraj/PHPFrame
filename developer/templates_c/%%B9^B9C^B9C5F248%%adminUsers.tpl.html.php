<?php /* Smarty version 2.6.19, created on 2011-02-10 11:31:16
         compiled from adminUsers.tpl.html */ ?>
<?php $this->assign('actionReturn', $this->_tpl_vars['obj']->actionReturn); ?>
<?php echo '
<script type="text/javascript">
$(document).ready(function(){
$("#adminusers").tooltip();
})
</script>
'; ?>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">
<?php if ($this->_tpl_vars['obj']->getPageError()): ?>
<tr>
	<td class="errorMessage"><?php echo $this->_tpl_vars['obj']->popPageError(); ?>
</td>
</tr>
<?php endif; ?>
<tr>
	<td class="pageHead"><span id="adminusers"><strong>Admin Users </strong></span></td>
</tr>
<?php if (( $this->_tpl_vars['obj']->currentAction == 'Addform' ) || ( $this->_tpl_vars['obj']->currentAction == 'Editform' )): ?>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
	<form action="" name="fromName" method="post" enctype="multipart/form-data">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				<th colspan="2">Manage Admin Users</th>
			</tr>
			<tr>
				<td width="200">Select User Types</td>
				<td><?php echo $this->_tpl_vars['actionReturn']['combo']; ?>
</td>
			</tr>
<!--			<tr>
				<td>Username</td>
				<td><input type="text"  name="username" valtype="emptyCheck-Please enter your username" value="<?php echo $this->_tpl_vars['actionReturn']['data']['username']; ?>
" id="usernameId" class="validateText" /></td>
			</tr>
-->			<tr>
				<td>Password</td>
				<td><input type="password"  name="password" valtype="emptyCheck-Please enter your password " value="<?php echo $this->_tpl_vars['actionReturn']['data']['password']; ?>
" id="passwordId"  /></td>
			</tr>
			<tr>
				<td>First Name</td>
				<td><input type="text"  name="fname" valtype="emptyCheck-Please retype your password " value="<?php echo $this->_tpl_vars['actionReturn']['data']['fname']; ?>
" id="fnameId" class="validateText" /></td>
			</tr>
			<tr>
				<td>Last Name</td>
				<td><input type="text"  name="lname" valtype="emptyCheck-Please enter your last name" value="<?php echo $this->_tpl_vars['actionReturn']['data']['lname']; ?>
" id="lnameId" class="validateText" /></td>
			</tr>
			
			<tr>
				<td>Email</td>
				<td><input type="text"  name="email" valtype="emptyCheck-Please enter your Email|emailCheck-please enter a valid Email " value="<?php echo $this->_tpl_vars['actionReturn']['data']['email']; ?>
" id="emailId" class="emailValidate" /></td>
			</tr>
			<tr>
				<td>Mobile</td>
				<td><input type="text"  name="mobile" valtype="emptyCheck-Please enter your phone number|checkNumber-please enter a valid phone number " value="<?php echo $this->_tpl_vars['actionReturn']['data']['mobile']; ?>
" id="mobileId" class="nummberOnly"  maxlength="10"/></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><textarea  name="address" id="address" valtype="emptyCheck-Please enter your address"   ><?php echo $this->_tpl_vars['actionReturn']['data']['address']; ?>
</textarea> </td>
			</tr>
			
			
			<tr>
				<td>&nbsp;</td>
				<td>
				<?php if ($this->_tpl_vars['obj']->currentAction == 'Editform'): ?>
					<?php if ($this->_tpl_vars['obj']->permissionCheck('Edit')): ?>
					<input type="submit" class="butsubmit"  valcheck="true" name="actionvar" value="Update" id="saveDataId" />
					<?php endif; ?>
				<?php else: ?>
					<?php if ($this->_tpl_vars['obj']->permissionCheck('Add')): ?>
					<input type="submit" class="butsubmit" valcheck="true" name="actionvar" value="Save" id="saveDataId" />
					<?php endif; ?>
				<?php endif; ?>
					<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
				</td>
			</tr>
		
		</table>
			</form>
	</td>
</tr>	
<?php endif; ?>




<tr>
	<?php if ($this->_tpl_vars['obj']->currentAction == 'Listing'): ?>
	<td>
		
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td  align="right">&nbsp;</td>
			</tr>
			
			<tr>
				<td>
			<form action="" name="fromName" method="post" enctype="multipart/form-data">
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
							<td><strong> <?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow; ?>
 - <?php echo $this->_tpl_vars['actionReturn']['spage']->endingRow; ?>
  </strong> of <strong><?php echo $this->_tpl_vars['actionReturn']['spage']->totcnt; ?>
 </strong> </td>
							<td>User Types: 
								<?php echo $this->_tpl_vars['actionReturn']['searchdata']['searchCombo']; ?>

							</td>
							<td>
							<input type="text" name="keyword" maxlength="25" id="id_keyword" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['keyword']; ?>
" />
							</td>
							<td>
							ID  <input type="text" name="userId" maxlength="25" id="userId" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['userId']; ?>
" size="5"/>
							</td>
							<td>
							<input name="actionvar" type="submit" class="butsubmit" value="Search" />
							</td>
							<td>
							<input name="actionvar" type="submit" class="butsubmit" value="Reset" />
							</td>
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Add')): ?>
								<input name="actionvar" type="submit" class="butsubmit" value="Add New" />
							<?php endif; ?>
							</td>
						</tr>
					</table>
					</form>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
			<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
			<tr>
				<td align="center" valign="middle">
			<form action="" name="fromName" method="post" enctype="multipart/form-data">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">							
							<th>No</th>
							<th>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=fname&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Name
								<?php echo $this->_tpl_vars['obj']->getSortImage('fname',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
							</th>
							<th>							
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=email&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Email
								<?php echo $this->_tpl_vars['obj']->getSortImage('email',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
							</th>
							<th>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=mobile&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Mobile
								<?php echo $this->_tpl_vars['obj']->getSortImage('mobile',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
							</th>
							<th>
<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=date_added&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Date
								<?php echo $this->_tpl_vars['obj']->getSortImage('date_added',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
								</th>
						<th>Action </th>

						</tr>
					<?php $_from = $this->_tpl_vars['actionReturn']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
						<tr>
							<td><?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow+($this->_foreach['i']['iteration']-1); ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['fname']; ?>
 <?php echo $this->_tpl_vars['data']['lname']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['email']; ?>
</td>
							<td><?php echo $this->_tpl_vars['obj']->getUSPhoneDisplay($this->_tpl_vars['data']['mobile']); ?>
</td>
							<td><?php echo $this->_tpl_vars['obj']->displayTime($this->_tpl_vars['data']['date_added']); ?>
</td>
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Status')): ?>
<a href="<?php echo $this->_tpl_vars['obj']->getLink('Stauschange','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'],'&status=',$this->_tpl_vars['data']['status'])); ?>
" class="Second_link">
							<?php if ($this->_tpl_vars['data']['status'] == 1): ?> 
							<img src="images/active.gif" border="0" title="Click here to inactivate">
							 <?php else: ?> 							 
							 <img src="images/inactive.gif" border="0" title="Click here to activate">
							 <?php endif; ?>
							 </a> 
							<?php endif; ?>
							
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Edit')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('editform','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link">
							<img src="images/edit.gif" border="0" title="Click here to edit">
							</a>
							<?php endif; ?>
							
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Delete')): ?>
							<a href="#" class="Second_link">
							<img src="images/delete.gif" border="0" title="Click here to delete">
							</a>
							<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; endif; unset($_from); ?>
					<tr>
						<td colspan="6"><?php echo $this->_tpl_vars['actionReturn']['links']; ?>
</td>
					</tr>
				</table>
				</form>
				</td>
			</tr>
			<?php endif; ?>
		<?php endif; ?>
		
		</table>
	</td>
	<?php endif; ?>
</tr>
</table>
</form>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
