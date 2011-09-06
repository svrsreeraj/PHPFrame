<?php /* Smarty version 2.6.19, created on 2011-01-26 10:59:41
         compiled from adminPermission.tpl.html */ ?>
<?php echo '
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
				  //document.getElementById(div).style.visibility = \'visible\'; 										
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
		var chlds	= $("input[name^=\'group_"+id+"_\']:checkbox");
		if(grps.attr(\'checked\'))
			{
				chlds.each(function(index) 
					{
						$(this).attr(\'checked\',true);
					});
			}
		else
			{
				if($("input[name^=\'group_"+id+"_\']:checkbox:checked").length>0)
					{
						chlds.each(function(index) 
							{
								$(this).attr(\'checked\',false);
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
		if(chlds.length	==	0)	grps.attr(\'checked\', false);
		else					grps.attr(\'checked\', true);
	}
</script>
<script type="text/javascript">
$(document).ready(function(){
$("#adminpaer").tooltip();
});
</script>
'; ?>
                   
 <form name="frm1" method="post" action="" >

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">

<tr>
	<td class="pageHead"><span id="adminpaer"><strong>Set Permission </strong></span></td>
</tr>
<?php if ($this->_tpl_vars['TPL_MESSAGE']): ?>
<tr>
	<td class="errorMessage"><?php echo $this->_tpl_vars['TPL_MESSAGE']; ?>
</td>
</tr>
<?php endif; ?>
<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
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
							<td><?php echo $this->_tpl_vars['TPL_ROLE']; ?>
	</td>							
						</tr>
					</table>
				</td>
			</tr>
			
			<?php if ($this->_tpl_vars['menus']): ?>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
						<td colspan="4">
							<div align="right">
								<?php if ($this->_tpl_vars['obj']->permissionCheck('Edit')): ?>
								<input type="submit" name="Submit" value="Update"  class="butsubmit" />	
								<?php endif; ?>		
							</div>
						</td>
					</tr>
			<tr>
				<td align="center" valign="middle">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="formTable">
					 <?php $_from = $this->_tpl_vars['menus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['menu']):
?>
					
					<tr  align="left" valign="middle">
					
					<th  style="text-align:left;" colspan="2"><?php echo $this->_tpl_vars['menu']['menutitle']; ?>
 
					 <input type="checkbox" name="group<?php echo $this->_tpl_vars['menu']['id']; ?>
"  value="<?php echo $this->_tpl_vars['menu']['id']; ?>
"  
					 <?php if ($this->_tpl_vars['menu']['checked'] == '1'): ?> checked = "checked" <?php endif; ?>  onclick="return grpfun(<?php echo $this->_tpl_vars['menu']['id']; ?>
) "/>
					</th>					
					</tr>
					
					 	<?php $_from = $this->_tpl_vars['menu']['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
							<tr align="center" valign="middle">
							
							<td><?php echo $this->_tpl_vars['page']['pagetitle']; ?>
</td>
							<td>
							<table cellpadding="0" cellspacing="0"  border="0">
							<tr>
							<?php $_from = $this->_tpl_vars['page']['action']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['action']):
?>
							<td>
							<input type="checkbox" name="group_<?php echo $this->_tpl_vars['menu']['id']; ?>
_<?php echo $this->_tpl_vars['page']['id']; ?>
_<?php echo $this->_tpl_vars['action']['id']; ?>
" id="group_<?php echo $this->_tpl_vars['menu']['id']; ?>
_<?php echo $this->_tpl_vars['page']['id']; ?>
_<?php echo $this->_tpl_vars['action']['id']; ?>
" value="<?php echo $this->_tpl_vars['action']['id']; ?>
"   
							<?php if ($this->_tpl_vars['action']['checked'] == '1'): ?> checked="checked" <?php endif; ?> onclick="return grpdefun('group_<?php echo $this->_tpl_vars['menu']['id']; ?>
_<?php echo $this->_tpl_vars['page']['id']; ?>
_<?php echo $this->_tpl_vars['action']['id']; ?>
')" />
								
								<?php echo $this->_tpl_vars['action']['action']; ?>

							</td>
							<?php endforeach; endif; unset($_from); ?>
							
							</tr>
							</table>
							</td> 							
							</tr>
						<?php endforeach; endif; unset($_from); ?>
					<?php endforeach; endif; unset($_from); ?>
					<tr>
						<td colspan="4">
							<div align="center">
								<?php if ($this->_tpl_vars['obj']->permissionCheck('Edit')): ?>
								<input type="submit" name="Submit" value="Update"  class="butsubmit" />	
								<?php endif; ?>	
							</div>
						</td>
					</tr>
					
					
					<?php endif; ?>
					
					</table>
				</td>
			</tr>
		</table>
	</td>
</tr>
<?php endif; ?>
</table>
</form>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
