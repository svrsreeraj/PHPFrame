<?php
/**************************************************************************************
Created By 	:	Maria
Created On	:	2011-09-20
Purpose		:	For handling products
**************************************************************************************/
class productsModel extends modelclass
	{
		public function Listing()
			{	
				$this->permissionCheck("View",1);
				$searchData			=	$this->getData("post","Search");
				$sortData				=	$this->getData("request","Search");
				$dealObj					=	new productModule();
				$catsArry				=	$this->getdbcontents_sql("select * from ".constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY")." where status = 1");	
				
				$pdCatArry			=	$this->getdbcontents_sql("SELECT * FROM ".constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY")." WHERE id not in(select `parent_id` from idp_category)");	
				$cat_combo			=	$this->get_combo_arr("category_id", $pdCatArry, "id", "category", $searchData["category_id"],"Select Category");
				$cat_combo			=	$this->get_combo_arr("category_id", $pdCatArry, "id", "category", $searchData["category_id"],"Select Category");
				$cat_combo				=	$this->get_category_combo($searchData["category_id"]);
				if(!trim($sortData["sortField"]))
					{
						$this->addData(array("sortField"=>"p.id"),"request","Search");
						$this->addData(array("sortMethod"=>"desc"),"request","Search");
						$sortData	=	$this->getData("request","Search");
					}
				if(trim($searchData["category_id"]))
					{						
						$sqlCond		.=	" And ( ";
						$sqlCond		.=	$this->dbSearchCond("=", "category_id", $searchData["category_id"]);
						$sqlCond		.=	") ";
					}
				if(trim($searchData["keyword"]))
					{
						$sqlCond		.=	" And ( ";
						$sqlCond		.=	$this->dbSearchCond("like", "product", "%".trim($searchData["keyword"])."%"). " or";
						$sqlCond		.=	$this->dbSearchCond("like", "description", "%".trim($searchData["keyword"])."%");
						$sqlCond		.=	") ";
					}
				
				
				$sqlCond	.=		" order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
				$sql		 =		"SELECT p.*,c.category as category from ".constant("CONST_MODULE_PRODUCT_TABLE_PRODUCT")." as p
											left join ".constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY")." as c on c.id=p.category_id
											where 1 $sqlCond  $orderBy ";
			
				$this->addData(array("sql"=>$sql),"post","",false);
				$spage			=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data				=	$this->getdbcontents_sql($spage->finalSql());
				
				if(!$data)		$this->setPageError("No records found !");
				
				$searchData							=	$this->getHtmlData($this->getData("post","Search",false));
				$searchData["cat_combo"]			=	$cat_combo;
				//$searchData["combo"]			=	$brand_combo;
				$searchData["sortData"]				=	$sortData;
				return array("data"=>$data,"spage"=>$spage,"searchdata"=>$searchData,"cat_combo"=>$cat_combo);
			}
		public function Viewform()
			{
				$this->permissionCheck("View",1);
				$prodObj			=	new productModule();
				$data				=	$this->getData("request");
				$sql			 	=	"SELECT p.*,c.category as category from ".constant("CONST_MODULE_PRODUCT_TABLE_PRODUCT")." as p
											left join ".constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY")." as c on c.id=p.category_id
											where p.id=".$data["id"] ;							
				$data				=	end($this->getdbcontents_sql($sql));
				$country_name		=	$prodObj->getName("idp_category","category","id=".$dataArr['category_id']);
				return array("data"=>$data,"cat_combo"=>$cat_combo,"brand"=>$brand_combo,"category"=>$country_name);
				
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
				$this->executeAction(array("action"=>"Addform","navigate"=>true,"sameParams"=>true));
			}
		public function Cancel()
			{
				$this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true));
			}
		public function Editform()
			{
				$this->permissionCheck("Edit",1);
				$data			=	$this->getData("request");
				$prodObj		=	new productModule();
				$dataArr		=	end($prodObj->getProductDetails($data["id"]));
				$pdCatArry		=	$this->getdbcontents_sql("SELECT * FROM ".constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY")." WHERE id not in(select `parent_id` from ".constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY").")");	
				$cat_combo		=	$this->get_combo_arr("category_id", $pdCatArry, "id", "category", $dataArr["category_id"],"Select Category");
				if(!$dataArr)
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						$this->executeAction(array("action"=>"Listing","navigate"=>true,"sameParams"=>true));
					}
				return array("data" => $this->getHtmlData($dataArr), "cat_combo"=>$cat_combo,"combo"=>$brand_combo);
			}
		public function Updatedata()
			{
				$data					=	$this->getData("request");
				$file					=	$this->getData("files");
				$prodObj					=	new productModule();
				if($file['image']['name'])
					{
						$upObj			=	$this->create_upload(10,"jpg,png,jpeg,gif,swf");
						$adimg			=	$upObj->copy("image","../manageproducts/images/product",2);
						if($adimg)			$upObj->img_resize("100","120","../manageproducts/images/product/thumb");
						else 				$this->setPageError($upObj->get_status());
						$this->addData(array("image"=>$adimg),"request");
					}
				$data						=	$this->getData("request");
				$dataIns					=	$this->populateDbArray(constant("CONST_MODULE_PRODUCT_TABLE_PRODUCT"),$data);
				if($prodObj->updateproduct($dataIns,$data["id"]))
					{
						$this->setPageError("Updated Successfully");
						$this->clearData();
						$this->clearData("Editform");						
						$this->executeAction(array("action"=>"Listing","navigate"=>true));					
					}
				else
					{
						$this->setPageError($prodObj->getPageError());
						$this->executeAction(array("action"=>"Editform","navigate"=>true));
					}	
			}
		public function Addform()
			{
				$data				=	$this->getData("request");
				$dealObj			=	new productModule();
				$pdCatArry		=	$this->getdbcontents_sql("SELECT * FROM ".constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY")." WHERE id not in(select `parent_id` from ".constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY").")");	
				$cat_combo		=	$this->get_combo_arr("category_id", $pdCatArry, "id", "category", $data["category_id"],"valtype='emptyCheck-please select a category'","Select Category");
				return array("data" => $this->getHtmlData($data),"cat_combo"=>$cat_combo,"combo"=>$brand_combo);
			}	
			
		public function Savedata()
			{
				$data				=	$this->getData("request");
				$file				=	$this->getData("files");
				$prodObj			=	new productModule();
				if($file['image']['name'])
					{
						$upObj		=	$this->create_upload(10,"jpg,png,jpeg,gif,swf");
						$adimg		=	$upObj->copy("image","../manageproducts/images/product",2);//
						if($adimg)		$upObj->img_resize("100","120","../manageproducts/images/product/thumb");
						$this->addData(array("image"=>$adimg),"request");
					}
				$data						=	$this->getData("request");print_r($data);
				$dataIns					=	$this->populateDbArray(constant("CONST_MODULE_PRODUCT_TABLE_PRODUCT"),$data);
				if($prodObj->createproduct($dataIns))	
					{
						$this->setPageError("Product added successfully");
						$this->clearData("Savedata");
						$this->clearData("Addform");						
						$this->executeAction(array("action"=>"Listing","navigate"=>true));	
					}
				else $this->redirectAction(true,$prodObj->getPageError(),"Addform");											
			}
		public function Stauschange()
			{	
				$this->permissionCheck("Status",1);					
				$data		=	$this->getData("request");	
				if($this->statusChange(constant("CONST_MODULE_PRODUCT_TABLE_PRODUCT"),$data["id"],"status"))
					{
						$this->setPageError("Status Changed Successfully");
						$this->clearData();											
						$this->executeAction(array("action"=>"Listing","navigate"=>true));
					}
			}
		public function Deleteform()
			{
				$this->permissionCheck("Delete",1);
				$data				=	$this->getData("request");
				$sql				=	"delete from ".constant("CONST_MODULE_PRODUCT_TABLE_PRODUCT")."
										where id=".$data["id"] ;
				$data				=	end($this->getdbcontents_sql($sql));
				$this->executeAction(array("action"=>"Listing","navigate"=>true));
			}
			//ml
		function get_category_combo($selected='',$sel_name='category_id',$params="")
			{
				$catArry			=	$this->fetchCategoryList();
				//print_r($catArry);exit;
				$stringval			=	" <select name='$sel_name' $params>
                					  <option value=''>Select Category</option>";
				foreach($catArry as $key=>$value)
					{
						if($selected == $catArry[$key]['id']) { $selstring	=	"selected='selected'";} else {$selstring	= "";}
						$stringval	.= "<option value='".$catArry[$key]['id']."' ".$selstring.">".stripslashes($catArry[$key]['title'])."</option>";
			  		}
		  		$stringval.= "</select>";
				return $stringval;
			}
		function fetchCategoryList($parentId = '0', $spacing = '', $exclude = '', $categoryListArray = '', $categoryActive= '')
			{
				if (!is_array($categoryListArray)) $categoryListArray = array();
				if($categoryActive=='')
					{
							$categoryQuery  = "	select id, category, parent_id from
										 		".constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY")." where parent_id = '" . (int)$parentId . "'
										 		order by category";
				
					}
				else
					{
							$categoryQuery  = "	select id, category, parent_id from
										 		".constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY")." where parent_id = '" . (int)$parentId . "'
										 		and status=1 order by category";
					}
				$categoryInfo     			= $this->getdbcontents_sql($categoryQuery);
				$categoryInfoSize 			= sizeof($categoryInfo);
				for($i=0;$i<$categoryInfoSize;$i++)
				{
				   $categoryListArray[] 	= array('id' => $categoryInfo[$i]['id'], 'title' => $spacing . $categoryInfo[$i]['category']);
				   $categoryListArray 		= $this->fetchCategoryList($categoryInfo[$i]['id'], $spacing . '&nbsp;-&nbsp;-', $exclude, $categoryListArray,$categoryActive);
				}
				
				return $categoryListArray;
				
			}
			//ml
	}

