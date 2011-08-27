<?php /* Smarty version 2.6.19, created on 2011-02-17 18:01:13
         compiled from dealOrderAll.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'dealOrderAll.tpl.html', 824, false),)), $this); ?>
<?php $this->assign('actionReturn', $this->_tpl_vars['obj']->actionReturn); ?>

<?php echo '
<script type="text/javascript">
function getsubcat(cid,changeId)
	{
		$("#"+changeId).html("Loading...");
		$.ajax({
			   type	: "GET",
			   url	: "dealOrderAll.php",
			   data	: "actionvar=Getsubcatcombo&cid="+cid,
			   dataType: "html",
			   success: function(msg){
				   $("#"+changeId).html(msg);
				}
			 });
	}
$(document).ready(function() {
	$("#dealorder").tooltip();
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


<form action="" name="fromName" method="post" enctype="multipart/form-data">
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
				<td align="left"  class="pageHead"><span id="dealorder"><strong> Deal Orders <?php if ($this->_tpl_vars['obj']->currentAction == 'Transall'): ?>All<?php endif; ?><?php if ($this->_tpl_vars['obj']->currentAction == 'Transyearly'): ?>Yearly<?php endif; ?><?php if ($this->_tpl_vars['obj']->currentAction == 'Transdaily'): ?>Daily<?php endif; ?><?php if ($this->_tpl_vars['obj']->currentAction == 'Transmonthly'): ?>Monthly<?php endif; ?><?php if ($this->_tpl_vars['obj']->currentAction == 'Transcoupon'): ?>Coupon Sharing<?php endif; ?> </strong></span></td>
				<td align="right" class="pageHead" style="text-align:right">
				<?php if ($this->_tpl_vars['obj']->currentAction == 'Transcoupon' || $this->_tpl_vars['obj']->currentAction == 'Transview' || $this->_tpl_vars['obj']->currentAction == 'Transcomplete'): ?>
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
	
	<?php if ($this->_tpl_vars['obj']->currentAction == 'Transall'): ?>
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'dealOrderSearch.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
				<tr>
					<td align="center" valign="middle">
						<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
							<tr align="center" valign="middle">							
								<th width="70"><input type="checkbox" name="checkall" id="id_check_all" ></th>
								<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transallsearch','','false'); ?>
&sortField=o.id&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Order Id
								<?php echo $this->_tpl_vars['obj']->getSortImage('o.id',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a></th>
								<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transallsearch','','false'); ?>
&sortField=o.orderDate&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Order Date
								<?php echo $this->_tpl_vars['obj']->getSortImage('o.orderDate',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a></th>
								<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transallsearch','','false'); ?>
&sortField=d.name&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Deal Name
								<?php echo $this->_tpl_vars['obj']->getSortImage('d.name',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
				
								</a></th>
								<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transallsearch','','false'); ?>
&sortField=o.total_amount&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Amount
								<?php echo $this->_tpl_vars['obj']->getSortImage('o.total_amount',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a></th>
								<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transallsearch','','false'); ?>
&sortField=cu.fname&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Customer Name
								<?php echo $this->_tpl_vars['obj']->getSortImage('cu.fname',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
								 </a></th>
								 
								 <th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transallsearch','','false'); ?>
&sortField=o.quantity&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								<span title="Redeemed Coupons/Total Coupons">Coupons</span>					
								<?php echo $this->_tpl_vars['obj']->getSortImage('o.quantity',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
								 </a></th>
								 							
								<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transallsearch','','false'); ?>
&sortField=o.paid_status&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Paid
								<?php echo $this->_tpl_vars['obj']->getSortImage('o.paid_status',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
								 </a></th>							
								<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transallsearch','','false'); ?>
&sortField=o.redeem_status&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Redeemed
								<?php echo $this->_tpl_vars['obj']->getSortImage('o.redeem_status',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
								 </a></th>							
	
								<th>
								Actions
								</th>							
							</tr>
							
						<?php $_from = $this->_tpl_vars['actionReturn']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
							<tr>
								<td width="70"><input type="checkbox" name="checkone[]" value="<?php echo $this->_tpl_vars['data']['id']; ?>
" id="id_chk_checkone" ></td>
								<td><?php echo $this->_tpl_vars['data']['id']; ?>
</td>
								<td><?php echo $this->_tpl_vars['obj']->displayDate($this->_tpl_vars['data']['orderDate']); ?>
</td>
								<td><a class="helpText" onmouseover="return escape('<?php echo $this->_tpl_vars['data']['dealPopUp']; ?>
')"><?php echo $this->_tpl_vars['data']['dealname']; ?>
</a></td>
								<td><a class="helpText" onmouseover="return escape('<?php echo $this->_tpl_vars['data']['amountPopUp']; ?>
')">$<?php echo $this->_tpl_vars['data']['total_amount']; ?>
</a></td>
								<td><?php echo $this->_tpl_vars['data']['customerfname']; ?>
 <?php echo $this->_tpl_vars['data']['customerlname']; ?>
</td>
								<td><?php echo $this->_tpl_vars['data']['used_coupons']; ?>
/<?php echo $this->_tpl_vars['data']['quantity']; ?>
</td>
								<td>
									<?php if ($this->_tpl_vars['data']['paid_status'] == @GLB_DEAL_PAID): ?>
										<img border="0" title="Paid" src="images/active.gif">
									<?php else: ?>
										<img border="0" title="Not Paid" src="images/inactive.gif">
									<?php endif; ?>
								</td>
								<td>
									<?php if ($this->_tpl_vars['data']['redeem_status'] == @GLB_COUPON_REDEEMED): ?>
										<img border="0" title="Redeemed" src="images/active.gif">
									<?php else: ?>
										<img border="0" title="Not Redeemed" src="images/inactive.gif">
									<?php endif; ?>
								</td>
								<td>
									<a href="<?php echo $this->_tpl_vars['obj']->getLink('Transview','','false'); ?>
&id=<?php echo $this->_tpl_vars['data']['id']; ?>
">
										<img border="0" title="Click here to view" src="images/view.gif">
									</a>
								</td>
							</tr>
						<?php endforeach; endif; unset($_from); ?>
						<tr>
							<td colspan="2">
							<input class="butsubmit cls_btn_hide" msg="Are you sure you want to change these records to paid?" value="Paid" type="submit" name="actionvar"> 
							<input class="butsubmit cls_btn_hide" msg="Are you sure you want to change these records to not paid?" value="Not Paid" type="submit" name="actionvar"> 
							</td>
							<td colspan="8"><?php echo $this->_tpl_vars['actionReturn']['spage']->s_get_links(); ?>
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
	
	<?php if ($this->_tpl_vars['obj']->currentAction == 'Transdaily'): ?>
	<tr>
	<td>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'dealOrderSearch.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
			<tr>
				<td align="center" valign="middle">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">							
						
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=o.orderDate&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Order Date
							<?php echo $this->_tpl_vars['obj']->getSortImage('o.orderDate',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=tot_orders&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Orders
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_orders',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=tot_deals&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Deals
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_deals',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
				
							</a></th>					
							
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=tot_total_amount&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Total Amount
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_total_amount',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 						
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=tot_customer_id&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Customers
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_customer_id',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 						
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=tot_paid&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Paid
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_paid',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>		
							 <th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=tot_quantity&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Coupons
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_quantity',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>					
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=totredeemed&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Redeemed
							<?php echo $this->_tpl_vars['obj']->getSortImage('totredeemed',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>
							 					
							<th>Action </th>

						</tr>
						
					<?php $_from = $this->_tpl_vars['actionReturn']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
						<tr>
							<td><?php echo $this->_tpl_vars['obj']->displayDate($this->_tpl_vars['data']['orderDate']); ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['tot_orders']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_deals']; ?>
</a></td>							
							<td>$<?php echo $this->_tpl_vars['data']['tot_total_amount']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_customer_id']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_paid']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_quantity']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['totredeemed']; ?>
</a></td>
							
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Gotransall','',true); ?>
&datesearch=<?php echo $this->_tpl_vars['obj']->displayDbDate($this->_tpl_vars['data']['orderDate']); ?>
" class="Second_link" title="Click here to view all details">
							<img height="20" width="20" border="0" src="images/inner_details.png"> 
							</a>
							<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; endif; unset($_from); ?>
					<tr>
						<td colspan="9"><?php echo $this->_tpl_vars['actionReturn']['spage']->s_get_links(); ?>
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

	<?php if ($this->_tpl_vars['obj']->currentAction == 'Transmonthly'): ?>
	<tr>
	<td>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'dealOrderSearch.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
			<tr>
				<td align="center" valign="middle">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">							
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=o.orderDate&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Order Date
							<?php echo $this->_tpl_vars['obj']->getSortImage('o.orderDate',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=tot_orders&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Orders
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_orders',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=tot_deals&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Deals
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_deals',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
				
							</a></th>
							
							
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=tot_total_amount&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Total Amount
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_total_amount',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 						
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=tot_customer_id&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Customers
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_customer_id',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 						
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=tot_paid&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Paid
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_paid',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>		
							
							 <th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=tot_quantity&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Coupons
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_quantity',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							 
							 					
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=totredeemed&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Redeemed
							<?php echo $this->_tpl_vars['obj']->getSortImage('totredeemed',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>
							 					
							<th>Action </th>

						</tr>
						
					<?php $_from = $this->_tpl_vars['actionReturn']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
						<tr>
							<td><?php echo $this->_tpl_vars['data']['dealyear']; ?>
 <?php echo $this->_tpl_vars['data']['dealmonth']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['tot_orders']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_deals']; ?>
</a></td>
							
							<td>$<?php echo $this->_tpl_vars['data']['tot_total_amount']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_customer_id']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_paid']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_quantity']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['totredeemed']; ?>
</a></td>
							
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Gotransdaily','',true); ?>
&datesearch=<?php echo $this->_tpl_vars['obj']->displayDbDate($this->_tpl_vars['data']['orderDate']); ?>
" class="Second_link" title="Click here to view daily wise details">
							<img height="20" width="20" border="0" src="images/inner_details.png"> 
							</a>
							<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; endif; unset($_from); ?>
					<tr>
						<td colspan="9"><?php echo $this->_tpl_vars['actionReturn']['spage']->s_get_links(); ?>
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

	<?php if ($this->_tpl_vars['obj']->currentAction == 'Transyearly'): ?>
	<tr>
	<td>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'dealOrderSearch.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
			<tr>
				<td align="center" valign="middle">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">							
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=o.orderDate&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Year
							<?php echo $this->_tpl_vars['obj']->getSortImage('o.orderDate',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=tot_orders&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Orders
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_orders',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=tot_deals&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Deals
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_deals',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
				
							</a></th>						
							
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=tot_total_amount&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Total Amount
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_total_amount',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 						
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=tot_customer_id&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Customers
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_customer_id',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 						
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=tot_paid&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Paid
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_paid',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>		
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=tot_quantity&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Coupons
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_quantity',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							 					
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=totredeemed&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Redeemed
							<?php echo $this->_tpl_vars['obj']->getSortImage('totredeemed',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>
							 					
							<th>Action </th>

						</tr>
						
					<?php $_from = $this->_tpl_vars['actionReturn']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
						<tr>
							<td><?php echo $this->_tpl_vars['data']['dealyear']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['tot_orders']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_deals']; ?>
</a></td>							
							<td>$<?php echo $this->_tpl_vars['data']['tot_total_amount']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_customer_id']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_paid']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_quantity']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['totredeemed']; ?>
</a></td>
							
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Gotransmonthly','',true); ?>
&datesearch=<?php echo $this->_tpl_vars['obj']->displayDbDate($this->_tpl_vars['data']['orderDate']); ?>
" class="Second_link" title="Click here to view monthly wise details">
							<img height="20" width="20" border="0" src="images/inner_details.png"> 
							</a>
							<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; endif; unset($_from); ?>
					<tr>
						<td colspan="9"><?php echo $this->_tpl_vars['actionReturn']['spage']->s_get_links(); ?>
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
<?php if ($this->_tpl_vars['obj']->currentAction == 'Transcomplete'): ?>
	<tr>
	<td>
		<table  width="100%"  cellpadding="0" cellspacing="0" border="0">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'dealOrderSearch.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
								<tbody>
									<tr>
										<td width="50%" height="100"valign="top">
											<div class="boxList"  >
												<div>
													<table width="674" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">		
														<th colspan="4" ><div align="center"><?php if ($this->_tpl_vars['actionReturn']['data']['0']['tot_orders'] == 0): ?>No Records Found<?php else: ?>Consolidated&nbsp; Report</div></th>
														<tr>
															<td width="125">Total Orders</td>
															<td width="238"><b><?php echo $this->_tpl_vars['actionReturn']['data']['0']['tot_orders']; ?>
</b></td>
															<td width="98">Total Paid</td>
															<td width="214"><b><?php echo $this->_tpl_vars['actionReturn']['data']['0']['tot_paid']; ?>
</b></td>
														</tr>
														<tr>															
															<td>Total Coupons(Qty)</td>
															<td><b><?php echo $this->_tpl_vars['actionReturn']['data']['0']['tot_quantity']; ?>
</b></td>
															<td>Total Redeemed</td>
															<td><b><?php echo $this->_tpl_vars['actionReturn']['data']['0']['totredeemed']; ?>
</b></td>
														</tr>
														<tr>
															<td>Total Sales Agents</td>
															<td><b><?php echo $this->_tpl_vars['actionReturn']['data']['0']['tot_salesagents']; ?>
</b></td>
															<td>Total Vendors</td>
															<td><b><?php echo $this->_tpl_vars['actionReturn']['data']['0']['tot_vendors']; ?>
</b></td>
														</tr>
														<tr>
															<td>Total Customers</td>
															<td><b><?php echo $this->_tpl_vars['actionReturn']['data']['0']['tot_customers']; ?>
</b></td>
															<td>Gift Orders</td>
															<td><b><?php echo $this->_tpl_vars['actionReturn']['data']['0']['tot_giftorder']; ?>
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
													<table width="674" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">		
														<th colspan="4" ><div align="center">Payment&nbsp; Details</div></th>
														<tr>
															<td width="125">Vendor Commission</td>
															<td width="238"><b>$<?php echo $this->_tpl_vars['actionReturn']['data']['0']['tot_vendor_commsn']; ?>
</b></td>
															<td>Site Commision</td>
															<td><b>$<?php echo $this->_tpl_vars['actionReturn']['data']['0']['tot_site_commsn']; ?>
</b></td>
														</tr>
														<tr>
															<td width="98">Sales Commission</td>
															<td width="214"><b>$<?php echo $this->_tpl_vars['actionReturn']['data']['0']['tot_sales_commsn']; ?>
</b></td>
															<td>Total Amount</td>
															<td><b>$<?php echo $this->_tpl_vars['actionReturn']['data']['0']['total_amount']; ?>
</b></td>
														</tr>
														<tr>
															<td>Total Site Credit</td>
															<td><b>$<?php echo $this->_tpl_vars['actionReturn']['data']['0']['tot_sitecredit']; ?>
</b></td>
															<td>Total Card Amount</td>
															<td><b>$<?php echo $this->_tpl_vars['actionReturn']['data']['0']['tot_cardamount']; ?>
</b></td>
														</tr>
														<?php endif; ?>
														<tr><td colspan="4"></td></tr>
												  </table>
										
												</div>
											</div>
									  </td>
									</tr>
								</tbody>
						</table>
	</td>
	</tr>
<?php endif; ?>

<?php if ($this->_tpl_vars['obj']->currentAction == 'Transcoupon'): ?>
	<tr>
	<td>
		<table  width="100%"  cellpadding="0" cellspacing="0" border="0">
								<tbody>
									<tr>
										<td width="50%" height="100"valign="middle">
											<div class="boxList"  >
					<div>
					<table width="817" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
					<tr><?php if ($this->_tpl_vars['actionReturn']['data']): ?>
					<th colspan="2"><div align="left">Coupon Code : &nbsp;<?php echo $this->_tpl_vars['actionReturn']['coupon_code']; ?>
</div></th>
					<th width="221"><div align="left">First Owner :&nbsp;<?php $this->assign('cuobj', $this->_tpl_vars['obj']->getCustomerPersonalDetails($this->_tpl_vars['actionReturn']['firstOwner'])); ?>
						<?php echo $this->_tpl_vars['cuobj']['fname']; ?>
 <?php echo $this->_tpl_vars['cuobj']['lname']; ?>
</div></th>
					<th width="282" colspan="2"><div align="left">Current Owner:&nbsp;<?php $this->assign('cuobj', $this->_tpl_vars['obj']->getCustomerPersonalDetails($this->_tpl_vars['actionReturn']['currentOwner'])); ?>
						<?php if ($this->_tpl_vars['cuobj']): ?><?php echo $this->_tpl_vars['cuobj']['fname']; ?>
 <?php echo $this->_tpl_vars['cuobj']['lname']; ?>
<?php else: ?>Not a Customer Yet<?php endif; ?></div></th>
					</tr>
					<tr>
					<td>#</td>
					<td><b>Sent From</b></td>
					<td><b>Sent To</b></td>
					<td><b>Sent To Email</b></td>
					<td><b>Sent Date</b></td>
					</tr>
					<?php $_from = $this->_tpl_vars['actionReturn']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
					<tr>
					<td><?php echo ($this->_foreach['i']['iteration']-1)+1; ?>
</td>
					<td><?php $this->assign('cuobj', $this->_tpl_vars['obj']->getCustomerPersonalDetails($this->_tpl_vars['data']['sent_from'])); ?>
						<?php echo $this->_tpl_vars['cuobj']['fname']; ?>
 <?php echo $this->_tpl_vars['cuobj']['lname']; ?>
</td>
					<td><?php $this->assign('cuobj', $this->_tpl_vars['obj']->getCustomerPersonalDetails($this->_tpl_vars['data']['sent_to'])); ?>
						<?php if ($this->_tpl_vars['cuobj']): ?><?php echo $this->_tpl_vars['cuobj']['fname']; ?>
 <?php echo $this->_tpl_vars['cuobj']['lname']; ?>
<?php else: ?>Not a Customer Yet<?php endif; ?></td>
					<td><?php echo $this->_tpl_vars['data']['sent_toemail']; ?>
</td>
					<td><?php echo $this->_tpl_vars['obj']->displayDate($this->_tpl_vars['data']['sent_date']); ?>
</td>
					</tr>
					<?php endforeach; endif; unset($_from); ?>
					<?php else: ?>	
					<td>No Record Found</td>
					</tr>
					<?php endif; ?>
					</table>
					</div>
										</div>
									  </td>
									</tr>
								</tbody>
						</table>
	</td>
	</tr>
<?php endif; ?>
	
	<?php if ($this->_tpl_vars['obj']->currentAction == 'Transview'): ?>
	<tr>
	<td>
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				<td width="50%" valign="top">
					<div class="boxList">
					<div>
					<table width="340"  border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">		
						<th colspan="2" ><div align="left">Order Details</div> </th>
						<tr>
							<td width="175">Order Id</td>
							<td><?php echo $this->_tpl_vars['actionReturn']['data']['id']; ?>
</td>
						</tr>
						<tr>
							<td>Ordered Date</td>
							<td><?php echo $this->_tpl_vars['obj']->displayTime($this->_tpl_vars['actionReturn']['data']['orderDate']); ?>
</td>
						</tr>
						<tr>
							<td>Ordered IP</td>
							<td><?php echo $this->_tpl_vars['actionReturn']['data']['ip']; ?>
</td>
						</tr>
						<tr>
							<td>Paid</td>
							<td>
								<?php if ($this->_tpl_vars['actionReturn']['data']['paid_status'] == @GLB_DEAL_PAID): ?>
									<img border="0" title="Paid" src="images/active.gif">
								<?php else: ?>
									<img border="0" title="Not Paid" src="images/inactive.gif">
								<?php endif; ?>
							</td>
						</tr>
						
						<?php if ($this->_tpl_vars['actionReturn']['data']['paid_status'] == @GLB_DEAL_PAID): ?>
						<tr>
							<td>Paid date</td>
							<td><?php echo $this->_tpl_vars['obj']->displayTime($this->_tpl_vars['actionReturn']['data']['paid_date']); ?>
</td>
						</tr>
						
						<tr>
							<td>Quantity</td>
							<td><?php echo $this->_tpl_vars['actionReturn']['data']['quantity']; ?>
</td>
						</tr>
						<tr>
							<td>Unit Price</td>
							<td>$<?php echo $this->_tpl_vars['actionReturn']['data']['unit_price']; ?>
</td>
						</tr>
						<?php if ($this->_tpl_vars['actionReturn']['data']['paid_sitecredit'] > 0): ?>
						<tr>
							<td>Site credit Amount</td>
							<td>$<?php echo $this->_tpl_vars['actionReturn']['data']['paid_sitecredit']; ?>
</td>
						</tr>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['data']['paid_cardamount'] > 0): ?>
						<tr>
							<td>Card Amount</td>
							<td>$<?php echo $this->_tpl_vars['actionReturn']['data']['paid_cardamount']; ?>
</td>
						</tr>
						<?php endif; ?>
						<?php endif; ?>
						<tr>
							<td>Total Amount</td>
							<td>$<?php echo $this->_tpl_vars['actionReturn']['data']['total_amount']; ?>
</td>
						</tr>
						<tr>
							<td>Admin unit commision</td>
							<td>$<?php echo $this->_tpl_vars['actionReturn']['data']['site_commision']; ?>
(<?php echo $this->_tpl_vars['actionReturn']['data']['site_commision']; ?>
%)</td>
						</tr>
								<td>Application Interface</td>
								<td><?php echo $this->_tpl_vars['actionReturn']['data']['apps']; ?>
</td>
						</tr>
						<tr>
							<td>Gift Order</td>
							<td>
								<?php if ($this->_tpl_vars['actionReturn']['data']['gift_order'] == @GLB_DEAL_TYPE_GIFT): ?>
									<img border="0" title="Gift Order" src="images/active.gif">
								<?php else: ?>
									<img border="0" title="Not a Gift Order" src="images/inactive.gif">
								<?php endif; ?>
							</td>
						</tr>

					</table>
		
				</div>
			
					<div>
					<table width="340" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">		
					<th colspan="2" ><div align="left">Billing details</div></th>
						<?php if ($this->_tpl_vars['actionReturn']['data']['billing_fname']): ?>
						<tr>
							<td width="175">Name</td>
							<td><?php echo $this->_tpl_vars['actionReturn']['data']['billing_fname']; ?>
 <?php echo $this->_tpl_vars['actionReturn']['data']['billing_lname']; ?>
</td>
						</tr>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['data']['billing_address']): ?>
						<tr>
							<td>Address</td>
							<td><?php echo $this->_tpl_vars['actionReturn']['data']['billing_address']; ?>
</td>
						</tr>	
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['data']['billing_city']): ?>					
						<tr>
							<td>City</td>
							<td><?php echo $this->_tpl_vars['actionReturn']['data']['billing_city']; ?>
</td>
						</tr>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['data']['country']): ?>
						<tr>
							<td>Country</td>
							<td><?php echo $this->_tpl_vars['actionReturn']['data']['country']; ?>
</td>
						</tr>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['data']['state']): ?>
						<tr>
							<td>State</td>
							<td><?php echo $this->_tpl_vars['actionReturn']['data']['state']; ?>
</td>
						</tr>
						<?php endif; ?>
						<?php if ($this->_tpl_vars['actionReturn']['data']['billing_zip']): ?>
						<tr>
							<td>Zip</td>
							<td><?php echo $this->_tpl_vars['actionReturn']['data']['billing_zip']; ?>
</td>
						</tr>
						<?php endif; ?>
					</table>
					
					</div>
					
					
					<div>
					<table width="340" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">		
					<th colspan="2" ><div align="left">Coupon details</div></th>
					<tr>
					<td width="175">Coupon Code</td>
					<td>
					<?php echo $this->_tpl_vars['actionReturn']['data']['coupon_code']; ?>

					</td>
					</tr>
					<tr>
					<td>Coupon Status</td>
					<td>
					<?php if ($this->_tpl_vars['actionReturn']['data']['coupon_status'] == @GLB_COUPON_INACTIVE): ?>
					Inactive					
					<?php elseif ($this->_tpl_vars['actionReturn']['data']['coupon_status'] == @GLB_COUPON_ACTIVE): ?>
					Active					
					<?php elseif ($this->_tpl_vars['actionReturn']['data']['coupon_status'] == @GLB_COUPON_EXPIRED): ?>
					Expired
					<?php endif; ?>
					</td>
					</tr>
					<tr>
					<td>Total Coupons </td>
					<td>				
					<?php echo $this->_tpl_vars['actionReturn']['data']['quantity']; ?>

					</td>
					</tr>
					<tr>
					<td>Total Redeemed </td>
					<td>				
					<?php echo $this->_tpl_vars['actionReturn']['data']['used_coupons']; ?>

					</td>
					</tr>
					<tr>
					<td>Total Not Redeemed </td>
					<td>				
					<?php echo $this->_tpl_vars['actionReturn']['data']['balance_coupons']; ?>

					</td>
					</tr>
					<tr>
					<td>Complete Redeemed </td>
					<td>
					<?php if ($this->_tpl_vars['actionReturn']['data']['redeem_status'] == @GLB_COUPON_REDEEMED): ?>
					<img border="0" title="Redeemed" src="images/active.gif">
					<?php else: ?>
					<img border="0" title="Not Redeemed" src="images/inactive.gif">
					<?php endif; ?>
					</td>
					</tr>
					<?php if ($this->_tpl_vars['actionReturn']['data']['redeem_status'] == @GLB_COUPON_REDEEMED): ?>
					<tr>
					<td>Redeemed Date</td>
					<td><?php echo $this->_tpl_vars['obj']->displayTime($this->_tpl_vars['actionReturn']['data']['redeem_date']); ?>
</td>
					</tr>
					<?php endif; ?>
					</table>
					</div>
					
					
					<?php if ($this->_tpl_vars['actionReturn']['data']['customer_id'] != $this->_tpl_vars['actionReturn']['data']['last_owner']): ?>
					<div>
						<table width="340" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">		
						<th colspan="2" ><div align="left">Coupon Sharing</div></th>
						<tr>
						<td width="175">Deal Purchased By</td>
						<td>
						<?php $this->assign('cuobj', $this->_tpl_vars['obj']->getCustomerPersonalDetails($this->_tpl_vars['actionReturn']['data']['customer_id'])); ?>
						<?php echo $this->_tpl_vars['cuobj']['fname']; ?>
 <?php echo $this->_tpl_vars['cuobj']['lname']; ?>

						</td>
						</tr>
						<tr>
						<td>Last Owner</td>
						<td>
						<?php $this->assign('cuobj', $this->_tpl_vars['obj']->getCustomerPersonalDetails($this->_tpl_vars['actionReturn']['data']['last_owner'])); ?>
						<?php echo $this->_tpl_vars['cuobj']['fname']; ?>
 <?php echo $this->_tpl_vars['cuobj']['lname']; ?>

						</td>
						</tr>
						<tr>
						<td>Current Owner</td>
						<td>
						<?php $this->assign('cuobj', $this->_tpl_vars['obj']->getCustomerPersonalDetails($this->_tpl_vars['actionReturn']['data']['current_owner'])); ?>
						<?php echo $this->_tpl_vars['cuobj']['fname']; ?>
 <?php echo $this->_tpl_vars['cuobj']['lname']; ?>

						</td>
						</tr>
						<tr>
						<td></td>
						<td><a class="view-more" target="_blank" href="<?php echo $this->_tpl_vars['obj']->getLink('Transcoupon','',true); ?>
">view more</a></td>
						</tr>
						</table>
						</div>
				<?php endif; ?>		
					</div>
					
					</td>	
					<td width="50%" valign="top">
						<div class="boxList" >
							<div>
									<table width="340" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
										<tr>
											<th colspan="2" ><div align="left">Deals Details</div></th>
										</tr>
										<tr>
											<td width="175">Deal Name</td>
											<td><?php echo $this->_tpl_vars['actionReturn']['data']['dealname']; ?>
</td>
										</tr>
										<tr>
											<td>Cost Value</td>
											<td>$<?php echo $this->_tpl_vars['actionReturn']['data']['cost']; ?>
</td>
										</tr>
										<tr>
											<td>Save Value</td>
											<td>$<?php echo smarty_function_math(array('equation' => "x-y",'x' => $this->_tpl_vars['actionReturn']['data']['cost'],'y' => $this->_tpl_vars['actionReturn']['data']['deal_price']), $this);?>
</td>
										</tr>
										<tr>
											<td>Deal Value</td>
											<td>$<?php echo $this->_tpl_vars['actionReturn']['data']['deal_price']; ?>
</td>
										</tr>
										<tr>
											<td>Offer Rate</td>
											<td>$<?php echo $this->_tpl_vars['actionReturn']['data']['offer_rate']; ?>
%</td>
										</tr>
										<tr>
											<td></td>
											<td>
											<a href="<?php echo $this->_tpl_vars['obj']->getLink('Viewdealdetails','dealOrderAll.php',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['data']['deal_id'])); ?>
" class="view-more" target="window_name" >view more</a>
                          					</td>
										</tr>
									</table>
							</div>
					
							<div>
								<table width="340" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">		
									<th colspan="2" ><div align="left">Vendor details</div></th>
									<tr>
										<td width="175">Vendor Id</td>
										<td><?php echo $this->_tpl_vars['actionReturn']['data']['vendor_id']; ?>
</td>
									</tr>
									<tr>
										<td>Vendor Name: </td>
										<td><?php echo $this->_tpl_vars['actionReturn']['data']['vendorname']; ?>
</td>
									</tr>
									<tr>
										<td>Deal Commision</td>
										<td><?php echo $this->_tpl_vars['actionReturn']['data']['vendor_commision']; ?>
(<?php echo $this->_tpl_vars['actionReturn']['data']['vendor_comm_rate']; ?>
%)</td>
									</tr>
									<tr>
										<td></td>
										<td align="right"><a target="_blank" class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Linktovendordetails','',true); ?>
&vendor_id=<?php echo $this->_tpl_vars['actionReturn']['data']['vendor_id']; ?>
">
										view more
										</a></td>
									</tr>
								</table>
					
							</div>
							
							<div>
								<table width="340" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">		
									<th colspan="2" ><div align="left">Customer details</div></th>
									<tr>
										<td width="175">Customer Id</td>
										<td><?php echo $this->_tpl_vars['actionReturn']['data']['customer_id']; ?>
</td>
									</tr>
									<tr>
										<td>Customer Name</td>
										<td><?php echo $this->_tpl_vars['actionReturn']['data']['customerfname']; ?>
 <?php echo $this->_tpl_vars['actionReturn']['data']['customerlname']; ?>
</td>
									</tr>
									<tr>
										<td>Customer Email</td>
										<td><?php echo $this->_tpl_vars['actionReturn']['data']['customeremail']; ?>
</td>
									</tr>
									<tr>
									<td></td>
									<td><a target="_blank" class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Linktocustomerdetails','',true); ?>
&customer_id=<?php echo $this->_tpl_vars['actionReturn']['data']['customer_id']; ?>
">view more</a></td>
									</tr>
								</table>
					
							</div>
							<?php if ($this->_tpl_vars['actionReturn']['data']['s_agent_fname'] != ""): ?>
							<div>
							<table width="340" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">		
								<th colspan="2" ><div align="left">Sales Agent Details</div></th>
								<tr>
									<td width="175">Sales Agent id</td>
									<td><?php echo $this->_tpl_vars['actionReturn']['data']['saleagent_id']; ?>
</td>
								</tr>
								<tr>
									<td>Sales Agent Name: </td>
									<td><?php echo $this->_tpl_vars['actionReturn']['data']['s_agent_fname']; ?>
<?php echo $this->_tpl_vars['actionReturn']['data']['s_agent_lname']; ?>
</td>
								</tr>
								<tr>
									<td>Deal Commision</td>
									<td>$<?php echo $this->_tpl_vars['actionReturn']['data']['sales_commision']; ?>
(<?php echo $this->_tpl_vars['actionReturn']['data']['sales_comm_rate']; ?>
%)</td>
								</tr>
								<tr>
									<td></td>
									<td><a target="_blank" class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Linktodealdetails','',true); ?>
&sales_agent=<?php echo $this->_tpl_vars['actionReturn']['data']['saleagent_id']; ?>
">view more</a></td>
								</tr>
							</table>
						</div>
							<?php endif; ?>
						</div>
					</td>
				</tr>
			</tbody>
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
