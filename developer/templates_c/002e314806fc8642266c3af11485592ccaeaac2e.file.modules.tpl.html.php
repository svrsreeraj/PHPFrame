<?php /* Smarty version Smarty-3.0.7, created on 2011-10-06 19:10:50
         compiled from "./templates/modules.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:2299798164e8dafe2210f33-22242117%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '002e314806fc8642266c3af11485592ccaeaac2e' => 
    array (
      0 => './templates/modules.tpl.html',
      1 => 1317908449,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2299798164e8dafe2210f33-22242117',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo smarty_function_call_header(array('title'=>"Modules Configurations"),$_smarty_tpl);?>

<?php $_smarty_tpl->tpl_vars["actionReturn"] = new Smarty_variable($_smarty_tpl->getVariable('obj')->value->actionReturn, null, null);?>
<form action="" name="formName" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="3" cellpadding="3">
  <tr>
  	<td align="center">
    	<table width="90%" border="0" cellspacing="4" cellpadding="4">
    		<tr><td colspan="2"><strong>Modules</strong></td></tr>
    		<?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('actionReturn')->value['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value){
?>
    		<tr>
    			<td width="40%"><?php echo $_smarty_tpl->tpl_vars['data']->value['module'];?>
</td>
    			<td width="40%">
    			<?php if ($_smarty_tpl->tpl_vars['data']->value['status']['moduleError']==1){?>
    				Module Error
    			<?php }?>
    			
    			<?php if ($_smarty_tpl->tpl_vars['data']->value['status']['moduleError']==0&&$_smarty_tpl->tpl_vars['data']->value['status']['moduleInstalled']==0){?>
    				Install
    			<?php }?>
    			
    			<?php if ($_smarty_tpl->tpl_vars['data']->value['status']['moduleInstalled']==1&&count($_smarty_tpl->tpl_vars['data']->value['status']['moduleInstalledErrorLog'])>0){?>
    			 	Error In Installation
    			<?php }?>	
    			
    			<?php if ($_smarty_tpl->tpl_vars['data']->value['status']['moduleInstalled']==1){?>
    				Uninstall
    			<?php }?>
    			
    			</td>
    		</tr>
    		<?php }} ?>
    	</table>
    </td>
  </tr>
 </table>
</form>
<?php echo smarty_function_call_footer(array(),$_smarty_tpl);?>

