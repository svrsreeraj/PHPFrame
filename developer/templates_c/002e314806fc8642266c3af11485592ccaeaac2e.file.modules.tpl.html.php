<?php /* Smarty version Smarty-3.0.7, created on 2011-10-07 15:15:05
         compiled from "./templates/modules.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:11864179044e8eca217177c9-59366348%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '002e314806fc8642266c3af11485592ccaeaac2e' => 
    array (
      0 => './templates/modules.tpl.html',
      1 => 1317980702,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11864179044e8eca217177c9-59366348',
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
    		<tr><td colspan="2">
    			<div style="color:red;">
				<?php echo $_smarty_tpl->getVariable('obj')->value->popPageError();?>

				</div>
			</td></tr>
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
    				<a href="javascript:;" title="<?php echo smarty_function_array2nl(array('array'=>$_smarty_tpl->tpl_vars['data']->value['status']['moduleErrorLog']),$_smarty_tpl);?>
">Module Error</a>
    			<?php }?>
    			
    			<?php if ($_smarty_tpl->tpl_vars['data']->value['status']['moduleError']==0&&$_smarty_tpl->tpl_vars['data']->value['status']['moduleInstalled']==0){?>
    				<a href="modules.php?actionvar=install&module=<?php echo $_smarty_tpl->tpl_vars['data']->value['module'];?>
" title="Install <?php echo $_smarty_tpl->tpl_vars['data']->value['module'];?>
">Install</a>
    			<?php }?>
    			
    			<?php if ($_smarty_tpl->tpl_vars['data']->value['status']['moduleInstalled']==1&&count($_smarty_tpl->tpl_vars['data']->value['status']['moduleInstalledErrorLog'])>0){?>
    			 	<a href="javascript:;" title="<?php echo smarty_function_array2nl(array('array'=>$_smarty_tpl->tpl_vars['data']->value['status']['moduleInstalledErrorLog']),$_smarty_tpl);?>
">Error in installation</a>
    			<?php }?>	
    			
    			<?php if ($_smarty_tpl->tpl_vars['data']->value['status']['moduleInstalled']==1){?>
    				<a href="modules.php?actionvar=Uninstall&module=<?php echo $_smarty_tpl->tpl_vars['data']->value['module'];?>
" title="Un install <?php echo $_smarty_tpl->tpl_vars['data']->value['module'];?>
">Un Install</a>
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

