<?php /* Smarty version Smarty-3.0.7, created on 2012-01-28 16:40:19
         compiled from "./templates/menuSettings.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:14335673444f23d79bedfe62-50653963%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '86c927561ed86f22c9f5a7c779206f883e44f81d' => 
    array (
      0 => './templates/menuSettings.tpl.html',
      1 => 1326102575,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14335673444f23d79bedfe62-50653963',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo smarty_function_call_core_header(array('title'=>"Menu Settings"),$_smarty_tpl);?>


<script type="text/javascript">
$(document).ready(function(){
$("#menusetting").tooltip();
});

</script>

<?php $_smarty_tpl->tpl_vars["actionReturn"] = new Smarty_variable($_smarty_tpl->getVariable('obj')->value->actionReturn, null, null);?>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">

<?php if ($_smarty_tpl->getVariable('obj')->value->getPageError()){?>
<tr>
	<td class="errorMessage"><?php echo $_smarty_tpl->getVariable('obj')->value->popPageError();?>
</td>
</tr>
<?php }?>
<tr>
	<td class="pageHead"><span id="menusetting"><strong>Menu Settings </strong></span></td>
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
				<th colspan="2">Manage Menus</th>
			</tr>
			
			<tr>
				<td width="300">Menu Title</td>
				<td ><input type="text"  name="menutitle" valtype="emptyCheck-Please enter the Menu Title " value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['menutitle'];?>
" id="menutitleId" class="validateText" /></td>
			</tr>			
			<tr>
				<td>Menu Name</td>
				<td><input type="text"  name="menuname" valtype="emptyCheck-Please enter the Menu Name " value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['menuname'];?>
" id="menunameId" class="validateText" /></td>
			</tr>
			<?php if ($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform"){?>
			<tr>
				<td >Sort Order</td>
				<td >
				<input name="txtpreference" type="text" id="preferenceId" valtype="emptyCheck-Please enter a number|checkNumber-Only numbers are allowed"  size="10" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['preference'];?>
" 
				class="nummberOnly"  maxlength="10">
				</td>
			</tr>
			<?php }?>
			
			<tr>
				<td>&nbsp;</td>
				<td>
				<?php if ($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform"){?>
					<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Edit")){?>
						<input type="submit" class="butsubmit" valcheck="true"  name="actionvar" value="Update" id="saveDataId" />
					<?php }?>
				<?php }else{ ?>
					<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Add")){?>
						<input type="submit" valcheck="true" class="butsubmit"  name="actionvar" value="Save" id="saveDataId" />
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


<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("View")){?>

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
							<td>  <strong> <?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->startingRow;?>
 - <?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->endingRow;?>
 </strong> 
							of <strong><?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->totcnt;?>
 </strong> </td>
							
							<td>
							<input type="text" name="keyword" maxlength="25" id="id_keyword" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['searchdata']['keyword'];?>
" />
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
			<?php if ($_smarty_tpl->getVariable('actionReturn')->value['data']){?>
			<tr>
				<td align="center" valign="middle">
					<form action="" name="fromName" method="post" enctype="multipart/form-data">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">							
							<th>No</th>
							<th>
<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=menutitle&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Title
<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('menutitle',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
							
							</th>
							<th>
							<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=menuname&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Name
<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('menuname',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
							</th>
							<th>
							<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=preference&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Order
<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('preference',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
							</th>
							<th>Enable</th>
							<th>							
							Action 							
							</th>
							

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
							<td><?php echo $_smarty_tpl->tpl_vars['data']->value['menutitle'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['data']->value['menuname'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['data']->value['preference'];?>
</td>
							
							<td>							
							<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Status")){?>
							<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Enablechange','',true,$_smarty_tpl->getVariable('obj')->value->getConcat('id=',$_smarty_tpl->tpl_vars['data']->value['id']));?>
" class="Second_link">
							<?php }?>	
								<?php if ($_smarty_tpl->tpl_vars['data']->value['menable']==1){?> 
								<img src="images/active.gif" border="0" title="Click here to disable the menu">
								<?php }else{ ?> 							 
								<img src="images/inactive.gif" border="0" title="Click here to enable the menu">
								<?php }?>
							<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Status")){?> 
							</a> 
							<?php }?>				
							
							</td>
							
							<td>
					<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Status")){?>
					<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Stauschange','',true,$_smarty_tpl->getVariable('obj')->value->getConcat('id=',$_smarty_tpl->tpl_vars['data']->value['id']));?>
" class="Second_link">
					<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['data']->value['status']==1){?> 
							<img src="images/active.gif" border="0" title="Click here to inactivate">
							 <?php }else{ ?> 							 
							 <img src="images/inactive.gif" border="0" title="Click here to activate">
							 <?php }?>
					<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Status")){?>
					 </a> 
					<?php }?>	 
							<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Edit")){?>
							<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('editform','',true,$_smarty_tpl->getVariable('obj')->value->getConcat('id=',$_smarty_tpl->tpl_vars['data']->value['id']));?>
" class="Second_link">
							<img src="images/edit.gif" border="0" title="Click here to edit">
							
							</a>  
							<?php }?>
											
							
							</td>
						</tr>
					<?php }} ?>
					<tr>
						<td colspan="6"><?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->s_get_links();?>
</td>
					</tr>
				</table>
				</form>
				</td>
			</tr>
		<?php }?>
		
		</table>
		
	</td>
	<?php }?>
</tr>
<?php }?>
</table>


<?php echo smarty_function_call_core_footer(array(),$_smarty_tpl);?>

