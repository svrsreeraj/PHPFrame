<?php /* Smarty version Smarty-3.0.7, created on 2012-04-07 10:35:59
         compiled from "./templates/users.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:17494716864f7fcb3705b4c9-33607531%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '81a7903264c9f41391ca3545797e9c75b7be8faf' => 
    array (
      0 => './templates/users.tpl.html',
      1 => 1333775157,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17494716864f7fcb3705b4c9-33607531',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo smarty_function_call_header(array('title'=>"Admin Users"),$_smarty_tpl);?>

<?php $_smarty_tpl->tpl_vars["actionReturn"] = new Smarty_variable($_smarty_tpl->getVariable('obj')->value->actionReturn, null, null);?>

<?php if ($_smarty_tpl->getVariable('obj')->value->getPageError()){?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">
<tr>
	<td class="errorMessage"><?php echo $_smarty_tpl->getVariable('obj')->value->popPageError();?>
</td>
</tr>
</table>
<?php }?>

<?php if ($_smarty_tpl->getVariable('obj')->value->currentAction=="Listing"){?>

<form action="" name="fromName" method="post" enctype="multipart/form-data">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
<tr>
	<td><strong> <?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->startingRow;?>
 - <?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->endingRow;?>
  </strong> of <strong><?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->totcnt;?>
 </strong> </td>
	<td>
		<input name="actionvar" type="submit" class="butsubmit" value="Add New" />
	</td>
</tr>
</table>
</form>


					
<?php if ($_smarty_tpl->getVariable('actionReturn')->value['data']){?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
	<tr>
		<td align="center" valign="middle">
			<form action="" name="fromName" method="post" enctype="multipart/form-data">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
				<tr align="center" valign="middle">							
					<th>No</th>
					<th>Name</th>
					<th>Email</th>
					<th>Options</th>
				</tr>
				<?php  $_smarty_tpl->tpl_vars['x'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('actionReturn')->value['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['i']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['x']->key => $_smarty_tpl->tpl_vars['x']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['i']['index']++;
?>
				<tr>
					<td><?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->startingRow+$_smarty_tpl->getVariable('smarty')->value['foreach']['i']['index'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['x']->value['name'];?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['x']->value['email'];?>
</td>
					<td>
					<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Editform','',false);?>
&id=<?php echo $_smarty_tpl->tpl_vars['x']->value['id'];?>
" class="Second_link">
							Edit
					</a>
					 &nbsp;&nbsp;&nbsp;
					<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Delete','',false);?>
&id=<?php echo $_smarty_tpl->tpl_vars['x']->value['id'];?>
" class="Second_link">
							Delete
					</a>
					</td>
				</tr>
				<?php }} ?>
				<tr>
				<td colspan="4"><?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->s_get_links();?>
</td>
				</tr>
			</table>
			</form>
		</td>
	</tr>
</table>
				
<?php }?>

<?php }?>

<?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="Addform")||($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform")){?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
	<form action="" name="fromName" method="post" enctype="multipart/form-data">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				<th colspan="2">Add Users</th>
			</tr>

			<tr>
				<td>First Name</td>
				<td><input type="text"  name="name" valtype="emptyCheck-Please enter your name" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['name'];?>
" id="fnameId" class="validateText" /></td>
			</tr>
			
			<tr>
				<td>Email</td>
				<td><input type="text"  name="email" valtype="emptyCheck-Please enter your Email|emailCheck-please enter a valid Email " value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['email'];?>
" id="emailId" class="emailValidate" /></td>
			</tr>
					
			<tr>
				<td>&nbsp;</td>
				<td>
				<?php if ($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform"){?>
					
					<input type="submit" class="butsubmit"  valcheck="true" name="actionvar" value="Update" id="saveDataId" />
				
				<?php }else{ ?>
					
					<input type="submit" class="butsubmit" valcheck="true" name="actionvar" value="Save" id="saveDataId" />
					
				<?php }?>
					<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
				</td>
			</tr>
		
		</table>
			</form>
	</td>
</tr>	
</table>
<?php }?>

</table>


<?php echo smarty_function_call_footer(array(),$_smarty_tpl);?>

