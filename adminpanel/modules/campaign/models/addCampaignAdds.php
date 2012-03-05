<?php
/**************************************************************************************
Created by :Anu
Created on :29-2-2011
Purpose    :Add campaign adds
**************************************************************************************/
class addCampaignAddsModel extends modelclass
	{
		public function Listing()
			{
				
				if($this->permissionCheck("View",1))
				$searchData				=	$this->getData("post","Search");
				$sortData				=	$this->getData("request","Search");	
				$viewdata				=   $this->getData("request");
				$searchData['sortData']	=	$this->getData("request","Search");
				if(!trim($sortData["sortField"]))
					{	
						$this->addData(array("sortField"=>"vba.id"),"request","Search");
						$this->addData(array("sortMethod"=>"desc"),"request","Search");
						$sortData		=	$this->getData("request","Search");//refreshing the variable
					}
				if(trim($searchData["keyword"]))
					{
						$sqlCond	.=	" And ( ";
						$sqlCond	.=	$this->dbSearchCond("like", "vba.name", "%".trim($searchData["keyword"])."%");
						$sqlCond	.= " OR ";
						$sqlCond	.=	$this->dbSearchCond("like", "vbac.name", "%".trim($searchData["keyword"])."%");
						$sqlCond	.=	") ";
					}
				if(trim($searchData["sel_category"]))
					{
						$sqlCond	.=	" And ( ";
						$sqlCond	.=	$this->dbSearchCond("=", "campaign_id",$searchData["sel_category"]);
						$sqlCond	.=	") ";
					}
				if(trim($viewdata['id']))	
					{
						$sqlCond	.=	" And ( ";
						$sqlCond	.=	$this->dbSearchCond("=", "campaign_id",$viewdata['id']);
						$sqlCond	.=	") ";
					}					
				$category			=	new campaignModule();
				if(trim($viewdata['id']))	
					{
						$addsCategory		=	$this->get_combo_arr("sel_category",$category->getAllCampaignAdsCategory("status=1"),"id","name",$viewdata['id'],"style='width:100px;' ","Any category");		
					}
				else
					{
						$addsCategory		=	$this->get_combo_arr("sel_category",$category->getAllCampaignAdsCategory("status=1"),"id","name",$searchData["sel_category"],"style='width:100px;' ","Any category");		
					}	
				$data2				=	array();	
				$sqlCond			.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				$sql				=	"select vba.*,vbac.name as campname from ".constant("CONST_MODULE_CAMPAIGN_ADS")."  as vba left join ".constant("CONST_MODULE_CAMPAIGN_TABLE")."  as vbac on vba.campaign_id=vbac.id WHERE 1 $sqlCond";
				$spage				=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				=	$this->getdbcontents_sql($spage->finalSql());
				$links				=	$spage->s_get_links();
				if(!$data)	$this->setPageError("No records found !");
				$searchData			=	$this->getHtmlData($this->getData("post","Search",false));
				$searchData["sortData"]	=	$sortData;			
			//	print_r($this->getHtmlData($data));exit;				
				return array("data"=>$this->getHtmlData($data),"spage"=>$spage,"combo"=>$addsCategory,"searchdata"=>$searchData);
			}
		public function Delete()	
			{
				$data				=	$this->getData("request");
				$id					=	$data['id'];
				$objAdds			=	new bannerModule();
				$bannerDetails		=	end($objAdds->getcampaignAdsDetailsById($id));
				$sql				=	"DELETE FROM ".constant("CONST_MODULE_CAMPAIGN_ADS")." WHERE id='".$id."'";
				$deleteStatus		=	mysql_query($sql);
				if($deleteStatus)
					{
						$this->setPageError("Deleted Successfully");
						$this->executeAction(array("action"=>"Listing","navigate"=>true));
					}
				else
					{
						$this->setPageError("Some Error Occurs");
						$this->executeAction(array("action"=>"Listing","navigate"=>true));
					}
			}
		public function Addformbtn()
			{
				if($this->permissionCheck("Add",1))
				$this->executeAction(array("action"=>"Addform","navigate"=>true,"sameParams"=>true));
			}
		public function Cancel()
			{
				$this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true));
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
		public function Editform()
			{
				if($this->permissionCheck("Edit",1))
				$data							=	$this->getData("get");
				$bannerObj						=	new campaignModule();
				$details						=	end($bannerObj->getcampaignAdsDetailsById($data['id']));				
				$addtype						=	array(0 =>array('id'=>1,'value'=>'image'),1 =>array('id'=>2,'value'=>'html'),2 =>array('id'=>3,'value'=>'Flash')) ;		
				$comb							=	array();
				if($details)
					{							
						$comb['addsCategory']		=	$this->get_combo_arr("campaign_id",$bannerObj->getAllCampaignAdsCategory("status=1"),"id","name",$details["campaign_id"]," valtype='emptyCheck-please select a category' style='width:100px;' ","Any category");		
						$comb['type']				=	$this->get_combo_arr("ads_type",$addtype,"id","value",$details["ads_type"],"id='type' valtype='emptyCheck-please select a category' style='width:100px;' ","Any category");		
					}
				else	
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						$this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true));
					}
				return array("data"=>$this->getHtmlData($details),"combo"=>$comb);
			}
		public function Addform()
			{
				$category			=	new campaignModule();
				$viewdata			=   $this->getData("request");
				if(trim($viewdata['id']))	
					{
						$addsCategory		=	$this->get_combo_arr("campaign_id",$category->getAllCampaignAdsCategory("status=1"),"id","name",$viewdata['id']," valtype='emptyCheck-please select a category' style='width:100px;' ","Any category");		
					}
				else
					{
						$addsCategory		=	$this->get_combo_arr("campaign_id",$category->getAllCampaignAdsCategory("status=1"),"id","name",$searchData["sel_category"]," valtype='emptyCheck-please select a category' style='width:100px;' ","Any category");		
					}
				return array("combo"=>$addsCategory);		
			}
		public function Stauschange()
			{	
				$this->permissionCheck("Status",1);					
				$data		=	$this->getData("request");						
				if($this->statusChange(constant("CONST_MODULE_CAMPAIGN_ADS"),$data["id"]))
					{
						$this->setPageError("Status Changed Successfully");
						$this->clearData();		
						$this->executeAction(array("action"=>"Listing","navigate"=>true));
					}
			}
		public function Savedata()
			{
				$data				=	$this->getData("post");
				
				$file				=	$this->getData("files");
				if($file['image']['name'])
					{
						$upObj		=	$this->create_upload(10,"jpg,png,jpeg,gif,swf");
						$adimg		=	$upObj->copy("image","../campaign/campimages",2);
						if($adimg)		$upObj->img_resize("100","120","../campaign/campimages/thumb");
						else 			$this->setPageError($upObj->get_status());
						$this->addData(array("image"=>$adimg),"post");
					}
					$data				=	$this->getData("post");					
					$data['ip']			=	$_SERVER['REMOTE_ADDR'];
					$data['date_added']	=	"escape now() escape";
					//print_r($data); echo "<br>";
					$dataIns			=	$this->populateDbArray(constant("CONST_MODULE_CAMPAIGN_ADS"),$data);
					$bannerObj			=	new campaignModule();
					//print_r($dataIns);exit;
					$insertStatus		=	$bannerObj->insertCampaignAdds($dataIns);
					if($insertStatus)	
						{
							$this->setPageError("Inserted Successfully");
							$this->clearData("Savedata");
							$this->clearData("Addform");						
						$this->executeAction(array("action"=>"Listing","navigate"=>true));	
						}
					else
						{
							$this->setPageError($bannerObj->getPageError());
							$this->executeAction(true,"Addform",true);
						}	
			}
		public function Updatedata()
			{
				$data					=	$this->getData("request");
				$file					=	$this->getData("files");
				if($file['fileImage']['name'])
					{
						$upObj			=	$this->create_upload(10,"jpg,png,jpeg,gif,swf");
						$adimg			=	$upObj->copy("fileImage","../campaign/campimages",2);
						if($adimg)			$upObj->img_resize("100","120","../campaign/campimages/thumb");
						else 				$this->setPageError($upObj->get_status());
						$this->addData(array("image"=>$adimg),"request");
					}
				$data					=	$this->getData("request");	
				//print_r($data); echo "<br>";
				$dataIns				=	$this->populateDbArray(constant("CONST_MODULE_CAMPAIGN_ADS"),$data);
				//print_r($dataIns); exit;
				$bannerObj				=	new campaignModule();
				$insertStatus			=	$bannerObj->updateCampaignAds($dataIns,$data['id']);
				if($insertStatus)
					{
						$this->setPageError("Updated Successfully");
						$this->clearData("Savedata");
						$this->clearData("Addform");						
						$this->executeAction(array("action"=>"Listing","navigate"=>true));					
					}
				else
					{
						$this->setPageError($bannerObj->getPageError());
						$this->executeAction(array("action"=>"Editform","navigate"=>true));
					}
			}
		
	}
