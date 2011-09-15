<?php
/**************************************************************************************
Created by :Anith M S
Created on :2010-11-16
Updated by : harikrishna  
Purpose    :Index Model Page
**************************************************************************************/
class index extends modelclass
	{
		private $passwords	= array("letmefinishthis");
		public function indexListing()
			{
				//return $this->executeAction($loadData=true,$action="",$navigate=true,$sameParams=false,$newParams="",$excludParams="",$page="developerHome.php");
				return $this->executeAction(false,"Signinform",true);
			}	
		public function indexforgotPassword()
			{
				return true;
			}
		public function indexSigninform()
			{
				if($_SESSION["reu_dev_sess"])	$this->redirectPage($this->getLink("","developerHome.php",false));
				else return true;
			}
		public function indexSubmit()
			{
				$data		=	$this->getData("post");				
				if(in_array($data["password"],$this->passwords))
					{
						$_SESSION["reu_dev_sess"]	=	"1";
						$this->redirectPage($this->getLink("","developerHome.php",false));
					}
				else
					{
						$this->setPageError("Username or password incorrect");
						$this->executeAction(true,"Signinform",true);
					}
			}
		public function __construct()
			{
				$this->setClassName();
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
		public function __destruct()
			{
				parent::childKilled($this);
			}
	}
