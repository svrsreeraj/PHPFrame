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
			<td class="footer"> <span class="darkblue" style="padding-top:20px;"> &copy; </span><?php echo date('Y');?>    All rights reserved, Patent Pending 2010. </td>
			</tr>
	  </table>
	 </td>
  </tr>
  
</table>
	<script type="text/javascript" src="<?php echo constant("CONST_SITE_ADMIN_ADDRESS");?>js/footerScript.js"> </script>
	<script type="text/javascript" src="<?php echo constant("CONST_SITE_ADMIN_ADDRESS");?>js/formValidation.js"></script>
</body>
</html>
