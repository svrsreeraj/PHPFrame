<?php /* Smarty version 2.6.19, created on 2011-01-31 17:56:53
         compiled from vendorReport.tpl.html */ ?>
<?php $this->assign('actionReturn', $this->_tpl_vars['obj']->actionReturn); ?>
<?php echo '
<script type="text/javascript">
function getStates(cid,selId,changeId)
	{
		$("#"+changeId).html("Loading...");
		$.ajax({
			   type	: "GET",
			   url	: "vendorReport.php",
			   data	: "actionvar=Getstatecombo&cid="+cid+"&sid="+selId,
			   dataType: "html",
			   success: function(msg){
				   $("#"+changeId).html(msg);
				}
			 });
	}
$(document).ready(function() {
$("#vendorReport").tooltip();
	$("#txt_join_from").datepicker();
	$("#txt_join_from").datepicker(\'option\',
	{
		showAnim:\'show\',
		changeMonth: true,
		changeYear: true,
		//minDate: -20, 
		//maxDate: \'+1M +10D\',
		showOtherMonths: true, 
		selectOtherMonths: true,
		//yearRange:\'c-50:c+10\',
		autoSize:false
	});

	$("#txt_join_to").datepicker();
	$("#txt_join_to").datepicker(\'option\',
	{
		showAnim:\'show\',
		changeMonth: true,
		changeYear: true,
		//minDate: -20, 
		//maxDate: \'+1M +10D\',
		showOtherMonths: true, 
		selectOtherMonths: true,
		//yearRange:\'c-50:c+10\',
		autoSize:false
	});

});
</script>

<link type="text/css" href="js/ui/themes/base/jquery.ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="js/ui/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/ui/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="js/ui/ui/jquery.ui.datepicker.js"></script>

'; ?>


<form action="" name="fromName" method="POST" enctype="multipart/form-data">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">
<?php if ($this->_tpl_vars['obj']->getPageError()): ?>
<tr>
	<td class="errorMessage"><?php echo $this->_tpl_vars['obj']->popPageError(); ?>
</td>
</tr>
<?php endif; ?>

<tr>
	<td>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td align="left"  class="pageHead"><span id="vendorReport"><strong>Vendor Report  <?php echo $this->_tpl_vars['obj']->currentAction; ?>
</strong></span></td>
				<td align="right" class="pageHead" style="text-align:right">
				<?php if ($this->_tpl_vars['obj']->currentAction == 'Transview'): ?>
				<?php else: ?>
					<strong> <?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow; ?>
 - <?php echo $this->_tpl_vars['actionReturn']['spage']->endingRow; ?>
  </strong> of <strong><?php echo $this->_tpl_vars['actionReturn']['spage']->totcnt; ?>
 </strong>
				<?php endif; ?>
				</td>
			</tr>
		</table>
	</td>
