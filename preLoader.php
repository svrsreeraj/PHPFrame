<?php
/**************************************************************************************
Created By 	:	Sreeraj
Created On	:	2010-12-07
Description	:	Loading Before page loads to catch all glbbal variables
**************************************************************************************/
$modelcalss	=	new modelclass();

//got a guest from bookmarking site
if($_REQUEST["vod_came_from"]!="")
	{
		$vod_came_str		=	$modelcalss->dbSearchCond("like", "site_key", $_REQUEST["vod_came_from"]);
		$sql				=	"select * from vod_social_bookmarking_sites where 1 and $vod_came_str";
		$camefromData		=	end($modelcalss->getdbcontents_sql($sql));
		if($camefromData)		
			{
				$_SESSION["vod_came_from"]	=	$camefromData["id"];
				$modelcalss->db_update('vod_social_bookmarking_sites',array("hits"=>"escape hits+1 escape"),'id='.$camefromData["id"]);
			}
	}
//shared by me...
if($_REQUEST["vod_shared_user"]!="")
	{
		$vod_shared_str		=	$modelcalss->dbSearchCond("like", "customercode", $_REQUEST["vod_shared_user"]);
		$sql				=	"select * from vod_customer where 1 and $vod_shared_str";
		$sharedData			=	end($modelcalss->getdbcontents_sql($sql));
		if($sharedData)			$_SESSION["vod_shared_user"]	=	$sharedData["id"];
	}
//invitation for sign up
if($_REQUEST["vod_invited_user"]!="")
	{
		$vod_invited_str	=	$modelcalss->dbSearchCond("like", "customercode", $_REQUEST["vod_invited_user"]);
		$sql				=	"select * from vod_customer where 1 and $vod_invited_str";
		$invitedData		=	end($modelcalss->getdbcontents_sql($sql));
		if($invitedData)		$_SESSION["vod_invited_user"]	=	$invitedData["id"];
	}
?>
