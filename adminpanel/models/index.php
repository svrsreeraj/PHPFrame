<?php
/**************************************************************************************
Created by :Anith M S
Created on :2010-11-16
Updated by : harikrishna  
Purpose    :Index Model Page
**************************************************************************************/
class indexModel extends modelclass
	{
		public function Listing()
			{
				return $this->executeAction(array("action"=>"Signinform","navigate"=>true));
			}	
		public function ForgotPassword()
			{
				return true;
			}
		public function Reset()
			{
				$data		=	$this->getData("post");
				if(trim($data['emailid']))
					  {
						$userObj	=	new adminUser();
						$sql		=	"select * from  php_admin_users  where email='".$data['emailid']."'";
						$dataArra	=	end($this->getdbcontents_sql($sql,true));
						if(!$dataArra)
							{
								$this->setPageError("Sorry! Invalid email");
								$this->executeAction(array("action"=>"forgotPassword","navigate"=>true));
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
										$this->executeAction(array("loadData"=>true,"action"=>"Signinform","navigate"=>true));
									}
							}	
					}
				else
					{
						$this->setPageError("Sorry! Invalid email");
						$this->executeAction(array("action"=>"forgotPassword","navigate"=>true));
					}
			}	
		public function Signinform()
			{
				$userObj	=	new adminUser();
				if($userObj->check_session())	$this->redirectPage($this->getLink("","adminHome.php",false));
				else return true;
			}
		public function Submit()
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
						$this->executeAction(array("loadData"=>true,"action"=>"Signinform","navigate"=>true));
						
					}	
			}
	}
