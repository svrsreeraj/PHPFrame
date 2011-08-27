<?php
/****************************************************************************************
Created by	:	hari krishna, Nischal Verma	
Created on	:	2010-2-3
Purpose		:	pod_coupon listing 
************************************* ***************************************************/
class pod_listing extends modelclass
	{
		public function pod_listingListing()
			{		
				$this->permissionCheck("View",1);
				$dealObj		=	new deals();
				$searchData		=	$this->getData("post","Listing");
				$sortData		=	$this->getData("request","Listing");
				if(!trim($sortData["sortField"]))
					{
						$this->addData(array("sortField"=>"id"),"request","Search");
						$this->addData(array("sortMethod"=>"desc"),"request","Search");
						$sortData	=	$this->getData("request","Search");
					}
					
				if(trim($searchData["sel_status"])!="")		$sqlFilter["cond"]	.=	" and pc.status in (".$searchData["sel_status"].")";	
				if(trim($searchData["sel_country"])!="")	$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "vv.country_id",$searchData["sel_country"]);
				if(trim($searchData["sel_state"])!="")		$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("=", "vv.state_id",$searchData["sel_state"]);
				if(trim($searchData["txt_join_from"])!="")	$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "date(vv.date_added)",$searchData["txt_join_from"]);
				if(trim($searchData["txt_join_to"])!="")	$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("<=", "date(vv.date_added)",$searchData["txt_join_to"]);
				if(trim($searchData["payment_from"])!="")	$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "pcp.amount",$searchData["payment_from"]);
				if(trim($searchData["payment_to"])!="")		$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("<=", "pcp.amount",$searchData["payment_to"]);		
				if(trim($searchData["coupon_expiry_from"])!="")	$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond(">=", "date(pc.coupon_expiry_date)",$searchData["coupon_expiry_from"]);
				if(trim($searchData["coupon_expiry_to"])!="")	$sqlFilter["cond"]	.=	" and ".$this->dbSearchCond("<=", "date(pc.coupon_expiry_date)",$searchData["coupon_expiry_to"]);
				
				if(trim($searchData["txt_vendorId"]))			
					{
						$sqlFilter["cond"]	.=	" and(".$this->dbSearchCond("=", "vv.id",$searchData["txt_vendorId"])." or ".$this->dbSearchCond("=", "vv.email",$searchData["txt_vendorId"]).")";	
					}
					
				if(trim($searchData["keyword"]))
					{
						$sqlFilter["cond"]	.=	" And ( ";
						$sqlFilter["cond"]	.=	$this->dbSearchCond("like", "pc.name", "%".$searchData["keyword"]."%"). " or";
						$sqlFilter["cond"]	.=	$this->dbSearchCond("like", "pc.caption", "%".$searchData["keyword"]."%"). " or";
						$sqlFilter["cond"]	.=	$this->dbSearchCond("like", "vv.business_name", "%".$searchData["keyword"]."%");					
						$sqlFilter["cond"]	.=	") ";
					}
				
				if($searchData["sel_opt_cat"]) $sqlFilter["cond"]	.=	" and pc.subcategory_id in(".implode(",",$searchData["sel_opt_cat"]).") ";
					
					
				$sqlFilter["ord"]	.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				$sql				.=	"select vv.business_name,pc.*,pcp.amount  from  pod_coupon as pc 
										left join vod_vendor as vv on vv.id=pc.vendor_id
										left join pod_coupon_payments as pcp on pc.id=pcp.coupon_id where 1	".$sqlFilter["cond"].$sqlFilter["ord"]; 
				
				//Application combo
				$masterObj			=	new masters();
				$appCombo			=	$masterObj->getAllDetails("vod_site_apps");
				$appCombo			=	$this->get_combo_arr("sel_apps",$appCombo,"id","apps",$searchData["sel_apps"],"","All");
				
				//Category Cambo
				$catCombo			=	$dealObj->getOptGroup('sel_opt_cat[]','style="width:170px;height:120px;"',$searchData["sel_opt_cat"]);
				
				$terObj				=	new territory();
				$stateData			=	$terObj->getAllStates("country_id=".$data["cid"]);
				$stateData			=	$this->get_combo_arr("sel_state",$stateData,"id","state",$searchData["sel_state"],"style='width:100px;'","Any State ");
				
				$terObj				=	new territory();
				$countryData		=	$terObj->getAllCountries("1 order by preference asc");
				$countryData		=	$this->get_combo_arr("sel_country",$countryData,"id","country",$searchData["sel_country"],"style='width:100px;' onchange='getStates(this.value,\"id_search_state\")'","Any Country");
				
				$this->addData(array("sql"=>$sql),"post");
				$spage				 =	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				 =	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)				$this->setPageError("No records found !");
				$searchData			 =	$this->getHtmlData($this->getData("post","Listing"));
				$searchData["searchCombo"]	=	$searchCombo; 
				$searchData["sortData"]		=	$sortData;
				$searchData["category"]		=	$catCombo;
				return array("data"=>$data,"spage"=>$spage,"country"=>$countryData, "application"=>$appCombo,"state"=>$stateData,"searchdata"=>$searchData);
			}
		
		public function pod_listingGetstatecombo()
			{
				ob_clean();
				$data				=	$this->getData("request");
				$terObj				=	new territory();
				$stateData			=	$terObj->getAllStates("country_id=".$data["cid"]);
				echo $stateData		=	$this->get_combo_arr("sel_state",$stateData,"id","state",$searchData["sel_state"],"style='width:100px;'","Any State ");
				exit;
			}	
		public function pod_listingEditform()
			{
				$data				=	$this->getData("get");	
				$sql				=	"select  vv.business_name,pc.*,pcp.* from  pod_coupon as pc 
										left join vod_vendor as vv on vv.id=pc.vendor_id left join pod_coupon_payments as pcp on 
										pc.id=pcp.coupon_id ";
				if($data[vod_deal_id])
				{	
					$sql				.=	" where pc.vod_deal_id=".$data['vod_deal_id'];	
				}
				else
				{
					$sql				.=	" where pc.id=".$data['id'];
				}
				$editdata			=	end($this->getdbcontents_sql($sql));
				
				$editdata['id']		=	$data['id'];
				$this->clearData();
				return array("data"=>$editdata);
			}		
		
		public function pod_listingAddnew()
			{
				$dealObj			=	new deals();
				$combo["subcat"]	=	$this->get_combo_arr("subcategory_id",$dealObj->getAllSubCategories("status='1' order by preference"),"id","subcategory",$dataArr["subcategory_id"],"id=\"subcategory_idId\" emptyCheck-'please select a sub-category'","Select Subcategory");
				$data				=	$this->getData("post");
				$this->clearData();	
				return array("data"=>$data,"subcat"=>$combo["subcat"]);
			}
		public function checkDealAbility($id)
			{
				$sql				=	"select status from vod_deal where id=".$id;
				$data				=	end($this->getdbcontents_sql($sql));
				
				$sql				=	"select count(*) as count from pod_coupon where vod_deal_id=".$id;
				$data				=	end($this->getdbcontents_sql($sql));
				if($data['count']!=0)
					{
						$this->addData(array("vod_deal_id"=>date('Y-m-d')),"request");				
						$this->redirectAction("A coupon has already beed posted with this deal ","Editform",ROOT_URL."pod_listing");
					}
				else	return true;
											
			}		
	
		public function add_date($givendate,$day=0,$mth=0,$yr=0) 
			{
				$cd 					=	strtotime($givendate);
				$newdate 				= 	date('Y-m-d', mktime(date('h',$cd),date('i',$cd), date('s',$cd), date('m',$cd)+$mth,date('d',$cd)+$day, date('Y',$cd)+$yr));
				return $newdate;
             }
		
		public function	pod_listingSave()
			{
				$this->permissionCheck("Add",1);
				$data		=	$this->getData("request");
				$eligible	=	$this->checkDealAbility($data['vod_deal_id']);
				
				if($eligible)
					{
						$activationDate					=	$data["activation_date"];
						$coupon_expiry_date				=	$data["coupon_expiry_date"];
						$coupon_days					=	$data["coupon_days"];
						
						$validExpiryDate				=	$this->add_date($activationDate,$coupon_days); 
						if($coupon_expiry_date	>=	$validExpiryDate)
							{	
								$couponObj					=	new pod();						
								$data						=	$this->getData("request");
								$data['coupondays']			=	trim($data['coupondays']);
								$ip							=	new ipcountry();
								$data['ip']					=	$ip->getip();
								$data['from_vod']			=	"1";
								$sql						=	"select vod_vendor.id,vod_deal.image from vod_deal left join vod_vendor on vod_deal.vendor_id=vod_vendor.id  where 1 and vod_deal.id=".$data['vod_deal_id'];
								$vendorname					=	end($this->getdbcontents_sql($sql));
								$data['date_added']			=	"escape now() escape";	
								$data['vendor_id']			=	$vendorname['id'];
								$data['image']				=	$vendorname['image'];
								$dataIns					=	$this->populateDbArray("pod_coupon",$data);	
								
								$dealObj					=	new deals();
								$detailsdetails				=	$dealObj->getDealDetails($dataIns['vod_deal_id']);
							
								$dataIns['expired_date']	=	"escape DATE_ADD('$data[activation_date]',INTERVAL $data[coupon_days] DAY) escape";
								$dataIns['apps_id']			=	"1";
								$dataIns['subcategory_id']	=	$detailsdetails['0']['subcategory_id'];
								$dataIns['description']		=	$detailsdetails['0']['description'];
								$dataIns['highlights']		=	$detailsdetails['0']['highlights'];
								$dataIns['rules']			=	$detailsdetails['0']['rules'];
								
								//here copy the images from deal to pick on deal
								$dataIns['image']			=	$detailsdetails['0']['image'];
								$imageInfo					=	pathinfo($dataIns['image']);
								$tmpfname 					=	tempnam(ROOT_ABSOLUTE_PATH."images/picondeals","");
								
								$newNameImage				=	$tmpfname.".".$imageInfo["extension"];
								rename($tmpfname,$newNameImage);
								$copy						=	copy(ROOT_HTTP_URL."images/deals/".trim($data['image']),$newNameImage);
								$newImageInfo				=	pathinfo($newNameImage);
								$fromPath					=	ROOT_URL."images/picondeals/".$newImageInfo["basename"];
								$this->img_resize("100","120",$fromPath,ROOT_ABSOLUTE_PATH."images/picondeals/thumb/".$newImageInfo["basename"]);
								$this->img_resize("47","50",$fromPath,ROOT_ABSOLUTE_PATH."images/picondeals/thumb47x50/".$newImageInfo["basename"]);
								$this->img_resize("100","100",$fromPath,ROOT_ABSOLUTE_PATH."images/picondeals/thumb100x100/".$newImageInfo["basename"]);
								$this->img_resize("146","95",$fromPath,ROOT_ABSOLUTE_PATH."images/picondeals/thumb146x95/".$newImageInfo["basename"]);
								$this->img_resize("190","80",$fromPath,ROOT_ABSOLUTE_PATH."images/picondeals/thumb190x80/".$newImageInfo["basename"]);
								$this->img_resize("330","224",$fromPath,ROOT_ABSOLUTE_PATH."images/picondeals/thumb330x224/".$newImageInfo["basename"]);
								$this->img_resize("349","182",$fromPath,ROOT_ABSOLUTE_PATH."images/picondeals/thumb349x182/".$newImageInfo["basename"]);
								$this->img_resize("390","256",$fromPath,ROOT_ABSOLUTE_PATH."images/picondeals/thumb390x256/".$newImageInfo["basename"]);
								$this->img_resize("589","372",$fromPath,ROOT_ABSOLUTE_PATH."images/picondeals/thumb589x372/".$newImageInfo["basename"]);
								die();
								$dataIns['image']			=	$newImageInfo["basename"];
								$insert						=	$couponObj->Insertcoupon($dataIns);
								
								if($insert)	$this->redirectAction("Successfully inserted","Listing",ROOT_URL."pod_listing");
								else 		$this->redirectAction($couponObj->getPageError(),"Listing",ROOT_URL."pod_listing");
							}
						else  $this->redirectAction("Please check the dates you have entered","Addnew",ROOT_URL."pod_listing");
					}
				else $this->redirectAction("Sorry this deal cannot be posted in pickondeals.com","Addnew",ROOT_URL."pod_listing");
					
			}
			
		public function pod_listingBlockstatuschange()
			{	
				$this->permissionCheck("Status",1);					
				$data				=	$this->getData("request");	
				if($this->statusChange("pod_coupon",$data["id"],"block_status"))
					{
						$this->setPageError("Block Status Changed Successfully");
						$this->clearData();											
						return $this->executeAction(false,"Listing",true,true,'','block_status,id');
					}
			}
		public function pod_listingStatuschange()
			{
				$this->permissionCheck("Status",1);
				$getData		=	$this->getData("get");
				$couponObj		=	new podCoupons();
				$cmsObj			=	new cms();	
				$updateRes		=	$couponObj->updateCouponStatus($getData["status"],$getData["id"]);
				if($updateRes)  
					{
						$details	=	end($this->getdbcontents_cond('pod_coupon',"id=".$getData["id"]));
						$vendArr	=	end($this->getdbcontents_cond('vod_vendor',"id=".$details["vendor_id"]));
						$to			=	$vendArr["email"];
						$from		=	GLB_SITE_EMAIL;
						if($details["status"]	==	1)
							{
								$subject						=	"PickOnDeals.com - Your Coupon has been accepted";
								$varArr							=	array();
								$varArr["{TPL_NAME}"]			=	$vendArr['business_name'];
								$varArr["{TPL_DEAL}"]			=	$details['caption'];
								$varArr["{TPL_DEAL_LINK}"]		=	ROOT_URL."coupons/".$this->getHtaccessFilter($details['caption'])."-".$getData["id"]."/";
								$varArr["{TPL_ACTIVATION_DATE}"]=	$cmsObj->displayDate($details['activation_date']);
								$send							=	$cmsObj->sendMailCMS("16",$to,$from,$subject,$varArr,5); 
							}
						else if($details["status"]	==	3)
							{
								$subject						=	"Voteondeals.com - Your Coupon Rejected";
								$varArr							=	array();
								$varArr["{TPL_NAME}"]			=	$vendArr['business_name'];
								$varArr["{TPL_DEAL}"]			=	$details['caption'];
								$varArr["{TPL_DEAL_LINK}"]		=	ROOT_URL."coupons/".$this->getHtaccessFilter($details['caption'])."-".$getData["id"]."/";
								$send							=	$cmsObj->sendMailCMS("17",$to,$from,$subject,$varArr,5); 
							}
						$this->redirectAction(false,"Status Changed Successfully","Viewform");
					}
				else	$this->redirectAction(false,"Status changing failed","Viewform");
			}	
		public function pod_listingViewform()
			{
				$data				=	$this->getData("get");	
				$sql				=	"select  vv.business_name,pc.*,pc.id as couponid,pcp.*, vcs.subcategory, vc.category from  pod_coupon as pc 
										left join vod_vendor as vv on vv.id=pc.vendor_id left join pod_coupon_payments as pcp on 
										pc.id=pcp.coupon_id left join vod_category_sub as vcs on pc.subcategory_id=vcs.id left join vod_category  as vc on vc.id=vcs.category_id where pc.id=".$data['id'];
				$viewdata			=	end($this->getdbcontents_sql($sql));
				return array("data"=>$viewdata);
			}
		public function pod_listingUpdatedata()
			{
				$this->permissionCheck("Edit");
				$podObj 	= 	new pod();				
				$files		=	$this->getData("files");
				$data		=	$this->getData("request");
				/*if($data["vod_deal_id"])
					{
						$sql 		=	"select id from pod_coupon where vod_deal_id=".$data["vod_deal_id"];
						$data 		=	$this->getdbcontents_sql($sql);
						$id			=	$data["id"];
					}*/
				$id			=	$data["id"];
				
				$coupondata	=	"select * from pod_coupon where id=".$id;
				$details	=	end($this->getdbcontents_sql($coupondata));
				$image_path	=	$details[image];
				if($files["fileImage"][name])
					{	
						$adimg		=	$podObj->uploadCouponImages("fileImage",$files["fileImage"][tmp_name],$image_path);
						if($adimg)	$this->addData(array("image"=>$adimg),"request");									
						else
							{
								$this->setPageError($podObj->getPageError());
								$this->executeAction(true,"Editform",true,true);
							}								
					}
				else $this->addData(array("image"=>$image_path),"request");	
										
				$data				=	$this->getData("request");
				$data['coupondays']	=	trim($data['coupondays']);
				if(!$data['Featured'])	$data['Featured']	=	"0";				
				$data['expired_date']=	"escape DATE_ADD('$data[activation_date]',INTERVAL $data[coupon_days] DAY) escape";
				$dataIns			=	$this->populateDbArray("pod_coupon",$data);				
				$update				=	$podObj->updateCoupons($dataIns,$id);
				if($update)	
					{
						$this->sortingRecords("vod_category ",$data["id"],$data["txtpreference"]);
						$this->setPageError("Updated Successfully");
												
						return $this->executeAction(false,"Listing",true,true);
					}
				else
					{
						$this->redirectAction($podObj->getPageError(),"Editform","pod_listing");
					}				
			}
		public function pod_listingReset()
			{
				$this->clearData("Listing");
				$this->executeAction(false,"Listing",true,false);	
			}
		public function redirectAction($errMessage,$action,$url)	
			{	
				$this->setPageError($errMessage);
				$this->executeAction(true,$action,$url,true);	
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
