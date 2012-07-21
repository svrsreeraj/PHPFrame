<?php /* Smarty version Smarty-3.0.7, created on 2012-07-21 17:12:11
         compiled from "./templates/masterTables.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:9352186374f5e8cff096b80-84970314%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e59d092d07c4d56d46be9ba6c8d3c599f089d83b' => 
    array (
      0 => './templates/masterTables.tpl.html',
      1 => 1342430627,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9352186374f5e8cff096b80-84970314',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo smarty_function_call_module_header(array('title'=>"Master Tables"),$_smarty_tpl);?>


<script type="text/javascript" src="js/ui/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="../libs/ckeditor_3.5.1/ckeditor.js"></script>
<script type="text/javascript">
function validate_add()
	{
		var flag 	= 0;
		var arr		=	document.formName.txt_add;
		for(var i=0;i<arr.length;i++)	if(arr[i].value!="")	flag	=	1;
		if(flag	==	0)
			{
				jAlert("Please Enter Value");
				return false;
			}
		return true;
	}
</script>
<link rel="stylesheet" type="text/css" href="css/style.css" />

<?php $_smarty_tpl->tpl_vars["actionReturn"] = new Smarty_variable($_smarty_tpl->getVariable('obj')->value->actionReturn, null, null);?>
<form action="" name="formName" method="post" enctype="multipart/form-data" onsubmit="return validatefck()">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">
<tr>
	<td class="pageHead"><span id="heading"><strong>Master Table Management</strong></span></td>
</tr>

<?php if ($_smarty_tpl->getVariable('obj')->value->getPageError()){?>
<tr>
	<td class="errorMessage" align="center"><?php echo $_smarty_tpl->getVariable('obj')->value->popPageError();?>
</td>
</tr>
<?php }else{ ?>
<tr>
	<td  align="right">&nbsp;</td>
</tr>
<?php }?>

 <?php if ($_smarty_tpl->getVariable('obj')->value->currentAction=="Addform"){?>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
		<table width="100%" border="0" cellpadding="3" cellspacing="3" align="center" class="formTable">
		<tr><th align="left" colspan="3"><?php if ($_smarty_tpl->getVariable('actionReturn')->value['data']['parent_id']){?> <b style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">Add <?php echo $_smarty_tpl->getVariable('obj')->value->GetSection($_smarty_tpl->getVariable('actionReturn')->value['data']['section_id']);?>
 Under <?php echo $_smarty_tpl->getVariable('obj')->value->GetParent($_smarty_tpl->getVariable('actionReturn')->value['data']['parent_id']);?>
</b><?php }else{ ?> Add <?php echo $_smarty_tpl->getVariable('obj')->value->GetSection($_smarty_tpl->getVariable('actionReturn')->value['data']['section_id']);?>
<?php }?></th></tr>
		<?php $_smarty_tpl->tpl_vars["count"] = new Smarty_variable(0, null, null);?>
		<?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = (int)0;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=5) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>
			<tr>
			<?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['j']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['name'] = 'j';
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['start'] = (int)0;
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop'] = is_array($_loop=3) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'] = 1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total']);
?>
				<?php $_smarty_tpl->tpl_vars["count"] = new Smarty_variable($_smarty_tpl->getVariable('count')->value+1, null, null);?>	
				<td>
				<?php if ($_smarty_tpl->getVariable('count')->value<=15){?>
				<input name="txt_add[]" type="text" id="txt_add" size="30" class="textBox" maxlength="40">
				<?php }else{ ?>
				&nbsp;
				<?php }?>				
				</td>
			<?php endfor; endif; ?>			
			</tr>
		<?php endfor; endif; ?>
		<tr><td align="center" colspan="3">
		
			<input type="submit" class="butsubmit"  name="actionvar" onClick="return validate_add();" value="Save" id="saveDataId"  />
			&nbsp;
			<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
		</td></tr>
		</table>	
			<script language="javascript" type="text/javascript">
			document.formName.txt_add[0].focus();
			</script> 
	</td>
  </tr>
  <?php }?>




<?php if ($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform"){?>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>

		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				<th colspan="2">Manage Master Table Details</th>
			</tr>
		
			<tr>
				<td width="150">Name</td>
				<td><input type="text" name="name" valtype="emptyCheck-please enter a name"  value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['name'];?>
" id="captionId" size="30" class="validateText"/></td>
			</tr>
			<tr>
				<td>Preference</td>
				<td>
					<input type="text" name="preference" id="preference"  value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['preference'];?>
" size="10" class="validateText"/>
				</td>
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
			<?php if ($_smarty_tpl->getVariable('actionReturn')->value['masters']){?>
			<tr>
				<td>
			
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
							<td>
									<div  id="floatingbar">
										 <ul>
										 <?php  $_smarty_tpl->tpl_vars['master'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('actionReturn')->value['masters']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['master']->key => $_smarty_tpl->tpl_vars['master']->value){
?>
										   <li><a class="butdefault" title="Click here to view all <?php echo $_smarty_tpl->tpl_vars['master']->value['ms_table_section'];?>
" href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('listing','',false,$_smarty_tpl->getVariable('obj')->value->getConcat('section_id=',$_smarty_tpl->tpl_vars['master']->value['id']));?>
">
										   <?php echo $_smarty_tpl->tpl_vars['master']->value['ms_table_section'];?>
</a></li>
										 <?php }} ?>
										 </ul>
									</div>
							</td>
						</tr>
					</table>
					
				</td>
			</tr>
			<?php }?>
			<tr>
				<td align="center" height="20"><?php if ($_smarty_tpl->getVariable('actionReturn')->value['msloop']['parentId']){?>All <b style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><?php echo $_smarty_tpl->getVariable('obj')->value->GetSection($_smarty_tpl->getVariable('actionReturn')->value['msloop']['sectionId']);?>
</b> Under <b style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><?php echo $_smarty_tpl->getVariable('obj')->value->GetParent($_smarty_tpl->getVariable('actionReturn')->value['msloop']['parentId']);?>
</b><?php }else{ ?> <?php if ($_smarty_tpl->getVariable('actionReturn')->value['msloop']['sectionId']){?><b style="font-family:Arial, Helvetica, sans-serif; font-size:14px;"><?php echo $_smarty_tpl->getVariable('obj')->value->GetSection($_smarty_tpl->getVariable('actionReturn')->value['msloop']['sectionId']);?>
 Listing</b><?php }?><?php }?></td>
			</tr>
			<tr>
				<td>
					<table width="100%">
						<tr><td width="50%" align="left"><b><?php echo $_smarty_tpl->getVariable('obj')->value->GetFlow($_smarty_tpl->getVariable('actionReturn')->value['msloop']['sectionId']);?>
</b></td>
						<td width="50%" align="right"><b><?php echo $_smarty_tpl->getVariable('obj')->value->GetFlow('',$_smarty_tpl->getVariable('actionReturn')->value['msloop']['parentId']);?>
</b></td></tr>
					</table>
				</td>
			</tr>
			<?php if ($_smarty_tpl->getVariable('actionReturn')->value['data']||$_smarty_tpl->getVariable('actionReturn')->value['msloop']['parentId']||$_smarty_tpl->getVariable('actionReturn')->value['msloop']['sectionId']){?>
			<tr>
				<td>
			
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
						<td> <strong> <?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->startingRow;?>
 - <?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->endingRow;?>
  </strong> of <strong><?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->totcnt;?>
 </strong> </td>							
						<td>Keyword:</td>
							<!--<td>
								<?php echo $_smarty_tpl->getVariable('actionReturn')->value['searchdata']['searchCombo'];?>

							</td>-->
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
			<?php }?>
			<?php if ($_smarty_tpl->getVariable('actionReturn')->value['data']){?>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td align="center" valign="middle">
				
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">							
							<th>No</th>
							<th>
								<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',true);?>
&sortField=mst.name&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Name
								<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('mst.name',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
							</th>
							
							<th>
								<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',true);?>
&sortField=mst.preference&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Preference
								<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('mst.preference',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
							
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
							<td><?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
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
							<?php if ($_smarty_tpl->getVariable('actionReturn')->value['msloop']['childId']){?>
							<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('listing','',false,$_smarty_tpl->getVariable('obj')->value->getConcat('section_id=',$_smarty_tpl->getVariable('actionReturn')->value['msloop']['childId'],'&parent_id=',$_smarty_tpl->tpl_vars['data']->value['id']));?>
" class="Second_link"><img src="images/forward.png" width="22" height="22" border="0" title="Click here view all <?php echo $_smarty_tpl->getVariable('actionReturn')->value['msloop']['child'];?>
 under <?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
"></a>
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

