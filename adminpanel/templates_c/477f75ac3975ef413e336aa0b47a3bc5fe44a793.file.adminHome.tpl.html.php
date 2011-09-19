<?php /* Smarty version Smarty-3.0.7, created on 2011-09-19 10:37:39
         compiled from "./templates/adminHome.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:143178914e76ce1bcf45e3-60474531%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '477f75ac3975ef413e336aa0b47a3bc5fe44a793' => 
    array (
      0 => './templates/adminHome.tpl.html',
      1 => 1316408473,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '143178914e76ce1bcf45e3-60474531',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo smarty_function_call_header(array('title'=>"Adminpanel Home"),$_smarty_tpl);?>


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

<?php echo smarty_function_call_footer(array(),$_smarty_tpl);?>

