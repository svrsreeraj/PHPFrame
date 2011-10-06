<?php
/**************************************************************************************
Created by :hari krishna
Created on :2010-11-16
Purpose    :Admin Home Model Page
******************* *******************************************************************/
class modulesModel extends modelclass 
	{
		public function Listing()
			{
				$modObj		=	new moduleclass();
				$modules	=	$modObj->getModulesListWithStatus();
				return array("modules"=>$modules);
			}
	}
