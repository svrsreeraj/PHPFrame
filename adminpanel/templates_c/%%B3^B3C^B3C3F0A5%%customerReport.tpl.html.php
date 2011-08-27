<?php /* Smarty version 2.6.19, created on 2011-02-05 13:56:17
         compiled from customerReport.tpl.html */ ?>
<?php $this->assign('actionReturn', $this->_tpl_vars['obj']->actionReturn); ?>
<?php echo '
<script type="text/javascript">
function getStates(cid,selId,changeId)
{
	$("#"+changeId).html("Loading...");
	$.ajax({
		   type	: "GET",
		   url	: "customerReport.php",
		   data	: "actionvar=Getstatecombo&cid="+cid+"&sid="+selId,
		  dataType: "html",
		   success: function(msg){
		   			
			   $("#"+changeId).html(msg);
			}
		 });
}
$(document).ready(function() {
$("#customer").tooltip();
$("#txt_order_from").datepicker();
$("#txt_order_from").datepicker(\'option\',
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

$("#txt_order_to").datepicker();
$("#txt_order_to").datepicker(\'option\',
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
				<td align="left"  class="pageHead"><span id="customer"><strong>Customer Report </strong></span></td>
				<td align="right" class="pageHead" style="text-align:right">
					
					<?php if ($this->_tpl_vars['obj']->currentAction == 'Transcomplete'): ?>
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
		
	<?php if ($this->_tpl_vars['obj']->currentAction == 'Transcomplete'): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'customerReport.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<tr><?php if ($this->_tpl_vars['actionReturn']['data']): ?>
	<td>
		<table  width="100%"  cellpadding="0" cellspacing="0" border="0">
		
								<tbody>
									<tr>
									&nbsp;
										<td width="50%" height="100"valign="top">
											<div class="boxList"  >
												<div>
													<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">		
														<th colspan="4" >Consolodated List</th>
														<tr>
															<td>Total customers :</td><td><b><?php echo $this->_tpl_vars['actionReturn']['data']['totalcustomers']; ?>
</b></td><td>Active customers :</td><td><b><?php echo $this->_tpl_vars['actionReturn']['data']['active']; ?>
</b></td>
															
														</tr>
														<tr>
															<td>Sms Active customers :</td><td><b><?php echo $this->_tpl_vars['actionReturn']['data']['smsactive']; ?>
</b></td><td> From Facebook customers :</td><td><b><?php echo $this->_tpl_vars['actionReturn']['data']['fromfacebook']; ?>
</b></td>
															
														</tr>
														<tr>
															<td>Email active:</td><td><b><?php echo $this->_tpl_vars['actionReturn']['data']['emailactive']; ?>
</b></td><td>Mobile Active</td><td> <b><?php echo $this->_tpl_vars['actionReturn']['data']['moblieactive']; ?>
</b></td>
															
														</tr>
														<tr>
															<td colspan="3"></td>
															<td><a class="view-more" title="Click here to view yearly report" target="_blank" href="customerReport.php?actionvar=Yearly">
															view more
                            								</a>
															</td>
														
														</tr>
													</table>
										
												</div>
											</div>
										
									  </td>
										
									</tr>
								</tbody>
						</table>
					<?php endif; ?>	
	</td>
</tr>
	<?php endif; ?>
<?php if ($this->_tpl_vars['obj']->currentAction == 'Daily'): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'customerReport.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<tr>
	<td>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			
			<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
			<tr>
				<td align="center" valign="middle">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">							
								<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=year&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Date
							<?php echo $this->_tpl_vars['obj']->getSortImage('year',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=totalcustomers&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Total 
							<?php echo $this->_tpl_vars['obj']->getSortImage('totalcustomers',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
                            
 							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=activecustomers&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Active 
							<?php echo $this->_tpl_vars['obj']->getSortImage('activecustomers',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=emailactive&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Email Active 
							<?php echo $this->_tpl_vars['obj']->getSortImage('emailactive',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 						
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=smsactive&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Sms Active 
							<?php echo $this->_tpl_vars['obj']->getSortImage('smsactive',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 						
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=facebook&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Facebook active 
							<?php echo $this->_tpl_vars['obj']->getSortImage('facebook',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>		
							 					
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=mobileactive&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Mobile active
							<?php echo $this->_tpl_vars['obj']->getSortImage('mobileactive',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
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
							<td><?php echo $this->_tpl_vars['data']['totalcustomers']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['activecustomers']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['emailactive']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['smsactive']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['facebook']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['mobileactive']; ?>
</td>
						
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
							
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('goToCustomerPage','',true); ?>
&datesearch=<?php echo $this->_tpl_vars['data']['searchyear']; ?>
" class="Second_link" title="Click here to view all details">
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
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'customerReport.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<tr>
	<td>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			
			<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
			<tr>
				<td align="center" valign="middle">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">	
											
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=year&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Date
							<?php echo $this->_tpl_vars['obj']->getSortImage('year',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=totalcustomers&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Total 
							<?php echo $this->_tpl_vars['obj']->getSortImage('totalcustomers',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
                            
 							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=activecustomers&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Active 
							<?php echo $this->_tpl_vars['obj']->getSortImage('activecustomers',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=emailactive&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Email Active 
							<?php echo $this->_tpl_vars['obj']->getSortImage('emailactive',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 						
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=smsactive&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Sms Active 
							<?php echo $this->_tpl_vars['obj']->getSortImage('smsactive',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 						
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=facebook&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Facebook active 
							<?php echo $this->_tpl_vars['obj']->getSortImage('facebook',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>		
							 					
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=mobileactive&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Mobile active
							<?php echo $this->_tpl_vars['obj']->getSortImage('mobileactive',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
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
							<td><?php echo $this->_tpl_vars['data']['totalcustomers']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['activecustomers']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['emailactive']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['smsactive']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['facebook']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['mobileactive']; ?>
</td>
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Gotransdaily','',true); ?>
&datesearch=<?php echo $this->_tpl_vars['data']['searchyear']; ?>
" class="Second_link" title="Click here to view daily wise details">
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
	<?php if ($this->_tpl_vars['obj']->currentAction == 'Yearly'): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'customerReport.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<tr>
	<td>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			
			<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
			<tr>
				<td align="center" valign="middle">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">							
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=year&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Date
							<?php echo $this->_tpl_vars['obj']->getSortImage('year',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=totalcustomers&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Total 
							<?php echo $this->_tpl_vars['obj']->getSortImage('totalcustomers',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
                            
 							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=activecustomers&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Active 
							<?php echo $this->_tpl_vars['obj']->getSortImage('activecustomers',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=emailactive&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Email Active 
							<?php echo $this->_tpl_vars['obj']->getSortImage('emailactive',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 						
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=smsactive&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Sms Active 
							<?php echo $this->_tpl_vars['obj']->getSortImage('smsactive',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 						
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=facebook&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Facebook active 
							<?php echo $this->_tpl_vars['obj']->getSortImage('facebook',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>		
							 					
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=mobileactive&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Mobile active
							<?php echo $this->_tpl_vars['obj']->getSortImage('mobileactive',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
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
							<td><?php echo $this->_tpl_vars['data']['totalcustomers']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['activecustomers']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['emailactive']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['smsactive']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['facebook']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['mobileactive']; ?>
</td>
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Gotransmonthly','',true); ?>
&datesearch=<?php echo $this->_tpl_vars['data']['searchyear']; ?>
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
	
	


</table>
<?php echo '
<script type="text/javascript" src="js/tooltip.js"></script>		
'; ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
