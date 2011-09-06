<?php /* Smarty version 2.6.19, created on 2011-01-03 10:25:19
         compiled from tpl_template1.tpl.html */ ?>
<?php echo '
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
'; ?>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">
  <tr>
    <th class="pageHead"><?php echo $this->_tpl_vars['tpls']['heading']; ?>
<?php if ($this->_tpl_vars['tpls']['parentpagevar']): ?> :<?php echo $this->_tpl_vars['tpls']['parentcaption']; ?>
<?php endif; ?></th>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
  <?php if ($this->_tpl_vars['tpls']['error']): ?>
  <tr>
    <td class="errorMessage"><div align="center"><strong><?php echo $this->_tpl_vars['tpls']['error']; ?>
</strong></div></td>
  </tr>
  <?php endif; ?>
  
  
  <?php if ($_REQUEST['add'] != ""): ?>
  <?php if ($this->_tpl_vars['cls_site']->permissionCheck('Add')): ?>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
		<form name="add_form" method="post" action="">
		<table width="100%" border="0" cellpadding="3" cellspacing="3" align="center" class="formTable">
		<tr><th align="left" colspan="<?php echo $this->_tpl_vars['tpls']['addsplit']; ?>
"><?php echo $this->_tpl_vars['tpls']['addcaption']; ?>
</th></tr>
		<?php $this->assign('count', 0); ?>
		<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['start'] = (int)0;
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['tpls']['floop']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
if ($this->_sections['i']['start'] < 0)
    $this->_sections['i']['start'] = max($this->_sections['i']['step'] > 0 ? 0 : -1, $this->_sections['i']['loop'] + $this->_sections['i']['start']);
else
    $this->_sections['i']['start'] = min($this->_sections['i']['start'], $this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] : $this->_sections['i']['loop']-1);
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = min(ceil(($this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] - $this->_sections['i']['start'] : $this->_sections['i']['start']+1)/abs($this->_sections['i']['step'])), $this->_sections['i']['max']);
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
			<tr>
			<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['start'] = (int)0;
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['tpls']['addsplit']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
if ($this->_sections['j']['start'] < 0)
    $this->_sections['j']['start'] = max($this->_sections['j']['step'] > 0 ? 0 : -1, $this->_sections['j']['loop'] + $this->_sections['j']['start']);
else
    $this->_sections['j']['start'] = min($this->_sections['j']['start'], $this->_sections['j']['step'] > 0 ? $this->_sections['j']['loop'] : $this->_sections['j']['loop']-1);
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = min(ceil(($this->_sections['j']['step'] > 0 ? $this->_sections['j']['loop'] - $this->_sections['j']['start'] : $this->_sections['j']['start']+1)/abs($this->_sections['j']['step'])), $this->_sections['j']['max']);
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?>
				<?php $this->assign('count', $this->_tpl_vars['count']+1); ?>	
				<td>
				<?php if ($this->_tpl_vars['count'] <= $this->_tpl_vars['tpls']['addcount']): ?>
				<input name="txt_add[]" type="text" id="txt_add" size="30" class="textBox" maxlength="40">
				<?php else: ?>
				&nbsp;
				<?php endif; ?>				
				</td>
			<?php endfor; endif; ?>			
			</tr>
		<?php endfor; endif; ?>
		<tr><td align="center" colspan="<?php echo $this->_tpl_vars['tpls']['addsplit']; ?>
">
			<input name="btn_save" type="submit" id="btn_save" value="<?php echo $this->_tpl_vars['tpls']['savebtnvalue']; ?>
" class="butsubmit" onClick="return validate_add();">
			&nbsp;
			<input name="btn_savecancel" valcheck="true" type="submit" id="btn_savecancel" value="<?php echo $this->_tpl_vars['tpls']['btnsavecancelvalue']; ?>
" class="butsubmit">
		</td></tr>
		</table>	
		</form>
			<script language="javascript" type="text/javascript">
			document.add_form.txt_add[0].focus();
			</script> 
	</td>
  </tr>
  <?php endif; ?>
  <?php endif; ?>	
  
  <?php if ($_REQUEST['edit'] != ""): ?>
  <?php if ($this->_tpl_vars['cls_site']->permissionCheck('Edit')): ?>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
 <tr>
    <td>
		
			<form name="frm_edit" method="post" action="">
			<table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" class="formTable">
			
			<tr>
			<th colspan="2"><div align="left"><strong><?php echo $this->_tpl_vars['tpls']['edithead']; ?>
 </strong></div></th>
			</tr>
			
			<tr>
			<td width="104" class="contentLeft"><div><?php echo $this->_tpl_vars['tpls']['editcaption']; ?>
