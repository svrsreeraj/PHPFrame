<?php
/*----------------------------------------------------------------------
created by	:	hari krishna s
project		:	voteondeals.com
pupose		:	Google url shortner API	
Date		:	2011-01-13
----------------------------------------------------------------------*/
class googleShortner
	{
		function __construct()
			{
				if(!defined('GLB_GOOGLE_SHORTNER_API_KEY'))		define('GLB_GOOGLE_SHORTNER_API_KEY', 'AIzaSyCtLFrbH1HVcX-tAY0uZm3Rt1E5j3dnY_M');
				if(!defined('GLB_GOOGLE_SHORTNER_ENDPOINT'))	define('GLB_GOOGLE_SHORTNER_ENDPOINT', 'https://www.googleapis.com/urlshortener/v1');
			}
		public function shortenUrl($longUrl)												
			{
				if(function_exists("curl_init"))
					{
						$ch = curl_init(sprintf('%s/url?key=%s',GLB_GOOGLE_SHORTNER_ENDPOINT, GLB_GOOGLE_SHORTNER_API_KEY));
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						$requestData = array('longUrl' => $longUrl);
						curl_setopt($ch, CURLOPT_POST, true);
						curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
						curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));
						$result = curl_exec($ch);
						curl_close($ch);
						return json_decode($result, true);
					}
				return false;
			}
		public function googl($longUrl)
			{
				$response	=	$this->shortenUrl($longUrl);
				return $response['id'];
			}
	} 
?>	