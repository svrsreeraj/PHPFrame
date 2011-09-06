<?php
/**************************************************************************************
Created by :Sreeraj
Created on :2010-11-04
Purpose    :Including Classes
**************************************************************************************/
require_once	$projectPath.'classes/defaults.php';
require_once	$projectPath.'classes/adminUser.php';
require_once	$projectPath.'classes/faq.php';
require_once	$projectPath.'classes/masters.php';

//Default Value Settings
$defaultsObj	=	new defaults();
$defaultsObj->defineConstants();

?>