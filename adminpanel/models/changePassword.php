<?php
/**************************************************************************************
Created by :hari krishna
Created on :2010-11-22
Purpose    :Contact us  Page
**************************************************************************************/
class changePassword extends modelclass
	{
		public function changePasswordChange()
			{
				$this->permissionCheck("Edit",1);
				$data			=	$this->getData("post");
				$count			=	0;
				foreach($data as $val)
					{
						if(is_null($val) OR empty($val)) $count++;
						if(strlen($data['newPass'])<4 or strlen($data['newPass'])>15)
							{
								$this->setPageError("Please enter a valid password with 6-15 characters");
								$this->executeAction(false,"Listing",true);
								$count++;
							}
						if($data['newPass']		!=	$data['confNewpass'])
							{
								$this->setPageError("Your passwords don't match");
								$this->executeAction(false,"Listing",true);
								$count++;
							}
					}
				
				if($count==0)
					{
						$adminNew			=	new adminUser();
						$logedin			=	end($adminNew->	get_user_data());
						$userid				= 	$logedin['id'];		
						$query				=	$this->dbSearchCond("=", "id",$userid);
						$sql				=	"select password from  vod_admin_users where".$query  ;
						$pass				=	end($this->getdbcontents_sql($sql));
						if($pass['password']==$data['oldPass'])
							{
								$newpass	=		$data['confNewpass'];
								$sqlupdate	=		"UPDATE vod_admin_users SET password = '$newpass' WHERE id='$userid'";
								$change		=		mysql_query($sqlupdate);
								if($change)
									{
										$this->setPageError("Password changed Successfully");
										$this->executeAction(false,"Listing",true);
									}
								else
									{
										$this->setPageError("Error changing password! please try again");
										$this->executeAction(false,"Listing",true);
									}	
							}
				else 
					{
						$this->setPageError("Your old password is wrong");
						$this->executeAction(false,"Listing",true);
					}
				}
			}	
		
		public function changePasswordCancel()
			{
				
				header('Location:adminHome.php?actionvar=Listing');
			}
		
		
		public function __construct()
			{
				$this->setClassName();
				$this->permissionCheck("View",1);
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
