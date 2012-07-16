<?php
/**************************************************************************************
Created by :Sreeraj
Created on :15-02-2009
Name       :tpl_template.php
Purpose    :tpl_template
**************************************************************************************/
if($tpls["parentpagevar"])
	{
		$parentpagevar	=	$tpls["parentpagevar"];
		if(!$_REQUEST[$parentpagevar])	exit("Parent table not found!");
		else
			{
				$parentpagevarval			=	$_REQUEST[$parentpagevar];
				$tpls["parentpagevarval"]	=	$parentpagevarval;
				$parentcaption				=	$cls_db->getdbcontents_cond($def_data["parent_table"],$def_data["parent_primary"]."='".$parentpagevarval."'");
				$temp						=	$def_data["parent_name"];
				$tpls["parentcaption"]		=	$parentcaption[0][$temp];
			}		
	}
if($_POST["btn_parent"]!="")
	{
		if($def_data["parent_foreign"])
			{
				$temp_data	=	$cls_db->getdbcontents_cond($def_data["parent_table"],$def_data["parent_primary"]."='".$parentpagevarval."'");
				$temp		=	$def_data["parent_foreign"];
				$temp		=	$temp_data[0][$temp];
				if($parentpagevar)	$temp2	=	$tpls["parentpagename"]."?".$parentpagevar."=".$temp;
				header("location:".$temp2);$temp	=	"";$temp2	=	"";exit;
			}
		if($parentpagevar)	$temp2	=	$tpls["parentpagename"];
		header("location:".$temp2);$temp	=	"";$temp2	=	"";exit;
	}
if($_POST["btnSearch"])
	{
		$searchq	=	mysql_real_escape_string(trim($_POST["txt_search"]));
		if(!$parentpagevar)
			{
				header("location:".$tpls["pagename"]."?searchq=$searchq");exit;
			}
		else
			{
				header("location:".$tpls["pagename"]."?searchq=$searchq"."&$parentpagevar=$parentpagevarval");exit;
			}
	}
if($_POST["btnSearchReset"])
	{
		if(!$parentpagevar)
			{
				header("location:".$tpls["pagename"]);exit;
			}
		else
			{
				header("location:".$tpls["pagename"]."?$parentpagevar=$parentpagevarval");exit;
			}
	}
if($_POST["add_btn"]!="")
	{
		if(!$parentpagevar)
			{
				header("location:".$tpls["pagename"]."?add=1");exit;
			}
		else
			{
				header("location:".$tpls["pagename"]."?add=1"."&$parentpagevar=$parentpagevarval");exit;
			}
	}
if($_REQUEST["statuschange"]!="")
	{
		 $cls_db->db_query("update ".$def_data["table"]." set ".$def_data["status"] . "= !" . $def_data["status"]	." where ".$def_data["primary"]."='".$_REQUEST["statuschange"]."'");
		 header("location:".$_SERVER['HTTP_REFERER']);exit;
	}
if($_POST["btn_editcancel"]!="" || $_POST["btn_savecancel"]!="")
	{
		if(!$parentpagevar)
			{
				header("location:".$tpls["pagename"]);exit;
			}
		else
			{
				header("location:".$tpls["pagename"]."?$parentpagevar=$parentpagevarval");exit;
			}
	}
if($_POST["btn_edit"])
	{
		extract($_POST);
		if(!$cls_db->getdbcount_cond($def_data["table"],$def_data["name"]."='".mysql_real_escape_string($txt_edit)."' and ".$def_data["primary"]."!='".$_REQUEST["edit"]."'"))
			{
				if(trim($txt_edit))
					{
						if($cls_db->db_update($def_data["table"],array($def_data["name"]=>mysql_real_escape_string($txt_edit)),$def_data["primary"]."='".$_REQUEST["edit"]."'"))
							{
								$cls_db->sortingRecords($def_data["table"],$_REQUEST["edit"],mysql_real_escape_string($_POST["txt_preference"]),$def_data["prference"]);
								$tpls["error"]	=	"Updated Successfully.";
								
							}
						else
							{
								$tpls["error"]	.=	implode("<br>",$cls_db->getDbErrors());	
							}
					}
				else	$tpls["error"]	=	"Entered data is not correct!";				
			}
		else	$tpls["error"]	=	"Details Already Exists!";
		
		$_SESSION["tpls_error"]	=	$tpls["error"];
		if(!$parentpagevar)
			{
				header("location:".$tpls["pagename"]);exit;
			}
		else
			{
				header("location:".$tpls["pagename"]."?$parentpagevar=$parentpagevarval");exit;
			}
		
	}