</div></td>
			<td width="199"><div align="left">
			<input name="txt_edit" type="text" id="txt_edit" size="30" value="<?php echo $this->_tpl_vars['tpls']['updatetxtlvalue']; ?>
" class="textBox" maxlength="40">
			</div>			</td>
			</tr>
			
			<tr>
			<td width="104" class="contentLeft"><div><?php echo $this->_tpl_vars['tpls']['preference']; ?>
</div></td>
			<td width="199"><div align="left">
			<input name="txt_preference" type="text" id="txt_preference" size="10" value="<?php echo $this->_tpl_vars['tpls']['updateprefervalue']; ?>
" class="nummberOnly"  maxlength="10">
			</div>			</td>
			</tr>
			
			<tr>
			<td>&nbsp;</td>
			<td><div align="left">
			<input name="btn_edit" type="submit" valtype="emptyCheck-Please enter a value" id="btn_edit" value="<?php echo $this->_tpl_vars['tpls']['updatebtnvalue']; ?>
" class="butsubmit" onClick="return validate_edit();">
			&nbsp;
			<input name="btn_editcancel"  type="submit" id="btn_editcancel" value="<?php echo $this->_tpl_vars['tpls']['btnupdatecancelvalue']; ?>
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
	<?php endif; ?>
	<?php endif; ?>
	<?php if ($_REQUEST['add'] == "" && $_REQUEST['edit'] == ""): ?>
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
									<td><strong> <?php echo $this->_tpl_vars['tpls']['spage']->startingRow; ?>
 - <?php echo $this->_tpl_vars['tpls']['spage']->endingRow; ?>
  </strong> of <strong><?php echo $this->_tpl_vars['tpls']['spage']->totcnt; ?>
 </strong></td>
									
									
									<td><?php echo $this->_tpl_vars['tpls']['listcaption']; ?>
</td>
									<td>
									<input type="text" name="txt_search" value="<?php echo $_REQUEST['searchq']; ?>
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
										<?php if ($this->_tpl_vars['cls_site']->permissionCheck('Add')): ?>
											<input name="add_btn" type="submit" id="add_btn" value="<?php echo $this->_tpl_vars['tpls']['addbtnvalue']; ?>
" class="butsubmit" >
										<?php endif; ?>
										<?php if ($this->_tpl_vars['tpls']['parentpagevar']): ?> 
											&nbsp;
											<input name="btn_parent" type="submit" class="butsubmit" id="btn_parent" value="<?php echo $this->_tpl_vars['tpls']['parentBtnBack']; ?>
" onClick="">
											<?php endif; ?>
									 </div>
									
					
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				<?php if ($this->_tpl_vars['tpls']['dataarray'] && $this->_tpl_vars['cls_site']->permissionCheck('View')): ?>
					<tr>
					<td align="center" valign="middle">
						
						<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr>
						<th align="left" width="10"><!--<input name="checkall" type="checkbox" id="checkall" onClick="return checkAll()" value="CHKALL"> --></th>
						<th align="left"><div align="center"><?php echo $this->_tpl_vars['tpls']['listcaption']; ?>
</div></th>
						
						<th align="left"><div align="center"><?php echo $this->_tpl_vars['tpls']['preference']; ?>
</div></th>
						
						<th align="left"><div align="center"><?php echo $this->_tpl_vars['tpls']['listoptions']; ?>
</div></th>
						
						
						</tr>
						<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['start'] = (int)0;
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['tpls']['dataarray']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
if ($this->_sections['i']['start'] < 0)
    $this->_sections['i']['start'] = max($this->_sections['i']['step'] > 0 ? 0 : -1, $this->_sections['i']['loop'] + $this->_sections['i']['start']);
else
    $this->_sections['i']['start'] = min($this->_sections['i']['start'], $this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] : $this->_sections['i']['loop']-1);
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = min(ceil(($this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] - $this->_sections['i']['start'] : $this->_sections['i']['start']+1)/abs($this->_sections['i']['step'])), $this->_sections['i']['max']);
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
						<tr>
						<td align="left" width="10"><!--<input name="checkone[]" type="checkbox" id="checkone" value="<?php echo $this->_tpl_vars['tpls']['dataarray'][$this->_sections['i']['index']][$this->_tpl_vars['tpls']['table']['primary']]; ?>
"> --></td>
						<td width="200" align="left">
						<?php if ($this->_tpl_vars['tpls']['childpagename']): ?>
						<a href="<?php echo $this->_tpl_vars['tpls']['childpagename']; ?>
