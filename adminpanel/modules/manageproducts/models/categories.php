<?php
/**************************************************************************************
Created By 	:	Maria
Created On	:	2011-09-20
Purpose		:	For handling Category section
**************************************************************************************/
class categoriesModel extends modelclass
	{
		public function Listing()
			{	
				$this->permissionCheck("View",1);
				$datacat					=	$this->getData("request");
				$searchData				=	$this->getData("post","Search");
				$sortData				=	$this->getData("request","Search");
				$catsArry				=	$this->getdbcontents_sql("select * from ".constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY")." where status = 1");
				$cat_combo				=	$this->get_category_combo($searchData["parent_id"],'parent_id');
		
				if(!trim($sortData["sortField"]))
					{
						$this->addData(array("sortField"=>"id"),"request","Search");
						$this->addData(array("sortMethod"=>"desc"),"request","Search");
						$sortData	=	$this->getData("request","Search");
					}
				
				if(trim($searchData["parent_id"]))
					{						
						$sqlCond		.=	" And ( ";
						$sqlCond		.=	$this->dbSearchCond("=", "parent_id", $searchData["parent_id"]);
						$sqlCond		.=	") ";
					}
				if(trim($searchData["keyword"]))
					{
						$sqlCond		.=	" And ( ";
						$sqlCond		.=	$this->dbSearchCond("like", "category", "%".trim($searchData["keyword"])."%"). " or";
						$sqlCond		.=	$this->dbSearchCond("like", "description", "%".trim($searchData["keyword"])."%");
						$sqlCond		.=	") ";
					}
				if($sqlCond == '')
					{
						if(trim($datacat["ids"]))
							{	
									$parid		=	$datacat["ids"];
									$cls		=	new categoryModule();
									$names		=	end($cls->getCategoryName($parid));
									$category	=	$names["category"];
									$prid 		=	$names["parent_id"];
									$cond1		.=	" And ( ";
									$cond1		.=	$this->dbSearchCond("=","parent_id",$parid);
									$cond1		.=	") ";
							}
						else
							{
								$parid	=	0;
								$cond1		.=	" And ( ";
								$cond1		.=	$this->dbSearchCond("=","parent_id",$parid);
								$cond1		.=	") ";
							}
					}	
				if($parid > 0)
					{
						$cat_combo				=	$this->get_category_combo($parid,"parent_id");
					}
				else
					{
						$searchData["parent_id"];
						$cat_combo				=	$this->get_category_combo($searchData["parent_id"],'parent_id');
					}
				
				
				$sqlCond				.=	" order by ".$sortData["sortField"]." ".$sortData["sortMethod"];
			
				$sql					 		=	"SELECT * from ".constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY")."
													where 1 $cond1 $sqlCond  $orderBy ";
				$this->addData(array("sql"=>$sql),"post","",false);
				$spage					=	$this->create_paging("n_page",$sql,GLB_PAGE_CNT);
				$data					=	$this->getdbcontents_sql($spage->finalSql());
				if(!$data)		$this->setPageError("No records found !");
				$searchData							=	$this->getHtmlData($this->getData("post","Search",false));
				$searchData["sortData"]				=	$sortData;
				return array("data"=>$data,"category" => $category,"prid" => $prid,"spage"=>$spage,"searchdata"=>$searchData,"cat_combo" => $cat_combo);
			}
		
		public function Editform()
			{
				$this->permissionCheck("Edit",1);
				$data			=	$this->getData("get");
				$dataArr		=	end($this->getdbcontents_sql("select * from ".constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY")." where status = 1 and id = ".$data["id"].""));
				if(!$dataArr)
					{
						$this->setPageError("Invalid Id");
						$this->clearData();
						return $this->executeAction(false,"Listing",true);
					}

				return array("data" => $dataArr,"cat_combo"=> $this->get_category_combo($dataArr["parent_id"],'parent_id'));
			}
		public function Updatedata()
			{
				$data					=	$this->getData("request");
				$file					=	$this->getData("files");
				$prodObj				=	new categoryModule();
				if($file['image']['name'])
					{
						$upObj			=	$this->create_upload(10,"jpg,png,jpeg,gif,swf");
						$adimg			=	$upObj->copy("image","../category/images/category",2);
						if($adimg)			$upObj->img_resize("100","120","../category/images/category/thumb");
						else 				$this->setPageError($upObj->get_status());
						$this->addData(array("image"=>$adimg),"request");
					}
				$data						=	$this->getData("request");
				$dataIns					=	$this->populateDbArray(constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY"),$data);
				$insertStatus				=	$prodObj->update($dataIns,$data['id']);
				if($insertStatus)
					{
						$this->setPageError("Updated Successfully");
						$this->clearData("Savedata");
						$this->clearData("Addform");						
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
				$this->permissionCheck("Add",1);
				$data				=	$this->getData("post");
				return array("cat_combo"=> $this->get_category_combo($data["parent_id"],'parent_id'),"data"=>$dataArr);
			}
		public function Savedata()
			{
				$data				=	$this->getData("request");
				$file				=	$this->getData("files");
					if($file['image']['name'])
					{
						$upObj		=	$this->create_upload(10,"jpg,png,jpeg,gif,swf");
						$adimg		=	$upObj->copy("image","../category/images/category",2);
						if($adimg)		$upObj->img_resize("100","120","../category/images/category/thumb");
						$this->addData(array("image"=>$adimg),"request");
					}
				$data					=		$this->getData("request");
				$dataIns				=	$this->populateDbArray(constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY"),$data);
				if($this->db_insert(constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY"),$dataIns))	
					{
						$this->setPageError("Category created successfully");
						$this->clearData("Savedata");
						$this->clearData("Addform");						
						$this->executeAction(array("action"=>"Listing","navigate"=>true));	
					}
				else 							$this->executeAction(true,"Addform",true);
											
			}
		public function Stauschange()
			{	
				$this->permissionCheck("Status",1);					
				$data		=	$this->getData("request");	
				if($this->statusChange(constant("CONST_MODULE_CATEGORY_TABLE_CATEGORY"),$data["id"],"status"))
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
				$sql				=	"delete from idp_category
											where id=".$data["id"] ;
				$data				=	end($this->getdbcontents_sql($sql));
				$this->executeAction(array("action"=>"Listing","navigate"=>true));
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
	
	}
