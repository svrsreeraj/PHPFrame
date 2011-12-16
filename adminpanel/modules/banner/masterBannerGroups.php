<?php
/**************************************************************************************
Created by : Maria
Created on : 14-12-2011
Purpose    : Banner group listing
**************************************************************************************/
require_once 'init.php';err_status("init.php included");
$tpls		=	array();
$def_data	=	array();

//page details
$tpls["norecords"]				=	"No Records Found!";
$tpls["heading"]				=	"Manage Banner Group";
$tpls["pagename"]				=	"masterBannerGroups.php";
$tpls["parentpagename"]			=	"";
$tpls["childpagename"]			=	"";
$tpls["childpagevar"]			=	"";
$tpls["parentpagevar"]			=	"";
$tpls["parentBtnBack"]			=	"";

//database details
$def_data["table"]				=	constant("CONST_MODULE_BANNER_TABLE_GROUP");
$def_data["primary"]			=	"id";
$def_data["name"]				=	"category";
$def_data["prference"]			=	"preference";
$def_data["foreign"]			=	"";
$def_data["status"]				=	"status";

$def_data["parent_table"]		=	"";
$def_data["parent_primary"]		=	"";
$def_data["parent_name"]		=	"";
$def_data["parent_foreign"]		=	"";

$def_data["child_table"]		=	"";
$def_data["child_primary"]		=	"";
$def_data["child_foreign"]		=	"";

//add area
$tpls["addcaption"]				=	"Add Banner category";
$tpls["addcount"]				=	15;
$tpls["addsplit"]				=	3;
$tpls["addbtnvalue"]			=	"Add Banner category";
$tpls["savebtnvalue"]			=	"Save";
$tpls["btnsavecancelvalue"]		=	"Cancel";

//update area
$tpls["edithead"]				=	"Edit Banner category";
$tpls["editcaption"]			=	"Groups";
$tpls["updatebtnvalue"]			=	"Update";
$tpls["btnupdatecancelvalue"]	=	"Cancel";

//listing area
$tpls["listcaption"]			=	"category";
$tpls["listoptions"]			=	"Options";
$tpls["preference"]				=	"Order";
$tpls["img_sortup"]				=	"images/up.gif";
$tpls["img_sortdown"]			=	"images/down.gif";

$page_cnt						=	GLB_PAGE_CNT;
require_once("tpl_template.php");
$smarty->display('tpl_template1.tpl.html');
