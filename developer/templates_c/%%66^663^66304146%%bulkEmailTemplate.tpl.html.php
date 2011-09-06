<?php /* Smarty version 2.6.19, created on 2011-02-18 12:48:29
         compiled from bulkEmailTemplate.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', 'bulkEmailTemplate.tpl.html', 138, false),)), $this); ?>
<script type="text/javascript" src="../libs/ckeditor_3.5.1/ckeditor.js"></script>
<?php $this->assign('actionReturn', $this->_tpl_vars['obj']->actionReturn); ?>
<form action="" name="formName" method="post" enctype="multipart/form-data" id="bulkemail">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">
<tr>
	<td class="pageHead"><strong>Bulk Email Templates </strong></td>
</tr>

<?php if ($this->_tpl_vars['obj']->getPageError()): ?>
<tr>
	<td class="errorMessage"><?php echo $this->_tpl_vars['obj']->popPageError(); ?>
</td>
</tr>
<?php endif; ?>


<?php if (( $this->_tpl_vars['obj']->currentAction == 'Addform' ) || ( $this->_tpl_vars['obj']->currentAction == 'Editform' )): ?>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>

		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				<th colspan="2">Manage Template</th>
			</tr>
			
			<tr>
				<td width="150">Template Category</td>
				<td><?php echo $this->_tpl_vars['actionReturn']['data']['tempcombo']; ?>
</td>
			</tr>
		
			<tr>
				<td width="150">Subject</td>
				<td><input type="text" name="title" valtype="emptyCheck-please enter a title"  value="<?php echo $this->_tpl_vars['actionReturn']['data']['title']; ?>
" id="captionId" size="50" class="validateText"/></td>
			</tr>
			<tr>
				<td>Template</td>
				<td>
								<textarea name="template" cols="75" rows="50" id="template"><?php echo $this->_tpl_vars['actionReturn']['data']['template']; ?>
</textarea>
				</td>
			</tr>
			
			<tr>
				<td>&nbsp;</td>
				<td>
				<?php if ($this->_tpl_vars['obj']->currentAction == 'Editform'): ?>
					<input type="submit" valcheck="true" class="butsubmit"  name="actionvar" value="Update" id="saveDataId" />
				<?php else: ?>
					<input type="submit" valcheck="true" class="butsubmit"  name="actionvar" value="Save" id="saveDataId" />
				<?php endif; ?>
					<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
				</td>
			</tr>
		</table>
	
	</td>
</tr>	
<?php endif; ?>

<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
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
						<td> <strong> <?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow; ?>
 - <?php echo $this->_tpl_vars['actionReturn']['spage']->endingRow; ?>
  </strong> of <strong><?php echo $this->_tpl_vars['actionReturn']['spage']->totcnt; ?>
 </strong> </td>							
						<td>Template Category:</td>
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
							<th>No</th>
							<th>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=temp_cat_id&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Category
								<?php echo $this->_tpl_vars['obj']->getSortImage('temp_cat_id',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
							</th>
							<th>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=title&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Subject
								<?php echo $this->_tpl_vars['obj']->getSortImage('title',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
							</th>
							
							<th>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=template&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Template
								<?php echo $this->_tpl_vars['obj']->getSortImage('template',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

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
							<td><?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow+($this->_foreach['i']['iteration']-1); ?>
</td>
							<td><?php echo $this->_tpl_vars['obj']->checkfields('vod_bulk_email_tpl_category','id',$this->_tpl_vars['data']['temp_cat_id'],'category'); ?>
</td>
							<td><?php echo $this->_tpl_vars['obj']->getLimitedText($this->_tpl_vars['data']['title'],100); ?>
</td>
							<td><?php echo ((is_array($_tmp=$this->_tpl_vars['obj']->getLimitedText($this->_tpl_vars['data']['template'],60))) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
</td>
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Status')): ?> 
<a href="<?php echo $this->_tpl_vars['obj']->getLink('Statuschange','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'],'&status=',$this->_tpl_vars['data']['status'])); ?>
" class="Second_link">
							<?php if ($this->_tpl_vars['data']['status'] == 1): ?> 
							<img src="images/active.gif" border="0" title="Click here to inactivate">
							 <?php else: ?> 							 
							 <img src="images/inactive.gif" border="0" title="Click here to activate">
							 <?php endif; ?>
							 </a> 
							<?php endif; ?>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Edit')): ?> 
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('editform','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link"> <img src="images/edit.gif" border="0" title="Click here to edit"></a> 
							<?php endif; ?> 
							<!--<?php if ($this->_tpl_vars['obj']->permissionCheck('Delete')): ?>
							<a href="#" class="Second_link"><img src="images/delete.gif" border="0" title="Click here to delete"> </a>
							<?php endif; ?>-->
							</td>
						</tr>
					<?php endforeach; endif; unset($_from); ?>
					<tr>
						<td colspan="6"><?php echo $this->_tpl_vars['actionReturn']['spage']->s_get_links(); ?>
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
<?php endif; ?>
</table>
	</form>
<?php echo '
<script type="text/javascript">
CKEDITOR.replace(\'template\');
</script>
<script type="text/javascript">

$(\'#bulkemail\').submit(function() {
var txt = $("#template").val();
});

</script>
'; ?>


<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
