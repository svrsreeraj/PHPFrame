<?php
/**************************************************************************************
Created by :Sreeraj
Created on :2011-04-05
Purpose    :custom made smarty plugins
**************************************************************************************/
function smarty_function_call_footer($params, $template)
	{
		include_once 'footer.php';
	}
function smarty_function_get_conf_const($params, $template)
	{
		$tempConst	=	trim(strtoupper($params["const"]));
		if(defined($tempConst))	return constant($tempConst);
		else					"";
	}
?>