</tr>

	<?php if ($this->_tpl_vars['obj']->currentAction == 'Daily'): ?>
	<tr>
	<td>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'vendorReportSearch.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
			<tr>
				<td align="center" valign="middle">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=day&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Date
							<?php echo $this->_tpl_vars['obj']->getSortImage('day',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=total&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Total Vendor
							<?php echo $this->_tpl_vars['obj']->getSortImage('total',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=activevendor&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Active Vendor
							<?php echo $this->_tpl_vars['obj']->getSortImage('activevendor',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=emailactive&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Email update
							<?php echo $this->_tpl_vars['obj']->getSortImage('emailactive',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=smsactive&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Sms update
							<?php echo $this->_tpl_vars['obj']->getSortImage('smsactive',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 					
							
							 					
							<th>Action </th>

						</tr>
						
					<?php $_from = $this->_tpl_vars['actionReturn']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
						<tr>
							<td><?php echo $this->_tpl_vars['data']['day']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['total']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['activevendor']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['emailactive']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['smsactive']; ?>
</td>
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('goToDeal','',true); ?>
&datesearch=<?php echo $this->_tpl_vars['data']['search']; ?>
" class="Second_link">

							<img height="20" width="20" border="0" src="images/inner_details.png"> 
							</a>
							<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; endif; unset($_from); ?>
					<tr>
						<td colspan="10"><?php echo $this->_tpl_vars['actionReturn']['spage']->s_get_links(); ?>
</td>
					</tr>
				</table>
				</td>
			</tr>
		<?php endif; ?>
		
		</table>
	</td>
</tr>

	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['obj']->currentAction == 'Monthly'): ?>
	<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
	<tr>
	<td>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'vendorReportSearch.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
			<tr>
				<td align="center" valign="middle">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">	
											
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=month&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Date
							<?php echo $this->_tpl_vars['obj']->getSortImage('month',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=total&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Total Vendor
							<?php echo $this->_tpl_vars['obj']->getSortImage('total',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=activevendor&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Active Vendor
							<?php echo $this->_tpl_vars['obj']->getSortImage('activevendor',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=emailactive&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Email update
							<?php echo $this->_tpl_vars['obj']->getSortImage('emailactive',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=smsactive&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Sms update
							<?php echo $this->_tpl_vars['obj']->getSortImage('smsactive',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>			
							 					
							
							 					
							<th>Action </th>

						</tr>
						
					<?php $_from = $this->_tpl_vars['actionReturn']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
						<tr>
							<td><?php echo $this->_tpl_vars['data']['month']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['total']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['activevendor']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['emailactive']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['smsactive']; ?>
</td>
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Gotransdaily','',true); ?>
&datesearch=<?php echo $this->_tpl_vars['data']['tosearch']; ?>
" class="Second_link" title="Click here to view daily wise details">

							<img height="20" width="20" border="0" src="images/inner_details.png"> 
							</a>
							<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; endif; unset($_from); ?>
					
				</table>
				</td>
			</tr>
		<?php endif; ?>
		<?php endif; ?>
		</table>
	</td>
</tr>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['obj']->currentAction == 'Yearly'): ?>
	<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
	<tr>
	<td>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'vendorReportSearch.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
			<tr>
				<td align="center" valign="middle">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">							
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=year&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Year
							<?php echo $this->_tpl_vars['obj']->getSortImage('year',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=total&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Total Vendor
							<?php echo $this->_tpl_vars['obj']->getSortImage('total',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=activevendor&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Active Vendor
							<?php echo $this->_tpl_vars['obj']->getSortImage('activevendor',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=emailactive&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Email update
							<?php echo $this->_tpl_vars['obj']->getSortImage('emailactive',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 						
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=smsactive&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Sms update
							<?php echo $this->_tpl_vars['obj']->getSortImage('smsactive',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>		
					
							<th>Action </th>

						</tr>
						
					<?php $_from = $this->_tpl_vars['actionReturn']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
						<tr>
							<td><?php echo $this->_tpl_vars['data']['year']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['total']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['activevendor']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['emailactive']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['smsactive']; ?>
</td>
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Gotransmonthly','',true); ?>
&datesearch=<?php echo $this->_tpl_vars['data']['year']; ?>
" class="Second_link" title="Click here to view monthly wise details">

							<img height="20" width="20" border="0" src="images/inner_details.png"> 
							</a>
							<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; endif; unset($_from); ?>
					<tr>
						<td colspan="10"><?php echo $this->_tpl_vars['actionReturn']['spage']->s_get_links(); ?>
</td>
					</tr>
				</table>
				</td>
			</tr>
		<?php endif; ?>
		
		</table>
	</td>
</tr>
	<?php endif; ?>
	<?php endif; ?>
	
<?php if ($this->_tpl_vars['obj']->currentAction == 'Consolidated'): ?>
<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
	<tr>
	<td><?php echo $this->_tpl_vars['obj']->{(($_var=$this->_tpl_vars['actionReturn']) && substr($_var,0,2)!='__') ? $_var : $this->trigger_error("cannot access property \"$_var\"")}['data']; ?>

		<table  width="100%"  cellpadding="0" cellspacing="0" border="0">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'vendorReportSearch.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
								<tbody>
									<tr>
										<td width="50%" height="100"valign="top">
											<div class="boxList"  >
												<div>
													<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">		
														<th colspan="4" ><div align="center"><?php if ($this->_tpl_vars['actionReturn']['data']['0']['ttotal'] == 0): ?>No Records Found<?php else: ?>Consolidated&nbsp; Report</div></th><?php endif; ?>
														<tr>
															<td width="125">Total Vendors</td>
															<td width="238"><b><?php echo $this->_tpl_vars['actionReturn']['data']['0']['ttotal']; ?>
</b></td>
															<td width="150">Total Active Vendors</td>
															<td width="214"><b><?php echo $this->_tpl_vars['actionReturn']['data']['0']['tactivetotal']; ?>
</b></td>
														</tr>
														<tr>
															<td>Total Email Update:</td>
															<td><b><?php echo $this->_tpl_vars['actionReturn']['data']['0']['temailactive']; ?>
</b></td>
															<td>Total SMS Update:</td>
															<td><b><?php echo $this->_tpl_vars['actionReturn']['data']['0']['tsmsactive']; ?>
</b></td>
														</tr>
														
														<tr>
														<td colspan="3"></td>
														<td><a class="view-more" title="Click here to view yearly report" target="_blank" href="<?php echo $this->_tpl_vars['obj']->getLink('Gotoyearlyreport','',true); ?>
">
														view more
                            							</a></td>
														</tr>
														<tr><td colspan="4"></td></tr>
												  </table>
										
												</div>
											</div>
											</td>
											</tr>
											<tr>
											<td>
											<div class="boxList"  >
												<div>
													
										
												</div>
											</div>
											
									  </td>
										
									</tr>
								</tbody>
						</table>
	</td>
	</tr>
<?php endif; ?>
<?php endif; ?>

</table>
<?php echo '
<script type="text/javascript" src="js/tooltip.js"></script>		
'; ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
