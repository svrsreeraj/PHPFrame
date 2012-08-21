<?php
/**************************************************************************************
Created by :Sreeraj
Created on :2011-04-05
Purpose    :custom made smarty plugins
**************************************************************************************/
function smarty_function_call_header($params, &$template)
	{
		if(!$params['title'])		$title	=	constant("CONST_SITE_ADDRESS");
		else 						$title	=	$params['title'];
		if(!$params['file'])		$file	=	"header.php";
		else 						$file	=	trim($params['file']);
		define("_HEAD_TITLE",$title);
		if(is_file(getcwd().DIRECTORY_SEPARATOR.$file)) include(getcwd().DIRECTORY_SEPARATOR.$file);
	}
function smarty_function_call_module_header($params, &$template)
	{
		if(!$params['title'])		$title	=	constant("CONST_SITE_ADDRESS");
		else 						$title	=	$params['title'];
		if(!$params['file'])		$file	=	"header.php";
		else 						$file	=	trim($params['file']);
		define("_HEAD_TITLE",$title);
		require "../../$file";
	}
function smarty_function_call_core_header($params, &$template)
	{
		if(!$params['title'])		$title	=	constant("CONST_SITE_ADDRESS");
		else 						$title	=	$params['title'];
		if(!$params['file'])		$file	=	"header.php";
		else 						$file	=	trim($params['file']);
		define("_HEAD_TITLE",$title);
		include "../$file";
	}
function smarty_function_call_module_footer($params, &$template)
	{
		if(!$params['file'])		$file	=	"footer.php";
		else 						$file	=	trim($params['file']);
		include_once "../../$file";
	}
function smarty_function_call_core_footer($params, &$template)
	{
		if(!$params['file'])		$file	=	"footer.php";
		else 						$file	=	trim($params['file']);
		include_once "../$file";
	}
function smarty_function_call_footer($params, &$template)
	{
		if(!$params['file'])		$file	=	"footer.php";
		else 						$file	=	trim($params['file']);
		include_once "$file";
	}
function smarty_function_get_conf_const($params, &$template)
	{
		$tempConst	=	trim(strtoupper($params["const"]));
		$template->assign($params['returnVar'], constant($tempConst));
	}
function smarty_function_array2nl($params, &$template)
	{
		$returnString	=	"";
		$array	=	$params["array"];
		$returnString	=	implode("\n", $array);
		echo $returnString;
	}
?>
