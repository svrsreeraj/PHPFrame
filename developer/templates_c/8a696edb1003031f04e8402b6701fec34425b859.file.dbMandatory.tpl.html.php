<?php /* Smarty version Smarty-3.0.7, created on 2012-07-30 17:01:25
         compiled from "./templates/dbMandatory.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:7288156125016708d90a685-42384155%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8a696edb1003031f04e8402b6701fec34425b859' => 
    array (
      0 => './templates/dbMandatory.tpl.html',
      1 => 1343647884,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7288156125016708d90a685-42384155',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo smarty_function_call_header(array('title'=>"Developer Basic Configurations"),$_smarty_tpl);?>


<style type="text/css" media="screen">
input[type=text]
	{
		width:150px;
	}
select
	{
		width:125px;
	}
</style type="text/javascript">

<?php $_smarty_tpl->tpl_vars["actionReturn"] = new Smarty_variable($_smarty_tpl->getVariable('obj')->value->actionReturn, null, null);?>

<form action="" name="formName" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="3" cellpadding="3">
	<tr>
		<td class="errorMessage"><?php echo $_smarty_tpl->getVariable('obj')->value->popPageError();?>
</td>
	</tr>	
  <tr>
  	<td align="center">
    	<table width="100%" border="0" cellspacing="4" cellpadding="4">
    		<tr><td colspan="5"><strong>Define your Database Mandatory Fields</strong></td></tr>
    		<tr>
    			<td>Table</td>
    			<td>
    			<div id="id_table">
					<select id="id_sel_tables" >
						
					</select>
    			</div>
    			<td>
    			
    			</td>
    			<td>Field</td>
    			<td>
    			<div id="id_fields">
    			<select id="id_sel_fields" >
    			
    			</select>
    			</div>
    			</td>
								
    			<td>
    			Message
    			</td>
    			
    			<td>
					<input type="text" value="" id="id_txt_message" name="message">
    			</td>
    			
    			<td>
    			Length from
    			</td>
    			
    			<td>
					<input type="text" maxlength=4 style="width:30px" value="" id="id_txt_length_from" name="min_length">
    			</td>
    			
    			<td>
    			to
    			</td>
    			
    			<td>
					<input type="text" maxlength=4 style="width:30px" value="" id="id_txt_length_to" name="max_length">
    			</td>
    			
    			<td align="center"><input type="submit" value="Submit" class='butsubmit' name="actionvar"></td>
				
    		</tr>
    	</table>
    </td>
  </tr>
  
  
  
</table>
</form>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
	<tr align="center" valign="middle">							
		<th>Table</th>
		<th>Field</th>
	
		<th>Minimum length</th>
		<th>Maximum length</th>
		<th>Message</th>
		<th>Options</th>
	</tr>
	<?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('actionReturn')->value['datas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value){
?>
	<tr>
		<td><?php echo $_smarty_tpl->tpl_vars['data']->value['table_name'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['data']->value['field_name'];?>
</td>

		<td><?php echo $_smarty_tpl->tpl_vars['data']->value['min_length'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['data']->value['max_length'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['data']->value['message'];?>
</td>
		<td>
		<a href="dbMandatory.php?actionvar=DeleteRule&id=<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" class="Second_link">
			<img src="images/delete.gif" border="0" title="Click here to delete">
		</a>
		</td>
	</tr>
	
	<?php }} ?>
</table>
		
<script>
var jObj 		= jQuery.parseJSON('<?php echo $_smarty_tpl->getVariable('actionReturn')->value['tables'];?>
');
var jObjMethods	= jQuery.parseJSON('<?php echo $_smarty_tpl->getVariable('actionReturn')->value['methods'];?>
');

//table dropdown
function createTables()
	{
		$("#id_sel_tables").remove();
		var selTable = $('<select id="id_sel_tables" name="table_name" onchange="createFields(this.value)" />');
		$('<option />', {value: "", text: "Select"}).appendTo(selTable);
		for(var val in jObj) 
			{
				$('<option />', {value: val, text: val}).appendTo(selTable);
			}
		selTable.appendTo($("#id_table")); // or wherever it should be
	}
function createFields(table)
	{
		$("#id_sel_fields").remove();
		var selTable 	=	$('<select name="field_name" id="id_sel_fields" />');
		if(table)
			{
				
				var fieldObj	=	jObj[table];
				for(var i=0;i<fieldObj.length;i++) 
					{
						$('<option />', {value: fieldObj[i], text: fieldObj[i]}).appendTo(selTable);
					}
			}
		selTable.appendTo($("#id_fields")); // or wherever it should bealert(jObj[table]);
	}


createTables();


</script>
<?php echo smarty_function_call_footer(array(),$_smarty_tpl);?>

