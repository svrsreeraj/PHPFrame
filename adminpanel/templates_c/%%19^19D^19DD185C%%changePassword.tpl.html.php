<?php /* Smarty version 2.6.19, created on 2011-01-24 01:40:42
         compiled from changePassword.tpl.html */ ?>
<?php $this->assign('actionReturn', $this->_tpl_vars['obj']->actionReturn); ?>
<?php echo '
<script type="text/javascript">
		$(document).ready(function(){
		$("#changepass").tooltip();
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
		<td class="pageHead"><span id="changepass"<strong> Change Password  </strong></td>
	</tr>

	
	<?php if ($this->_tpl_vars['obj']->currentAction == 'Listing'): ?>
	<tr>
	<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>	
  
      </div>
		<td>
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr>
					<td  align="right">&nbsp;</td>
				</tr>
					<tr>	
						<td align="center" valign="middle">
							<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
								<tr>
									<th colspan="2">Change Password</th>
								</tr>
								<tr>
									<td WIDTH="300">Old password </td>
									<td><input type="password" width="300" name="oldPass" valtype="emptyCheck-Please enter your old password " value="<?php echo $this->_tpl_vars['actionReturn']['data']['oldPass']; ?>
" /></td>
								</tr>
								<tr>
									<td>New password</td>
									<td><input type="password"  name="newPass" valtype="emptyCheck-Please enter your new password" value="<?php echo $this->_tpl_vars['actionReturn']['data']['newPass']; ?>
"/></td>
								</tr>
								<tr>
									<td>Confirm Password</td>
									<td><input type="password"  name="confNewpass" valtype="emptyCheck-Please retype your password" value="<?php echo $this->_tpl_vars['actionReturn']['data']['phone']; ?>
" id="confNewpass"  /></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td><?php if ($this->_tpl_vars['obj']->permissionCheck('Edit')): ?>		
										<input type="submit" valcheck="true" class="butsubmit"   name="actionvar" value="Change " id="saveDataId" />
										<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
										<?php endif; ?>
									</td>
								</tr>
							</table>
						</td>
					</tr>
			</table>
			<?php endif; ?>
		</td>
	</tr>
	<?php endif; ?>
</table>
</form>
<?php echo '

<script type="text/javascript" src="js/formValidation.js"> </script>
'; ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
