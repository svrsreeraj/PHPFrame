<?php
/**
 * @author	Sreeraj 
 * @Date	from 20:7:2008
 * @file	siteclass.php 
 */
class siteclass extends sdbclass
	{
		public $pageError			=	""; 
		
		//method for paging
		function create_paging($varname,$tot_cnt,$per_page=10,$tot_links=10,$stable_links=3)
			{
				return 	new spaging($varname,$tot_cnt,$per_page,$tot_links,$stable_links);
			}
		//method for uploading
		function create_upload($max_size=10,$files="")
			{
				return 	new upload($max_size,$files);
			}
		//create validation Class
		static function  create_php_validation()
			{
				return new phpValidation();
			}
		//to get trhe current page name
		public static function getPageName()
			{
				$scriptName		=	$_SERVER["SCRIPT_FILENAME"];
				$scriptArray	=	explode(DIRECTORY_SEPARATOR,$scriptName);
				return end($scriptArray);
			}
	   //to get trhe current page's query string
		public static function getPageQueryString()
			{
				$queryString		=	$_SERVER["QUERY_STRING"];
				return $queryString;
			}
		
		//concatenating arguments
		public static function getConcat()
			{
				$dat		=	func_get_args();
				$tempStr	=	"";	
				foreach($dat	as	$key=>$val)	$tempStr	.=	$val;
				return $tempStr;
			}

		//page error
		public function setPageError($var)
			{
				if(is_array($var))
					{
						foreach($var	as $val)	
							$this->pageError[]	=	trim($val);		
					}
				else	$this->pageError[]	=	trim($var);				
				
			}
		//page error
		public function getPageError()
			{
				return	$this->pageError;
			}
		//page error
		public function clearPageError()
			{
				$this->pageError	=	array();
			}
		
		//page error
		public function popPageError()
			{
				if($temp	=	$this->pageError)
					{
						$this->clearPageError();
						return implode("<br>", $temp);	
					}
				else
					return false;
			}
		function getMaxPreference($table,$cond="1",$preference="preference")
			{
				$sql					=	"SELECT  max($preference)+1 as pref FROM $table WHERE $cond";			
				$data					=	$this->getdbcontents_sql($sql);	
				$nxtVal					=	$data[0]['pref'];
				return $nxtVal;
			}
		
		function getSearchFilter($str)
			{
				$str	=	strtolower(trim($str));
				$str	=	str_replace("+"," ",$str);
				$compre	=	array(array("97","122"),array("48","57"),array("32","32"));
				$strcmp	=	$str;
				
				$len	=	strlen($str);
				for($i=0;$i<$len;$i++)
					{
						$temp	=	$strcmp[$i];
						$flag	=	0;
						foreach($compre	as	$key=>$val)
							{
								for($j=$val[0];$j<=$val[1];$j++)
									{
										if(ord($temp)	==	$j)	
											{
												$flag	=	1;
												break;
											}
									}
								if($flag	==	1)	break;
							}
						if($flag	==	0)	$str	=	str_replace($temp,"",$str);
					}
				return $str;
			}
		function getHtaccessFilter($str)
			{
				$str	=	$this->getSearchFilter($str);
				$str	=	str_replace(" ","+",$str);
				return $str;
			}	
				
		function getPercentage($amount,$total)
			{
				$saveAmt		=	$total - $amount;
				return $perc	=	($saveAmt * 100) / $total;				
			}
		function getTotalByPercentage($amount,$perc)
			{
				$saveAmt		=	($total * $perc)/100;
				return	  $total - $saveAmt;				
			}
				
		public static function getSortImage($fieldval1,$fieldval2,$type,$srcPrefix="")
			{
				if($fieldval1	==	$fieldval2)
					{
						if(strtolower($type	==	"asc"))		return "<img src='".$srcPrefix."images/downarrow.gif' border='0'>";
						if(strtolower($type	==	"desc"))	return "<img src='".$srcPrefix."images/uparrow.gif' border='0'>";
					}	
				return "";
			}	
		
		//date format in dd mon year hr:min
		function displayTime($date_value)
			{
				$arr	=	explode(" ",$date_value);
				$dt		=	explode("-",$arr[0]);
				$tm		=	explode(":",$arr[1]);
				return @date("d M Y h:i A",mktime($tm[0],$tm[1],$tm[0],$dt[1],$dt[2],$dt[0]));
			}
		//date format in dd mon year hr:min
		function displayDate($date_value)
			{
				if(!$date_value)	return	"";
				$arr	=	explode(" ",$date_value);
				$dt		=	explode("-",$arr[0]);
				if($arr[1])	$tm		=	explode(":",$arr[1]);
				return @date("d M Y",mktime($tm[0],$tm[1],$tm[0],$dt[1],$dt[2],$dt[0]));
			}
			
			//date format in  mon dd year hr:min
		function displayMonthFirst($date_value)
			{
				if(!$date_value)	return	"";
				$arr	=	explode(" ",$date_value);
				$dt		=	explode("-",$arr[0]);
				if($arr[1])	$tm		=	explode(":",$arr[1]);
				return @date("M d Y",mktime($tm[0],$tm[1],$tm[0],$dt[1],$dt[2],$dt[0]));
			}
				
		//date format in dd mon year hr:min
		function displayDbDate($date_value)
			{
				if(!$date_value)	return	"";
				$arr	=	explode(" ",$date_value);
				$dt		=	explode("-",$arr[0]);
				if($arr[1])	$tm		=	explode(":",$arr[1]);
				return @date("Y-m-d",mktime($tm[0],$tm[1],$tm[0],$dt[1],$dt[2],$dt[0]));
			}
		//firstday of month
		function firstOfMonth($month,$year) 
			{
				return date("Y-m-d", strtotime($month.'/01/'.$year.' 00:00:00'));
			}
		function lastOfMonth($month,$year) 
			{
				return date("Y-m-d", strtotime('-1 second',strtotime('+1 month',strtotime($month.'/01/'.$year.' 00:00:00'))));
			}
		function determine_age($dob)
			{
				$arr		=	explode("-",$dob);
				$birth_date	=	date("d F Y",mktime(0,0,0,$arr[1],$arr[2],$arr[0]));		
				$birth_date_time = strtotime($birth_date);
				$to_date = date('m/d/Y', $birth_date_time);
				 
				list($birth_month, $birth_day, $birth_year) = explode('/', $to_date);
				 
				$now = time();
				 
				$current_year = date("Y");
				 
				$this_year_birth_date = $birth_month.'/'.$birth_day.'/'.$current_year;
				$this_year_birth_date_timestamp = strtotime($this_year_birth_date);
				 
				$years_old = $current_year - $birth_year;
				 
				if($now < $this_year_birth_date_timestamp)
					{
						$years_old = $years_old - 1;
					}
				 
				return $years_old;
			}
			
		
		//limiting Text
		function getLimitedText($str,$limit=0,$moreChar="...")
			{
				$str	=	trim($str);				
				if($limit>0)
					{
						if(strlen($str)>$limit)	return substr($str,0,$limit).$moreChar;						
						else					return $str;
					}
				else	return $str;
					
			}
		//Display content in html for labels, text boxes
		function dispContent($str,$limit=0)
			{
				$entity	=	trim($str);
				return htmlentities($entity);
			}
		//Html will display as html
		function dispHTML($str)
			{
				$entity	=	trim($str);
				return nl2br($entity);
			}
		
		//stripslashes
		function stripslashes($str)
			{
				return stripslashes($str);
			}
		
		function comma2br($str)
			{
				$str	=	str_replace(",", "<br />", $str);
				return $str.",";
			}
		//nl2br
		function nl2br($str)
			{
				return nl2br($str);
			}
		//htmlentities
		function htmlentities($str)
			{
				$entity	=	ucfirst(stripslashes($str));
				return htmlentities($entity);
			}
		//Ucfirst
		function ucfirst($str)
			{
				return ucfirst($str);
			}
		//ucwords
		function ucwords($str)
			{
				return ucwords($str);
			}
		//print_r
		function print_r($str)
			{
			  echo "<pre/>";
			  print_r($str);
			}	
		
		//round
		function number_format($val,$decimals=0,$dec_point = '.',$thousands_sep = ',')
			{
				return number_format($val,$decimals,$dec_point,$thousands_sep);
			}
			
		//round
		function round($val,$num="0")
			{
				return round($val,$num);
			}
		//floor
		function floor($val)
			{
				return floor($val);
			}
		//ceil
		function ceil($val)
			{
				return ceil($val);
			}
		function urlencode($val)
			{
				return urlencode($val);
			}
			
		function get_fck($name,$val="")
			{
				$str	=	'<input type="hidden" id="'.$name.'" name="'.$name.'"
							 value="'.$val.'" style="display:none" />
							 <input type="hidden" id="'.$name.'___Config" value="" 
							 style="display:none" />
							 <iframe id="'.$name.'___Frame" 
							 src="../libs/FCKeditor/editor/fckeditor.html?InstanceName='.$name.'&amp;
							 Toolbar=Default" width="100%" height="400" 
							 frameborder="0" scrolling="no"></iframe>';
				return	$str;
			}	
		
							
		
		//this function will resize the image(jpg,gif,png,bmp,wbmp)
		function img_resize($widthtmp,$heighttemp,$src,$des)//this function will resize the image(jpg,gif,png,bmp,wbmp)
			{	
				$filename 	= 	$src;
				$dest_file 	= 	$des;
				$fnamerev	=	strrev($filename);
				$expfname	=	explode(".",$fnamerev);///for extension 
				$expfname1	=	$expfname[0];
				$filetype	=	strrev($expfname1);
				$ftype 		=	$filetype;
				$percent 	= 	0.5;
				
				$a			=	getimagesize($filename);// Get new sizes
				$old_w		=	$a[0];
				$old_h		=	$a[1];
				$new_w		=	$a[0];
				$new_h		=	$a[1];
			
				if($old_w	>	$widthtmp)
					{
						$new_w	=	$widthtmp; 
						$x		=	round(($new_w*100)/$old_w);
						$new_h	=	round($old_h*($x/100));
						$old_h	=	$new_h;
					}	
				if($old_h	>	$heighttemp)
					{		
						$new_h	=	$heighttemp;
						$x		=	round(($new_h*100)/$old_h);
						$new_w	=	round($new_w*($x/100)); 
					}
				list($width, $height) = getimagesize($filename);
							
				if(($a[0]>$widthtmp) or ($a[1]>$heighttemp))	$thumb 		= imagecreatetruecolor($new_w, $new_h);
				else											$thumb 		= imagecreatetruecolor($old_w, $old_h);
							
				if(strtolower($ftype)	==	'jpeg') $ftype="jpg";
				if(strtolower($ftype)	==	'bmp' )	$ftype="wbmp";
				
				if(strtolower($ftype)	==	'jpg' )	$source 	= imagecreatefromjpeg($filename);
				if(strtolower($ftype)	==	'gif' )	$source 	= imagecreatefromgif($filename);
				if(strtolower($ftype)	==	'png' )	$source 	= imagecreatefrompng($filename);
				if(strtolower($ftype)	==	'wbmp')	$source 	= imagecreatefromwbmp($filename);
		   
				imagecopyresized($thumb, $source, 0, 0, 0, 0, $new_w, $new_h, $width, $height);// Resize
						
				if(strtolower($ftype)=='jpg')	imagejpeg($thumb, $dest_file); 
				if(strtolower($ftype)=='gif')	imagegif($thumb, $dest_file); 
				if(strtolower($ftype)=='png')	imagepng($thumb, $dest_file); 
				if(strtolower($ftype)=='wbmp')	imagewbmp($thumb, $dest_file); 
			}
		
			
		// name=> select box name,$arr=>data array,$valname=>value index name of arry,$dataname=> data index name of array, $selected => value to be selected,$params=> Extra params of select box(like class etc) 
		function get_combo_arr($name,$arr,$valname,$dataname,$selectd="",$params="",$name_change="Select")
			{
				$str		=	"<select name='$name' $params>";
				if($name_change)
					{
						if($selectd	==	"")		$str		.=	"<option selected value=''>".$name_change."</option>";
						else 					$str		.=	"<option value=''>".$name_change."</option>";
					}
				if(is_array($arr))
					{
						
						foreach ($arr as $key	=>	$val)
							{
								$val[$dataname]		=	stripslashes($val[$dataname]);
								
								if($selectd)
									{
										if($selectd	==	$val[$valname])
											$str		.=	"<option selected value='".$val[$valname]."'>".stripslashes($val[$dataname])."</option>";
										else
											$str		.=	"<option value='".$val[$valname]."'>".stripslashes($val[$dataname])."</option>";
									}
								else
									$str		.=	"<option value='".$val[$valname]."'>".$val[$dataname]."</option>";
							}
					}
				$str		.=	"</select>";
				return $str;
			}	
		//name=> select box name,$start=>starting number of series,$end=>ending number of series,$selected => value to be selected,$params=> Extra params of select box	
		function get_combo_int($name,$start,$end,$selectd="",$params="",$name_change="")
			{
				$str		=	"<select name='$name' $params>";
				if($name_change)
					{
						if($selectd	==	"")		$str		.=	"<option selected value=''>".$name_change."</option>";
						else 					$str		.=	"<option value=''>".$name_change."</option>";
					}
				for($i=$start;$i<=$end;$i++)
					{
						
						if($selectd	>=	0)
							{
								if($selectd	==	$i)		$str		.=	"<option selected value='".$i."'>".$i."</option>";
								else					$str		.=	"<option value='".$i."'>".$i."</option>";
							}
						else
							$str		.=	"<option value='".$i."'>".$i."</option>";
					}
				$str		.=	"</select>";
				return  $str;
			}
		//name=> select box name,$start=>starting number of series,$end=>ending number of series,$selected => value to be selected,$params=> Extra params of select box	
		function get_combo_list_array($name,$arr,$selectd="",$params="",$name_change="Select")
			{
				$str		=	"<select name='$name' $params>";
				if($name_change)
					{
						if($selectd	==	"")		$str		.=	"<option selected value=''>".$name_change."</option>";
						else 					$str		.=	"<option value=''>".$name_change."</option>";
					}
				for($i=0;$i<count($arr);$i++)
					{
						foreach ($arr[$i] as $key	=>	$val)
							{
								if($selectd	>=	0)
									{
										if($selectd	==	$key)
											$str		.=	"<option selected value='".$key."'>".stripslashes($val)."</option>";
										else
											$str		.=	"<option value='".$key."'>".stripslashes($val)."</option>";
									}
								else
									$str		.=	"<option value='".$key."'>".$val."</option>";
							}
					}
				$str		.=	"</select>";
				return  $str;
			}
		//for getting year
		function get_combo_year($name,$selectd="",$params="",$name_change="",$nos=95,$diffyear=0)
			{
			
				$endyr		=	date('Y')-$diffyear;
				$startyr	=	$endyr-$nos;
				$str		=	"<select name='$name' $params>";
				if($name_change)
					{
						if($selectd	==	"")		$str		.=	"<option selected value=''>".$name_change."</option>";
						else 					$str		.=	"<option value=''>".$name_change."</option>";
					}
				for($i = $startyr; $i <= $endyr; $i++ )
					{
						if($i	==	$selectd)	$str	.="<option value='$i' selected>$i</option>";
						else					$str	.="<option value='$i'>$i</option>";
					}
				$str		.=	"</select>";
				return  $str;
			}
		//for getting months
		function get_combo_months($name,$selectd="",$params="",$name_change="")
			{
				$str		=	"<select name='$name' $params>";
				if($name_change)
					{
						if($selectd	==	"")		$str		.=	"<option selected value=''>".$name_change."</option>";
						else 					$str		.=	"<option value=''>".$name_change."</option>";
					}		
				for($i=1;$i<=12;$i++)
					{
						if($i	==	$selectd)	$str	.="<option value='$i' selected>".date("F", mktime(0,0,0,$i+1,0,0))."</option>";
						else					$str	.="<option value='$i'>".date("F", mktime(0,0,0,$i+1,0,0))."</option>";
												
					}
				$str		.=	"</select>";
				return  $str;
			}
		//for multi selection dropdown
		function get_combo_multiple($name,$arr,$valname,$dataname,$selectd="",$params="",$name_change="")
				{
				
					$sel_arr	=	explode(",",$selectd);
					$co_arr		=	count($sel_arr);
					$str		=	"<select name='$name' $params multiple='multiple'>";
					if($name_change)
						{
							if($selectd	==	"")		$str		.=	"<option selected value='0'>".$name_change."</option>";
							else					$str		.=	"<option value='0'>".$name_change."</option>";	
						}
					if(is_array($arr))
						{
							
							foreach ($arr as $key	=>	$val)
								{
									$val[$dataname]		=	stripslashes($val[$dataname]);
									if($selectd)
										{
											$flag	=	0;
											for($a=0;$a<$co_arr;$a++)
											{
												if($val[$valname]==$sel_arr[$a])
												{
												$str		.=	"<option selected value='".$val[$valname]."'>".stripslashes($val[$dataname])."</option>";
												$flag		=	1;
												}	
											}
											if($flag!=1)
												$str		.=	"<option value='".$val[$valname]."'>".stripslashes($val[$dataname])."</option>";
											
										}
									else
										$str		.=	"<option value='".$val[$valname]."'>".$val[$dataname]."</option>";
								}
						}
					$str		.=	"</select>";
					return $str;
				}
	
		
		//Random string : excluded - o,0,1 and I
		function createRandom($no=6)
			 {
				$chars = "abcdefghijkmnpqrstuvwxyz23456789ABCDEFGHJKLMNPQRSTUVWXYZ";
				srand((double)microtime()*1000000);
				$i = 1;
				$pass = '' ;
				while ($i <= $no)
					{
						$num = rand() % 33;
						$tmp = substr($chars, $num, 1);
						$pass = $pass . $tmp;
						$i++;
					}			
				return $pass;
			 }
		//Random number : excluded - 0
		function createRandomNum($no=6)
			 {
				$chars = "123456789";
				srand((double)microtime()*1000000);
				$i = 1;
				$pass = '' ;
				while ($i <= $no)
					{
						$num = rand() % 9;
						$tmp = substr($chars, $num, 1);
						$pass = $pass . $tmp;
						$i++;
					}			
				return $pass;
			 }
		
		//Sending email as HTMl with files if any 
		function sendmail($to,$from,$subject,$message,$files="")
			{
				$headers 		= 	"From: $from";
				$semi_rand 		= 	md5(time());// boundary
				$mime_boundary 	= 	"==Multipart_Boundary_x{$semi_rand}x";

				// headers for attachment
				$headers 		.= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

				// multipart boundary
				$message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $message . "\n\n";
				$message .= "--{$mime_boundary}\n";
					
				if(is_array($files))// preparing attachments
					{
						for($x=0;$x<count($files);$x++)
							{
								$file 	=	fopen($files[$x],"rb");
								$data 	=	fread($file,filesize($files[$x]));
								$data 	=	chunk_split(base64_encode($data));
								$fname	=	end(explode("/",$files[$x]));
								fclose($file);
								$message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"$fname\"\n" .
											 "Content-Disposition: attachment;\n" . " filename=\"$files[$x]\"\n" .
											 "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
								$message .= "--{$mime_boundary}\n";
							}
					}
				$ok = @mail($to, $subject, $message, $headers);// send
				return $ok;
			}
		//zipFiles("xyz.zip",array("dir1","dir2"),array("file1","file2"));
		function zipFiles($zipname,$dir_arr,$file_arr)
			{
				$zip		= 	  new ZipArchive();   
				if($zip->open($zipname, ZIPARCHIVE::CREATE)	!=		TRUE)	exit("cannot open <$zipname>\n");
				
				$num_file	=	count($file_arr);
				for($i=0;$i<$num_file;$i++)		$zip->addFile($file_arr[$i]);
				$num_dir	=	count($dir_arr);	
				for($i=0;$i<$num_dir;$i++)
					{
						if(!is_dir($dir_arr[$i]))	return false;
						$files 		= 	  array();
						$dirs 		= 	  array($dir_arr[$i]);
						while(NULL	!==	($dir = array_pop( $dirs)))
							{
								if($dh = opendir($dir))
									{
										while(false	!==		($file	=	readdir($dh)))
											{
												if($file	==	'.' || $file	==	'..')	continue;
												$path = $dir . '/' . $file;
												if(is_dir($path))	$dirs[]		= 	$path;	
												else
													{
														$files[]	=	$path;
														$zip->addFile($path);
													}
											}	
										closedir($dh);
									}		
							}
					}
				$zip->close();
			}
		//removing an elemnt by searching its value
		function array_remove($arr,$value) 
			{
				return array_values(array_diff($arr,array($value)));
			}
				
		//checking whether the
		function isie()
			{
				if(strstr($_SERVER["HTTP_USER_AGENT"],"MSIE"))	return 1;
				else											return 0;
			}
		//server side validation - Email
		function validateEmail($email)
			{
				if (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) return true;
				else return false;				
			}
			 
		//function to make CSV FILE		
		function getCsvFile($sql,$headArr,$fieldArr,$filename="ResultRecords")
			{
				ob_clean();
				header("Content-type: application/octet-stream");
				header("Content-Disposition: attachment;Filename=".$filename.".csv");
				echo $this->getCSVQuotedArray($headArr);
				
				$result			=	$this->db_query($sql);
				$finalArray		=	array();
				while($dataObject = mysql_fetch_array($result)) 
					{	
						foreach($fieldArr as $key=>$val)
							{							
								 $resArr[$key] 	= 	stripslashes($dataObject[$val]);
							}
						echo $this->getCSVQuotedArray($resArr);
						unset($resArr);
					}
				exit;				
			}
		function getCSVQuotedArray($arr)
			{
				if(!function_exists('appendQuotes'))
					{
						function appendQuotes(&$item)
							{
								$item	=	'"'.$item.'"';
							}		
					}
					
				array_walk($arr,"appendQuotes");			
				return implode(",",$arr)."\n";		
			}

		//Status Change
		function statusChange($table,$id,$field="status")
			{
				if($id)
					{
						$status	 =	!$status;
						 $sql	 =	"update $table set `$field` = !($field) where id='$id'";
						return  $this->db_query($sql);
					}
			}		
		function permissionCheck($action,$redirect="")
			{
				$objCls		= 	new coreAdminUser();
				return $objCls->permissionMenuCheck($action,$redirect);				
			}
		function getPopUpTable($headArray,$dataArray,$tWidth="100%",$params='class="listTablePopUp"')
			{
				foreach($headArray	as $key=>$val)	$tempTh	.=	"<th>".$val."</th>";
				if($tempTh)							$tempTh	=	'<tr align="center" valign="middle">'.$tempTh.'</tr>';
				
				$tempData	=	"";
				foreach($dataArray	as $key=>$val)
					{
						$tempTd	=	"";
						if(is_array($val))
							{
								foreach($val	as $key1=>$val1)	$tempTd	.=	"<td>".$val1."</td>";
								if($tempTd)	$tempData	.=	"<tr>".$tempTd."</tr>";	
							}
					}
				if(!$tempData)
					{
						$tempTd	=	"";
						foreach($dataArray	as $key=>$val1)			$tempTd	.=	"<td>".$val1."</td>";
						if($tempTd)	$tempData	.=	"<tr>".$tempTd."</tr>";
					}
				foreach($dataArray	as $key=>$val)	$tempTd	.=	"<td>".$val."</td>";
				$tempStr	=	'<table width="'.$tWidth.'" border="0" cellpadding="0" cellspacing="0" '.$params.'>
								'.$tempTh.$tempData.'										
								 </table>
								 ';
				$tempStr		=	str_replace("\n","",$tempStr);
				$tempStr		=	str_replace("\r","",$tempStr);
				$tempStr		=	str_replace('"','\"',$tempStr);
				$tempStr		=	str_replace('"','&quot;',$tempStr);
				return $tempStr;
			}
		function getRealEscapeData($arr,$exceptions=array())
			{
				if(!function_exists("callBackFngetRealEscapeData"))
					{
						function callBackFngetRealEscapeData(&$item, $key,$exceptions)
							{
								if($exceptions)	if(in_array($key, $exceptions))	return;
								$item	=	mysql_real_escape_string($item);
							}
					}
				if(is_array($arr))
					{
						array_walk_recursive($arr,"callBackFngetRealEscapeData",$exceptions);
						return $arr;
					}
				else	return mysql_real_escape_string($arr);
			}
		function mysqlDatetoPhp($newDate)
			{
				$newDate	=	explode(" ",$newDate);
				$date		=	$newDate[0];
				$time		=	$newDate[1];
				$dates		=	explode("-",$date);
				$times		=	explode(":",$time);
				return mktime($times[0],$times[1],$times[2],$dates[1],$dates[2],$dates[0]);
			}
		function getApplication()
			{ 
				$appln		=	$_SERVER['HTTP_USER_AGENT'];
				if(strstr($appln,'VOD IPHONE')) return 2;
				elseif(strstr($appln,'VOD ANDROID')) return 3;
				else return 1;
			}
		function getUSPhoneDisplay($phNumber)
			{
				$phNumber		=	strtolower($phNumber);
				if(strlen($phNumber)	==	10)
					{
						return  $newString	=	"(".substr($phNumber,0,3).") ".substr($phNumber,3,3)."-".substr($phNumber,6,4);
					}
				return $phNumber;
			}
		function array_replace_new($base,$new)
			{
				foreach($new	as $key=>$val)	$base[$key]	=	$val;
				return $base;
			}
		static function addHook($argsArray=array())
			{
				global $hookSessionName;
				$defaultArray		=	array("fromClass"=>"","fromFunction"=>"","toClass"=>"","toFunction"=>"");
				$mergedArray		=	array_merge($defaultArray, $argsArray);
				$hookSessionName[]	=	$mergedArray;
			}
		function testHook($val)
			{
				return $val;	
			}
	}	
?>
