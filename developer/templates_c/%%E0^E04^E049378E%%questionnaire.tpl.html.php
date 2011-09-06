<?php /* Smarty version 2.6.19, created on 2011-02-07 19:42:45
         compiled from questionnaire.tpl.html */ ?>
<?php echo '
<script type="text/javascript">
$(document).ready(function(){
	$("#question").tooltip();
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
	<td class="pageHead"><span id="question"><strong><?php if (( $this->_tpl_vars['obj']->currentAction == 'Editform' )): ?>Edit<?php endif; ?><?php if (( $this->_tpl_vars['obj']->currentAction == 'Addform' )): ?>Add<?php endif; ?> Questionaire </strong></span></td>
</tr>
<?php if (( $this->_tpl_vars['obj']->currentAction == 'Editform' )): ?>
<?php if ($this->_tpl_vars['obj']->permissionCheck('Edit')): ?>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
			
				<th colspan="2">Questionaire</th>
			</tr>
			<tr>
				<td width="140">Question</td>
				<td><TEXTAREA  name="question" valtype="emptyCheck-Please enter a question"  class="validateText" COLS=40 ROWS=6><?php echo $this->_tpl_vars['actionReturn']['data']['question']; ?>
</TEXTAREA></td>
			</tr>
			<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['actionReturn']['data']['id']; ?>
"/>
			<tr><td>Answer</td></tr>
			<?php $_from = $this->_tpl_vars['actionReturn']['data2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data3']):
        $this->_foreach['i']['iteration']++;
?>
			<tr><td></td><td><TEXTAREA valtype="emptyCheck-Please enter an answer" name="<?php echo $this->_tpl_vars['data3']['id']; ?>
" class="validateText" COLS=40 ROWS=3><?php echo $this->_tpl_vars['data3']['options']; ?>
</TEXTAREA></td></tr>
			<?php endforeach; endif; unset($_from); ?>
			<?php if ($this->_tpl_vars['obj']->currentAction == 'Editform'): ?>
			<tr>
				<td >Choice</td>
				<td >
				<select name="choice">						
					<option value="1" <?php if ($this->_tpl_vars['actionReturn']['data']['choice'] == 1): ?> Selected <?php endif; ?>>Single choice</option>
					<option value="2" <?php if ($this->_tpl_vars['actionReturn']['data']['choice'] == 2): ?> Selected <?php endif; ?>>Multiple choice</option>
				</select>
				
				</td>
			</tr>
			<?php endif; ?>
			
			<tr>
				<td>&nbsp;</td>
				<td>
				<?php if ($this->_tpl_vars['obj']->currentAction == 'Editform'): ?>
					<?php if ($this->_tpl_vars['obj']->permissionCheck('Edit')): ?>
					<input type="submit" class="butsubmit" valcheck="true"  name="actionvar" value="Update" id="saveDataId" />
				<?php endif; ?> <?php endif; ?>
					<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
			<?php endif; ?>	
				</td>
			</tr>
		</table>
	</td>
</tr>	
<?php endif; ?>

<!--this is the ad ne form-->
<?php if (( $this->_tpl_vars['obj']->currentAction == 'Addform' )): ?>
<?php if ($this->_tpl_vars['obj']->permissionCheck('Add')): ?>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
			
				<th colspan="2">Questionaire</th>
			</tr>
			<tr>
				<td width="100px">Question</td>
				<td><TEXTAREA valtype="emptyCheck-Please enter a question" name="question" class="validateText"  COLS=40 ROWS=6><?php echo $this->_tpl_vars['actionReturn']['data']['question']; ?>
</TEXTAREA></td>
			</tr>
			<tr><td>Answer</td></tr>
			
			<tr><td></td><td><TEXTAREA  valtype="emptyCheck-Please enter an answer" name="ans1" class="validateText" COLS=40 ROWS=3></TEXTAREA></td></tr>
			<tr><td></td><td><TEXTAREA  valtype="emptyCheck-Please enter an answer" name="ans2"  class="validateText" COLS=40 ROWS=3></TEXTAREA></td></tr>
			<tr><td></td><td><TEXTAREA valtype="emptyCheck-Please enter an answer" name="ans3"  class="validateText" COLS=40 ROWS=3></TEXTAREA></td></tr>
			<tr><td></td><td><TEXTAREA valtype="emptyCheck-Please enter an answer" name="ans4"  COLS=40 ROWS=3></TEXTAREA></td></tr>
			
			<tr>
				<td >Choice</td>
				<td >
				<select name="choice">	
				<option value="1">Single Choice</option>
				<option value="2">Multiple Choice</option>
				</select>
				
				</td>
			</tr>
			
			
			<tr>
				<td>&nbsp;</td>
				<td>
				<?php if ($this->_tpl_vars['obj']->currentAction == 'Addform'): ?>
					
					<input type="submit" valcheck="true"  class="butsubmit"  name="actionvar" value="Save" id="saveDataId" />
				<?php endif; ?>
					<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
				</td>
			</tr>
		</table>
	</td>
</tr>	
<?php endif; ?>
<?php endif; ?>
<!--this is the ad ne form-->

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
							<td>Viewing  <strong> <?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow; ?>
 - <?php echo $this->_tpl_vars['actionReturn']['spage']->endingRow; ?>
 </strong> 
							of <strong><?php echo $this->_tpl_vars['actionReturn']['spage']->totcnt; ?>
 </strong>  </td>
							
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
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=question&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Question<?php echo $this->_tpl_vars['obj']->getSortImage('question',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a></th>
							<th>Answer</th>
								<th>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=choice&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Choice
<?php echo $this->_tpl_vars['obj']->getSortImage('choice',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

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
							<td><?php echo $this->_tpl_vars['data']['question']; ?>
</td>
							<td>
								<?php $_from = $this->_tpl_vars['data']['answers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['data1']):
?>
								<?php echo $this->_tpl_vars['obj']->getLimitedText($this->_tpl_vars['data1']['options'],50); ?>
 <br />
								<?php endforeach; endif; unset($_from); ?>
							</td>
							<td><?php if ($this->_tpl_vars['data']['choice'] == 1): ?> Single<?php else: ?> Multiple<?php endif; ?></td>
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Status')): ?>
					<a href="<?php echo $this->_tpl_vars['obj']->getLink('Statuschange','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
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
" class="Second_link">
							<img src="images/edit.gif" border="0" title="Click here to edit">							
							</a> 
								<?php endif; ?>				
							</td>
						</tr>
					<?php endforeach; endif; unset($_from); ?>
					<tr>
						<td>
						
						
						 
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

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
