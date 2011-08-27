<?php
/**************************************************************************************
Created By 	:	hari krishna
Created On	:	2010-11-04
Purpose		:	Get country from IP 
**************************************************************************************/

class ipcountry extends siteclass
	{
		public function getip()
			{
				// gets the ip of the sysytem
				
				$ip		=		$_SERVER['REMOTE_ADDR'];
				
				return $ip;

			}


		public function getcountryfromip($ip)
			{
				// detects the country from the ip
				$sql		=		"SELECT country_code, country_name FROM vod_ip_to_country_all  WHERE  ip_n_from <= inet_aton('$ip') 	AND ip_n_to >= inet_aton('$ip')" ;
				 
				$data		=	$this->getdbcontents_sql($sql);
				print_r($data	);				
				echo $ip; 
			}
		
	}
?>
