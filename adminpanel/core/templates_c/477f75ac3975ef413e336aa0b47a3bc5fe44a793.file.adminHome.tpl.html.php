<?php /* Smarty version Smarty-3.0.7, created on 2012-07-21 17:20:38
         compiled from "./templates/adminHome.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:395447833500a978e9ed092-91681293%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '477f75ac3975ef413e336aa0b47a3bc5fe44a793' => 
    array (
      0 => './templates/adminHome.tpl.html',
      1 => 1342430626,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '395447833500a978e9ed092-91681293',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo smarty_function_call_core_header(array('title'=>"Admin Home"),$_smarty_tpl);?>


<?php $_smarty_tpl->tpl_vars["actionReturn"] = new Smarty_variable($_smarty_tpl->getVariable('obj')->value->actionReturn, null, null);?>
<form action="" name="fromName" method="POST" enctype="multipart/form-data">
<table width="100%" border="0"  cellpadding="0" cellspacing="0" class="table_style" onload="refreshpage()l">

<div id="error">
	<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data1']['error'];?>

</div>

<tr>
	<td class="pageHead"><span id="home"><strong>Home </strong></span></td>
</tr>


</table>
<?php echo smarty_function_call_core_footer(array(),$_smarty_tpl);?>

