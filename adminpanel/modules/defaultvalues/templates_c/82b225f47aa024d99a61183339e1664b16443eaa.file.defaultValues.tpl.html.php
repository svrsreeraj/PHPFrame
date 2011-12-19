<?php /* Smarty version Smarty-3.0.7, created on 2011-12-17 10:20:32
         compiled from "./templates/defaultValues.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:8992353504eec1f98e57e92-88731758%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '82b225f47aa024d99a61183339e1664b16443eaa' => 
    array (
      0 => './templates/defaultValues.tpl.html',
      1 => 1324097415,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8992353504eec1f98e57e92-88731758',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo smarty_function_call_module_header(array('title'=>"Default Values"),$_smarty_tpl);?>


<script type="text/javascript" src="js/ui/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="../libs/ckeditor_3.5.1/ckeditor.js"></script>
<script type="text/javascript">
$(document).ready(function(){

$("#heading").tooltip();
$("[valcheck='true']").click(function()
	{
		jsArticleBody	=	CKEDITOR.instances.description.getData();	
		var len			=	jsArticleBody.length;
		if(len==0)
			{
				$("#errorsub").append("<span class='val_error_alert'>&nbsp;please enter a description</span>");
				return false;
			}

	});

});
</script>


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
	<td class="pageHead"><span id="heading"><strong>Default Values</strong></span></td>
</tr>
<?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="Addform")||($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform")){?>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>

		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				<th colspan="2">Manage CMS</th>
			</tr>
		
			<tr>
				<td width="150">Caption</td>
				<td><input size="70"  type="text" valtype="emptyCheck-please enter caption" name="caption" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['caption'];?>
" id="captionId" class="validateText"/></td>
			</tr>
		
			<?php if ($_smarty_tpl->getVariable('actionReturn')->value['combo']){?>
				<tr>
				<td>Group</td>
				<td><?php echo $_smarty_tpl->getVariable('actionReturn')->value['combo'];?>
</td>
			</tr>
			<?php }?>
			<?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="Addform")){?>
			<tr>
				<td>Name</td>
				<td><input type="text" size="70"  name="name"  valtype="emptyCheck-please enter name" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['name'];?>
" id="nameId" /></td>
			</tr>
			<?php }?>
			<tr>
				<td>Value</td>
				<td>
				<textarea  name="value" id="valueId" valtype="emptyCheck-Please enter value"  cols="52" rows="5"><?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['value'];?>
</textarea>
			</tr>
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
				<td>
			
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
						<td> <strong> <?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->startingRow;?>
 - <?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->endingRow;?>
  </strong> of <strong><?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->totcnt;?>
 </strong> </td>							
						<td>CMS Section:</td>
							<td>
								<?php echo $_smarty_tpl->getVariable('actionReturn')->value['searchdata']['searchCombo'];?>

							</td>
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
&sortField=def.caption&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Caption
								<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('def.caption',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
							</th>
							
							<th>
								<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=def.value&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Value
								<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('def.value',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
							</th>
								<th>
								<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=def.name&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Name
								<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('def.name',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

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
							<td><span title="<?php echo $_smarty_tpl->tpl_vars['data']->value['caption'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['caption'];?>
</span></td>
							<td ><span title="<?php echo $_smarty_tpl->tpl_vars['data']->value['value'];?>
">	<?php echo $_smarty_tpl->getVariable('obj')->value->getLimitedText($_smarty_tpl->tpl_vars['data']->value['value'],30);?>
</span></td>
							<td><?php echo $_smarty_tpl->getVariable('obj')->value->getLimitedText($_smarty_tpl->tpl_vars['data']->value['name'],100);?>
</td>
							<td>
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
<script type="text/javascript">
CKEDITOR.replace('description');
</script>
<?php echo smarty_function_call_module_footer(array(),$_smarty_tpl);?>

