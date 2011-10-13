<?php
/**************************************************************************************
Created by :Mahinsha
Created on :2010-11-12
Purpose    :Admin Users
**************************************************************************************/
class adminUsersModel extends modelclass
	{
		public function Listing()
			{
				$this->permissionCheck("View",1);
				$searchData		=	$this->getData("post","Search");
				$sortData		=	$this->getData("request","Search");
				$adminUserObj	=	new coreAdminUser();
				$searchCombo	=	$this->get_combo_arr("sel_search_group",$adminUserObj->getAllUsertypes("1"),"id","typename",$searchData["sel_search_group"],"style='width:100px;'","All User Types");
				if(!trim($sortData["sortField"]))
					{
						$this->addData(array("sortField"=>"id"),"request","Search");
						$this->addData(array("sortMethod"=>"desc"),"request","Search");
						$sortData	=	$this->getData("request","Search");//refreshing the variable
					}					
				if(trim($searchData["userId"]))
					{
						
						$sqlCond	.=	" And ( ";
						$sqlCond	.=	$this->dbSearchCond("=", "id", $searchData["userId"]);
						$sqlCond	.=	") ";
					}	
				if(trim($searchData["keyword"]))
					{
						$sqlCond	.=	" And ( ";
						$sqlCond	.=	$this->dbSearchCond("like", "fname", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "lname", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "email", "%".$searchData["keyword"]."%"). " or";
						$sqlCond	.=	$this->dbSearchCond("=", "mobile", $searchData["keyword"]). " or";
						$sqlCond	.=	$this->dbSearchCond("like", "date_added", "%".$searchData["keyword"]."%");
						$sqlCond	.=	") ";
					}
				if(trim($searchData["sel_search_group"]))
					{
						$sqlCond	.=	" And ". $this->dbSearchCond("=", "usertype", $searchData["sel_search_group"]);
					}
				$sqlCond	.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				$sql		=	"select * from ".constant("CONST_ADMIN_CORE_TABLE_ADMIN_USERS")." where 1  $sqlCond";
				$spage		=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data		=	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)		$this->setPageError("No records found !");
				$searchData					=	$this->getHtmlData($this->getData("post","Search",false));
				$searchData["searchCombo"]	=	$searchCombo; 
				$searchData["sortData"]		=	$sortData;
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);
			}
		public function Reset()
			{
				$this->clearData("Search");
				$this->executeAction(array("action"=>"Listing","navigate"=>true));
			}
		public function Search()
			{
				$this->executeAction(array("action"=>"Listing","navigate"=>true));
			}
		public function Addformbtn()
			{
				$this->permissionCheck("Add",1);
				$this->executeAction(array("action"=>"Addform","navigate"=>true,"sameParams"=>true));
			}
		public function Cancel()
			{
				$this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true));	
			}
		public function Editform()
			{
				$this->permissionCheck("Edit",1);
				$data			=	$this->getData("get");
				$adminUserObj	=	new coreAdminUser();
				$dataArr		=	end($adminUserObj->getDetails($data["id"]));
				if(!$dataArr)
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						return $this->executeAction(false,"Listing",true);
					}
				$dropDown	=	$this->get_combo_arr("usertype",$adminUserObj->getAllUsertypes("status=1"),"id","typename",$dataArr["usertype"]);						
				return array("combo"=>$dropDown,"data"=>$this->getHtmlData($dataArr));
			}
		public function Addform()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getHtmlData($this->getData("post","Addform",false));
				$adminUserObj	=	new coreAdminUser();
				$dropDwon	=	$this->get_combo_arr("usertype",$adminUserObj->getAllUsertypes("status=1"),"id","typename",$dataArr["usertype"]);
				return array("combo"=>$dropDwon,"data"=>$data);
			}
		public function Savedata()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getData("files");
				if($data[fileImage] [name])
					{
						$upObj		=	$this->create_upload(10,"jpg,png,jpeg,gif");
						$adimg		=	$upObj->copy("fileImage","../images/subcategory",2);
						if($adimg)		$upObj->img_resize("100","120","../images/subcategory/thumb");
						else 			$this->setPageError($upObj->get_status());
						$this->addData(array("image"=>$adimg),"request");
					}
				$data		=	$this->getData("request");
				$dataIns	=	$this->populateDbArray(constant("CONST_ADMIN_CORE_TABLE_ADMIN_USERS"),$data);
				$adminUserObj	=	new coreAdminUser();
				if(!$this->getPageError())
					{
						$id	=	$adminUserObj->createAdminUser($dataIns);
						if($id)	
							{
								$adminUserdata						=	end($adminUserObj->getAdminUsers("id=".$id));
								$custArr["{TPL_NAME}"]				=	$adminUserdata['fullname'];
								$custArr["{TPL_ACTIVATION_LINK}"]	=	ROOT_ADMIN_URL.'adminUsers.php?actionvar=Stauschange&id='.$id."&status=0&activation=1";
								$to									=	$adminUserdata['email'];
								$from								=	GLB_SITE_EMAIL;
								$subject							=	"Voteondeals.com - Admin User Activation Mail";
								
								$cmsObj								=	new cms();
								$send								=	$cmsObj->sendMailCMS('11',$to,$from,$subject,$custArr,5); 
								
								if($send)
									{
										$this->setPageError("Inserted Successfully");
										$this->clearData("Savedata");
										$this->clearData("Addform");						
										$this->executeAction(array("action"=>"Listing","navigate"=>true));
									}
							}
						else
							{
								$this->setPageError($adminUserObj->getPageError());
								$this->executeAction(array("action"=>"Addform","navigate"=>true));
							}	
					}
				
			}
		public function Stauschange()
			{	
				
				$this->permissionCheck("Status",1);
				$data				=	$this->getData("request");
				$dataIns["status"]	=	!$data["status"];
				$userObj			=	new coreAdminUser();
				$updatesucces		=	$userObj->updateAdminUser($dataIns,$data["id"])	;
				if( $updatesucces & $data['activation'])	
					{
						$adminUserdata							=	end($userObj->getAdminUsers("id=".$data["id"]));
						$adminmail["{TPL_NAME}"]				=	$adminUserdata['fullname'];
						$adminmail["{TPL_EMAIL}"]				=	$adminUserdata['email'];
						$adminmail["{TPL_PASSWORD}"]			=	$adminUserdata['password'];
						$to										=	$adminUserdata['email'];
						$from									=	GLB_SITE_EMAIL;
						$subject								=	"Voteondeals.com -  Admin User account details";
						
						$cmsObj									=	new cms();
						$send									=	$cmsObj->sendMailCMS('42',$to,$from,$subject,$adminmail,5); 
						
						if($send)
							{
								$this->setPageError("Inserted Successfully");
								$this->clearData("Savedata");
								$this->clearData("Addform");						
								return $this->executeAction(array("action"=>"Listing","navigate"=>true));
							}
						
						$this->setPageError("Updated Successfully");
						$this->clearData();//this											
						return $this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true,"excludeParams"=>'status,id'));
					}
				else if($updatesucces)	
					{
						$this->setPageError("Updated Successfully");
						$this->clearData();//this											
						return $this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true,"excludeParams"=>'status,id'));
					}
				else
					{
						$this->setPageError($userObj->getPageError());
						return $this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true));
					}
			}
		public function Updatedata()
			{				
				$this->permissionCheck("Edit",1);
				$adminUserObj	=	new coreAdminUser();
				$data		=	$this->getData("request");
				$dataIns	=	$this->populateDbArray(constant("CONST_ADMIN_CORE_TABLE_ADMIN_USERS"),$data);
				if($adminUserObj->updateAdminUser($dataIns,$data["id"]))	
					{
						$this->setPageError("Updated Successfully");
						$this->clearData();//this
						$this->clearData("Editform");						
						return $this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true));
					}
				else
					{
						$this->setPageError($adminUserObj->getPageError());
						return $this->executeAction(array("action"=>"Editform","navigate"=>true,"sameParams"=>true));
					}	
			}
	}
