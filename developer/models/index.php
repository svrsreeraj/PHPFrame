<?php
/**************************************************************************************
Created by :Anith M S
Created on :2010-11-16
Updated by : harikrishna  
Purpose    :Index Model Page
**************************************************************************************/
class indexModel extends modelclass
	{
		private $passwords	= array("letmefinishthis");
		public function Listing()
			{
				//return $this->executeAction($loadData=true,$action="",$navigate=true,$sameParams=false,$newParams="",$excludParams="",$page="developerHome.php");
				return $this->executeAction(false,"Signinform",true);
			}	
		public function ForgotPassword()
			{
				return true;
			}
		public function Signinform()
			{
				if($_SESSION["reu_dev_sess"])	$this->redirectPage($this->getLink("","developerHome.php",false));
				else return true;
			}
		public function Submit()
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
		public function __destruct()
			{
				parent::childKilled($this);
			}
	}
