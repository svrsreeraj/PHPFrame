<?php /* Smarty version Smarty-3.0.7, created on 2011-09-15 10:23:35
         compiled from "./templates/index.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:16610406504e7184cf4b6e21-57087647%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '01ecfae32e301db98e9a68ae3b8db3604ec329d7' => 
    array (
      0 => './templates/index.tpl.html',
      1 => 1315200161,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16610406504e7184cf4b6e21-57087647',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>voteondeals.com</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php $_smarty_tpl->tpl_vars["actionReturn"] = new Smarty_variable($_smarty_tpl->getVariable('obj')->value->actionReturn, null, null);?>

<form action="" name="formName" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td ><table width="100%" border="0" cellspacing="0" cellpadding="0">
      
      <tr>
        <td align="center" valign="top" style="padding-top:125px; padding-bottom:15px;"><table width="50%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td style="border:solid 1px; border-color:#018fb6;">
			<table bgcolor="#E1F7FD" width="100%" border="0" cellspacing="0" cellpadding="0">
              
			  
			  <tr>
                <td width="48%"><img src="images/admin_12.gif" width="237" height="262" /></td>
                <td width="52%" align="center" valign="middle" bgcolor="#E1F7FD">
				
				<table width="90%" border="0" cellspacing="0" cellpadding="0">
					<?php if ($_smarty_tpl->getVariable('obj')->value->getPageError()){?>
					<tr>
					<td class="errorMessage" colspan="2"><?php echo $_smarty_tpl->getVariable('obj')->value->popPageError();?>
</td>
					</tr>
					<?php }else{ ?>
					<tr>
						<td class="errorMessage" colspan="2"><?php echo $_smarty_tpl->getVariable('TPL_MSG')->value;?>
</td>
					</tr>
					
					<?php }?>
					
					<?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="ForgotPassword")){?>
					<tr>
					<td width="50%" height="30" align="left" valign="middle" class="graytext">Email :</td>
					<td align="right" valign="middle">
						<input name="emailid" type="text" class="categoryinput125" id="emailid" value="" />
					</td>
					</tr>
					<tr>&nbsp;
					</tr>
					<tr>
						<td>
							<input name="actionvar" type="submit" class="butsubmit" value="reset" />
						</td>
						<td>
							<input name="actionvar" type="submit" class="butsubmit" value="Cancel" /></td>
						</td>
					</tr>
					<?php }?>
					<?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="Signinform")){?>
					<tr>
					<td width="50%" height="30" align="left" valign="middle" class="graytext">Email:</td>
					<td align="right" valign="middle">
						<input name="username" type="text" class="categoryinput125" id="usernameId" value="" />
					</td>
					</tr>
					<tr>
					<td align="left" valign="middle" class="graytext">Password</td>
					<td align="right" valign="middle">
						<input name="password" type="password" class="categoryinput125" id="passwordId" value="" />
					</td>
					</tr>
					<tr>
					<td align="left" valign="middle"><span class="black"><a href="index.php?actionvar=forgotPassword">Forgot Password ?</a></span></td>
					<td height="50" align="center">
					<input name="actionvar" type="submit" class="butsubmit" value="Submit" /></td>
					</tr>
					<?php }?>
				  
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center" valign="bottom" style="padding-bottom:20px;"><table width="50%" border="0" cellspacing="0" cellpadding="4">
          <tr>
            <td align="left" valign="top" class="whitetext"><span class="redbold">WARNING!</span><span class="darktext"> ACCESS AND USE OF THIS COMPUTER SYSTEM BY ANYONE WITHOUT THE PERMISSION OF THE OWNER, </span><span class="graytext">www.voteondeal.com</span><span class="darktext">, IS STRICTLY PROHIBITED BY STATE AND FEDERAL LAWS AND MAY SUBJECT AN UNAUTHORIZED USER, INCLUDING EMPLOYEES NOT HAVING AUTHORIZATION, TO CRIMINAL AND CIVIL PENALTIES AS WELL AS COMPANY-INITIATED DISCIPLINARY ACTION. DEVELOPED BY . 2011 ALL RIGHTS RESERVED</span></td>
          </tr>
        </table></td>
      </tr>
      
      
    </table></td>
  </tr>
</table>

</form>
<script language="javascript" type="text/javascript">
document.formName.username.focus();
</script> 
<script language="javascript" type="text/javascript">
document.formName.emailid.focus();
</script> 
</body>
</html>