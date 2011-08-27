<?php
/**************************************************************************************
Created By 	:Hari Krishna S	
Created On	:9th novmber	
Purpose		:territory (country and states)	
**************************************************************************************/

class territory extends siteclass
	{
		
		public function getAllCountries($args="1")
			{	
				$sql		=	"select * from vod_country where $args"; 
				$result		=	$this->getdbcontents_sql($sql);
				return $result;
			}
		public function getAllStates($args="1")
			{
				$sql		=	"select * from vod_country_state where $args"; 
				$result		=	$this->getdbcontents_sql($sql);
				return $result;
				
			}
		public function getCountryName($args="1")
			{
				$countryArry	=	$this->getdbcontents_cond('vod_country',$args);
				return $countryArry[0]['country'];
			}
		public function getStateName($args="1")
			{
				$stateArry	=	$this->getdbcontents_cond('vod_country_state',$args);
				return $stateArry[0]['state'];
			}
			
		public function insertCountry($dataArray)
			{
				$country_id		=	$this->db_insert('vod_country',$dataArray);
				if(!$country_id) 
					{
						$this->dbRollBack;
						$this->setPageError($this->getDbErrors());
						return false;
					}
					
				else return $country_id;
				
			}
		public function insertState($dataArray)
			{
				$state_id		=	$this->db_insert('vod_country_state',$dataArray);
				if(!$state_id) 
					{
						$this->dbRollBack;
						$this->setPageError($this->getDbErrors());
						return false;
					}
				else return $country_id;
			}
		public function updateCountry($dataArray,$Id)
			{
				$data		=	$this->db_update('vod_country',$dataArray,'id='.$Id);
				if(!$data) 	
					{
						$this->setPageError($this->getDbErrors());
						return false;
					}		
					else return true;	
			}
		public function updateState($dataArray,$stateId)
			{
				$data		=	$this->db_update('vod_country_state',$dataArray,"id=".$stateId);
				if(!$data) 	
					{
						$this->setPageError($this->getDbErrors());
						return false;
					}		
				else return true;	
			}
	//***************************************function for api addede by meghna*****************************************
	
		public function getAllCountriesApi()
			{	
				$args		=	"status = 1 ORDER BY `preference` ASC"; 
				$reultArry	= 	$this->getAllCountries($args);
				return $reultArry;
			}
		public function getAllStatesApi($country_id)
			{	
				$args		=	"country_id = ".$country_id." and status = 1 ORDER BY `preference` ASC"; 
				$reultArry	= 	$this->getAllStates($args);
				return $reultArry;
			}
		public function getSignupCountry()
			{	
				$args		=	"id in (".GLB_US_COUNTRYID.")"; 
				$reultArry	= 	$this->getAllCountries($args);
				return $reultArry;
			}
	//******************************************************end********************************************************
	}
?>
