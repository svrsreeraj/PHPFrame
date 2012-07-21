<?php /* Smarty version Smarty-3.0.7, created on 2012-07-21 17:10:18
         compiled from "./templates/changePassword.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:719399193500a9522535487-67228452%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '18beb34862fef9eb08d1f3ca39a065c2518c9214' => 
    array (
      0 => './templates/changePassword.tpl.html',
      1 => 1342430626,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '719399193500a9522535487-67228452',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo smarty_function_call_core_header(array('title'=>"Change Password"),$_smarty_tpl);?>


<script type="text/javascript">
		$(document).ready(function(){
		$("#changepass").tooltip();
	});
</script>

<form action="" name="fromName" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">

	<?php if ($_smarty_tpl->getVariable('obj')->value->getPageError()){?>
	
	<tr>
		<td class="errorMessage"><?php echo $_smarty_tpl->getVariable('obj')->value->popPageError();?>
</td>
	</tr>
	<?php }?>
	<tr>
		<td class="pageHead"><span id="changepass"><strong> Change Password  </strong></td>
	</tr>

	
	<?php if ($_smarty_tpl->getVariable('obj')->value->currentAction=="Listing"){?>
	<tr>
	<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("View")){?>	
  
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
									<td><input type="password" width="300" name="oldPass" valtype="emptyCheck-Please enter your old password " value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['oldPass'];?>
" /></td>
								</tr>
								<tr>
									<td>New password</td>
									<td><input type="password"  name="newPass" valtype="emptyCheck-Please enter your new password" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['newPass'];?>
"/></td>
								</tr>
								<tr>
									<td>Confirm Password</td>
									<td><input type="password"  name="confNewpass" valtype="emptyCheck-Please retype your password" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['phone'];?>
" id="confNewpass"  /></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td><?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Edit")){?>		
										<input type="submit" valcheck="true" class="butsubmit"   name="actionvar" value="Change " id="saveDataId" />
										<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
										<?php }?>
									</td>
								</tr>
							</table>
						</td>
					</tr>
			</table>
			<?php }?>
		</td>
	</tr>
	<?php }?>
</table>
</form>


<script type="text/javascript" src="{$smarty.const.CONST_SITE_ADDRESS}js/formValidation.js"> </script>

<?php echo smarty_function_call_core_footer(array(),$_smarty_tpl);?>


