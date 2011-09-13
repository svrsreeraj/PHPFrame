<?php /* Smarty version Smarty-3.0.7, created on 2011-09-12 15:01:16
         compiled from "./templates/config.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:17366229614e6dd1645e9180-26601467%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6ef1c814196b62756f77184f325867d33bac07bd' => 
    array (
      0 => './templates/config.tpl.html',
      1 => 1315819874,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17366229614e6dd1645e9180-26601467',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_smarty_tpl->tpl_vars["actionReturn"] = new Smarty_variable($_smarty_tpl->getVariable('obj')->value->actionReturn, null, null);?>

<form action="" name="formName" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="3" cellpadding="3">
  <tr>
  	<td align="center">
    	<table width="70%" border="0" cellspacing="4" cellpadding="4">
    		<tr><td colspan="2"><strong>Database Details</strong></td></tr>
    		<tr>
    			<td width="40%">Host</td>
    			<td><input type="text" name="const_db_host" id="id_txt_db_host" value="<?php echo smarty_function_get_conf_const(array('const'=>'const_db_host'),$_smarty_tpl);?>
"></td>
    		</tr>
    		<tr>
    			<td>UserName</td>
    			<td><input type="text" name="const_db_username" id="id_txt_db_username" value="<?php echo smarty_function_get_conf_const(array('const'=>'const_db_username'),$_smarty_tpl);?>
"></td>
    		</tr>
    		<tr>
    			<td>Password</td>
    			<td><input type="text" name="const_db_password" id="id_txt_db_password" value="<?php echo smarty_function_get_conf_const(array('const'=>'const_db_password'),$_smarty_tpl);?>
"></td>
    		</tr>
    		<tr>
    			<td>DataBase Name</td>
    			<td><input type="text" name="const_db_name" id="id_txt_db_name" value="<?php echo smarty_function_get_conf_const(array('const'=>'const_db_name'),$_smarty_tpl);?>
"></td>
    		</tr>
    	</table>
    </td>
  </tr>
   <tr>
  	<td align="center">
    	<table width="70%" border="0" cellspacing="4" cellpadding="4">
    		<tr><td colspan="2"><strong>Domain And File Paths</strong></td></tr>
    		<tr>
    			<td width="40%">Site Address</td>
    			<td><input type="text" name="const_site_address" id="id_txt_site_address" value="<?php echo smarty_function_get_conf_const(array('const'=>'const_site_address'),$_smarty_tpl);?>
"></td>
    		</tr>
    		<tr>
    			<td>Absolutre site path</td>
    			<td><input type="text" name="const_site_absolute_path" id="id_txt_absolute_path" value="<?php echo smarty_function_get_conf_const(array('const'=>'const_site_absolute_path'),$_smarty_tpl);?>
"></td>
    		</tr>
    		
    	</table>
    </td>
  </tr>
  <tr>
  	<td align="center">
    	<table width="70%" border="0" cellspacing="4" cellpadding="4">
    		<tr><td colspan="2"><strong>TimeZones</strong></td></tr>
    		<tr>
    			<td width="40%">PHP TimeZone</td>
    			<td><input type="text" name="const_time_zone_php" id="id_txt_time_zone_php" value="<?php echo smarty_function_get_conf_const(array('const'=>'const_time_zone_php'),$_smarty_tpl);?>
"></td>
    		</tr>
    		<tr>
    			<td>Mysql TimeZone (GMT)</td>
    			<td><input type="text" name="const_time_zone_mysql" id="id_txt_time_zone_mysql" value="<?php echo smarty_function_get_conf_const(array('const'=>'const_time_zone_mysql'),$_smarty_tpl);?>
"></td>
    		</tr>
    		
    	</table>
    </td>
  </tr>
  <tr>
  	<td align="center">
    	<table width="70%" border="0" cellspacing="4" cellpadding="4">
    		<tr><td colspan="2"><strong>Miscellaneous</strong></td></tr>
    		<tr>
    			<td width="40%">Local Or Online</td>
    			<td><input type="text" name="const_local_or_online" id="id_txt_local_or_online" value="<?php echo smarty_function_get_conf_const(array('const'=>'const_local_or_online'),$_smarty_tpl);?>
"></td>
    		</tr>
    		
    		
    	</table>
    </td>
  </tr>
  <tr>
  	<td align="center"><input type="submit" value="Submit" name="actionvar"></td>
  </tr>
  
</table>
</form>
      

<?php echo smarty_function_call_footer(array(),$_smarty_tpl);?>

