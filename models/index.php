<?php
/****************************************************************************************
Created by	:	Sreeraj
Created on	:	2010-12-14
Purpose		:	Model class for AppProcess
*************** *************************************************************************/
class index extends modelclass
	{
		public function indexListing()
			{
				return array();
			}
		
		public function __construct()
			{
				$this->setClassName();
			}
		public function executeAction($loadData=true,$action="",$ufURL="",$navigate=false,$sameParams=false,$newParams="",$excludParams="",$page="")
			{
				if(trim($action))	$this->setAction($action);//forced action
				$methodName	=		(method_exists($this,$this->getMethodName()))	? $this->getMethodName($default=false):$this->getMethodName($default=true);
				$this->actionToBeExecuted($loadData,$methodName,$action,$navigate,$sameParams,$newParams,$excludParams,$page,$ufURL);
				$this->actionReturn		=	call_user_func(array($this, $methodName));				
				$this->actionExecuted($methodName);
				return $this->actionReturn;
			}
		public function __destruct() 
			{
				parent::childKilled($this);
			}
	}
