<?php
/**************************************************************************************
Created by :Anith
Created on :2010-11-08
Purpose    :Test Model Page
**************************************************************************************/
class testAnith extends modelclass
	{
		public function __construct()
			{
				$this->setClassName();
			}
		
		public function testAnithEdit()
			{
				echo "Update DONE !!!!!";
			}
		public function testAnithListing()
			{
				echo "Listing DONE !!!!!";
			}
		public function executeAction($loadData=true,$action="",$navigate=false,$sameParams=false,$newParams="",$excludParams="",$page="")
			{
				if(trim($action))	$this->setAction($action);//forced action
				$methodName	=		(method_exists($this,$this->getMethodName()))	? $this->getMethodName($default=false):$this->getMethodName($default=true);
				$this->actionToBeExecuted($loadData,$methodName,$action,$navigate,$sameParams,$newParams,$excludParams,$page);
				$this->actionReturn		=	call_user_func(array($this, $methodName));				
				$this->actionExecuted($methodName);
				return $this->actionReturn;
			}
		function __destruct()
			{
				parent::childKilled($this);
			}
	}
?>
