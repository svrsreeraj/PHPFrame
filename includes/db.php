<?php
/**************************************************************************************
Created by :Sreeraj
Created on :15-11-2011
Purpose    :Database details page
**************************************************************************************/
$cfg["DB_SERVER"]	=	constant("CONST_DB_HOST");
$cfg["DB_USER"]		=	constant("CONST_DB_USERNAME");
$cfg["DB_PASSWORD"]	=	constant("CONST_DB_PASSWORD");
$cfg["DB"]			=	constant("CONST_DB_NAME");
	
$con	=	mysql_pconnect($cfg["DB_SERVER"],$cfg["DB_USER"],$cfg["DB_PASSWORD"]) or die("Cannot connect to server");
mysql_select_db($cfg["DB"],$con) or die("Cannot connect to Database");
?>
