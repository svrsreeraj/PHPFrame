<?php /* Smarty version 2.6.19, created on 2011-01-25 18:15:22
         compiled from pageSettings.tpl.html */ ?>
<?php $this->assign('actionReturn', $this->_tpl_vars['obj']->actionReturn); ?>
<?php echo '
<script type="text/javascript">
	$(document).ready(function(){
	$("#pagesetting").tooltip();
});
</script>
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
	<td class="pageHead"><span id="pagesetting"><strong>Page Settings </strong></span></td>
</tr>

<?php if (( $this->_tpl_vars['obj']->currentAction == 'Editform' ) || ( $this->_tpl_vars['obj']->currentAction == 'Addform' )): ?>

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
				<td><?php echo $this->_tpl_vars['actionReturn']['combo']; ?>
</td>
			</tr>
			<tr>
				<td>Page Name</td>
				<td><input type="text"  name="page" valtype="emptyCheck-Please enter a page name" value="<?php echo $this->_tpl_vars['actionReturn']['data']['page']; ?>
" id="pageId"  size="60" /></td>
			</tr>			
			<tr>
				<td>Page Title</td>
				<td><input type="text"  name="pagetitle" valtype="emptyCheck-Please enter  a page title" value="<?php echo $this->_tpl_vars['actionReturn']['data']['pagetitle']; ?>
" id="pagetitleId" size="60" class="validateText"/></td>
			</tr>
			<tr>
				<td>Description</td>
				<td align="left">
				
				<textarea name="description" cols="45" rows="3" 
				id="descriptionId" valtype="emptyCheck-Please enter a description" ><?php echo $this->_tpl_vars['actionReturn']['data']['description']; ?>
</textarea>
				</td>
			</tr>
			<?php if ($this->_tpl_vars['obj']->currentAction == 'Addform'): ?>		
			<?php if ($this->_tpl_vars['actionReturn']['actionArr']): ?>
			<tr>
				<td>Page Options</td>
				<td align="left">
				<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['actionReturn']['actionArr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
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
				<input type="checkbox" name="actions[]" id="add" value="<?php echo $this->_tpl_vars['actionReturn']['actionArr'][$this->_sections['i']['index']]['id']; ?>
" />
				<?php echo $this->_tpl_vars['actionReturn']['actionArr'][$this->_sections['i']['index']]['action']; ?>
   
				<?php endfor; endif; ?>
				</td>
			</tr>			
			<?php endif; ?>
			<?php endif; ?>
			
			<?php if ($this->_tpl_vars['obj']->currentAction == 'Editform'): ?>			
			<tr>
				<td >Sort Order</td>
				<td >
				<input name="txtpreference" type="text" valtype="checkNumber-Please enter a number" id="preferenceId" size="10" value="<?php echo $this->_tpl_vars['actionReturn']['data']['preference']; ?>
" 
				class="nummberOnly"  maxlength="10">
				</td>
			</tr>
			
			<?php if ($this->_tpl_vars['actionReturn']['actions']): ?>
			<tr>
				<td>Page Options Remaining</td>
				<td align="left">
				<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['actionReturn']['actions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
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
				<input type="checkbox" name="actions[]" id="edit" value="<?php echo $this->_tpl_vars['actionReturn']['actions'][$this->_sections['i']['index']]['id']; ?>
" />
				<?php echo $this->_tpl_vars['actionReturn']['actions'][$this->_sections['i']['index']]['action']; ?>
  
				<?php endfor; endif; ?>
				</td>
			</tr>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['actionReturn']['actionSel']): ?> 
			<tr>
				<td>Page Options Selected</td>
				<td align="left">
				
				<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['actionReturn']['actionSel']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
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
				
					
					<?php echo $this->_tpl_vars['actionReturn']['actionSel'][$this->_sections['j']['index']]['action']; ?>
  <?php if (! $this->_sections['j']['last']): ?>,<?php endif; ?>

				<?php endfor; endif; ?>
				</td>
			</tr> 
			<?php endif; ?>
			<?php endif; ?>	
			
				
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
							<td>Menus:</td>
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
			
			
			<?php if ($this->_tpl_vars['obj']->permissionCheck('view')): ?>
			<?php if ($this->_tpl_vars['actionReturn']['data']): ?> 
					<tr>
						<td align="center" valign="middle">
							<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
								<tr align="center" valign="middle">							
									<th>No</th>									
									<th>
									<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=p.pagetitle&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Title
<?php echo $this->_tpl_vars['obj']->getSortImage('p.pagetitle',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
									</th>
									<th>
									<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=p.page&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Page
<?php echo $this->_tpl_vars['obj']->getSortImage('p.page',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
									</th>							
									<th>
									<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=m.menutitle&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Menu
<?php echo $this->_tpl_vars['obj']->getSortImage('m.menutitle',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
								</th>
									<th>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=p.preference&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
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
								<td><?php echo $this->_tpl_vars['data']['pagetitle']; ?>
</td>
								<td><?php echo $this->_tpl_vars['data']['page']; ?>
</td>
								<td><?php echo $this->_tpl_vars['data']['menutitle']; ?>
</td>
								<td><?php echo $this->_tpl_vars['data']['preference']; ?>
</td>
							
							<td>							
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Status')): ?>
<a href="<?php echo $this->_tpl_vars['obj']->getLink('Enablechange','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link">
<?php endif; ?>
							<?php if ($this->_tpl_vars['data']['penable'] == 1): ?> 
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
							<td colspan="7"><?php echo $this->_tpl_vars['actionReturn']['spage']->s_get_links(); ?>
</td>
							</tr>
						</table>
						</td>
					</tr>
			<?php endif; ?>
			<?php endif; ?>
		</table>
	</td>
	<?php endif; ?>
</tr>

</table>
</form>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>