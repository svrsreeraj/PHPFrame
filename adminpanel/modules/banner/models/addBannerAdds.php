<?php
/**************************************************************************************
Created by :Maria
Created on :14-12-2011
Purpose    :Add banner adds
**************************************************************************************/
class addBannerAddsModel extends modelclass
	{
		public function Listing()
			{
				if($this->permissionCheck("View",1))
				$searchData				=	$this->getData("post","Search");
				$sortData				=	$this->getData("request","Search");	
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
						$sqlCond	.=	") ";
					}
				if(trim($searchData["sel_category"]))
					{
						$sqlCond	.=	" And ( ";
						$sqlCond	.=	$this->dbSearchCond("=", "category_id",$searchData["sel_category"]);
						$sqlCond	.=	") ";
					}		
				$category			=	new bannerModule();
				$addsCategory		=	$this->get_combo_arr("sel_category",$category->getAllBannerAdCategory("status=1"),"id","category",$searchData["sel_category"],"style='width:100px;' ","Any category");		
				$data2				=	array();	
				$sqlCond			.=	"order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				$sql				=	"select vba.*,vbac.category from ".constant("CONST_MODULE_BANNER_TABLE_BANNER")."  as vba left join ".constant("CONST_MODULE_BANNER_TABLE_GROUP")."  as vbac on vba.category_id=vbac.id WHERE 1 $sqlCond";
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
				$bannerDetails		=	end($objAdds->getBannerAdsDetailsById($id));
				$sql				=	"DELETE FROM ".constant("CONST_MODULE_BANNER_TABLE_BANNER")." WHERE id='".$id."'";
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
				$bannerObj						=	new bannerModule();
				$details						=	end($bannerObj->getBannerAdsDetailsById($data['id']));				
				$addtype						=	array(0 =>array('id'=>1,'value'=>'image'),1 =>array('id'=>2,'value'=>'html'),2 =>array('id'=>3,'value'=>'Flash')) ;		
				$comb							=	array();
				if($details)
					{	
						$comb['addsCategory']		=	$this->get_combo_arr("category_id",$bannerObj->getAllBannerAdCategory("status=1"),"id","category",$details["category_id"]," valtype='emptyCheck-please select a category' style='width:100px;' ","Any category");		
						$comb['type']				=	$this->get_combo_arr("types",$addtype,"id","value",$details["types"],"id='type' valtype='emptyCheck-please select a category' style='width:100px;' ","Any category");		
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
				$category			=	new bannerModule();
				$addsCategory		=	$this->get_combo_arr("category_id",$category->getAllBannerAdCategory("status=1"),"id","category",$searchData["sel_category"]," valtype='emptyCheck-please select a category' style='width:100px;' ","Any category");		
				return array("combo"=>$addsCategory);		
			}
		public function Stauschange()
			{	
				$this->permissionCheck("Status",1);					
				$data		=	$this->getData("request");						
				if($this->statusChange(constant("CONST_MODULE_BANNER_TABLE_BANNER"),$data["id"]))
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
						$adimg		=	$upObj->copy("image","../banner/images",2);
						if($adimg)		$upObj->img_resize("100","120","../banner/images/thumb");
						else 			$this->setPageError($upObj->get_status());
						$this->addData(array("image"=>$adimg),"post");
					}
					$data				=	$this->getData("post");
					$data['ip']			=	$_SERVER['REMOTE_ADDR'];
					$data['date_added']	=	"escape now() escape";
					$dataIns			=	$this->populateDbArray(constant("CONST_MODULE_BANNER_TABLE_BANNER"),$data);
					$bannerObj			=	new bannerModule();
					$insertStatus		=	$bannerObj->insertBanner($dataIns);
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
						$adimg			=	$upObj->copy("fileImage","../banner/images",2);
						if($adimg)			$upObj->img_resize("100","120","../banner/images/thumb");
						else 				$this->setPageError($upObj->get_status());
						$this->addData(array("image"=>$adimg),"request");
					}
				$data					=	$this->getData("request");	
				$dataIns				=	$this->populateDbArray(constant("CONST_MODULE_BANNER_TABLE_BANNER"),$data);
				$bannerObj				=	new bannerModule();
				$insertStatus			=	$bannerObj->update($dataIns,$data['id']);
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
