<?php /* Smarty version 2.6.19, created on 2011-02-07 19:39:25
         compiled from faq.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'strip_tags', 'faq.tpl.html', 189, false),)), $this); ?>
<?php echo '
<script type="text/javascript" src="js/ui/ui/jquery.ui.core.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#faq").tooltip();
$("[valcheck=\'true\']").click(function()
	{
			var oEditor 		= FCKeditorAPI.GetInstance(\'question\') ;
			var jsArticleBody 	= oEditor.GetXHTML(true) ;
			var len				=	jsArticleBody.length;
			var errcount		=	0;
			 if(len==0)
				{
					errcount++;	
					$("#questionerror").html("<span class=\'val_error_alert\'>&nbsp;please enter a question</span>");
					
				}
			var oEditor 		= FCKeditorAPI.GetInstance(\'answer\') ;
			var jsArticleBody 	= oEditor.GetXHTML(true) ;
			var len				=	jsArticleBody.length;
			 if(len==0)
				{
					errcount++;
					$("#answererror").html("<span class=\'val_error_alert\'>&nbsp;please enter an answer</span>");
					
				}	
			if(errcount!=0)
				{
					return false;
				}
	});
	
	});
</script>
'; ?>

<?php $this->assign('actionReturn', $this->_tpl_vars['obj']->actionReturn); ?>
<form action="" name="fromName" method="post" enctype="multipart/form-data" >
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">
<?php if ($this->_tpl_vars['obj']->getPageError()): ?>
<tr>
	<td class="errorMessage"><?php echo $this->_tpl_vars['obj']->popPageError(); ?>
</td>
</tr>
<?php endif; ?>
<tr>
	<td class="pageHead"><span id="faq"><strong> Manage FAQ </strong></span></td>
</tr>
<?php if (( $this->_tpl_vars['obj']->currentAction == 'Addform' ) || ( $this->_tpl_vars['obj']->currentAction == 'Editform' )): ?>

<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				<th colspan="2">Manage FAQ</th>
			</tr>
			<tr>
				<td>FAQ Group</td>
				<td><?php echo $this->_tpl_vars['actionReturn']['faq_combo']; ?>
</td>
			</tr>
			<tr>
				<td>Question</td>
				<td><!--<?php echo $this->_tpl_vars['obj']->get_fck('question',$this->_tpl_vars['actionReturn']['data']['question']); ?>
-->
				
				<textarea id="questionId" name="question" rows="5" cols="50"/><?php echo $this->_tpl_vars['actionReturn']['data']['question']; ?>
</textarea>
				</td>
			</tr>
			<tr><td></td><td id="questionerror"></td></tr>
			<tr>
				<td>Answer</td>
				<td>
				
				<textarea id="answerId" name="answer" rows="5" cols="50"/><?php echo $this->_tpl_vars['actionReturn']['data']['answer']; ?>
</textarea>
				
				<!--<?php echo $this->_tpl_vars['obj']->get_fck('answer',$this->_tpl_vars['actionReturn']['data']['answer']); ?>
	-->
				
				</td>
			</tr>
			<tr><td></td> <td id="answererror"></td></tr>
			<?php if ($this->_tpl_vars['obj']->currentAction == 'Editform'): ?>
			<tr>
				<td >Sort Order</td>
				<td >
				<input name="txtpreference" type="text" valtype="checkNumber-Please enter a number" id="preferenceId" size="10" value="<?php echo $this->_tpl_vars['actionReturn']['data']['preference']; ?>
"
				class="textBox" maxlength="40">
				</td>
			</tr>
			<?php endif; ?>
			
			<tr>
				<td>&nbsp;</td>
				<td>
				<?php if ($this->_tpl_vars['obj']->currentAction == 'Editform'): ?>
					<?php if ($this->_tpl_vars['obj']->permissionCheck('Edit')): ?>
					<input type="submit" class="butsubmit" valcheck="true" name="actionvar" value="Update" id="saveDataId" />
					<?php endif; ?>
				<?php else: ?>
					<?php if ($this->_tpl_vars['obj']->permissionCheck('Add')): ?>
					<input type="submit" class="butsubmit" valcheck="true" name="actionvar" value="Save" id="saveDataId" />
					<?php endif; ?>
				<?php endif; ?>
					<input type="submit" valcheck="faq" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
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
 </strong> 
							of <strong><?php echo $this->_tpl_vars['actionReturn']['spage']->totcnt; ?>
 </strong>  </td>
							<td>FAQ Group:</td>
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
			<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
			<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
			<tr>
				<td align="center" valign="middle">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">							
							<th  <?php if ($this->_tpl_vars['obj']->permissionCheck('Delete')): ?> width="70" <?php endif; ?>>
								<?php if ($this->_tpl_vars['obj']->permissionCheck('Delete')): ?>
								<input type="checkbox" name="checkall" id="id_check_all" >
								<?php endif; ?>
							</th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=fg.group&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Faq Group<?php echo $this->_tpl_vars['obj']->getSortImage('fg.group',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
</a></th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=f.question&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Question<?php echo $this->_tpl_vars['obj']->getSortImage('f.question',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a></th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=f.answer&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Answer<?php echo $this->_tpl_vars['obj']->getSortImage('f.answer',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a></th>
								<th>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=f.preference&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Order
<?php echo $this->_tpl_vars['obj']->getSortImage('f.preference',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

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
							<td><?php echo $this->_tpl_vars['data']['group']; ?>
</td>
							<td><?php echo ((is_array($_tmp=$this->_tpl_vars['obj']->getLimitedText($this->_tpl_vars['data']['question'],80))) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
</td>
							<td><?php echo ((is_array($_tmp=$this->_tpl_vars['obj']->getLimitedText($this->_tpl_vars['data']['answer'],80))) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['preference']; ?>
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
		<?php endif; ?>
		
		</table>
	</td>
	<?php endif; ?>
	
</tr>
</table>
</form>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
