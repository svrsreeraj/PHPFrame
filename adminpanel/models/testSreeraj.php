<?php
/**************************************************************************************
Created by :Sreeraj
Created on :2010-11-07
Purpose    :Model Page
**************************************************************************************/
class testSreeraj extends modelclass
	{
		public $actionReturn	=	"";
		
		public function __construct()
			{
				$this->setClassName();
			}
		public function testSreerajIplist()
			{
				$data		=	$this->getData();
				$sql		=	"select * from vod_ip_to_country_all";
				$spage		=	$this->create_paging("n_page",$sql,10);
				$data		=	$this->getdbcontents_sql($spage->finalSql());
				$links		=	$spage->s_get_links();
				return $links;
			}
		public function testSreerajYoutube()
			{
				return "Youtube DONE !!!!!";
			}
		public function testSreerajListing()
			{
				return "Listing....";
			}
		public function testSreeraja1()
			{
				print_r($this->getData());
				return "Listing....";
			}
		public function testSreeraja2()
			{
				print_r($this->getData());
				return "Listing....";
			}
		public function testSreeraja3()
			{
				print_r($this->getData());
				return "Listing....";
			}
		public function testSreeraja4()
			{
				print_r($this->getData());
				return "Listing....";
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
		function __destruct()
			{
				parent::childKilled($this);
			}
	}
?>