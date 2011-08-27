<?php
/****************************************************************************************
Created by	:	M S Anith
Created on	:	2010-11-30
Purpose		:	Manage deals 
****************************************************************************************/
class dealsList extends modelclass
	{
		public function dealsListListing()
			{ 
				$this->permissionCheck("View",1);
				$searchData		=	$this->getData("post","Search");
				$sortData		=	$this->getData("request","Search");
				$dealObj		=	new deals();
								
				//Application combo
				$masterObj		=	new masters();
				$appCombo		=	$masterObj->getAllDetails("vod_site_apps");
				$appCombo		=	$this->get_combo_arr("sel_apps",$appCombo,"id","apps",$searchData["sel_apps"],"","All");
				
				//sales agent combo
				$adminObj		=	new adminUser();
				$userSess 		=	end($adminObj->get_user_data());					
				$utypeId	 	=	$userSess["usertype"];
				$uid	 		=	$userSess["id"];
				
				if($utypeId == GLB_ADMIN_UTYPEID)	
					{		
						$salesAgents	=	$adminObj->getAdminUsers("usertype=".GLB_SAGENT_UTYPEID." and status='1'");
						$salesAgents	=	$this->get_combo_arr("sales_agents",$salesAgents,"id","fullname",$searchData["sales_agents"]);
					}
				
				//cat combo
				$catCombo		=	$dealObj->getOptGroup('sel_opt_cat[]','style="width:170px;height:120px;"',$searchData["sel_opt_cat"]);
				
				if(trim($searchData["sel_status"])!="")									$sqlFilter["cond"]	.=	" and d.status in (".$searchData["sel_status"].")";
				if(trim($searchData["sel_apps"])!="")									$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "d.apps_id",$searchData["sel_apps"]);
				if(trim($searchData["sel_date_field_from"])=="Added")					$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "date(d.date_added)",$searchData["txt_date_field_from"]);
				if(trim($searchData["sel_date_field_from"])=="Locked")					$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "date(d.activation_date)",$searchData["txt_date_field_from"]);
				if(trim($searchData["sel_date_field_from"])=="Unlocked")				$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "date(d.unlocked_date)",$searchData["txt_date_field_from"]);
				if(trim($searchData["sel_date_field_from"])=="Cooldown")				$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "date(d.cooldown_date)",$searchData["txt_date_field_from"]);
				if(trim($searchData["sel_date_field_from"])=="Expired")					$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "date(d.expired_date)",$searchData["txt_date_field_from"]);
				if(trim($searchData["sel_date_field_from"])=="CouponExpiry")			$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "date(d.coupon_expiry_date)",$searchData["txt_date_field_from"]);
				if(trim($searchData["sel_date_field_from"])=="Updated")					$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "date(d.status_updatedate)",$searchData["txt_date_field_from"]);

				
				if(trim($searchData["sel_date_field_to"])=="Added")						$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("<=", "date(d.date_added)",$searchData["txt_date_field_to"]);
				if(trim($searchData["sel_date_field_to"])=="Locked")					$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("<=", "date(d.activation_date)",$searchData["txt_date_field_to"]);
				if(trim($searchData["sel_date_field_to"])=="Unlocked")					$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("<=", "date(d.unlocked_date)",$searchData["txt_date_field_to"]);
				if(trim($searchData["sel_date_field_to"])=="Cooldown")					$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("<=", "date(d.cooldown_date)",$searchData["txt_date_field_to"]);
				if(trim($searchData["sel_date_field_to"])=="Expired")					$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("<=", "date(d.expired_date)",$searchData["txt_date_field_to"]);
				if(trim($searchData["sel_date_field_to"])=="CouponExpiry")				$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("<=", "date(d.coupon_expiry_date)",$searchData["txt_date_field_to"]);
				if(trim($searchData["sel_date_field_to"])=="Updated")					$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("<=", "date(d.status_updatedate)",$searchData["txt_date_field_to"]);
					
				if(trim($searchData["sel_amount_field_from"])=="Votes")					$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "d.votes",$searchData["txt_amount_field_from"]);
				if(trim($searchData["sel_amount_field_from"])=="Unlockvote")			$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "d.unlockvote",$searchData["txt_amount_field_from"]);
				if(trim($searchData["sel_amount_field_from"])=="Total_Quantity")		$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "d.total_quantity",$searchData["txt_amount_field_from"]);
				if(trim($searchData["sel_amount_field_from"])=="Sold_Quantity")			$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "d.sold_quantity",$searchData["txt_amount_field_from"]);
				if(trim($searchData["sel_amount_field_from"])=="Balance_Quantity")		$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "d.balance_quantity",$searchData["txt_amount_field_from"]);
				if(trim($searchData["sel_amount_field_from"])=="Price")					$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "d.deal_price",$searchData["txt_amount_field_from"]);
				if(trim($searchData["sel_amount_field_from"])=="Cost")					$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "d.cost",$searchData["txt_amount_field_from"]);
				if(trim($searchData["sel_amount_field_from"])=="Offer")					$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "d.offer_rate",$searchData["txt_amount_field_from"]);
				if(trim($searchData["sel_amount_field_from"])=="Vendor_Commission")		$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "d.vendor_comm_rate",$searchData["txt_amount_field_from"]);
				if(trim($searchData["sel_amount_field_from"])=="Site_Commission")		$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "d.site_comm_rate",$searchData["txt_amount_field_from"]);
				if(trim($searchData["sel_amount_field_from"])=="Agent_Commission")		$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "d.sales_comm_rate",$searchData["txt_amount_field_from"]);

				if(trim($searchData["sel_amount_field_to"])=="Votes")					$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("<=", "d.votes",$searchData["txt_amount_field_to"]);
				if(trim($searchData["sel_amount_field_to"])=="Unlockvote")				$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("<=", "d.unlockvote",$searchData["txt_amount_field_to"]);
				if(trim($searchData["sel_amount_field_to"])=="Total_Quantity")			$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("<=", "d.total_quantity",$searchData["txt_amount_field_to"]);
				if(trim($searchData["sel_amount_field_to"])=="Sold_Quantity")			$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("<=", "d.sold_quantity",$searchData["txt_amount_field_to"]);
				if(trim($searchData["sel_amount_field_to"])=="Balance_Quantity")		$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("<=", "d.balance_quantity",$searchData["txt_amount_field_to"]);
				if(trim($searchData["sel_amount_field_to"])=="Price")					$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("<=", "d.deal_price",$searchData["txt_amount_field_to"]);
				if(trim($searchData["sel_amount_field_to"])=="Cost")					$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("<=", "d.cost",$searchData["txt_amount_field_to"]);
				if(trim($searchData["sel_amount_field_to"])=="Offer")					$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "d.offer_rate",$searchData["txt_amount_field_to"]);
				if(trim($searchData["sel_amount_field_to"])=="Vendor_Commission")		$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "d.vendor_comm_rate",$searchData["txt_amount_field_to"]);
				if(trim($searchData["sel_amount_field_to"])=="Site_Commission")			$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "d.site_comm_rate",$searchData["txt_amount_field_to"]);
				if(trim($searchData["sel_amount_field_to"])=="Agent_Commission")		$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "d.sales_comm_rate",$searchData["txt_amount_field_to"]);
				
				if(trim($searchData["txt_vendorId"]))			
					{
						$sqlFilter["cond"]	.=	" and(".$this->dbSearchCond("=", "v.id",$searchData["txt_vendorId"])." or ".$this->dbSearchCond("=", "v.email",$searchData["txt_vendorId"]).")";	
					}
				if(trim($searchData["txt_dealId"]))			
					{
						$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "d.id",$searchData["txt_dealId"]);	
					}
				if(!trim($sortData["sortField"]))
					{
						$this->addData(array("sortField"=>"id"),"request","Search");
						$this->addData(array("sortMethod"=>"desc"),"request","Search");
						$sortData	=	$this->getData("request","Search");
					}
				$sqlFilter["join"]	.=	" left join	 vod_admin_users as au on au.id = d.saleagent_id ";
				$sqlFilter["selc"]	.=	" ,au.fname as s_agent_fname, au.lname  as s_agent_lname ";	
				if(trim($searchData["sales_agents"]))			
					{
						$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("=", "d.saleagent_id",$searchData["sales_agents"]);
					}
				else
					{
						if($utypeId == GLB_SAGENT_UTYPEID)
						$sqlFilter["cond"]	.=	" and".$this->dbSearchCond("=", "d.saleagent_id",$uid);
					}
				if(trim($searchData["keyword"]))
					{
						$sqlFilter["cond"]	.=	" And ( ";
						$sqlFilter["cond"]	.=	$this->dbSearchCond("like", "d.name", "%".$searchData["keyword"]."%"). " or";
						$sqlFilter["cond"]	.=	$this->dbSearchCond("like", "d.caption", "%".$searchData["keyword"]."%"). " or";
						$sqlFilter["cond"]	.=	$this->dbSearchCond("like", "d.description", "%".$searchData["keyword"]."%"). " or";
						$sqlFilter["cond"]	.=	$this->dbSearchCond("like", "d.rules", "%".$searchData["keyword"]."%"). " or";
						$sqlFilter["cond"]	.=	$this->dbSearchCond("like", "v.contact_person", "%".$searchData["keyword"]."%"). " or";
						$sqlFilter["cond"]	.=	$this->dbSearchCond("=", "v.tax",$searchData["keyword"]);
						$sqlFilter["cond"]	.=	") ";
					}
				if($searchData["sel_opt_cat"])
					{
						$sqlFilter["cond"]	.=	" and d.subcategory_id in(".implode(",",$searchData["sel_opt_cat"]).") ";
					}	
				$sqlFilter["ord"]			.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				$sql						 =	"SELECT d.*,v.business_name,s.subcategory".$sqlFilter["selc"]." 
												from  vod_deal as d".$sqlFilter["join"]."
												left join vod_vendor as v on  d.vendor_id=v.id 
												left join vod_category_sub as s on d.subcategory_id=s.id 
												where 1 ".$sqlFilter["cond"].$sqlFilter["ord"];
				$this->addData(array("sql"=>$sql),"post","",false);
				$spage				 		=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);						
				$data				 		=	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)						$this->setPageError("No records found !");
				else
					{
						foreach($data as $keys=>$vals)
							{
								$did		=	$vals["id"];
								$sql		=	"select * from pod_coupon where vod_deal_id=".$did;
								$dataCnt	=	$this->getdbcount_sql($sql);
								if($dataCnt > 0)	$data[$keys]["podPosted"]	=	1;	
								else				$data[$keys]["podPosted"]	=	"";								
							}
						
					}
					
				$searchData			 		=	$this->getHtmlData($this->getData("post","Search",false));
				$searchData["sortData"]			=	$sortData;
				$searchData["cat_application"]	=	$appCombo;	
				$searchData["sel_opt_cat"]		=	$catCombo;	
				if($utypeId == GLB_ADMIN_UTYPEID)	$searchData["sales_combo"]		=	$salesAgents; 
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData);
			}
		public function dealsListGetcsv()
			{	
				$sqlData		=	$this->getData("post","Listing",false);
				if(trim($sqlData["sql"]))
					{	
						$headArr		=	array('NAME','CAPTION','VENDOR','DESCRIPTION','SUBCATEGORY','RULES','DEAL PRICE','COST');
						$fieldArr		=	array('name','caption','business_name','description','subcategory','rules','deal_price','cost');
						$this->getCsvFile($sqlData["sql"],$headArr,$fieldArr,"dealList");						
					}
			}
		public function dealsListBlockstatuschange()
			{	
					$this->permissionCheck("Status",1);					
					$data				=	$this->getData("request");	
					if($this->statusChange("vod_deal",$data["id"],"block_status"))
						{
						
							$this->setPageError("Block Status Changed Successfully");
							$this->clearData();											
							return $this->executeAction(false,"Listing",true,true,'','block_status,id');
						}
			}
		public function dealsListDeletedeal()
			{
				$dealObj				=	new deals;
				$data					=	$this->getData("request");
				if($dealObj->deletePendingDeals($data["id"]))	
					{
						$this->setPageError("Deleted Successfully");
						$this->clearData();
						return $this->executeAction(true,"Listing",true);
					}
				else	
					{
						$this->setPageError("Sorry. Can not delete the deal");	
						return $this->executeAction(true,"Listing",true);
					}					
						
			}
		public function dealsListSearch()
			{
				$this->executeAction(false,"Listing",true);
			}
		public function dealsListTopod()
			{
				$data					=	$this->getData("request");
				$dealObj				=	new deals();
				$detailsdetails			=	$dealObj->getDealDetails($data['id']);
				$sql					=	"select count(*) as count from pod_coupon where vod_deal_id=".$data['id'];
				$datacount					=	end($this->getdbcontents_sql($sql));
				if($datacount['count']==0)
					{
						$this->clearData();
						$this->addData(array("vod_deal_id"=>$data['id'],"name"=>$detailsdetails['0']['name'],"caption"=>$detailsdetails['0']['caption']),"post","Addnew",false,"pod_listing.php");
						$this->executeAction(true,"Addnew",true,false,"","","pod_listing.php");	
					}
				else
					{
						$this->clearData();
						$this->addData(array("vod_deal_id"=>$data['id'],"name"=>$detailsdetails['0']['name'],"caption"=>$detailsdetails['0']['caption']),"get","Editform",false,"pod_listing.php");	
						$this->executeAction(true,"Editform",true,false,"","","pod_listing.php");	
					}
			}
		public function dealsListCancel()
			{
				$this->clearData("Editform");
				$this->clearData("Addform");
				$this->executeAction(false,"Listing",true,false);	
			}
		public function dealsListReset()
			{
				$this->clearData("Search");
				$this->executeAction(false,"Listing",true,false);	
			}
		public function dealsListGetcombo()
			{
				ob_clean();
				$data				=	$this->getData("request");
				$dealObj			=	new deals();
				echo $this->get_combo_arr("subcategory_id",$dealObj->getAllSubCategories("category_id ='".$data["id"]."' and status='1' order by preference"),"id","subcategory",$data["subcategory_id"],"id=\"subcategory_idId\"","Select Subcategory");
				exit;
			}
		public function dealsListGetvendor()
			{
				ob_clean();
				$data				=	$this->getData("request");
				$dealObj			=	new deals();				
				$valid				=	is_numeric(trim($data["id"]));	
				if($valid)			$vid	= trim($data["id"]); else $vid="";
								
				if($dealObj->canCreateDeal($vid))
					{
						echo   '<input type="text"  name="vendor_id"  value="'.$vid.'" id="vendor_idId"   maxlength="20" class="nummberOnly" onchange="getvalidvendor(this.value,\'divVendor\')"/><span style="color:#0099CC"> [Eligible Vendor] </span>';
						exit;
					}
				else
					{
						echo   '<input type="text"  name="vendor_id" value="" id="vendor_idId"   maxlength="20" class="nummberOnly" onchange="getvalidvendor(this.value,\'divVendor\')"/><span style="color:#0099CC"> [Either this ID is incorrect or this vendor <br />is not eligible for creating new deal] </span>';
						exit;
					}
			}
		public function dealsListAddformbtn()
			{
				$this->permissionCheck("Add",1);
				$this->executeAction(false,"Addform",true);	
			}	
			
		public function dealsListAddform()
			{
				$this->permissionCheck("Add",1);
				$data				=	$this->getData("post");
				$dealObj			=	new deals();				
				$vendorObj			=	new vendor();
				$userObj			=	new adminUser();
				$userSess 			=	end($userObj->get_user_data());					
				$utypeId	 		=	$userSess["usertype"];
				$uid	 			=	$userSess["id"];				
				if($utypeId			==	GLB_SAGENT_UTYPEID)	
					{
						$sid				=	$uid;
						$combo["vendor"]	=	$this->get_combo_arr("vendor_id",$dealObj->eligibleVendorsToCreateDeal($uid),"id","business_name",$data["vendor_id"],"id=\"vendor_idId\"","Select Vendor");
					}
				else	
					{
						$sid				=	"";
						$salesAgents		=	$userObj->getAdminUsers("usertype=".GLB_SAGENT_UTYPEID." and status='1'");
						$combo["sagent"]	=	$this->get_combo_arr("saleagent_id",$salesAgents,"id","fullname",$data["saleagent_id"]," ");
						
					}
				$combo["category"]	=	$this->get_combo_arr("category_id",$dealObj->getAllCategories("status='1' order by preference"),"id","category",$data["category_id"],"onchange=\"getcombo(this.value,'subcatDivId');\" id=\"category_idId\"","Select Category");
				$combo["subcat"]	=	$this->get_combo_arr("subcategory_id",$dealObj->getAllSubCategories("category_id ='".$dataArr["category_id"]."' and status='1' order by preference"),"id","subcategory",$data["subcategory_id"],"id=\"subcategory_idId\"","Select Subcategory");
				return array("data"=>$this->getHtmlData($data),"combo"=>$combo,"sagent"=>$sid);
			}					
		public function dealsListEditform()
			{
				$this->permissionCheck("Edit",1);
				$data				=	$this->getData("get");
				$dealObj			=	new deals();				
				$vendorObj			=	new vendor();
				$userObj			=	new adminUser();
				$userSess 			=	end($userObj->get_user_data());					
				$utypeId	 		=	$userSess["usertype"];
				$uid	 			=	$userSess["id"];
				$expired			=	GLB_DEAL_EXPIRED;
				$rejected			=	GLB_DEAL_REJECTED;
				$cooldown			=	GLB_DEAL_COOLDOWN;		
				$dataArr			=	end($dealObj->getAllDealDetails(" id = ".$data["id"]." and status not in($expired,$rejected,$cooldown) ".$cond));						
				if($utypeId			==	GLB_SAGENT_UTYPEID)	
					{
						$sid		=	$uid;
						$cond		=	" and saleagent_id=".$uid;	
					}
				else	
					{	
						$sid				=	"";
						$salesAgents		=	$userObj->getAdminUsers("usertype=".GLB_SAGENT_UTYPEID." and status='1'");
						$combo["sagent"]	=	$this->get_combo_arr("saleagent_id",$salesAgents,"id","fullname",$dataArr["saleagent_id"]," ");
					}
				if(!$dataArr)
					{
						$this->setPageError("Invalid Deal Selection");
						$this->clearData();
						return $this->executeAction(false,"Listing",true);
					}
				else 
					{
		
						$catArr				=	end($dealObj->getCategories("vs.id='".$dataArr["subcategory_id"]."' and vc.status='1' order by vc.preference"));
						$combo["vendor"]	=	$this->get_combo_arr("vendor_id",$dealObj->eligibleVendorsToCreateDeal($sid,$data["id"]),"id","business_name",$dataArr["vendor_id"],"valtype='emptyCheck-please select a vendor' id=\"vendor_idId\"","Select Vendor");
						$combo["category"]	=	$this->get_combo_arr("category_id",$dealObj->getAllCategories("status='1' order by preference"),"id","category",$catArr["category_id"],"emptyCheck-'please select a category' onchange=\"getcombo(this.value,'subcatDivId');\" id=\"category_idId\"","Select Category");
						$combo["subcat"]	=	$this->get_combo_arr("subcategory_id",$dealObj->getAllSubCategories("category_id ='".$catArr["category_id"]."' and status='1' order by preference"),"id","subcategory",$dataArr["subcategory_id"],"id=\"subcategory_idId\" emptyCheck-'please select a sub-category'","Select Subcategory");
						$dataPosted			=	$this->getData("post");
						if($dataPosted)	$dataArr	=	$dataPosted;
						return array("data"=>$this->getHtmlData($dataArr),"combo"=>$combo,"sagent"=>$sid);
					}
			}
		public function dealsListUpdatedata()
			{
				$this->permissionCheck("Edit",1);
				$files		=	$this->getData("files");
				$dealObj	=	new deals();
				$userObj	=	new adminUser();
				$userSess 	=	end($userObj->get_user_data());					
				$utypeId	=	$userSess["usertype"];
				$uid	 	=	$userSess["id"];
				$data		=	$this->getData("request");
				$this->addData(array("today"=>date('Y-m-d')),"request");				
				$expired			=	GLB_DEAL_EXPIRED;
				$rejected			=	GLB_DEAL_REJECTED;
				$cooldown			=	GLB_DEAL_COOLDOWN;		
				if($utypeId			==	GLB_SAGENT_UTYPEID)	
					{
						$data["updateby"]	=	"Agent";
						$cond				=	" and saleagent_id=".$uid;	
					}
				$details			=	end($dealObj->getAllDealDetails(" id = ".$data["id"]." and status not in($expired,$rejected,$cooldown) ".$cond));						
				
				if($details)
					{
						$image_path		=	$details["image"];
						$image_path1	=	$details["thumb_image"];
						if($files["fileImage"][name])
							{	
								$adimg		=	$dealObj->uploadDealImage("fileImage",$files["fileImage"][tmp_name],$image_path);
								if($adimg)	$this->addData(array("image"=>$adimg),"request");									
								else
									{
										$this->setPageError($dealObj->getPageError());
										$this->executeAction(true,"Editform",true,true);
									}								
							}
						else $this->addData(array("image"=>$image_path),"request");
						
						if($files["fileImage1"][name])
							{	
								$adimg1			=	$dealObj->uploadDealThumbImage("fileImage1",$files["fileImage1"][tmp_name],$image_path1);
								if($adimg1)	$this->addData(array("thumb_image"=>$adimg1),"request");									
								else
									{
										$this->setPageError($dealObj->getPageError());
										$this->executeAction(true,"Editform",true,true);
									}								
							}
						else	$this->addData(array("thumb_image"=>$image_path1),"request");	
						
						$data		=	$this->getData("request");//refreshing
						$dataIns	=	$this->populateDbArray("vod_deal",$data);
						if($dealObj->updateDeal($dataIns,$data["id"]))	
							{	
								$this->setPageError("Deal details updated successfully");
								$this->clearData();
								$this->clearData("Editform");						
								return $this->executeAction(false,"Listing",true);
							}
						else
							{
								//$dealObj->unlinkDealImages($adimg);							
								$this->setPageError($dealObj->getPageError());
								$this->executeAction(true,"Editform",true,true);
							}
					}
				else	
					{
						$this->setPageError("Invalid Deal Selection");
						$this->clearData();
						return $this->executeAction(false,"Listing",true);
					}
			}
		public function dealsListSavedata()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getData("files");
				$userObj	=	new adminUser();
				$userSess 	=	end($userObj->get_user_data());	
				$utypeId	=	$userSess["usertype"];
				$uid	 	=	$userSess["id"];	
				$dealObj	=	new deals();						
				
				if($_SESSION["newImage"]	==	"")
					{
						if($data["fileImage"][name])
							{
								$adimg		=	$dealObj->uploadDealImage("fileImage",$data["fileImage"][tmp_name]);
								if($adimg)	
									{
										$_SESSION["newImage"]	=	$adimg;	
										$this->addData(array("image"=>$adimg),"request");
									}
								else
									{
										$this->setPageError($dealObj->getPageError());
										$this->executeAction(true,"Addform",true);
									}
							}
					}
				else	$this->addData(array("image"=>$_SESSION["newImage"]),"request");
				
				if($_SESSION["newImage1"]	==	"")
					{
						if($data["fileImage1"][name])
							{
								$adimg1		=	$dealObj->uploadDealThumbImage("fileImage1",$data["fileImage1"][tmp_name]);
								if($adimg1)	
									{
										$_SESSION["newImage1"]	=	$adimg1;	
										$this->addData(array("thumb_image"=>$adimg1),"request");
									}
								else
									{
										$this->setPageError($dealObj->getPageError());
										$this->executeAction(true,"Addform",true,true);
									}
							}
					}					
				else	$this->addData(array("thumb_image"=>$_SESSION["newImage1"]),"request");
				
				$data						=	$this->getData("request");
				$dataIns					=	$this->populateDbArray("vod_deal",$data);	
				$dataIns["added_by"]		=	$uid;
				if($dealObj->canCreateDeal($dataIns["vendor_id"]))
					{
						if($utypeId	==	GLB_SAGENT_UTYPEID)
							{
								$dataIns["saleagent_id"]	=	$uid;					
								$data["vendor_comm_rate"]	=	GLB_VENDOR_COMM_RATE;	
								$data["site_comm_rate"]		=	GLB_ADMIN_COMM_RATE;	
								$data["sales_comm_rate"]	=	GLB_AGENT_COMM_RATE;
							}	
		
						if(!$this->getPageError())
							{
								if($dealObj->createDeal($dataIns))	
									{
										$_SESSION["newImage"]	=	"";
										$_SESSION["newImage1"]	=	"";
										$this->setPageError("Deal details added successfully");
										$this->clearData("Savedata");
										$this->clearData("Addform");						
										return $this->executeAction(false,"Listing",true);
									}
								else $this->redirectAction(true,$dealObj->getPageError(),"Addform");											
							}	
					}
				else	$this->redirectAction(true,"This vendor is not allowed to post a deal during this time","Addform");
			}
			
		public function dealsListViewform()
			{
				$this->permissionCheck("View",1);
				$data				=	$this->getData("get");
				$customerObj		=	new customer();
				$dealObj			=	new deals();
				$dataArr			=	end($dealObj->getAllDealDetails(" id = $data[id] "));					
				if($dataArr)
					{ 
						$catArr					=	$dealObj->getCategories(" vs.id = $dataArr[subcategory_id]");
						$dataArr["category"]	=	$catArr[0]["category"];	
						$payArr					=	end($dealObj->getAllPaymentDebitByDeal($data["id"]));	
						$orderArr				=	$dealObj->getDealOrders($data["id"]);
						$dataArr["orderCnt"]	=	$dealObj->getCountPurchasedDeal($data["id"]);
						$dataArr["redeemCnt"]	=	$dealObj->getCountCouponRedeemed($data["id"]);
						$dataArr["notRedeemCnt"]=	$dealObj->getCountCouponNotRedeemed($data["id"]);
					}
				else
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						return $this->executeAction(false,"Listing",true);
					}		
				return array("data"=>$this->getHtmlData($dataArr,array("description","highlights","rules")),"payData"=>$this->getHtmlData($payArr),"orderData"=>$this->getHtmlData($orderArr));
					
			}
		public function dealsListStatuschange()
			{
				$this->permissionCheck("Status",1);
				$getData		=	$this->getData("get");
				$dealObj		=	new deals();
				$vendorObj		=	new vendor();
				$cmsObj			=	new cms();	
				$updateRes		=	$dealObj->updateDealStatus($getData["status"],$getData["id"]);
				if($updateRes)  
					{
						$details	=	end($dealObj->getAllDealDetails("id=".$getData["id"]));
						$vendArr	=	end($vendorObj->getDetails("`id`= '".$details["vendor_id"]."'"));
						$to			=	$vendArr["email"];
						$from		=	GLB_SITE_EMAIL;
						if($details["status"]	==	GLB_DEAL_ACCEPTED)
							{
								$subject	=	"VoteOnDeals.com - Your Deal has been accepted";
								$varArr							=	array();
								$varArr["{TPL_NAME}"]			=	$vendArr['business_name'];
								$varArr["{TPL_DEAL}"]			=	$details['caption'];
								$varArr["{TPL_DEAL_LINK}"]		=	ROOT_URL."deals/".$dealObj->getHtaccessFilter($details['caption'])."-".$getData["id"]."/";
								$varArr["{TPL_ACTIVATION_DATE}"]=	$cmsObj->displayDate($details['activation_date']);
								$send							=	$cmsObj->sendMailCMS("16",$to,$from,$subject,$varArr,5); 
							}
						else if($details["status"]	==	GLB_DEAL_REJECTED)
							{
								$subject						=	"Voteondeals.com - Your Deal Rejected";
								$varArr							=	array();
								$varArr["{TPL_NAME}"]			=	$vendArr['business_name'];
								$varArr["{TPL_DEAL}"]			=	$details['caption'];
								$varArr["{TPL_DEAL_LINK}"]		=	ROOT_URL."deals/".$dealObj->getHtaccessFilter($details['caption'])."-".$getData["id"]."/";
								$send							=	$cmsObj->sendMailCMS("17",$to,$from,$subject,$varArr,5); 
							}
						$this->redirectAction(false,"Status Changed Successfully","Viewform");
					}
				else	$this->redirectAction(false,"Status changing failed","Viewform");
			}	
		public function dealsListViewcoupon()
			{
				$this->permissionCheck("View",1);
				$getData		=	$this->getData("get");
				$this->addData(array("txt_dealId"=>$getData["id"]),"post","Transallsearch",true,"dealOrderAll.php");
				$this->executeAction(false,"Transallsearch",true,false,"","","dealOrderAll.php");
			}
		public function dealsListViewadmin()
			{
				$this->permissionCheck("View",1);
				$getData		=	$this->getData("get");
				$this->addData(array("userId"=>$getData["user"]),"post","Search",true,"adminUsers.php");
				$this->executeAction(false,"Search",true,false,"","","adminUsers.php");
			}
		public function dealsListViewvendor()
			{
				$this->permissionCheck("View",1);
				$getData		=	$this->getData("get");
				$this->addData(array("userId"=>$getData["user"]),"post","Search",true,"vendors.php");
				$this->executeAction(false,"Search",true,false,"","","vendors.php");
			}	
		public function dealsListViewvotes()
			{
				$this->permissionCheck("View",1);
				$getData		=	$this->getData("get");
				$this->addData(array("keyword"=>$getData["deal"]),"post","Search",true,"customerVotes.php");
				$this->executeAction(false,"Search",true,false,"","","customerVotes.php");
			}			
		public function dealsListViewsalespay()
			{
				$this->permissionCheck("View",1);
				$getData		=	$this->getData("get");
				$this->addData(array("keyword"=>$getData["deal"]),"post","Search",true,"salesPayment.php");
				$this->executeAction(false,"Search",true,false,"","","salesPayment.php");
			}
		public function dealsListViewvendorpay()
			{
				$this->permissionCheck("View",1);
				$getData		=	$this->getData("get");
				$this->addData(array("keyword"=>$getData["deal"]),"post","Search",true,"vendorPayment.php");
				$this->executeAction(false,"Search",true,false,"","","vendorPayment.php");
			}
		public function redirectAction($loadData=true,$errMessage,$action)	
			{	
				$this->setPageError($errMessage);
				$this->executeAction($loadData,$action,true);	
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
