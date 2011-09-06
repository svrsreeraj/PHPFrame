<?php
/**************************************************************************************
Created by :Anith M S
Created on :2010-11-16
Updated by : harikrishna  
Purpose    :Index Model Page
**************************************************************************************/
class index extends modelclass
	{
		public function indexListing()
			{
				return $this->executeAction($loadData=true,$action="",$navigate=true,$sameParams=false,$newParams="",$excludParams="",$page="adminHome.php");
			}	
		public function indexforgotPassword()
			{
				return true;
			}
		public function indexReset()
			{
				$data		=	$this->getData("post");
				if(trim($data['emailid']))
				  {
					$userObj	=	new adminUser();
					$sql		=	"select * from  vod_admin_users  where email='".$data['emailid']."'";
					$dataArra	=	end($this->getdbcontents_sql($sql,true));
					if(!$dataArra)
						{
							$this->setPageError("Sorry! Invalid email");
							$this->executeAction(false,"forgotPassword",true);
						}
					else
						{
							$to			=	$data['emailid'];
							$from		=	GLB_SITE_EMAIL;
							$subject	=	"Password recovery mail";
							$cmsObj		=	new cms();
							
							$varArr							=	array();
							$varArr["{TPL_NAME}"]			=	$dataArra['fname'].' '.$dataArra['lname'];
							$varArr["{TPL_EMAIL}"]			=	$dataArra["email"];
							$varArr["{TPL_PASSWORD}"]		=	$dataArra['password'];
							$send							=	$cmsObj->sendMailCMS("14",$to,$from,$subject,$varArr,5); 
							if($send)
								{
									$this->setPageError("A mail has been to your email address");
									$this->executeAction(true,"Signinform",true);
								}
						}	
				}
				else
				{
					$this->setPageError("Sorry! Invalid email");
					$this->executeAction(false,"forgotPassword",true);
				}
			}	
		public function indexSigninform()
			{
				$userObj	=	new adminUser();
				if($userObj->check_session())	$this->redirectPage($this->getLink("","adminHome.php",false));
				else return true;
			}
		public function indexSubmit()
			{
				$data		=	$this->getData("post");				
				$userObj	=	new adminUser();
				$arr		=	$userObj->validateAdminUser($data['username'],$data['password']);
				if($arr)	
					{
						$userid								=	$arr[0]["id"];
						$_SESSION[$userObj->get_sessname()]	=	$userid;
						$this->clearData();			

						if($_SESSION['adminLoginRedirectLink'])
							$this->redirectPage($_SESSION['adminLoginRedirectLink']);
						else
							$this->redirectPage($this->getLink("","adminHome.php",false));
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
