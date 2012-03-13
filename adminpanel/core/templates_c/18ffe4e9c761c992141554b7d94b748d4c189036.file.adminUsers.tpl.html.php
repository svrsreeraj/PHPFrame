<?php /* Smarty version Smarty-3.0.7, created on 2012-03-13 04:56:21
         compiled from "./templates/adminUsers.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:6433828814f5e861de462a4-32193927%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '18ffe4e9c761c992141554b7d94b748d4c189036' => 
    array (
      0 => './templates/adminUsers.tpl.html',
      1 => 1318235321,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6433828814f5e861de462a4-32193927',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo smarty_function_call_core_header(array('title'=>"Admin Users"),$_smarty_tpl);?>

<?php $_smarty_tpl->tpl_vars["actionReturn"] = new Smarty_variable($_smarty_tpl->getVariable('obj')->value->actionReturn, null, null);?>

<script type="text/javascript">
$(document).ready(function(){
$("#adminusers").tooltip();
})
</script>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">
<?php if ($_smarty_tpl->getVariable('obj')->value->getPageError()){?>
<tr>
	<td class="errorMessage"><?php echo $_smarty_tpl->getVariable('obj')->value->popPageError();?>
</td>
</tr>
<?php }?>
<tr>
	<td class="pageHead"><span id="adminusers"><strong>Admin Users </strong></span></td>
</tr>
<?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="Addform")||($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform")){?>
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
				<td><?php echo $_smarty_tpl->getVariable('actionReturn')->value['combo'];?>
</td>
			</tr>
<!--			<tr>
				<td>Username</td>
				<td><input type="text"  name="username" valtype="emptyCheck-Please enter your username" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['username'];?>
" id="usernameId" class="validateText" /></td>
			</tr>
-->			<tr>
				<td>Password</td>
				<td><input type="password"  name="password" valtype="emptyCheck-Please enter your password " value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['password'];?>
" id="passwordId"  /></td>
			</tr>
			<tr>
				<td>First Name</td>
				<td><input type="text"  name="fname" valtype="emptyCheck-Please retype your password " value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['fname'];?>
" id="fnameId" class="validateText" /></td>
			</tr>
			<tr>
				<td>Last Name</td>
				<td><input type="text"  name="lname" valtype="emptyCheck-Please enter your last name" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['lname'];?>
" id="lnameId" class="validateText" /></td>
			</tr>
			
			<tr>
				<td>Email</td>
				<td><input type="text"  name="email" valtype="emptyCheck-Please enter your Email|emailCheck-please enter a valid Email " value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['email'];?>
" id="emailId" class="emailValidate" /></td>
			</tr>
			<tr>
				<td>Mobile</td>
				<td><input type="text"  name="mobile" valtype="emptyCheck-Please enter your phone number|checkNumber-please enter a valid phone number " value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['mobile'];?>
" id="mobileId" class="nummberOnly"  maxlength="10"/></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><textarea  name="address" id="address" valtype="emptyCheck-Please enter your address"   ><?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['address'];?>
</textarea> </td>
			</tr>
			
			
			<tr>
				<td>&nbsp;</td>
				<td>
				<?php if ($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform"){?>
					<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Edit")){?>
					<input type="submit" class="butsubmit"  valcheck="true" name="actionvar" value="Update" id="saveDataId" />
					<?php }?>
				<?php }else{ ?>
					<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Add")){?>
					<input type="submit" class="butsubmit" valcheck="true" name="actionvar" value="Save" id="saveDataId" />
					<?php }?>
				<?php }?>
					<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
				</td>
			</tr>
		
		</table>
			</form>
	</td>
</tr>	
<?php }?>




<tr>
	<?php if ($_smarty_tpl->getVariable('obj')->value->currentAction=="Listing"){?>
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
							<td><strong> <?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->startingRow;?>
 - <?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->endingRow;?>
  </strong> of <strong><?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->totcnt;?>
 </strong> </td>
							<td>User Types: 
								<?php echo $_smarty_tpl->getVariable('actionReturn')->value['searchdata']['searchCombo'];?>

							</td>
							<td>
							<input type="text" name="keyword" maxlength="25" id="id_keyword" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['searchdata']['keyword'];?>
" />
							</td>
							<td>
							ID  <input type="text" name="userId" maxlength="25" id="userId" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['searchdata']['userId'];?>
" size="5"/>
							</td>
							<td>
							<input name="actionvar" type="submit" class="butsubmit" value="Search" />
							</td>
							<td>
							<input name="actionvar" type="submit" class="butsubmit" value="Reset" />
							</td>
							<td>
							<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Add")){?>
								<input name="actionvar" type="submit" class="butsubmit" value="Add New" />
							<?php }?>
							</td>
						</tr>
					</table>
					</form>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("View")){?>
			<?php if ($_smarty_tpl->getVariable('actionReturn')->value['data']){?>
			<tr>
				<td align="center" valign="middle">
			<form action="" name="fromName" method="post" enctype="multipart/form-data">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">							
							<th>No</th>
							<th>
								<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=fname&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Name
								<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('fname',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
							</th>
							<th>							
								<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=email&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Email
								<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('email',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
							</th>
							<th>
							<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=mobile&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Mobile
								<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('mobile',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
							</th>
							<th>
<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=date_added&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Date
								<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('date_added',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
								</th>
						<th>Action </th>

						</tr>
					<?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('actionReturn')->value['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['i']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['i']['index']++;
?>
						<tr>
							<td><?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->startingRow+$_smarty_tpl->getVariable('smarty')->value['foreach']['i']['index'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['data']->value['fname'];?>
 <?php echo $_smarty_tpl->tpl_vars['data']->value['lname'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['data']->value['email'];?>
</td>
							<td><?php echo $_smarty_tpl->getVariable('obj')->value->getUSPhoneDisplay($_smarty_tpl->tpl_vars['data']->value['mobile']);?>
</td>
							<td><?php echo $_smarty_tpl->getVariable('obj')->value->displayTime($_smarty_tpl->tpl_vars['data']->value['date_added']);?>
</td>
							<td>
							<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Status")){?>
<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Stauschange','',true,$_smarty_tpl->getVariable('obj')->value->getConcat('id=',$_smarty_tpl->tpl_vars['data']->value['id'],'&status=',$_smarty_tpl->tpl_vars['data']->value['status']));?>
" class="Second_link">
							<?php if ($_smarty_tpl->tpl_vars['data']->value['status']==1){?> 
							<img src="images/active.gif" border="0" title="Click here to inactivate">
							 <?php }else{ ?> 							 
							 <img src="images/inactive.gif" border="0" title="Click here to activate">
							 <?php }?>
							 </a> 
							<?php }?>
							
							<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Edit")){?>
							<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('editform','',true,$_smarty_tpl->getVariable('obj')->value->getConcat('id=',$_smarty_tpl->tpl_vars['data']->value['id']));?>
" class="Second_link">
							<img src="images/edit.gif" border="0" title="Click here to edit">
							</a>
							<?php }?>
							
							<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Delete")){?>
							<a href="#" class="Second_link">
							<img src="images/delete.gif" border="0" title="Click here to delete">
							</a>
							<?php }?>
							</td>
						</tr>
					<?php }} ?>
					<tr>
						<td colspan="6"><?php echo $_smarty_tpl->getVariable('actionReturn')->value['links'];?>
</td>
					</tr>
				</table>
				</form>
				</td>
			</tr>
			<?php }?>
		<?php }?>
		
		</table>
	</td>
	<?php }?>
</tr>
</table>
</form>

<?php echo smarty_function_call_core_footer(array(),$_smarty_tpl);?>

