<?php /* Smarty version 2.6.19, created on 2011-01-24 16:09:18
         compiled from subCategory.tpl.html */ ?>
<?php echo '
<script type="text/javascript" src="js/highslide/highslide.js"></script>
<link rel="stylesheet" type="text/css" href="js/highslide/highslide.css" />
<script type="text/javascript">
$(document).ready(function(){
$("#subcat").tooltip();
});
</script>
'; ?>

<?php $this->assign('actionReturn', $this->_tpl_vars['obj']->actionReturn); ?>
<form action="" name="fromName" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">
<?php if ($this->_tpl_vars['obj']->getPageError()): ?>
<tr>
	<td class="errorMessage"><?php echo $this->_tpl_vars['obj']->popPageError(); ?>
</td>
</tr>
<?php endif; ?>
<tr>
	<td class="pageHead"><span id="subcat"><strong><?php if (( $this->_tpl_vars['obj']->currentAction == 'Addform' )): ?>Add <?php endif; ?> <?php if (( $this->_tpl_vars['obj']->currentAction == 'Editform' )): ?>Edit <?php endif; ?>SubCategories </strong></span></td>
</tr>
<?php if (( $this->_tpl_vars['obj']->currentAction == 'Addform' ) || ( $this->_tpl_vars['obj']->currentAction == 'Editform' )): ?>
<?php if (( $this->_tpl_vars['obj']->permissionCheck('Add') ) || ( $this->_tpl_vars['obj']->permissionCheck('Edit') )): ?>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
		<form action="" name="fromName" method="post" enctype="multipart/form-data">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				<th colspan="2">Manage Subcategory</th>
			</tr>
			
			<tr>
				<td width="150">Sub Category</td>
				<td><input type="text" valtype="emptyCheck-Please enter Subcategory " name="subcategory" value="<?php echo $this->_tpl_vars['actionReturn']['data']['subcategory']; ?>
" id="captionId" class="validateText" /></td>
			</tr>
			
			<?php if ($this->_tpl_vars['actionReturn']['combo']): ?>
			<tr>
				<td>Category</td>
				<td><?php echo $this->_tpl_vars['actionReturn']['combo']; ?>
</td>
			</tr>
			<?php endif; ?>
				<tr>
				<td>Image</td>
				<td><input type="file"  name="fileImage" value="<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" id="fileImageId" /> 
				<?php if ($this->_tpl_vars['actionReturn']['data']['image']): ?>
				<a  href="../images/subcategory/<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" class="highslide" onclick="return hs.expand(this)">
				<img src="../images/subcategory/thumb/<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" width="25" height="25"border="0"/>
				</a>
				<?php endif; ?>
				
				</td></tr>
							
			
			
			<tr>
				<td>&nbsp;</td>
				<td>
				<?php if ($this->_tpl_vars['obj']->currentAction == 'Editform'): ?>
					<input type="submit" class="butsubmit" valcheck="true" name="actionvar" value="Update" id="saveDataId" />
				<?php else: ?>
					<input type="submit" class="butsubmit" valcheck="true"  name="actionvar" value="Save" id="saveDataId" />
				<?php endif; ?>
					<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
				</td>
			</tr>
			
		</table>
		</form>
	</td>
</tr>	
<?php endif; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
<tr>
	<?php if ($this->_tpl_vars['obj']->currentAction == 'Listing'): ?>
	<td>
		<form action="" name="fromName" method="post" enctype="multipart/form-data">
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
							<input name="actionvar" type="submit" class="butsubmit" value="Add New" />
							</td>
						</tr>
						
					</table>
					</form>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
			<tr>
				<td align="center" valign="middle">
						<form action="" name="fromName" method="post" enctype="multipart/form-data">

					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">							
							<th>No</th>
							<th>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=vs.subcategory&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								SubCategory
								<?php echo $this->_tpl_vars['obj']->getSortImage('vs.subcategory',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
							</th>
							<th>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=vc.category&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Category
								<?php echo $this->_tpl_vars['obj']->getSortImage('vc.category',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
							</th>
							<th>Image</th>
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
							<td><?php echo $this->_tpl_vars['data']['subcategory']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['category']; ?>
</td>
							<td>
							<a  href="../images/subcategory/<?php echo $this->_tpl_vars['data']['image']; ?>
" class="highslide" onclick="return hs.expand(this)">
							<img src="../images/subcategory/thumb/<?php echo $this->_tpl_vars['data']['image']; ?>
" width="17" height="17" border="0"/>
							</a><div class="highslide-caption"><?php echo $this->_tpl_vars['data']['subcategory']; ?>
</div>							
							</td>
							<td>
						<?php if ($this->_tpl_vars['obj']->permissionCheck('Status')): ?>
					<a href="<?php echo $this->_tpl_vars['obj']->getLink('Stauschange','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link">
					<?php endif; ?>
							<?php if ($this->_tpl_vars['data']['status'] == 1): ?> 
							<img src="images/active.gif" border="0" title="Click here to inactivate">
							 <?php else: ?> 							 
							 <img src="images/inactive.gif" border="0" title="Click here to activate">
							 <?php endif; ?>
					<?php if ($this->_tpl_vars['obj']->permissionCheck('Status')): ?>
					 </a> 
					<?php endif; ?>	 
							
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Edit')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('editform','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link">
							<img src="images/edit.gif" border="0" title="Click here to edit"></a>
							<?php endif; ?>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Delete')): ?>
							<a href="#" class="Second_link"><img src="images/delete.gif" border="0" title="Click here to delete"></a>
							<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; endif; unset($_from); ?>
					<tr>
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
<?php endif; ?>
</table>
</form>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
