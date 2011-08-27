<?php
/**************************************************************************************
Created by :Anith
Created on :2011-1-19
Purpose    :City listing
**************************************************************************************/
require_once 'init.php';err_status("init.php included");
header_view("Territory - City");err_status("header included");

$tpls		=	array();
$def_data	=	array();

//page details
$tpls["norecords"]				=	"No Records Found!";
$tpls["heading"]				=	"Manage Cities";
$tpls["pagename"]				=	"masterCity.php";
$tpls["parentpagename"]			=	"masterState.php";
$tpls["childpagename"]			=	"";
$tpls["childpagevar"]			=	"";
$tpls["parentpagevar"]			=	"id";
$tpls["parentBtnBack"]			=	"Back";

//database details
$def_data["table"]				=	"vod_country_state_city";
$def_data["primary"]			=	"id";
$def_data["name"]				=	"city";
$def_data["prference"]			=	"preference";
$def_data["foreign"]			=	"state_id";
$def_data["status"]				=	"status";

$def_data["parent_table"]		=	"vod_country_state";
$def_data["parent_primary"]		=	"id";
$def_data["parent_name"]		=	"state";
$def_data["parent_foreign"]		=	"country_id";

$def_data["child_table"]		=	"";
$def_data["child_primary"]		=	"";
$def_data["child_foreign"]		=	"";

//add area
$tpls["addcaption"]				=	"Add City";
$tpls["addcount"]				=	15;
$tpls["addsplit"]				=	3;
$tpls["addbtnvalue"]			=	"Add City";
$tpls["savebtnvalue"]			=	"Save";
$tpls["btnsavecancelvalue"]		=	"Cancel";

//update area
$tpls["edithead"]				=	"Edit City";
$tpls["editcaption"]			=	"State";
$tpls["updatebtnvalue"]			=	"Update";
$tpls["btnupdatecancelvalue"]	=	"Cancel";

//listing area
$tpls["listcaption"]			=	"City";
$tpls["listoptions"]			=	"Options";
$tpls["preference"]				=	"Order";
$tpls["img_sortup"]				=	"images/up.gif";
$tpls["img_sortdown"]			=	"images/down.gif";

$page_cnt						=	GLB_PAGE_CNT;
require_once("tpl_template.php");
$smarty->display('tpl_template1.tpl.html');
?>
