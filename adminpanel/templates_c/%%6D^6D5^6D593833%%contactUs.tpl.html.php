<?php /* Smarty version 2.6.19, created on 2011-02-07 18:18:44
         compiled from contactUs.tpl.html */ ?>
<?php $this->assign('actionReturn', $this->_tpl_vars['obj']->actionReturn); ?>
<?php echo '
<script type="text/javascript">
$(document).ready(function(){
$("#contactus").tooltip();
});
</script>
'; ?>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">
<form action="" name="fromName" method="post" enctype="multipart/form-data">
<?php if ($this->_tpl_vars['obj']->getPageError()): ?>
<tr>
	<td class="errorMessage"><?php echo $this->_tpl_vars['obj']->popPageError(); ?>
</td>
</tr>
<?php endif; ?>
<tr>
	<td class="pageHead"><span id="contactus"><strong> Contact Us  </strong></span></td>
</tr>

<?php if (( $this->_tpl_vars['obj']->currentAction == 'Editform' )): ?>
<?php if ($this->_tpl_vars['obj']->permissionCheck('Reply')): ?>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				<th colspan="2">Reply Message</th>
			</tr>
			<?php if ($this->_tpl_vars['actionReturn']['data']['name']): ?>
			<tr>
				<td>Name </td>
				<td><?php echo $this->_tpl_vars['actionReturn']['data']['name']; ?>
</td>
			</tr>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['actionReturn']['data']['email']): ?>
			<tr>
				<td>Email </td>
				<td><?php echo $this->_tpl_vars['actionReturn']['data']['email']; ?>
</td>
			</tr>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['actionReturn']['data']['phone']): ?>
			<tr>
				<td>Phone</td>
				<td><?php echo $this->_tpl_vars['actionReturn']['data']['phone']; ?>
</td>
			</tr>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['actionReturn']['data']['subject']): ?>
			
			<tr>
				<td>Subject</td>
				<td><?php echo $this->_tpl_vars['actionReturn']['data']['subject']; ?>
</td>
			</tr>

			<?php endif; ?>
			<?php if ($this->_tpl_vars['actionReturn']['data']['message']): ?>
			<tr>
				<td>Message</td>
				<td><?php echo $this->_tpl_vars['actionReturn']['data']['message']; ?>
</td>
			</tr>
			<?php endif; ?>
			
			<tr>
				<td>Reply message</td>
				<td><textarea  name="reply_message" id="reply_messageId" ><?php echo $this->_tpl_vars['actionReturn']['data']['reply_message']; ?>
</textarea></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>					
					<input type="submit" class="butsubmit"  name="actionvar" value="Send" id="saveDataId" />								
				
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
							<td><strong> <?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow; ?>
 - <?php echo $this->_tpl_vars['actionReturn']['spage']->endingRow; ?>
  </strong> of <strong><?php echo $this->_tpl_vars['actionReturn']['spage']->totcnt; ?>
 </strong> </td>							
							<td>Search
							<input type="text" name="keyword" maxlength="25" id="id_keyword" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['keyword']; ?>
" />
							</td>
							<td>
							<input name="actionvar" type="submit" class="butsubmit" value="Search" />
							</td>
							<td>
							<input name="actionvar" type="submit" class="butsubmit" value="Reset" />
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
&sortField=name&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Name
								<?php echo $this->_tpl_vars['obj']->getSortImage('name',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
							</th>
							<th>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=email&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Email
								<?php echo $this->_tpl_vars['obj']->getSortImage('email',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
							</th>
							<th>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=subject&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Subject
								<?php echo $this->_tpl_vars['obj']->getSortImage('subject',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
							</th>
							<th>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=reply_message&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Reply
								<?php echo $this->_tpl_vars['obj']->getSortImage('reply_message',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

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
							<td><?php echo $this->_tpl_vars['data']['name']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['email']; ?>
</td>
							<td><?php echo $this->_tpl_vars['obj']->getLimitedText($this->_tpl_vars['data']['subject'],30); ?>
</td>
							<td><?php if ($this->_tpl_vars['data']['reply_message'] != ""): ?><?php echo $this->_tpl_vars['obj']->getLimitedText($this->_tpl_vars['data']['reply_message'],30); ?>
<?php endif; ?><?php if ($this->_tpl_vars['data']['reply_message'] == ""): ?><b>Not replied  yet<b><?php endif; ?></td>
							
							
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Reply')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('editform','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link">
							 <img src="images/reply_icon.gif" border="0" title="Click here to send reply"> 
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
