<?php /* Smarty version Smarty-3.0.7, created on 2012-07-21 17:10:12
         compiled from "./templates/adminPermission.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:429461848500a951c3f5ba0-41328205%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '533cdcc068f50e86180b7f5ee29580ac04bb437a' => 
    array (
      0 => './templates/adminPermission.tpl.html',
      1 => 1342430626,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '429461848500a951c3f5ba0-41328205',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo smarty_function_call_core_header(array('title'=>"Admin Users"),$_smarty_tpl);?>


<script language="javascript" type="text/javascript">
function ajaxFunction_page(param,div)
	{
		document.getElementById(div).innerHTML	=	"Loading...."
		var ajaxRequest;  // The variable that makes Ajax possible!									
		try{
			// Opera 8.0+, Firefox, Safari
			
			ajaxRequest = new XMLHttpRequest();
		} catch (e){
			// Internet Explorer Browsers
			try{
				ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try{
					ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e){
					// Something went wrong
					alert("Your browser broke!");
					return false;
				}
			}
		}
		// Create a function that will receive data sent from the server
		ajaxRequest.onreadystatechange = function()
		{
			if(ajaxRequest.readyState == 4 )
			{
				   document.getElementById(div).innerHTML= ajaxRequest.responseText;
				  //document.getElementById(div).style.visibility = 'visible'; 										
			}
		}    
		ajaxRequest.open("GET",param, true);
		ajaxRequest.send(null); 
	}	

function fun(id)
	{
		document.frm1.action="adminPermission.php?flag=" + id;
		document.frm1.submit();
	}

function grpfun(id)
	{
		var grps	= $("input[name=group"+id+"]");
		var chlds	= $("input[name^='group_"+id+"_']:checkbox");
		if(grps.attr('checked'))
			{
				chlds.each(function(index) 
					{
						$(this).attr('checked',true);
					});
			}
		else
			{
				if($("input[name^='group_"+id+"_']:checkbox:checked").length>0)
					{
						chlds.each(function(index) 
							{
								$(this).attr('checked',false);
							});

					}
			}
	}

function grpdefun(id)
	{
		var element = 	id.split("_");
		var topId	=	element[0]+element[1]
		var grps	= $("input[name="+element[0]+element[1]+"]");
		var chlds	= $("input[name^="+element[0]+"_"+element[1]+"]:checkbox:checked");
		if(chlds.length	==	0)	grps.attr('checked', false);
		else					grps.attr('checked', true);
	}
</script>
<script type="text/javascript">
$(document).ready(function(){
$("#adminpaer").tooltip();
});
</script>
                   
 <form name="frm1" method="post" action="" >

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">

<tr>
	<td class="pageHead"><span id="adminpaer"><strong>Set Permission </strong></span></td>
</tr>
<?php if ($_smarty_tpl->getVariable('TPL_MESSAGE')->value){?>
<tr>
	<td class="errorMessage"><?php echo $_smarty_tpl->getVariable('TPL_MESSAGE')->value;?>
</td>
</tr>
<?php }?>
<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("View")){?>
<tr>
	<td>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td  align="right">&nbsp;</td>
			</tr>
			
			<tr>
				<td>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
							<td>&nbsp;</td>
							<td>Select User Type:</td>
							<td><?php echo $_smarty_tpl->getVariable('TPL_ROLE')->value;?>
	</td>							
						</tr>
					</table>
				</td>
			</tr>
			
			<?php if ($_smarty_tpl->getVariable('menus')->value){?>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
						<td colspan="4">
							<div align="right">
								<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Edit")){?>
								<input type="submit" name="Submit" value="Update"  class="butsubmit" />	
								<?php }?>		
							</div>
						</td>
					</tr>
			<tr>
				<td align="center" valign="middle">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="formTable">
					 <?php  $_smarty_tpl->tpl_vars['menu'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('menus')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['menu']->key => $_smarty_tpl->tpl_vars['menu']->value){
?>
					
					<tr  align="left" valign="middle">
					
					<th  style="text-align:left;" colspan="2"><?php echo $_smarty_tpl->tpl_vars['menu']->value['menutitle'];?>
 
					 <input type="checkbox" name="group<?php echo $_smarty_tpl->tpl_vars['menu']->value['id'];?>
"  value="<?php echo $_smarty_tpl->tpl_vars['menu']->value['id'];?>
"  
					 <?php if ($_smarty_tpl->tpl_vars['menu']->value['checked']=="1"){?> checked = "checked" <?php }?>  onclick="return grpfun(<?php echo $_smarty_tpl->tpl_vars['menu']->value['id'];?>
) "/>
					</th>					
					</tr>
					
					 	<?php  $_smarty_tpl->tpl_vars['page'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['menu']->value['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['page']->key => $_smarty_tpl->tpl_vars['page']->value){
?>
							<tr align="center" valign="middle">
							
							<td><?php echo $_smarty_tpl->tpl_vars['page']->value['pagetitle'];?>
</td>
							<td>
							<table cellpadding="0" cellspacing="0"  border="0">
							<tr>
							<?php  $_smarty_tpl->tpl_vars['action'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['page']->value['action']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['action']->key => $_smarty_tpl->tpl_vars['action']->value){
?>
							<td>
							<input type="checkbox" name="group_<?php echo $_smarty_tpl->tpl_vars['menu']->value['id'];?>
_<?php echo $_smarty_tpl->tpl_vars['page']->value['id'];?>
_<?php echo $_smarty_tpl->tpl_vars['action']->value['id'];?>
" id="group_<?php echo $_smarty_tpl->tpl_vars['menu']->value['id'];?>
_<?php echo $_smarty_tpl->tpl_vars['page']->value['id'];?>
_<?php echo $_smarty_tpl->tpl_vars['action']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['action']->value['id'];?>
"   
							<?php if ($_smarty_tpl->tpl_vars['action']->value['checked']=="1"){?> checked="checked" <?php }?> onclick="return grpdefun('group_<?php echo $_smarty_tpl->tpl_vars['menu']->value['id'];?>
_<?php echo $_smarty_tpl->tpl_vars['page']->value['id'];?>
_<?php echo $_smarty_tpl->tpl_vars['action']->value['id'];?>
')" />
								
								<?php echo $_smarty_tpl->tpl_vars['action']->value['action'];?>

							</td>
							<?php }} ?>
							
							</tr>
							</table>
							</td> 							
							</tr>
						<?php }} ?>
					<?php }} ?>
					<tr>
						<td colspan="4">
							<div align="center">
								<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Edit")){?>
								<input type="submit" name="Submit" value="Update"  class="butsubmit" />	
								<?php }?>	
							</div>
						</td>
					</tr>
					
					
					<?php }?>
					
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>
<?php }?>
</table>
</form>
<?php echo smarty_function_call_core_footer(array(),$_smarty_tpl);?>

