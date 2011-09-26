	<?php
		
		$obj		=	$GLOBALS["cls_site"];
		$smarty		=	$GLOBALS["smarty"];
		$fileArray	=	pathinfo($obj->getPageName());
		$file		=	$smarty->template_dir."/help/".$fileArray["filename"].".tpl.html";
		if(file_exists($file)) require_once $file;
	?>
</td>
  </tr>
  </table>
  </td>
  </tr>
  
  <tr>
  	<td>
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
			<td align="left" valign="top" bgcolor="#8ADEF8">&nbsp;</td>
			<td align="center" valign="middle" bgcolor="#8ADEF8" style="padding:20px;"><span class="darkblue" style="padding-top:20px;">Copyright <span class="darkblue" style="padding-top:20px;"> &copy; </span><?php echo date('Y');?>  </span></td>
			</tr>
	  </table>
	 </td>
  </tr>
</table>
	<script type="text/javascript" src="<?php echo constant("CONST_SITE_ADDRESS")?>/js/footerScript.js"> </script>
	<script type="text/javascript" src="<?php echo constant("CONST_SITE_ADDRESS")?>/js/formValidation.js"></script>
</body>
</html>
