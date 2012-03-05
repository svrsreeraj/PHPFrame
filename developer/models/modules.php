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
		public function Install()
			{
				$data		=	$this->getData("request");
				$modObj		=	new moduleclass();
				$mStatus	=	$modObj->getModuleStatus($data["module"]);
				$err		=	false;
				if($mStatus["moduleErrorLog"])	
					{
						$err	=	true;
						$this->setPageError($mStatus["moduleErrorLog"]);
					}
				if($mStatus["moduleInstalled"])
					{
						$err	=	true;
						$this->setPageError("Module Already installed");
					}
				if($err		==	false)
					{
						$modObj->installModule($data["module"]);
						if($modObj->errorArray)	$this->setPageError($modObj->errorArray);
						else $this->setPageError($modObj->statusArray);
					}
				$this->executeAction(array("action"=>"listing","navigate"=>true));
			}
		public function Uninstall()
			{
				$data		=	$this->getData("request");
				$modObj		=	new moduleclass();
				$mStatus	=	$modObj->getModuleStatus($data["module"]);
				$err		=	false;

				if(!$mStatus["moduleInstalled"])
					{
						$err	=	true;
						$this->setPageError("Module is not installed");
					}
				if($err		==	false)
					{
						$modObj->uninstallModule($data["module"]);
						$this->setPageError("Removed all possible related files");
					}
				$this->executeAction(array("action"=>"listing","navigate"=>true));
			}
	}
