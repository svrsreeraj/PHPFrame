<?php /* Smarty version Smarty-3.0.7, created on 2012-07-21 17:10:14
         compiled from "./templates/pageSettings.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:2029073964500a951e5c4f64-20471878%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '185d1f2a573b48946ebef5f54b979b055bfb2d48' => 
    array (
      0 => './templates/pageSettings.tpl.html',
      1 => 1342430626,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2029073964500a951e5c4f64-20471878',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo smarty_function_call_core_header(array('title'=>"Menu Settings"),$_smarty_tpl);?>

<?php $_smarty_tpl->tpl_vars["actionReturn"] = new Smarty_variable($_smarty_tpl->getVariable('obj')->value->actionReturn, null, null);?>

<script type="text/javascript">
	$(document).ready(function(){
	$("#pagesetting").tooltip();
});
</script>


<form action="" name="fromName" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">

<?php if ($_smarty_tpl->getVariable('obj')->value->getPageError()){?>
<tr>
	<td class="errorMessage"><?php echo $_smarty_tpl->getVariable('obj')->value->popPageError();?>
</td>
</tr>
<?php }?>


<tr>
	<td class="pageHead"><span id="pagesetting"><strong>Page Settings </strong></span></td>
</tr>

<?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform")||($_smarty_tpl->getVariable('obj')->value->currentAction=="Addform")){?>

<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				<th colspan="2">Edit Pages</th>
			</tr>
			<tr>
				<td width="150">Select Menu</td>
				<td><?php echo $_smarty_tpl->getVariable('actionReturn')->value['combo'];?>
</td>
			</tr>
			<tr>
				<td>Page Name</td>
				<td><input type="text"  name="page" valtype="emptyCheck-Please enter a page name" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['page'];?>
" id="pageId"  size="60" /></td>
			</tr>			
			<tr>
				<td>Page Title</td>
				<td><input type="text"  name="pagetitle" valtype="emptyCheck-Please enter  a page title" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['pagetitle'];?>
" id="pagetitleId" size="60" class="validateText"/></td>
			</tr>
			<tr>
				<td>Description</td>
				<td align="left">
				
				<textarea name="description" cols="45" rows="3" 
				id="descriptionId" valtype="emptyCheck-Please enter a description" ><?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['description'];?>
</textarea>
				</td>
			</tr>
			<?php if ($_smarty_tpl->getVariable('obj')->value->currentAction=="Addform"){?>		
			<?php if ($_smarty_tpl->getVariable('actionReturn')->value['actionArr']){?>
			<tr>
				<td>Page Options</td>
				<td align="left">
				<?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->getVariable('actionReturn')->value['actionArr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
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
				<input type="checkbox" name="actions[]" id="add" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['actionArr'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" />
				<?php echo $_smarty_tpl->getVariable('actionReturn')->value['actionArr'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['action'];?>
   
				<?php endfor; endif; ?>
				</td>
			</tr>			
			<?php }?>
			<?php }?>
			
			<?php if ($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform"){?>			
			<tr>
				<td >Sort Order</td>
				<td >
				<input name="txtpreference" type="text" valtype="checkNumber-Please enter a number" id="preferenceId" size="10" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['preference'];?>
" 
				class="nummberOnly"  maxlength="10">
				</td>
			</tr>
			
			<?php if ($_smarty_tpl->getVariable('actionReturn')->value['actions']){?>
			<tr>
				<td>Page Options Remaining</td>
				<td align="left">
				<?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->getVariable('actionReturn')->value['actions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
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
				<input type="checkbox" name="actions[]" id="edit" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['actions'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id'];?>
" />
				<?php echo $_smarty_tpl->getVariable('actionReturn')->value['actions'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['action'];?>
  
				<?php endfor; endif; ?>
				</td>
			</tr>
			<?php }?>
			<?php if ($_smarty_tpl->getVariable('actionReturn')->value['actionSel']){?> 
			<tr>
				<td>Page Options Selected</td>
				<td align="left">
				
				<?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['j']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['name'] = 'j';
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop'] = is_array($_loop=$_smarty_tpl->getVariable('actionReturn')->value['actionSel']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop'];
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
				
					
					<?php echo $_smarty_tpl->getVariable('actionReturn')->value['actionSel'][$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['action'];?>
  <?php if (!$_smarty_tpl->getVariable('smarty')->value['section']['j']['last']){?>,<?php }?>

				<?php endfor; endif; ?>
				</td>
			</tr> 
			<?php }?>
			<?php }?>	
			
				
			<tr>
				<td>&nbsp;</td>
				<td>
				<?php if ($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform"){?>					
						<input type="submit" valcheck="true" class="butsubmit"  name="actionvar" value="Update" id="saveDataId" />					
				<?php }else{ ?>					
						<input type="submit" valcheck="true" class="butsubmit"  name="actionvar" value="Save" id="saveDataId" />				
				<?php }?>	
				<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
				</td>
			</tr>
		</table>
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
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
							<td>  <strong> <?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->startingRow;?>
 - <?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->endingRow;?>
  </strong> of <strong><?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->totcnt;?>
 </strong></td>
							<td>Menus:</td>
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
			
			
			<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("view")){?>
			<?php if ($_smarty_tpl->getVariable('actionReturn')->value['data']){?> 
					<tr>
						<td align="center" valign="middle">
							<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
								<tr align="center" valign="middle">							
									<th>No</th>									
									<th>
									<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=p.pagetitle&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Title
<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('p.pagetitle',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
									</th>
									<th>
									<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=p.page&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Page
<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('p.page',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
									</th>							
									<th>
									<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=m.menutitle&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
								Menu
<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('m.menutitle',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

								</a>
								</th>
									<th>
							<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=p.preference&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
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
								<td><?php echo $_smarty_tpl->tpl_vars['data']->value['pagetitle'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['data']->value['page'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['data']->value['menutitle'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['data']->value['preference'];?>
</td>
							
							<td>							
							<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Status")){?>
<a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Enablechange','',true,$_smarty_tpl->getVariable('obj')->value->getConcat('id=',$_smarty_tpl->tpl_vars['data']->value['id']));?>
" class="Second_link">
<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['data']->value['penable']==1){?> 
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
							<td colspan="7"><?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->s_get_links();?>
</td>
							</tr>
						</table>
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

