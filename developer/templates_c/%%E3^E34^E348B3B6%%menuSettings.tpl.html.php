<?php /* Smarty version 2.6.19, created on 2011-01-24 01:20:09
         compiled from menuSettings.tpl.html */ ?>
<?php echo '
<script type="text/javascript">
$(document).ready(function(){
$("#menusetting").tooltip();
});

</script>
'; ?>

<?php $this->assign('actionReturn', $this->_tpl_vars['obj']->actionReturn); ?>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">

<?php if ($this->_tpl_vars['obj']->getPageError()): ?>
<tr>
	<td class="errorMessage"><?php echo $this->_tpl_vars['obj']->popPageError(); ?>
</td>
</tr>
<?php endif; ?>
<tr>
	<td class="pageHead"><span id="menusetting"><strong>Menu Settings </strong></span></td>
</tr>
<?php if (( $this->_tpl_vars['obj']->currentAction == 'Addform' ) || ( $this->_tpl_vars['obj']->currentAction == 'Editform' )): ?>
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
				<td ><input type="text"  name="menutitle" valtype="emptyCheck-Please enter the Menu Title " value="<?php echo $this->_tpl_vars['actionReturn']['data']['menutitle']; ?>
" id="menutitleId" class="validateText" /></td>
			</tr>			
			<tr>
				<td>Menu Name</td>
				<td><input type="text"  name="menuname" valtype="emptyCheck-Please enter the Menu Name " value="<?php echo $this->_tpl_vars['actionReturn']['data']['menuname']; ?>
" id="menunameId" class="validateText" /></td>
			</tr>
			<?php if ($this->_tpl_vars['obj']->currentAction == 'Editform'): ?>
			<tr>
				<td >Sort Order</td>
				<td >
				<input name="txtpreference" type="text" id="preferenceId" valtype="emptyCheck-Please enter a number|checkNumber-Only numbers are allowed"  size="10" value="<?php echo $this->_tpl_vars['actionReturn']['data']['preference']; ?>
" 
				class="nummberOnly"  maxlength="10">
				</td>
			</tr>
			<?php endif; ?>
			
			<tr>
				<td>&nbsp;</td>
				<td>
				<?php if ($this->_tpl_vars['obj']->currentAction == 'Editform'): ?>
					<?php if ($this->_tpl_vars['obj']->permissionCheck('Edit')): ?>
						<input type="submit" class="butsubmit" valcheck="true"  name="actionvar" value="Update" id="saveDataId" />
					<?php endif; ?>
				<?php else: ?>
					<?php if ($this->_tpl_vars['obj']->permissionCheck('Add')): ?>
						<input type="submit" valcheck="true" class="butsubmit"  name="actionvar" value="Save" id="saveDataId" />
					<?php endif; ?>
				<?php endif; ?>
					<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
				</td>
			</tr>
		</table>
		</form>
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
					<form action="" name="fromName" method="post" enctype="multipart/form-data">
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
							<td>  <strong> <?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow; ?>
 - <?php echo $this->_tpl_vars['actionReturn']['spage']->endingRow; ?>
 </strong> 
							of <strong><?php echo $this->_tpl_vars['actionReturn']['spage']->totcnt; ?>
 </strong> </td>
							
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
&sortField=menutitle&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Title
<?php echo $this->_tpl_vars['obj']->getSortImage('menutitle',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
							
							</th>
							<th>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=menuname&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Name
<?php echo $this->_tpl_vars['obj']->getSortImage('menuname',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
							</th>
							<th>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=preference&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Order
<?php echo $this->_tpl_vars['obj']->getSortImage('preference',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
							</th>
							<th>Enable</th>
							<th>							
							Action 							
							</th>
							

						</tr>
					<?php $_from = $this->_tpl_vars['actionReturn']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
						<tr>
							<td><?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow+($this->_foreach['i']['iteration']-1); ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['menutitle']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['menuname']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['preference']; ?>
</td>
							
							<td>							
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Status')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Enablechange','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link">
							<?php endif; ?>	
								<?php if ($this->_tpl_vars['data']['menable'] == 1): ?> 
								<img src="images/active.gif" border="0" title="Click here to disable the menu">
								<?php else: ?> 							 
								<img src="images/inactive.gif" border="0" title="Click here to enable the menu">
								<?php endif; ?>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Status')): ?> 
							</a> 
							<?php endif; ?>				
							
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
							<img src="images/edit.gif" border="0" title="Click here to edit">
							
							</a>  
							<?php endif; ?>
											
							
							</td>
						</tr>
					<?php endforeach; endif; unset($_from); ?>
					<tr>
						<td colspan="6"><?php echo $this->_tpl_vars['actionReturn']['spage']->s_get_links(); ?>
</td>
					</tr>
				</table>
				</form>
				</td>
			</tr>
		<?php endif; ?>
		
		</table>
		
	</td>
	<?php endif; ?>
</tr>
<?php endif; ?>
</table>


<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
