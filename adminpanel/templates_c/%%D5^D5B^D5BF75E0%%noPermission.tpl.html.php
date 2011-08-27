<?php /* Smarty version 2.6.19, created on 2010-12-30 11:00:54
         compiled from noPermission.tpl.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>NO PERMISSION</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" src="js/jquery-1.4.3.min.js"></script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="84" align="right" valign="middle" bgcolor="#FFFFFF" style="background-image:url(images/admin_03.jpg); background-position:left top; background-repeat:no-repeat; padding-right:15px;"><table width="45%" border="0" cellspacing="5" cellpadding="0">
            <tr>
              <td align="right" valign="middle"><table width="20%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center" valign="middle"><a href="#" class="letnav">Login</a></td>
                    <td align="center" valign="middle"><a href="logout.php" class="letnav" title="Click here to logout">Logout</a></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td align="right" valign="middle" class="head">Administrative Area </td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td align="left" valign="top" bgcolor="#0FA1DA"><img src="images/space.jpg" width="3" height="5" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="20%" align="left" valign="top" 
	style="background-image:url(images/inner_11.gif); background-position:left top; background-repeat:repeat-y; padding-top:20px;">
		
		
		
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td width="20%" align="left" valign="top"  style="background-image:url(images/inner_11.gif);
			 background-position:left top; background-repeat:repeat-y; padding-top:2px;">
			
			
			<?php echo $this->_tpl_vars['objCls']->get_leftmenu(); ?>

			</td>
			</tr>   
          
          <tr>
            <td align="left" valign="top">&nbsp;</td>
          </tr>
        </table></td>
        <td class="contentArea">



<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">

<tr>
	<td class="errorMessage">&nbsp;</td>
</tr>

<tr>
	<td class="pageHead"><strong>No Permission </strong></td>
</tr>



<tr>
	
	<td>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td  align="right">&nbsp;
				</td>
			</tr>
			<tr>
				<td  align="right">
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
							<td align="right">
							<a href="javascript:history.go(-1)" title="Click here to go back" class="Second_link" style="">							
								<input name="actionvar" type="button" class="butsubmit" value="Back" />	
								</a>						
							</td>
							
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" height="500">
					
					
							<tr>
							<td class="errorMessage"> YOU HAVE NO PERMISSION TO VIEW THE PAGE 							
							</td>
						</tr>
						<tr>
							<td >&nbsp;
							
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			
		
		</table>
	</td>
	
</tr>
</table>


<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
