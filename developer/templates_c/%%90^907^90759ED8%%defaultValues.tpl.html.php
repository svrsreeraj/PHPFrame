<?php /* Smarty version 2.6.19, created on 2011-01-22 01:18:06
         compiled from defaultValues.tpl.html */ ?>
<?php $this->assign('actionReturn', $this->_tpl_vars['obj']->actionReturn); ?>
<?php echo '
<script type="text/javascript">
function getcombo(cid,changeId)
	{
		$.ajax({
			   type	: "GET",
			   url	: "defaultValues.php",
			   data	: "actionvar=Getcombo&id="+cid,
			   dataType: "html",
			   success: function(msg){
				   $("#"+changeId).html(msg);
				}
			 });
	}
</script>

<link type="text/css" href="js/ui/themes/base/jquery.ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="js/ui/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/ui/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="js/ui/ui/jquery.ui.datepicker.js"></script>

'; ?>

<form action="" name="fromName" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">
<?php if ($this->_tpl_vars['obj']->getPageError()): ?>
<tr>
	<td class="errorMessage"><?php echo $this->_tpl_vars['obj']->popPageError(); ?>
</td>
</tr>
<?php endif; ?>
<tr>
	<td class="pageHead"><strong>Default Values</strong></td>
</tr>
<?php if (( $this->_tpl_vars['obj']->currentAction == 'Addform' ) || ( $this->_tpl_vars['obj']->currentAction == 'Editform' )): ?>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
		
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				<th colspan="2">Add Defaults</th>
			</tr>
			
			<tr>
				<td width="150" >
					Caption
				</td>
				<td><input size="70"  type="text" valtype="emptyCheck-please enter caption" name="caption" value="<?php echo $this->_tpl_vars['actionReturn']['data']['caption']; ?>
" id="captionId" class="validateText"/></td>
			</tr>
			<tr>
				<td>Group</td>
				<td><?php echo $this->_tpl_vars['actionReturn']['combo']; ?>
</td>
			</tr>
			<?php if (( $this->_tpl_vars['obj']->currentAction == 'Addform' )): ?>
			<tr>
				<td>Name</td>
				<td><input type="text" size="70"  name="name"  valtype="emptyCheck-please enter name" value="<?php echo $this->_tpl_vars['actionReturn']['data']['name']; ?>
" id="nameId" /></td>
			</tr>
			<?php endif; ?>
			<tr>
				<td>Value</td>
				<td>
				<textarea  name="value" id="valueId" valtype="emptyCheck-Please enter value"  cols="52" rows="5"><?php echo $this->_tpl_vars['actionReturn']['data']['value']; ?>
</textarea>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
				<?php if ($this->_tpl_vars['obj']->currentAction == 'Editform'): ?>
				<?php if ($this->_tpl_vars['obj']->permissionCheck('Edit')): ?>
					<input type="submit" class="butsubmit" valcheck="true" name="actionvar" value="Update" id="saveDataId" />
					<?php endif; ?>
				<?php else: ?>
					<?php if ($this->_tpl_vars['obj']->permissionCheck('Add')): ?>
					<input type="submit" class="butsubmit" valcheck="true"   name="actionvar" value="Save" id="saveDataId" />
					<?php endif; ?>
				<?php endif; ?>
					<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
				</td>
			</tr>
		</table>
		
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
					
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
							<td>  <strong> <?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow; ?>
 - <?php echo $this->_tpl_vars['actionReturn']['spage']->endingRow; ?>
  </strong> of <strong><?php echo $this->_tpl_vars['actionReturn']['spage']->totcnt; ?>
 </strong></td>
							<td>Default Group:</td>
							<td>
								<?php echo $this->_tpl_vars['actionReturn']['searchdata']['searchCombo']; ?>

							</td>
							<td>
							<input type="text" name="keyword" maxlength="25" id="id_keyword" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['keyword']; ?>
" />
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
					
					
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
			<tr>
				<td align="center" valign="middle">
				
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">	
							<th <?php if ($this->_tpl_vars['obj']->permissionCheck('Delete')): ?> width="80" <?php endif; ?>>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Delete')): ?>
								<input type="checkbox" name="checkall" id="id_check_all" >
								<?php endif; ?>
							</th>				
							<th>No</th>
							<th style="text-align:left;">
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=d.caption&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Caption
								<?php echo $this->_tpl_vars['obj']->getSortImage('d.caption',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
							</th>
							<th style="text-align:left;">
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=d.value&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Value
								<?php echo $this->_tpl_vars['obj']->getSortImage('d.value',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
							</th>
							<th style="text-align:left;">
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=d.name&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Name
								<?php echo $this->_tpl_vars['obj']->getSortImage('d.name',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

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
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Delete')): ?>
								<input type="checkbox" name="checkone[]" value="<?php echo $this->_tpl_vars['data']['id']; ?>
" >
							<?php endif; ?>
							</td>
							<td style="text-align:left;"><?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow+($this->_foreach['i']['iteration']-1); ?>
</td>
							<td style="text-align:left;"><?php echo $this->_tpl_vars['obj']->getLimitedText($this->_tpl_vars['data']['caption'],50); ?>
</td>
							<td style="text-align:left;">
							<!--<a onmouseover="return escape('<?php echo $this->_tpl_vars['data']['value']; ?>
')">-->
							<?php echo $this->_tpl_vars['obj']->getLimitedText($this->_tpl_vars['data']['value'],30); ?>

							<!--</a>-->
							</td>
							<td style="text-align:left;"><?php echo $this->_tpl_vars['obj']->getLimitedText($this->_tpl_vars['data']['name'],100); ?>
</td>
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Edit')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('editform','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link">
							<img src="images/edit.gif" alt="edit" border='0' titile="Click here to edit">
							</a> 
							<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; endif; unset($_from); ?>
					<tr>
						<td>
						<?php if ($this->_tpl_vars['obj']->permissionCheck('Delete')): ?>
						<input class="butsubmit" value="Delete" type="submit" name="actionvar" id="id_btn_delete"> 
						<?php endif; ?>
						</td>
						<td colspan="5"><?php echo $this->_tpl_vars['actionReturn']['spage']->s_get_links(); ?>
</td>
					</tr>
				</table>
			
				</td>
			</tr>
		<?php endif; ?>
		
		</table>

	</td>
	<?php endif; ?>
</tr>
</table>
</form>
<?php echo '

<script type="text/javascript" src="js/tooltip.js"></script>		
'; ?>


<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
