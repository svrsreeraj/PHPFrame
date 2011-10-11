<?php /* Smarty version Smarty-3.0.7, created on 2011-10-10 14:16:56
         compiled from "./templates/adminHome.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:17172500444e92b100095dc4-72401821%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '477f75ac3975ef413e336aa0b47a3bc5fe44a793' => 
    array (
      0 => './templates/adminHome.tpl.html',
      1 => 1318236414,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17172500444e92b100095dc4-72401821',
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

