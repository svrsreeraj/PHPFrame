<?php /* Smarty version 2.6.19, created on 2011-01-15 03:06:11
         compiled from index.tpl.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>voteondeals.com</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php $this->assign('actionReturn', $this->_tpl_vars['obj']->actionReturn); ?>

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
					<?php if ($this->_tpl_vars['obj']->getPageError()): ?>
					<tr>
					<td class="errorMessage" colspan="2"><?php echo $this->_tpl_vars['obj']->popPageError(); ?>
</td>
					</tr>
					<?php else: ?>
					<tr>
						<td class="errorMessage" colspan="2"><?php echo $this->_tpl_vars['TPL_MSG']; ?>
</td>
					</tr>
					
					<?php endif; ?>
					
					<?php if (( $this->_tpl_vars['obj']->currentAction == 'ForgotPassword' )): ?>
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
					<?php endif; ?>
					<?php if (( $this->_tpl_vars['obj']->currentAction == 'Signinform' )): ?>
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
					<?php endif; ?>
				  
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