?<?php echo $this->_tpl_vars['tpls']['childpagevar']; ?>
=<?php echo $this->_tpl_vars['tpls']['dataarray'][$this->_sections['i']['index']][$this->_tpl_vars['tpls']['table']['primary']]; ?>
"><?php echo $this->_tpl_vars['tpls']['dataarray'][$this->_sections['i']['index']][$this->_tpl_vars['tpls']['table']['name']]; ?>
</a>
						<?php else: ?>
						<?php echo $this->_tpl_vars['tpls']['dataarray'][$this->_sections['i']['index']][$this->_tpl_vars['tpls']['table']['name']]; ?>

						<?php endif; ?>			</td>
						
						<td>
							<?php echo $this->_tpl_vars['tpls']['dataarray'][$this->_sections['i']['index']][$this->_tpl_vars['tpls']['table']['prference']]; ?>

						</td>
						
						<td width="100" align="left">
						
						<?php if ($this->_tpl_vars['tpls']['childpagename']): ?>
						&nbsp;&nbsp;
						<a href="<?php echo $this->_tpl_vars['tpls']['childpagename']; ?>
?<?php echo $this->_tpl_vars['tpls']['childpagevar']; ?>
=<?php echo $this->_tpl_vars['tpls']['dataarray'][$this->_sections['i']['index']][$this->_tpl_vars['tpls']['table']['primary']]; ?>
" title="Click here to view the details of <?php echo $this->_tpl_vars['tpls']['dataarray'][$this->_sections['i']['index']][$this->_tpl_vars['tpls']['table']['name']]; ?>
">
						<img src="images/inner_details.png" border="0"  width="20" height="20">
						</a>
						<?php endif; ?>
						
						<?php if ($this->_tpl_vars['cls_site']->permissionCheck('Edit')): ?>
						&nbsp;&nbsp;
						<a href="<?php echo $this->_tpl_vars['tpls']['pagename']; ?>
?edit=<?php echo $this->_tpl_vars['tpls']['dataarray'][$this->_sections['i']['index']][$this->_tpl_vars['tpls']['table']['primary']]; ?>
<?php if ($this->_tpl_vars['tpls']['parentpagevar']): ?>&<?php echo $this->_tpl_vars['tpls']['parentpagevar']; ?>
=<?php echo $this->_tpl_vars['tpls']['parentpagevarval']; ?>
<?php endif; ?>">
						<img src="images/edit.gif" border="0" title="Click here to edit">	
						</a>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['cls_site']->permissionCheck('Status')): ?>
						<?php if ($this->_tpl_vars['tpls']['dataarray'][$this->_sections['i']['index']][$this->_tpl_vars['tpls']['table']['status']] == '1'): ?>
						&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['tpls']['pagename']; ?>
?statuschange=<?php echo $this->_tpl_vars['tpls']['dataarray'][$this->_sections['i']['index']][$this->_tpl_vars['tpls']['table']['primary']]; ?>
<?php if ($this->_tpl_vars['tpls']['parentpagevar']): ?>&<?php echo $this->_tpl_vars['tpls']['parentpagevar']; ?>
=<?php echo $this->_tpl_vars['tpls']['parentpagevarval']; ?>
<?php endif; ?>">
						<img src="images/active.gif" border="0" title="Click here inactivate"></a>
						<?php else: ?>
						&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['tpls']['pagename']; ?>
?statuschange=<?php echo $this->_tpl_vars['tpls']['dataarray'][$this->_sections['i']['index']][$this->_tpl_vars['tpls']['table']['primary']]; ?>
<?php if ($this->_tpl_vars['tpls']['parentpagevar']): ?>&<?php echo $this->_tpl_vars['tpls']['parentpagevar']; ?>
=<?php echo $this->_tpl_vars['tpls']['parentpagevarval']; ?>
<?php endif; ?>">
						<img src="images/inactive.gif" border="0" title="Click here to activate"></a>
						<?php endif; ?>	
						<?php endif; ?>		
						</td>
						
						
						
						</tr>
						<?php endfor; endif; ?>
						<?php if ($this->_tpl_vars['tpls']['paging']): ?>	
						<tr><td colspan="4" align="center"><div align="center"><?php echo $this->_tpl_vars['tpls']['paging']; ?>
</div></td></tr>
						<?php endif; ?>
						</table>
						
						</td>
					</tr>
					<?php else: ?>
					<?php if ($_REQUEST['add'] == "" && $_REQUEST['edit'] == ""): ?>
					<tr>
					<td class="errorMessage"><div align="center"><strong><?php echo $this->_tpl_vars['tpls']['norecords']; ?>
</strong></div></td>
					</tr>	
					<?php endif; ?>

					<?php endif; ?>
				</table>
				</form>
			</td>
		</tr>
	<?php endif; ?>
	
  </table>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
