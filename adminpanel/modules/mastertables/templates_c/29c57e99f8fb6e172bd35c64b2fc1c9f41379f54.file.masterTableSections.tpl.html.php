<?php /* Smarty version Smarty-3.0.7, created on 2012-07-21 17:12:12
         compiled from "./templates/masterTableSections.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:7438920754eaa993e8e72e4-43495596%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '29c57e99f8fb6e172bd35c64b2fc1c9f41379f54' => 
    array (
      0 => './templates/masterTableSections.tpl.html',
      1 => 1342430627,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7438920754eaa993e8e72e4-43495596',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo smarty_function_call_module_header(array('title'=>"Master Tables"),$_smarty_tpl);?>


<script type="text/javascript" src="js/ui/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="../libs/ckeditor_3.5.1/ckeditor.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css" />

<?php $_smarty_tpl->tpl_vars["actionReturn"] = new Smarty_variable($_smarty_tpl->getVariable('obj')->value->actionReturn, null, null);?>
<form action="" name="formName" method="post" enctype="multipart/form-data" onsubmit="return validatefck()">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">
<?php if ($_smarty_tpl->getVariable('obj')->value->getPageError()){?>
<tr>
	<td class="errorMessage"><?php echo $_smarty_tpl->getVariable('obj')->value->popPageError();?>
</td>
</tr>
<?php }?>
<tr>
	<td class="pageHead"><span id="heading"><strong>Master Table Management</strong></span></td>
</tr>
<?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="Addform")||($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform")){?>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>

		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				<th colspan="2">Manage Master Table Section</th>
			</tr>
		
			<tr>
				<td width="150">Section</td>
				<td><input type="text" name="ms_table_section" valtype="emptyCheck-please enter section name"  value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['ms_table_section'];?>
" id="sectionId" size="30" class="validateText"/></td>
			</tr>
			<?php if ($_smarty_tpl->getVariable('actionReturn')->value['combo']){?>
				<tr>
				<td>Parent Section</td>
				<td><?php echo $_smarty_tpl->getVariable('actionReturn')->value['combo'];?>
</td>
			</tr>
			<?php }?>
			<?php if ($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform"){?>
			<tr>
				<td>Preference</td>
				<td>
					<input type="text" name="preference" id="preference"  value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['preference'];?>
" size="10" class="validateText"/>
				</td>
			</tr>
			<?php }?>
			<tr>
				<td>&nbsp;</td>
				<td>
				<?php if ($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform"){?>
					<input type="submit" valcheck="true" class="butsubmit"  name="actionvar" value="Update" id="saveDataId" />
				<?php }else{ ?>
					<input type="submit" valcheck="true" class="butsubmit"  name="actionvar" value="Save" id="saveDataId"  />
				<?php }?>
					<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
				</td>
			</tr>
		</table>
	
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
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>
			
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
						<td> <strong> <?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->startingRow;?>
 - <?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->endingRow;?>
  </strong> of <strong><?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->totcnt;?>
 </strong> </td>							
						<td>Select parent:</td>
							<td>
								<?php echo $_smarty_tpl->getVariable('actionReturn')->value['searchdata']['combo'];?>

							</td>
							<td>Keyword:</td>
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
					
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<?php if ($_smarty_tpl->getVariable('actionReturn')->value['data']){?>
			<tr>
				<td align="center" valign="middle">
				
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">							
							<th>No</th>
							<th>
								<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=ms_table_section&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Section
								<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('ms_table_section',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
							</th>
							
							<th>
								<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=preference&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Preference
								<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('preference',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

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
							<td><?php echo $_smarty_tpl->tpl_vars['data']->value['ms_table_section'];?>
</td>
							<td ><?php echo $_smarty_tpl->tpl_vars['data']->value['preference'];?>
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
" class="Second_link"> <img src="images/edit.gif" border="0" title="Click here to edit"></a> 
							<?php }?>
							</td>
						</tr>
					<?php }} ?>
					<tr>
						<td colspan="6"><?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->s_get_links();?>
</td>
					</tr>
				</table>
				</td>
			</tr>
		<?php }?>
		
		</table>
	</td>
	<?php }?>
</tr>
<?php }?>
</table>
	</form>
<?php echo smarty_function_call_module_footer(array(),$_smarty_tpl);?>

