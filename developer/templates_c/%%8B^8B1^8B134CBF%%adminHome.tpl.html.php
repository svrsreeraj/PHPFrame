<?php /* Smarty version 2.6.19, created on 2011-02-17 12:53:16
         compiled from adminHome.tpl.html */ ?>
<?php echo '

<script language="JavaScript">

function check()
	{	
		$.ajax({
		type	: "GET",
		url		: "adminHome.php",
		data	: "actionvar=updateData",
		dataType: "json",
		success: function(data1)
			{
				
				//$(\'#total_under_review\').html(data1.UnlockDealDetails.total_under_review.total_under_review);
				$(\'#total_queue_data\').html(data1.UnlockDealDetails.total_queue.total_queue);
				$(\'#total_rejected_data\').html(data1.UnlockDealDetails.total_rejected.total_rejected);
				$(\'#total_locked_data\').html(data1.UnlockDealDetails.total_locked.total_locked);
				$(\'#total_unlocked_data\').html(data1.UnlockDealDetails.total_unlocked.total_unlocked);
				$(\'#total_cooldown_data\').html(data1.UnlockDealDetails.total_cooldown.total_cooldown);
				$(\'#total_expired_data\').html(data1.UnlockDealDetails.total_expired.total_expired);
				$(\'#total_runing_data\').html(data1.UnlockDealDetails.total_running.total_running);
				
				
				
			//old	
				$(\'#UnlockedDealsNumberpurchase\').html(data1.UnlockDealDetails.Numberofpurchase);
				$(\'#UnlockedDealsTotalAmount\').html(data1.UnlockDealDetails.Totalamount);
				$(\'#getEcommerce\').html(data1.getEcommerce.count);
				$(\'#getEcommerceTotalAmount\').html(data1.getEcommerce.total);
				$(\'#getEcommerceTotalTodaysAmount\').html(data1.getEcommerce.totalAmount);
				$(\'#getEcommerceTotalTodaysOrders\').html(data1.getEcommerce.todaydeal);
				$(\'#vendorTotal\').html(data1.getVendors.vendor_count);
				$(\'#vendorTotalToday\').html(data1.getVendors.vendorCountToday);
				$(\'#orderTotal\').html(data1.getOrders.order_count);
				$(\'#orderTotalToday\').html(data1.getOrders.orderCountToday);
				$(\'#Customerdetails\').html(data1.getCustomersDet.totcount);
				$(\'#CustomerdetailsTotalProductive\').html(data1.getCustomersDet.countprd);
				$(\'#CustomerdetailsCustomers\').html(data1.getCustomersDet.totcusttoday);
			}
		});
		setTimeout(\'check()\',5000); 
	}
check();
$(document).ready(function(){
$("#home").tooltip();
$("#dealriview").tooltip();
$("#total_queue").tooltip();
$("#total_rejected").tooltip();
$("#total_locked").tooltip();
$("#total_Unlocked").tooltip();
$("#total_cooldown").tooltip();
$("#total_Expired").tooltip();

$("#totalorder").tooltip();

$("#totalpoints").tooltip();
$("#todaysorder").tooltip();
$("#todayspoints").tooltip();
$("#totalvendor").tooltip();
$("#todaysvendor").tooltip();
$("#totalorders").tooltip();
$("#todaysorders").tooltip();
$("#dealnumber").tooltip();
$("#dealpurchase").tooltip();
$("#amount").tooltip();
$("#totalusers").tooltip();
$("#productiveusers").tooltip();
$("#todayscut").tooltip();
});

</script>
'; ?>

<?php $this->assign('actionReturn', $this->_tpl_vars['obj']->actionReturn); ?>
<form action="" name="fromName" method="POST" enctype="multipart/form-data" onload="refreshpage()">
<table width="100%" border="0"  cellpadding="0" cellspacing="0" class="table_style" onload="refreshpage()l">

<div id="error">
	<?php echo $this->_tpl_vars['actionReturn']['data1']['error']; ?>

</div>

<tr>
	<td class="pageHead"><span id="home"><strong>Home </strong></span></td>
</tr>
	<tr>
		<td>	
			<table  width="100%" height="500px" cellpadding="0" cellspacing="0" border="0">
						<tbody>
							<TR>
								<td  width="50%" valign="top">
									<div class="boxList" style="margin-top: 15px;" >
									
										<DIV>
										<?php if (@LOGGEDIN_ADMIN_USER == 1): ?>
											<table width="360" border="0"  align="center" cellpadding="0" cellspacing="0" class="listTablePopUp" >								<tr>
												<th colspan="3"><div align="left">E-commerce</div></th>
												
												<tr>
													<td style="text-align:left;" width="175" ><span id="totalorder">Total Orders</div></td>
													<td>
														<div id="getEcommerce" style="margin:0px" >	
														
															<?php echo $this->_tpl_vars['actionReturn']['data3']['count']; ?>

														</div>
													</td>
													<td>
															<a href="<?php echo $this->_tpl_vars['obj']->getLink('Toecomm','',true); ?>
&inneraction=totalorder" class="view-more">view more</a>
													</td>	
												</tr>
												<tr>
													<td style="text-align:left;">Total Points</td>
													<td><div id="getEcommerceTotalAmount" style="margin:0px">
														<?php if ($this->_tpl_vars['actionReturn']['data3']['total'] == ""): ?>
															0.00
														<?php else: ?>	
															<?php echo $this->_tpl_vars['actionReturn']['data3']['total']; ?>

														<?php endif; ?>
														</div>
													</td>
													<td>
															<a href="<?php echo $this->_tpl_vars['obj']->getLink('Toecomm','',true); ?>
&inneraction=totalpoints" class="view-more">view more</a>
													</td>	
												</tr>
												<tr>
													<td style="text-align:left;"id="todaysorder"> Today's Orders</td>
													<td>
														<div id="getEcommerceTotalTodaysOrders">
															<?php echo $this->_tpl_vars['actionReturn']['data3']['todaydeal']; ?>

													
														</div>
													</td>
													<td>
															<a href="<?php echo $this->_tpl_vars['obj']->getLink('Toecomm','',true); ?>
&inneraction=todaysorder" class="view-more">view more</a>
													</td>	
												</tr>
												<tr>
													<td style="text-align:left;" id="todayspoints">Today's Points</td>
													<td>
														<div id="getEcommerceTotalTodaysAmount" style="margin:0px">
															<?php echo $this->_tpl_vars['actionReturn']['data3']['todaydeal']; ?>

														</div>
													</td>
													<td>
															<a href="<?php echo $this->_tpl_vars['obj']->getLink('Toecomm','',true); ?>
&inneraction=todaytotalpoints" class="view-more">view more</a>
													</td>	
												</tr>
											</table>
											<?php endif; ?>
									</div>
										<div>	
											<table width="360" border="0"  align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">								<tr>
													<th colspan="3" align ="center"><div align="left">Vendor</div></th>
													<tr>
														<td  style="text-align:left;" width="175" id="totalvendor">Total Vendors</td>
														<td>
															<div id="vendorTotal" style="margin:0px">
																		<?php echo $this->_tpl_vars['actionReturn']['data4']['vendor_count']; ?>

															</div>
														</td>
														<td>
														<a href="<?php echo $this->_tpl_vars['obj']->getLink('Tovendor','',true); ?>
&inneraction=allVendor" class="view-more">view more</a>
														</td>
													</tr>
													<tr>
														<td  style="text-align:left;"id="todaysvendor">Today's Vendors</td>
														<td>
															<div id="vendorTotalToday" style="margin:0px">
																<?php echo $this->_tpl_vars['actionReturn']['data4']['vendorCountToday']; ?>

															</div>
														</td>
														<td>
															<a href="<?php echo $this->_tpl_vars['obj']->getLink('Tovendor','',true); ?>
&inneraction=allVendortoday" class="view-more">view more</a>
														</td>
													</tr>
											</table>
											
										</div>
										<div>	
											<table width="360" border="0"  align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">								<tr>
													<th colspan="3" align ="center"><div align="left">Orders</div></th>
													<tr>
														<td  style="text-align:left;" width="175" id="totalorders">Total Orders</td>
														<td>
															<div id="orderTotal" style="margin:0px">
																		<?php echo $this->_tpl_vars['actionReturn']['data6']['order_count']; ?>

															</div>
														</td>
														<td>
														<a href="<?php echo $this->_tpl_vars['obj']->getLink('Toorder','',true); ?>
&inneraction=allOrder" class="view-more">view more</a>
														</td>
													</tr>
													<tr>
														<td  style="text-align:left;"id="todaysorders">Today's Orders</td>
														<td>
															<div id="orderTotalToday" style="margin:0px">
																<?php echo $this->_tpl_vars['actionReturn']['data6']['orderCountToday']; ?>

															</div>
														</td>
														<td>
															<a href="<?php echo $this->_tpl_vars['obj']->getLink('Toorder','',true); ?>
&inneraction=allOrdertoday" class="view-more">view more</a>
														</td>
													</tr>
											</table>
											
										</div>
									</DIV>
								</td>
						
								<td width="50%" valign="top" >
									<div class="boxList" style="margin-top: 15px;" >
									
											<div>
											<table width="360" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">	
													
														<tr>
															<th colspan="3"><div align="left">Deals</div></th>
														</tr>
														
														<tr>
															<td style="text-align:left;" id="dealriview" width="175">Number of deal under review:</td>
															<td>
																<div id="total_under_review" style="margin:0px">
																	<?php echo $this->_tpl_vars['actionReturn']['data1']['total_under_review']['total_under_review']; ?>

																</div>
															</td>
															<td>
																<a href="<?php echo $this->_tpl_vars['obj']->getLink('Todeals','',true); ?>
&status=0" class="view-more">view more</a>
															</td>
														</tr>
														<tr>
															<td style="text-align:left;" id="total_queue" width="175">Number of deal under queue:</td>
															<td>
																<div id="total_queue_data" style="margin:0px">
																	<?php echo $this->_tpl_vars['actionReturn']['data1']['total_queue']['total_queue']; ?>

																</div>
															</td>		
															<td>
															<a href="<?php echo $this->_tpl_vars['obj']->getLink('Todeals','',true); ?>
&status=1" class="view-more">view more</a>
														</td>
														</tr>
														<tr>
															<td style="text-align:left;" id="total_rejected" width="175">Number of deal rejected:</td>
															<td>
																<div id="total_rejected_data" style="margin:0px">
																	<?php echo $this->_tpl_vars['actionReturn']['data1']['total_rejected']['total_rejected']; ?>

																</div>
															</td>
														<td>
																<a href="<?php echo $this->_tpl_vars['obj']->getLink('Todeals','',true); ?>
&status=2" class="view-more">view more</a>
														</td>															
														</tr>
														<tr>
															<td  style="text-align:left;" id="total_locked" width="175">Number of deal locked:</td>
															<td>
																<div id="total_locked_data" style="margin:0px">
																	<?php echo $this->_tpl_vars['actionReturn']['data1']['total_locked']['total_locked']; ?>

																</div>
															</td>
														<td>
																<a href="<?php echo $this->_tpl_vars['obj']->getLink('Todeals','',true); ?>
&status=3" class="view-more">view more</a>
														</td>			
														</tr>
														<tr>
															<td style="text-align:left;" id="total_Unlocked" width="175">Number of deal Unlocked:</td>
															<td>
																<div id="total_unlocked_data" style="margin:0px">
																	<?php echo $this->_tpl_vars['actionReturn']['data1']['total_unlocked']['total_unlocked']; ?>

																</div>
															</td>
															<td>
															<a href="<?php echo $this->_tpl_vars['obj']->getLink('Todeals','',true); ?>
&status=4" class="view-more">view more</a>
														</td>		
														</tr>
														<tr>
															<td style="text-align:left;" id="total_cooldown" width="175">Number of deal Cooldown:</td>
															<td>
																<div id="total_cooldown_data" style="margin:0px">
																	<?php echo $this->_tpl_vars['actionReturn']['data1']['total_cooldown']['total_cooldown']; ?>

																</div>
															</td>	
															<td>
															<a href="<?php echo $this->_tpl_vars['obj']->getLink('Todeals','',true); ?>
&status=5" class="view-more">view more</a>
														</td>
														</tr>
														<tr>
															<td style="text-align:left;" id="total_Expired" width="175">Number of deal Exipred:</td>
															<td>
																<div id="total_expired_data" style="margin:0px">
																	<?php echo $this->_tpl_vars['actionReturn']['data1']['total_expired']['total_expired']; ?>

																</div>
															</td>	
																<td>
															<a href="<?php echo $this->_tpl_vars['obj']->getLink('Todeals','',true); ?>
&status=6" class="view-more">view more</a>
														</td>
														</tr>
														<tr>
															<td  style="text-align:left;"id="total_running" width="175">Number of deal running:</td>
															<td>
																<div id="total_runing_data" style="margin:0px">
																	<?php echo $this->_tpl_vars['actionReturn']['data1']['total_running']['total_running']; ?>

																</div>
															</td>
																<td>
															<a href="<?php echo $this->_tpl_vars['obj']->getLink('Todeals','',true); ?>
&status=3,4" class="view-more">view more</a>
														</td>
														</tr>
														
														
											</table>
											</DIV>
											<DIV>
											<?php if (@LOGGEDIN_ADMIN_USER == 1): ?>
												<table width="360" border="0"  align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
													<tr>
														<th colspan="3" ><div align="left">Customer Details</div></th>
													</tr>
													<tr>
														<td style="text-align:left;" width="175" id="totalusers">Total Users</td>
														<td>
															<div id="Customerdetails" style="margin:0px">
																<?php echo $this->_tpl_vars['actionReturn']['data2']['totcount']; ?>

															</div>
														</td>
														<td>
																<a href="<?php echo $this->_tpl_vars['obj']->getLink('Tocustomer','',true); ?>
&inneraction=allcustomers" class="view-more">view more</a>
														</td>
													</tr>
													<tr>
														<td style="text-align:left;" id="productiveusers">
															Total Productive Users
														</td>
														<td>
															<div id="CustomerdetailsTotalProductive" style="margin:0px">
																	<?php echo $this->_tpl_vars['actionReturn']['data2']['countprd']; ?>

															</div>
														</td>
														<td>
															<a href="<?php echo $this->_tpl_vars['obj']->getLink('Tocustomer','',true); ?>
&inneraction=allcustomers" class="view-more">view more</a>
														</td>
													</tr>
													<tr>
														<td style="text-align:left;" id="todayscut">
															Today's Customers
														</td>
														<td>
															<div id="CustomerdetailsCustomers"  style="margin:0px">
																<?php echo $this->_tpl_vars['actionReturn']['data2']['totcusttoday']; ?>

															</div>
														</td>
														<td>
															<a href="<?php echo $this->_tpl_vars['obj']->getLink('Tocustomer','',true); ?>
&inneraction=allcustomers" class="view-more">view more</a>
														</td>
													</tr>
												</table>
												<?php endif; ?>
											</DIV>
									</div>
								</td>
							</TR>	
						</tbody>
				
			</table>
		</td>
	</tr>
		
	

</table>
</form>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
