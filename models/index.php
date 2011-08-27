<?php
/****************************************************************************************
Created by	:	Sreeraj
Created on	:	2010-12-14
Purpose		:	Model class for AppProcess
*************** *************************************************************************/
class index extends modelclass
	{
		public function indexListing()
			{
				//$testClass	=	new dealsOrder();
				//$testClass->encryptCard("4648578474587452","2");
				
				//categories
				$masterObj	=	new	masters();
				$cats		=	$masterObj->getAllDetails("vod_category","1  order by preference");
				foreach($cats as $key=>$val)
					{
						$cats[$key]["catUrl"]	=	ROOT_URL."Alldeals/".$this->getHtaccessFilter($val["category"])."-".$val["id"]."/";
					}
				$unlocked	=	GLB_DEAL_UNLOCKED;
				$locked		=	GLB_DEAL_LOCKED;
				$sql		=	"SELECT d.*,v.business_name,v.address,v.phone,v.city,v.zip,v.mobile,cntry.country,state.state,cat.id as catId 
								FROM `vod_deal` as d 
								left join vod_vendor as v on v.id=d.vendor_id 
								left join vod_country as cntry on cntry.id=v.country_id 
								left join vod_country_state as state on state.id=v.state_id 
								left join vod_category_sub as scat on scat.id=d.subcategory_id
								left join vod_category as cat on cat.id=scat.category_id
							
								where d.block_status=0 and(d.status=$unlocked or d.status=$locked)
								";

				//json data for unlocked deals
				$dealObj		=	new deals();
				
				$sql			.=	"order by d.activation_date desc";
				$udata			=	$dealObj->getdbcontents_sql($sql);
				
				
				$temparray	=	array();
				foreach($udata	as $key=>$val)
					{
						if(in_array($val["catId"], $temparray))	unset($udata[$key]);
						else 									$temparray[]	=	$val["catId"];
					}
				$udata	=	array_values($udata);
				
				$udealsArray	=	array();
				
				$vendorObj		=	new vendor();
				
				foreach($udata as $key=>$val)
					{
						foreach ($cats	as	$catkey=>$catval)
							{
								if($val["catId"]	==	$catval["id"])	$cats[$catkey]["dealImage"]	=	$val["thumb_image"];
							}
						$vendorDetails	=	end($vendorObj->getDetails($this->dbSearchCond("=", "id", $val["id"])));

						//date calulation
						$unlockedDate	=	$val["unlocked_date"];
						$unlockedHours	=	$val["unlock_active_hours"];
						$uTimeStamp		=	$this->mysqlDatetoPhp($unlockedDate);
						
						$deadLine		=	getdate(strtotime("+$unlockedHours Hour",$uTimeStamp));
						$unlockedStamp	=	getdate();
						
						$remainingTime	=	strtotime("+$unlockedHours Hour",$uTimeStamp)	-	$unlockedStamp[0];
						
						$temparray["vName"]			=	utf8_encode($val["business_name"]);
						$temparray["vAddress"]		=	utf8_encode($val["address"]);
						$temparray["vState"]		=	utf8_encode($val["state"]);
						if($val["city"])	$cityComma	=	","; 	else $cityComma	=	"";
						$temparray["vCity"]			=	utf8_encode($val["city"].$cityComma);
						$temparray["vPhone"]		=	$this->getUSPhoneDisplay(utf8_encode($val["phone"]));
						$temparray["vZip"]			=	utf8_encode($val["zip"]);
						$temparray["vMobile"]		=	$this->getUSPhoneDisplay(utf8_encode($val["mobile"]));
						$temparray["vCountry"]		=	utf8_encode($val["country"]);
						
						$temparray["id"]			=	$val["id"];
						$temparray["dealCategoryID"]=	$val["catId"];
						$temparray["dealCaption"]	=	$val["caption"];
						$temparray["dealurl"]		=	ROOT_URL."deals/".$this->getHtaccessFilter($val["caption"])."-".$val["id"]."/";
						$temparray["purchaselink"]	=	ROOT_URL."dealPurchase-".$val["id"]."/";
						$temparray["dealImage"]		=	ROOT_URL."images/deals/thumb390x256/".$val["image"];
						if(!$val["image"])
							{
								$temparray["dealImage"]		=	ROOT_URL."images/deals/thumb390x256/no-image.jpg";
							}
						elseif(!file_exists("images/deals/thumb390x256/".$val["image"]))
							{
								$temparray["dealImage"]		=	ROOT_URL."images/deals/thumb390x256/no-image.jpg";	
							}
						
						$temparray["dealPrice"]		=	$val["deal_price"];
						$temparray["dealCost"]		=	$val["cost"];
						$temparray["dealSave"]		=	$val["cost"] - $val["deal_price"];
						$temparray["dealOfferRate"]	=	round($val["offer_rate"]);
						$temparray["jsDeadLine"]	=	$deadLine;
						$temparray["unlockedStamp"]	=	$unlockedStamp;
						$temparray["description"]	=	utf8_encode(htmlentities($this->getLimitedText(strip_tags($val["description"]),200)));
						
						$temparray1["name"]			=	utf8_encode($val["name"]);
						$temparray1["dealurl"]		=	$temparray["dealurl"];
						
						if($val["status"]	==	GLB_DEAL_UNLOCKED)	
							{	
								$temparray["dStatus"]		=	"unlocked";
								$temparray["dealImgUrl"]	=	ROOT_URL."images/buy.png";
								
							}
						
						if($val["status"]	==	GLB_DEAL_LOCKED)	
							{
								$temparray["dStatus"]		=	"locked";
								$temparray["dealImgUrl"]	=	ROOT_URL."images/view_home_deal.png";
								$temparray["purchaselink"]	=	$temparray["dealurl"];
							}	
						
						$udealsArray[]				=	$temparray;
						$dealarry[]					=	$temparray1;	
					}
				if(WHERE_AM_I	==	"online")
					$jsonData	=	$jsonData	=	json_encode($udealsArray,JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP);
				else
					$jsonData	=	json_encode($udealsArray);
				
				$jsonData	=	str_replace("'", "\'", $jsonData);
				$jsonData	=	str_replace('\n', " ", $jsonData);
				$jsonData	=	str_replace('\r', "", $jsonData);
				$jsonData	=	str_replace('\t', " ", $jsonData);
				return array("cats"=>$cats,"udeals"=>$jsonData,"data"=>$dealarry);
			}
		public function indexEmailsubscription()
			{
				ob_clean();
				$data			=	$this->getData("request");
				$data			=	$this->populateDbArray('vod_email_newsletter',$data);
				$NewslttrObj	=	new emailNewsletter();
				$resultId		=	$NewslttrObj->InsertEmailNewsletterSubscription($data);
				if($resultId) 
					{
						echo "You are successfully subcribed for our email newsletters";exit;
					}
				else 
					{
						echo "Either email already exist or something wrong with insertion";exit;
					}
			}
		public function __construct()
			{
				$this->setClassName();
			}
		public function executeAction($loadData=true,$action="",$ufURL="",$navigate=false,$sameParams=false,$newParams="",$excludParams="",$page="")
			{
				if(trim($action))	$this->setAction($action);//forced action
				$methodName	=		(method_exists($this,$this->getMethodName()))	? $this->getMethodName($default=false):$this->getMethodName($default=true);
				$this->actionToBeExecuted($loadData,$methodName,$action,$navigate,$sameParams,$newParams,$excludParams,$page,$ufURL);
				$this->actionReturn		=	call_user_func(array($this, $methodName));				
				$this->actionExecuted($methodName);
				return $this->actionReturn;
			}
		public function __destruct() 
			{
				parent::childKilled($this);
			}
	}