if($_REQUEST["edit"]!="")
	{
		 $editdata					=	$cls_db->getdbcontents_cond($def_data["table"],$def_data["primary"]."='".$_REQUEST["edit"]."'");
		 $temp						=	$def_data["name"];
		 $tpls["updatetxtlvalue"]	=	stripslashes($editdata[0][$temp]);
		 $tpls["updateprefervalue"]	=	stripslashes($editdata[0][$def_data["prference"]]);
	}
if($_POST["btn_save"])
	{
		$cnt	=	0;
		extract($_POST);
		for($i=0;$i<count($txt_add);$i++)
			{
				if(!$cls_db->getdbcount_cond($def_data["table"],$def_data["name"]."='".mysql_real_escape_string($txt_add[$i])."'"))
					{
						if(trim($txt_add[$i]))
							{
								$dataAraay	=	array();
								$pref_cnt	=	$cls_db->getdbcontents_sql("SELECT max(`".$def_data["prference"]."`)+1 as maxpref FROM `".$def_data["table"]."`");
								$pref_cnt	=	$pref_cnt[0]["maxpref"];
								$fields		=	$def_data["name"].",".$def_data["prference"];
								$name		=	$txt_add[$i];
								if(!$parentpagevar)
									{
										$name								=	$txt_add[$i];
										$dataAraay[$def_data["name"]]		=	$name;
										$dataAraay[$def_data["prference"]]	=	$pref_cnt;
										if(!$cls_db->db_insert($def_data["table"],$dataAraay))
											{
												$tempErr	.=	implode("<br>",$cls_db->getDbErrors());
											}
										else	$cnt++;
									}
								else
									{
										$name		=	$txt_add[$i];
										$dataAraay[$def_data["name"]]			=	$name;
										$dataAraay[$def_data["foreign"]]		=	$parentpagevarval;
										$dataAraay[$def_data["prference"]]		=	$pref_cnt;
										if(!$cls_db->db_insert($def_data["table"],$dataAraay))
											{
												$tempErr	.=	implode("<br>",$cls_db->getDbErrors());
											}
										else	$cnt++;
									}
							}
					}
			}
		$tpls["error"]			=	"$cnt Details Inserted. <br> $tempErr";
		$_SESSION["tpls_error"]	=	$tpls["error"];
		if(!$parentpagevar)
			{
				header("location:".$tpls["pagename"]);exit;
			}
		else
			{
				header("location:".$tpls["pagename"]."?$parentpagevar=$parentpagevarval");exit;
			}
	}
if($_POST["btn_delete"])
	{
		$cnt	=	0;
		extract($_POST);
		if($def_data["child_table"])
			{
				for($i=0;$i<=count($checkone);$i++)
					{
						if($cls_db->checkfields($def_data["child_table"],$def_data["child_foreign"],$checkone[$i],$def_data["child_primary"]))
							{
								$checkone	=	$cls_site->array_remove($checkone,$checkone[$i]);
								$i--;
								$cnt	=	1;
							}
					}
			}
		$cnt		=	count($checkone);
		$del_vals	=	implode(",",$checkone);
		$cls_db->db_query("delete from ".$def_data["table"]." where ".$def_data["primary"]." in($del_vals)");
		if($cnt)	$tpls["error"]	=	count($checkone)." Records Deleted Successfully.";
		else		$tpls["error"]	=	"Deleted Successfully.";
	}
