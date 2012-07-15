<?php
/**************************************************************************************
Created by :hari krishna
Created on :2010-11-22
Purpose    :Contact us  Page
**************************************************************************************/
class changePasswordModel extends modelclass
	{
		public function Change()
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
								$this->executeAction(array("action"=>"Listing","navigate"=>true));
								$count++;
							}
					}
				
				if($count==0)
					{
						$adminNew			=	new coreAdminUser();
						$logedin			=	end($adminNew->	get_user_data());
						$userid				= 	$logedin['id'];		
						$query				=	$this->dbSearchCond("=", "id",$userid);
						$sql				=	"select password from  ".constant("CONST_ADMIN_CORE_TABLE_ADMIN_USERS")." where".$query  ;
						$pass				=	end($this->getdbcontents_sql($sql));
						if($pass['password']==$data['oldPass'])
							{
								$newpass	=		$data['confNewpass'];
								$sqlupdate	=		"UPDATE ".constant("CONST_ADMIN_CORE_TABLE_ADMIN_USERS")." SET password = '$newpass' WHERE id='$userid'";
								$change		=		mysql_query($sqlupdate);
								if($change)
									{
										$this->setPageError("Password changed Successfully");
										$this->executeAction(array("action"=>"Listing","navigate"=>true));
									}
								else
									{
										$this->setPageError("Error changing password! please try again");
										$this->executeAction(array("action"=>"Listing","navigate"=>true));
									}	
							}
				else 
					{
						$this->setPageError("Your old password is wrong");
						$this->executeAction(array("action"=>"Listing","navigate"=>true));
					}
				}
			}	
		public function Cancel()
			{
				header('Location:adminHome.php?actionvar=Listing');exit;
			}
	}
