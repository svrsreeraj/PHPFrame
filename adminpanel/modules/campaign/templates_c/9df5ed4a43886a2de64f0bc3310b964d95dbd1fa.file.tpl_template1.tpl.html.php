<?php /* Smarty version Smarty-3.0.7, created on 2012-02-29 15:45:06
         compiled from "./templates/tpl_template1.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:2330898494f4dfaaa487eb6-40566855%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9df5ed4a43886a2de64f0bc3310b964d95dbd1fa' => 
    array (
      0 => './templates/tpl_template1.tpl.html',
      1 => 1330510336,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2330898494f4dfaaa487eb6-40566855',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo smarty_function_call_module_header(array('title'=>"Campaign Group"),$_smarty_tpl);?>


<script language="javascript" type="text/javascript">
function checkAll()
	{
		if(document.frmlist.checkone)
			{
				document.frmlist.checkone.checked=document.frmlist.checkall.checked;
				for(i=0;i<document.frmlist.checkone.length;i++)
				document.frmlist.checkone[i].checked=document.frmlist.checkall.checked;
			}
		else
			{
				alert("Nothing to select");
				document.frmlist.checkall.checked=false;
			
			}
	}
function Remove()
	{
		flag = 0;
		if(document.frmlist.checkone.checked)	flag = 1;
		for(i=0;i<document.frmlist.checkone.length;i++)
			{
				if(document.frmlist.checkone[i].checked)
					{
						flag = 1;
						break;
					}
			}
		if(flag == 1)
			{
				if(confirm("You are going to delete these records permenantly, Do you want to continue?"))	  return true;
				else return false;
			}
		else
			{
				alert("No record(s) selected");
				return false;
			}	
	}
function validate_add()
	{
		var flag 	= 0;
		var arr		=	document.add_form.txt_add;
		for(var i=0;i<arr.length;i++)	if(arr[i].value!="")	flag	=	1;
		if(flag	==	0)
			{
				jAlert("Enter Details.");
				return false;
			}
		return true;
	}
function validate_edit()
	{
		if(document.frm_edit.txt_edit.value=="")
			{
				jAlert("Enter Correct Details.");
				return false;
			}
		return true;
	}

</script>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">
  <tr>
    <th class="pageHead"><?php echo $_smarty_tpl->getVariable('tpls')->value['heading'];?>
<?php if ($_smarty_tpl->getVariable('tpls')->value['parentpagevar']){?> :<?php echo $_smarty_tpl->getVariable('tpls')->value['parentcaption'];?>
<?php }?></th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
  <?php if ($_smarty_tpl->getVariable('tpls')->value['error']){?>
  <tr>
    <td class="errorMessage"><div align="center"><strong><?php echo $_smarty_tpl->getVariable('tpls')->value['error'];?>
</strong></div></td>
  </tr>
  <?php }?>
  
  
  <?php if ($_REQUEST['add']!=''){?>
  <?php if ($_smarty_tpl->getVariable('cls_site')->value->permissionCheck("Add")){?>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
		<form name="add_form" method="post" action="">
		<table width="100%" border="0" cellpadding="3" cellspacing="3" align="center" class="formTable">
		<tr><th align="left" colspan="<?php echo $_smarty_tpl->getVariable('tpls')->value['addsplit'];?>
"><?php echo $_smarty_tpl->getVariable('tpls')->value['addcaption'];?>
</th></tr>
		<?php $_smarty_tpl->tpl_vars["count"] = new Smarty_variable(0, null, null);?>
		<?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = (int)0;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->getVariable('tpls')->value['floop']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop'] = is_array($_loop=$_smarty_tpl->getVariable('tpls')->value['addsplit']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<?php if ($_smarty_tpl->getVariable('count')->value<=$_smarty_tpl->getVariable('tpls')->value['addcount']){?>
				<input name="txt_add[]" type="text" id="txt_add" size="30" class="textBox" maxlength="40">
				<?php }else{ ?>
				&nbsp;
				<?php }?>				
				</td>
			<?php endfor; endif; ?>			
			</tr>
		<?php endfor; endif; ?>
		<tr><td align="center" colspan="<?php echo $_smarty_tpl->getVariable('tpls')->value['addsplit'];?>
">
			<input name="btn_save" type="submit" id="btn_save" value="<?php echo $_smarty_tpl->getVariable('tpls')->value['savebtnvalue'];?>
" class="butsubmit" onClick="return validate_add();">
			&nbsp;
			<input name="btn_savecancel" valcheck="true" type="submit" id="btn_savecancel" value="<?php echo $_smarty_tpl->getVariable('tpls')->value['btnsavecancelvalue'];?>
" class="butsubmit">
		</td></tr>
		</table>	
		</form>
			<script language="javascript" type="text/javascript">
			document.add_form.txt_add[0].focus();
			</script> 
	</td>
  </tr>
  <?php }?>
  <?php }?>	
  
  <?php if ($_REQUEST['edit']!=''){?>
  <?php if ($_smarty_tpl->getVariable('cls_site')->value->permissionCheck("Edit")){?>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
 <tr>
    <td>
		
			<form name="frm_edit" method="post" action="">
			<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" class="formTable">
			
			<tr>
			<th colspan="2"><div align="left"><strong><?php echo $_smarty_tpl->getVariable('tpls')->value['edithead'];?>
 </strong></div></th>
			</tr>
			
			<tr>
			<td width="104" class="contentLeft"><div><?php echo $_smarty_tpl->getVariable('tpls')->value['editcaption'];?>
</div></td>
			<td width="199"><div align="left">
			<input name="txt_edit" type="text" id="txt_edit" size="30" value="<?php echo $_smarty_tpl->getVariable('tpls')->value['updatetxtlvalue'];?>
" class="textBox" maxlength="40">
			</div>			</td>
			</tr>
			
			<tr>
			<td width="104" class="contentLeft"><div><?php echo $_smarty_tpl->getVariable('tpls')->value['preference'];?>
</div></td>
			<td width="199"><div align="left">
			<input name="txt_preference" type="text" id="txt_preference" size="10" value="<?php echo $_smarty_tpl->getVariable('tpls')->value['updateprefervalue'];?>
" class="nummberOnly"  maxlength="10">
			</div>			</td>
			</tr>
			
			<tr>
			<td>&nbsp;</td>
			<td><div align="left">
			<input name="btn_edit" type="submit" valtype="emptyCheck-Please enter a value" id="btn_edit" value="<?php echo $_smarty_tpl->getVariable('tpls')->value['updatebtnvalue'];?>
" class="butsubmit" onClick="return validate_edit();">
			&nbsp;
			<input name="btn_editcancel"  type="submit" id="btn_editcancel" value="<?php echo $_smarty_tpl->getVariable('tpls')->value['btnupdatecancelvalue'];?>
" class="butsubmit">
			</div>			</td>
			</tr>
			</table>
			</form>	
			<script language="javascript" type="text/javascript">
			document.frm_edit.txt_edit.focus();
			</script> 
		</td>
	</tr>
	<?php }?>
	<?php }?>
	<?php if ($_REQUEST['add']==''&&$_REQUEST['edit']==''){?>
		<tr>
		<td>&nbsp;</td>	
		</tr>
		<tr>
			<td>
			<form name="frmlist" method="post" action="">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td>
							<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
								<tr>
									<td><strong> <?php echo $_smarty_tpl->getVariable('tpls')->value['spage']->startingRow;?>
 - <?php echo $_smarty_tpl->getVariable('tpls')->value['spage']->endingRow;?>
  </strong> of <strong><?php echo $_smarty_tpl->getVariable('tpls')->value['spage']->totcnt;?>
 </strong></td>
									
									
									<td><?php echo $_smarty_tpl->getVariable('tpls')->value['listcaption'];?>
</td>
									<td>
									<input type="text" name="txt_search" value="<?php echo $_REQUEST['searchq'];?>
" id="id_txt_search" />
									</td>
									<td>
									<input name="btnSearch" type="submit" class="butsubmit" value="Search" />
									</td>
									<td>
									<input name="btnSearchReset"  type="submit" class="butsubmit" value="Reset" />
									</td>
			
									<td>
									
									
									 <div align="right">       
										<?php if ($_smarty_tpl->getVariable('cls_site')->value->permissionCheck("Add")){?>
											<input name="add_btn" type="submit" id="add_btn" value="<?php echo $_smarty_tpl->getVariable('tpls')->value['addbtnvalue'];?>
" class="butsubmit" >
										<?php }?>
										<?php if ($_smarty_tpl->getVariable('tpls')->value['parentpagevar']){?> 
											&nbsp;
											<input name="btn_parent" type="submit" class="butsubmit" id="btn_parent" value="<?php echo $_smarty_tpl->getVariable('tpls')->value['parentBtnBack'];?>
" onClick="">
											<?php }?>
									 </div>
									
					
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				<?php if ($_smarty_tpl->getVariable('tpls')->value['dataarray']&&$_smarty_tpl->getVariable('cls_site')->value->permissionCheck("View")){?>
					<tr>
					<td align="center" valign="middle">
						
						<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr>
						<th align="left" width="10"><!--<input name="checkall" type="checkbox" id="checkall" onClick="return checkAll()" value="CHKALL"> --></th>
						<th align="left"><div align="center"><?php echo $_smarty_tpl->getVariable('tpls')->value['listcaption'];?>
</div></th>
						
						<th align="left"><div align="center"><?php echo $_smarty_tpl->getVariable('tpls')->value['preference'];?>
</div></th>
						
						<th align="left"><div align="center"><?php echo $_smarty_tpl->getVariable('tpls')->value['listoptions'];?>
</div></th>
						
						
						</tr>
						<?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = (int)0;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->getVariable('tpls')->value['dataarray']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<td align="left" width="10"><!--<input name="checkone[]" type="checkbox" id="checkone" value="<?php echo $_smarty_tpl->getVariable('tpls')->value['dataarray'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->getVariable('tpls')->value['table']['primary']];?>
"> --></td>
						<td width="200" align="left">
						<?php if ($_smarty_tpl->getVariable('tpls')->value['childpagename']){?>
						<a href="<?php echo $_smarty_tpl->getVariable('tpls')->value['childpagename'];?>
?<?php echo $_smarty_tpl->getVariable('tpls')->value['childpagevar'];?>
=<?php echo $_smarty_tpl->getVariable('tpls')->value['dataarray'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->getVariable('tpls')->value['table']['primary']];?>
"><?php echo $_smarty_tpl->getVariable('tpls')->value['dataarray'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->getVariable('tpls')->value['table']['name']];?>
</a>
						<?php }else{ ?>
						<?php echo $_smarty_tpl->getVariable('tpls')->value['dataarray'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->getVariable('tpls')->value['table']['name']];?>

						<?php }?>			</td>
						
						<td>
							<?php echo $_smarty_tpl->getVariable('tpls')->value['dataarray'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->getVariable('tpls')->value['table']['prference']];?>

						</td>
						
						<td width="100" align="left">
						
						<?php if ($_smarty_tpl->getVariable('tpls')->value['childpagename']){?>
						&nbsp;&nbsp;
						<a href="<?php echo $_smarty_tpl->getVariable('tpls')->value['childpagename'];?>
?<?php echo $_smarty_tpl->getVariable('tpls')->value['childpagevar'];?>
=<?php echo $_smarty_tpl->getVariable('tpls')->value['dataarray'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->getVariable('tpls')->value['table']['primary']];?>
" title="Click here to view the details of <?php echo $_smarty_tpl->getVariable('tpls')->value['dataarray'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->getVariable('tpls')->value['table']['name']];?>
">
						<img src="images/inner_details.png" border="0"  width="20" height="20">
						</a>
						<?php }?>
						
						<?php if ($_smarty_tpl->getVariable('cls_site')->value->permissionCheck("Edit")){?>
						&nbsp;&nbsp;
						<a href="<?php echo $_smarty_tpl->getVariable('tpls')->value['pagename'];?>
?edit=<?php echo $_smarty_tpl->getVariable('tpls')->value['dataarray'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->getVariable('tpls')->value['table']['primary']];?>
<?php if ($_smarty_tpl->getVariable('tpls')->value['parentpagevar']){?>&<?php echo $_smarty_tpl->getVariable('tpls')->value['parentpagevar'];?>
=<?php echo $_smarty_tpl->getVariable('tpls')->value['parentpagevarval'];?>
<?php }?>">
						<img src="images/edit.gif" border="0" title="Click here to edit">	
						</a>
						<?php }?>
						<?php if ($_smarty_tpl->getVariable('cls_site')->value->permissionCheck("Status")){?>
						<?php if ($_smarty_tpl->getVariable('tpls')->value['dataarray'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->getVariable('tpls')->value['table']['status']]=="1"){?>
						&nbsp;&nbsp;<a href="<?php echo $_smarty_tpl->getVariable('tpls')->value['pagename'];?>
?statuschange=<?php echo $_smarty_tpl->getVariable('tpls')->value['dataarray'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->getVariable('tpls')->value['table']['primary']];?>
<?php if ($_smarty_tpl->getVariable('tpls')->value['parentpagevar']){?>&<?php echo $_smarty_tpl->getVariable('tpls')->value['parentpagevar'];?>
=<?php echo $_smarty_tpl->getVariable('tpls')->value['parentpagevarval'];?>
<?php }?>">
						<img src="images/active.gif" border="0" title="Click here inactivate"></a>
						<?php }else{ ?>
						&nbsp;&nbsp;<a href="<?php echo $_smarty_tpl->getVariable('tpls')->value['pagename'];?>
?statuschange=<?php echo $_smarty_tpl->getVariable('tpls')->value['dataarray'][$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->getVariable('tpls')->value['table']['primary']];?>
<?php if ($_smarty_tpl->getVariable('tpls')->value['parentpagevar']){?>&<?php echo $_smarty_tpl->getVariable('tpls')->value['parentpagevar'];?>
=<?php echo $_smarty_tpl->getVariable('tpls')->value['parentpagevarval'];?>
<?php }?>">
						<img src="images/inactive.gif" border="0" title="Click here to activate"></a>
						<?php }?>	
						<?php }?>		
						</td>
						
						
						
						</tr>
						<?php endfor; endif; ?>
						<?php if ($_smarty_tpl->getVariable('tpls')->value['paging']){?>	
						<tr><td colspan="4" align="center"><div align="center"><?php echo $_smarty_tpl->getVariable('tpls')->value['paging'];?>
</div></td></tr>
						<?php }?>
						</table>
						
						</td>
					</tr>
					<?php }else{ ?>
					<?php if ($_REQUEST['add']==''&&$_REQUEST['edit']==''){?>
					<tr>
					<td class="errorMessage"><div align="center"><strong><?php echo $_smarty_tpl->getVariable('tpls')->value['norecords'];?>
</strong></div></td>
					</tr>	
					<?php }?>

					<?php }?>
				</table>
				</form>
			</td>
		</tr>
	<?php }?>
	
  </table>
<?php echo smarty_function_call_module_footer(array(),$_smarty_tpl);?>

