<?php
/**
 * @author	Sreeraj 
 * @Date	from 20:7:2008
 * @file	spaging.php 
 */
//class for paging
class spaging
	{
		public	$nextCaption			=	"<img alt='Next' title='Next' src='images/right_arrow.png' border='0'>";
		public	$prevCaption			=	"<img alt='Previous' title='Previous'  src='images/left_arrow.png'  border='0'>";
		public	$containerTag			=	"li";
		public	$containerLinkParams	=	"class='pagingLink'";
		public	$containerStatParams	=	"class='pagingStat'";
		public	$outerTag				=	"ul";
		public	$outerTagParams			=	"id='paging_ul'";
		public	$urlFformat				=	"<a href = 'xyz.php?{pageVarName}={pageVarValue}'>{pageNumberVlaue}</a>";	
		
		public $perpage					=	"";//number of records per page
		public $totcnt					=	"";//total number of records	private  $s_current_page	=	"";//current page
		public $s_stable_links			=	"";//stable links on the links
		public $s_total_links			=	"";//total links
		public $varname					=	"";//html variabe for paging
		public $sql						=	"";
		public $finalSql				=	"";
		public $limitStr				=	"";
		public $currentPage				=	"";
		public $pagingLinks				=	"";
		public $startingRow				=	"";
		
		
		function  __construct($varname,$sql,$per_page=10,$tot_links=10,$stable_links=3)
			{
				$this->set_per_page($per_page);
				$this->set_sql_tot_count($sql);
				$this->set_varname($varname);
				$this->set_total_links($tot_links);
				$this->set_stable_links($stable_links);
				$this->findURL();
				$this->finalSql	=	$this->finalSql();
				$this->setRow();
			}
		function set_sql_tot_count($sql)
			{
				global $cls_db;
				$this->sql	=	$sql;
				if(trim($sql))
					{
						$cnt		=	$cls_db->getdbcount_sql($sql);
						$this->set_tot_count($cnt);
					}
			}
		function setPagingVars($array)
			{
				foreach($array	as	$key=>$val)
					{
						$this->$key	=	$val;
					}
			}
		function setRow()
			{
				$this->startingRow	=	(($this->get_cur_page()*	$this->perpage)-$this->perpage)+1;
				$this->endingRow	=	($this->startingRow	+	$this->perpage)-1;
				if($this->totcnt	==	0)					$this->startingRow	=	0;
				if($this->totcnt	<	$this->endingRow)	$this->endingRow	=	$this->totcnt;
			}
		function finalSql()
			{
				return $this->sql.$this->s_get_limit();			
			}
		function findURL()
			{
				$fileName	= siteclass::getPageName();
				foreach($_GET as $key=>$val)	if ($key	<>	$this->varname)	$tempstr	.=	$key."=".$val."&";
				$urlFformat				=	"<a href = '$fileName?$tempstr{pageVarName}={pageVarValue}'>{pageNumberVlaue}</a>";
				$this->urlFformat		=	$urlFformat;
			}
		function getOpeningContainer($static=false)
			{
				if($static	==	true)
					{
						return "<".$this->containerTag." ".$this->containerStatParams.">";
					}
				else
					{
						return "<".$this->containerTag." ".$this->containerLinkParams.">";
					}
			}
		function getClosingContainer()
			{
				return "</".$this->containerTag.">";
			}		
		function getOpeningOuterTag()
			{
				return "<".$this->outerTag." ".$this->outerTagParams.">";
			}
		function getClosingOuterTag()
			{
				return "</".$this->outerTag.">";
			}		
		function getreplacedFormat()
			{
				$tempvar	=	$this->urlFformat;
				
				$tempvar	=	str_replace("{pageVarName}",$this->pageVarName,$tempvar);
				$tempvar	=	str_replace("{pageVarValue}",$this->pageVarValue,$tempvar);
				$tempvar	=	str_replace("{pageNumberVlaue}",$this->pageNumberVlaue,$tempvar);
				
				return 		$tempvar;		
			}
		//nextCaption
		function getNextCaption()
			{
				return	$this->nextCaption	;
			}
		function setNextCaption($str)
			{
				$this->nextCaption		=	$str;
			}
		//prevCaption
		function getPrevCaption()
			{
				return	$this->prevCaption	;
			}
		function setPrevCaption($str)
			{
				$this->prevCaption		=	$str;
			}
		//containerTag
		function getContainerTag()
			{
				return	$this->containerTag;
			}
		function setContainerTag($str)
			{
				$this->containerTag		=	$str;
			}
		//containerLinkParams
		function getContainerLinkParams()
			{
				return	$this->containerLinkParams;
			}
		function setContainerLinkParams($str)
			{
				$this->containerLinkParams	=	$str;
			}
		//containerStatParams
		function getContainerStatParams()
			{
				return	$this->containerStatParams;
			}
		function setContainerStatParams($str)
			{
				$this->containerStatParams	=	$str;
			}
		//urlFformat
		function getUrlFformat()
			{
				return	$this->urlFformat;
			}
		function setUrlFformat($str)
			{
				$this->urlFformat	=	$str;
			}
		function geturl($param,$sql)
			{
				if($param	==	"")	$param		=	"1-".$this->perpage;
				$params							=	explode("-",$param);
				$s_current_page_tmp				= 	$params["0"];
				$s_per_page						= 	$params["1"];
				$sql_limit						=	($s_per_page	*	$s_current_page_tmp)	-	$s_per_page;
				$sql_q							=	"$sql limit $sql_limit,$s_per_page";
				$res							=	mysql_query($sql_q);
				return $res;
			}
		private function s_get_nos($start,$end,$totnos)
			{
				$arraycount	=	-1;
				$arraycount++;
				$arr_data[$arraycount]	=	$start;
				$diff	=	($end-$start)/($totnos-1);
				for($i=1;$i<=$totnos-2;$i++)
					{
						$start	=	$start + $diff;
						if($start >=$end )$start	=	$end-1;
						if($arr_data[$arraycount]	>=	$end-1) $start	=	"";
						$arraycount++;
						$arr_data[$arraycount]	=	ceil($start);
					}
				$arraycount++;
				$arr_data[$arraycount]	=	$end;				
				return($arr_data);
			}
		function set_varname($name)
			{
				$this->varname	=	$name;				
			}
		function set_total_links($num)
			{
				$this->s_total_links	=	$num;
			}		
		function set_stable_links($num)
			{
				$this->s_stable_links	=	$num;
			}
		function set_per_page($num)
			{
				$this->perpage	=	$num;
			}
		function set_tot_count($num)
			{
				$this->totcnt	=	$num;
			}
		function s_get_limit()
			{
				$param	=	$_REQUEST[$this->varname];
				if($param	==	"")	$param	=	"1-".$this->perpage;
				$params						=	explode("-",$param);
				$s_current_page_tmp			= 	$params["0"];
				$s_per_page					= 	$params["1"];
				$sql_limit					=	($s_per_page	*	$s_current_page_tmp)	-	$s_per_page;
				$sql_q						=	" limit $sql_limit,$s_per_page";
				$this->limitStr				=	"$sql_limit,$s_per_page";
				return $sql_q; 
			}
		function get_cur_page()
			{
				$param	=	$_REQUEST[$this->varname];
				if($param	==	"")	$param	=	"1-0";
				$params		=	explode("-",$param);
				$s_current_page_tmp	= 	$params["0"];
				$s_per_page			= 	$params["1"];
				$this->currentPage	=	$s_current_page_tmp;
				return $s_current_page_tmp;
			}
		function get_per_page()
			{
				$param	=	$_REQUEST[$this->varname];
				if($param	==	"")	$param	=	"1-0";
				$params		=	explode("-",$param);
				$s_current_page_tmp	= 	$params["0"];
				$s_per_page			= 	$params["1"];
				$this->perPage	=	$s_per_page;
				return $s_per_page;
			}
		function s_get_links($format="")
			{
				$param					=	$_REQUEST[$this->varname];
				$s_current_page			=	$this->get_cur_page($params);
				$totcnt					=	$this->totcnt;
				$s_per_page				=	$this->perpage;
				$s_stable_links			=	$this->s_stable_links;
				$s_total_links			=	$this->s_total_links;
				$varname				=	$this->varname; 
				$s_total_rows			=	$totcnt;//getting total no of rows
				
				if($s_total_rows	==	0)	return "";//if no of total row is zero then the function will stop
				$s_arraycount	=	-1;//to increment array index
				
				//setting the start point of stavle link to sree_numbertostart_stable
				if(($s_numbertostart_stable	=	$s_current_page - intval($s_stable_links/2)) <= 0 ) $s_numbertostart_stable=1;

				//generating links order 	start:starting no of links, end ending no of links, totnos:total no of links
				if(ceil($s_total_rows/$s_per_page)<=$s_total_links)
					{
						for($i=1;$i<=ceil($s_total_rows/$s_per_page);$i++)
							{
								$s_arraycount++;
								$arr_data[$s_arraycount]	=	$i;
							}
						$varwait	=	$arr_data[(count($arr_data))-1];
					}
				else
					{
						$arr_data	=	$this->s_get_nos(1,ceil($s_total_rows/$s_per_page),$s_total_links);
						$varwait	=	$arr_data[(count($arr_data))-1];
						$s_flag	=	0;
						for($i=0;$i<count($arr_data);$i++)
							{
								if($s_flag	==	0)
									{
										if($varwait	==	$s_current_page)
											{
												for($j=1;$j<=$s_stable_links;$j++)
													{
														if($arr_data[(count($arr_data))-$j] <> "")
															{
																$arr_data[(count($arr_data))-$j] = $varwait-($j-1);
															}
														$s_flag				=	1;
													}	
												break;
											}
										if($arr_data[$i]	>=	$s_numbertostart_stable)
											{
												$s_assign_stabele	=	$i;
												$s_flag				=	1;
												for($j=1;$j<=$s_stable_links;$j++)
													{
														if($arr_data[$s_assign_stabele] <> "")
															{
																$arr_data[$s_assign_stabele] = $s_numbertostart_stable;
															}
														$s_numbertostart_stable++;
														$s_assign_stabele++;
													}
											}
									}
							}
					}
				//getting $_GET variables
				$tempstr	=	"";
				foreach($_GET as $key=>$val)
					if ($key	<>	$varname)	$tempstr	.=	$key."=".$val."&";
				if($tempstr)	$ex_params	=	"&".substr($tempstr,0,strlen($tempstr)-1);

				$arr_data[(count($arr_data))-1]	=	$varwait;	
				$flag	=	0;
				for($i=0;$i<count($arr_data);$i++)
					if($arr_data[$i]	==	$s_current_page)	$flag	=	1;
				
				if($flag	==	0)	$arr_data[(count($arr_data))-2]	=	$s_current_page;
				
				$Next		=	$this->nextCaption;
				$Previous	=	$this->prevCaption;
				
				for($i=0;$i<count($arr_data);$i++)
					{
						if($arr_data[$i] == $s_current_page)
							{
								$s_return_string	.=	$this->getOpeningContainer(true).$arr_data[$i].$this->getClosingContainer();
								continue;
							}
						if($arr_data[$i] <> "")	
							{
								$this->pageVarName		=	$varname;
								$this->pageVarValue		=	"$arr_data[$i]-$s_per_page";
								$this->pageNumberVlaue	=	"$arr_data[$i]";

								$s_return_string	.=		$this->getOpeningContainer().$this->getreplacedFormat().$this->getClosingContainer();
							}
					}
				if(end($arr_data)	<>	$s_current_page)
					{
						$s_current_page_tmp		=	$s_current_page+1;
						
						$this->pageVarName		=	$varname;
						$this->pageVarValue		=	"$s_current_page_tmp-$s_per_page";
						$this->pageNumberVlaue	=	$Next;

						$s_return_string		.=			$this->getOpeningContainer().$this->getreplacedFormat().$this->getClosingContainer();
					}
				if($arr_data[0]		<>	$s_current_page)
					{
						$s_current_page_tmp	=	$s_current_page-1;
						
						$this->pageVarName		=	$varname;
						$this->pageVarValue		=	"$s_current_page_tmp-$s_per_page";
						$this->pageNumberVlaue	=	$Previous;
						
						$s_return_string	=		$this->getOpeningContainer().$this->getreplacedFormat().$this->getClosingContainer().$s_return_string;
					}
				if(count($arr_data)	==	"1") return "";
				$tempVal	=	$this->getOpeningOuterTag().$s_return_string.$this->getClosingOuterTag();
				$this->pagingLinks	=	$tempVal;
				return($tempVal);
			}
	}
?>