if($_REQUEST["sortdown"])
	{
		$tempprimary	=	$def_data["primary"];
		$temppreference	=	$def_data["prference"];
		$pref			=	$cls_db->getdbcontents_cond($def_data["table"],$tempprimary."='".$_REQUEST["sortdown"]."'");
		$prefval		=	$pref[0][$temppreference];
		if(!$parentpagevar)	$nextp			=	$cls_db->getdbcontents_cond($def_data["table"],$temppreference." > $prefval order by ".$temppreference." asc limit 1");
		else				$nextp			=	$cls_db->getdbcontents_cond($def_data["table"],$temppreference." > $prefval and ".$def_data["foreign"]." ='$parentpagevarval' order by ".$temppreference." asc limit 1");
		$nextid			=	$nextp[0][$tempprimary];
		$nextp			=	$nextp[0][$temppreference];	
		$data_update	=	$cls_db->db_update($def_data["table"],array($temppreference => $nextp), $tempprimary	="'".$_REQUEST["sortdown"]."'");
		$data_up		=	$cls_db->db_update($def_data["table"],array($temppreference => $prefval),$tempprimary ='$nextid');
		header("location:".$_SERVER["HTTP_REFERER"]);exit;		
	}
if($_REQUEST["sortup"])
	{
		$tempprimary	=	$def_data["primary"];
		$temppreference	=	$def_data["prference"];
		$pref			=	$cls_db->getdbcontents_cond($def_data["table"],$tempprimary."='".$_REQUEST["sortup"]."'");
		$prefval		=	$pref[0][$temppreference];
		if(!$parentpagevar)	$nextp			=	$cls_db->getdbcontents_cond($def_data["table"],$temppreference." < $prefval order by ".$temppreference." desc limit 1");
		else				$nextp			=	$cls_db->getdbcontents_cond($def_data["table"],$temppreference." < $prefval and ".$def_data["foreign"]." ='$parentpagevarval' order by ".$temppreference." desc limit 1");	
		$nextid			=	$nextp[0][$tempprimary];
		$nextp			=	$nextp[0][$temppreference];	
		$data_update	=	$cls_db->db_update($def_data["table"],array($temppreference => $nextp), $tempprimary	="'".$_REQUEST["sortup"]."'");
		$data_up		=	$cls_db->db_update($def_data["table"],array($temppreference => $prefval), $tempprimary = '$nextid');
		header("location:".$_SERVER["HTTP_REFERER"]);exit;		
	}
if(trim($_REQUEST["searchq"]))
	{
		$searchq	=	mysql_real_escape_string(trim($_REQUEST["searchq"]));
		$searchCond	=	" and ".$def_data["name"]." like '%".$searchq."%'";
	}
if(!$parentpagevar)
	{
		$sql		=	"select * from ".$def_data["table"]." where 1".$searchCond." order by ".$def_data["prference"];
		$spage		=	$cls_site->create_paging("n_page",$sql,$page_cnt);
		$data		=	$cls_db->getdbcontents_sql($spage->finalSql());
		$links		=	$spage->s_get_links();
		
		$tpls["spage"]			=	$spage;
		$tpls["paging"]			=	$links;
		$tpls["table"]			=	$def_data;
		$tpls["dataarray"]		=	$data;
	}
else
	{
		$sql		=	"select * from ".$def_data["table"]." where ".$def_data["foreign"]." ='".$parentpagevarval."'".$searchCond;
		$spage		=	$cls_site->create_paging("n_page",$sql,$page_cnt);
		$data		=	$cls_db->getdbcontents_sql($spage->finalSql());
		$links		=	$spage->s_get_links();
		
		$tpls["spage"]			=	$spage;
		$tpls["paging"]			=	$links;
		$tpls["table"]			=	$def_data;
		$tpls["dataarray"]		=	$data;
	}
if($_SESSION["tpls_error"])
	{
		$tpls["error"]			=	$_SESSION["tpls_error"];
		$_SESSION["tpls_error"]	=	"";
	}
$tpls["floop"]		=	ceil($tpls["addcount"]/$tpls["addsplit"]);
$smarty->assign("tpls",$tpls);
?>