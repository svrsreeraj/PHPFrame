<?php /* Smarty version 2.6.19, created on 2011-01-31 18:03:35
         compiled from ecommReportAll.tpl.html */ ?>
<?php $this->assign('actionReturn', $this->_tpl_vars['obj']->actionReturn); ?>
<?php echo '
<script type="text/javascript">
function getproducts(cid,changeId)
	{
		$("#"+changeId).html("Loading...");
		$.ajax({
			   type	: "GET",
			   url	: "ecommReportAll.php",
			   data	: "actionvar=Getproductscombo&cid="+cid,
			   dataType: "html",
			   success: function(msg){
				   $("#"+changeId).html(msg);
				}
			 });
	}
function getStates(cid,selId,changeId)
	{
		$("#"+changeId).html("Loading...");
		$.ajax({
			   type	: "GET",
			   url	: "ecommReportAll.php",
			   data	: "actionvar=Getstatecombo&cid="+cid+"&sid="+selId,
			   dataType: "html",
			   success: function(msg){
				   $("#"+changeId).html(msg);
				}
			 });
	}
$(document).ready(function() {
	$("#EcomOrder").tooltip();
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
				<td align="left"  class="pageHead"><span id='EcomOrder'><strong>Ecommerce Orders <?php if ($this->_tpl_vars['obj']->currentAction == 'Transall'): ?> All<?php endif; ?><?php if ($this->_tpl_vars['obj']->currentAction == 'Transmonthly'): ?>Monthly <?php endif; ?> <?php if ($this->_tpl_vars['obj']->currentAction == 'Transdaily'): ?>Daily <?php endif; ?><?php if ($this->_tpl_vars['obj']->currentAction == 'Transyearly'): ?>Yearly <?php endif; ?><?php if ($this->_tpl_vars['obj']->currentAction == 'Transcomplete'): ?>Consolidated<?php endif; ?></strong></span></td>
				<td align="right" class="pageHead" style="text-align:right">
				<?php if ($this->_tpl_vars['obj']->currentAction == 'Transview' || $this->_tpl_vars['obj']->currentAction == 'Transcomplete'): ?>
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
$this->_smarty_include(array('smarty_include_tpl_file' => 'ecomReportSearch.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
			<tr>
				<td align="center" valign="middle">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">							
							<th width="70"><?php if ($this->_tpl_vars['obj']->permissionCheck('Status')): ?><input type="checkbox" name="checkall" id="id_check_all" ><?php endif; ?></th>
							<th>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Transallsearch','','false'); ?>
&sortField=eo.id&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Order Id
							<?php echo $this->_tpl_vars['obj']->getSortImage('eo.id',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a>
							</th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transallsearch','','false'); ?>
&sortField=eo.order_date&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Order Date
							<?php echo $this->_tpl_vars['obj']->getSortImage('eo.order_date',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transallsearch','','false'); ?>
&sortField=eo.paid_point&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Grand Total
							<?php echo $this->_tpl_vars['obj']->getSortImage('eo.paid_point',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transallsearch','','false'); ?>
&sortField=cu.fname&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Customer Name
							<?php echo $this->_tpl_vars['obj']->getSortImage('cu.fname',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transallsearch','','false'); ?>
&sortField=eo.paid_status&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Paid
							<?php echo $this->_tpl_vars['obj']->getSortImage('eo.paid_status',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transallsearch','','false'); ?>
&sortField=eo.deliver_status&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Delivered
							<?php echo $this->_tpl_vars['obj']->getSortImage('eo.deliver_status',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
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
							<td><?php if ($this->_tpl_vars['obj']->permissionCheck('Status')): ?><input type="checkbox" name="checkone[]" value="<?php echo $this->_tpl_vars['data']['id']; ?>
" id="id_chk_checkone" ><?php endif; ?></td>
							<td><?php echo $this->_tpl_vars['data']['id']; ?>
</td>
							<td><?php echo $this->_tpl_vars['obj']->displayDate($this->_tpl_vars['data']['order_date']); ?>
</td>
							<td><!--<a class="helpText" onmouseover="return escape('<?php echo $this->_tpl_vars['data']['amountPopUp']; ?>
')">--><?php echo $this->_tpl_vars['data']['paid_point']; ?>
<!--</a>--></td>
							<td><?php echo $this->_tpl_vars['data']['fullname']; ?>
</td>
							<td>
								<?php if ($this->_tpl_vars['data']['paid_status'] == @GLB_ECOM_PAID): ?>
									<img border="0" title="Paid" src="images/active.gif">
								<?php else: ?>
									<img border="0" title="Not Paid" src="images/inactive.gif">
								<?php endif; ?>
							</td>
							<td>
								<?php if ($this->_tpl_vars['data']['deliver_status'] == 1): ?>
									<img border="0" title="Delivered" src="images/active.gif">
								<?php else: ?>
									<a href="<?php echo $this->_tpl_vars['obj']->getLink('updatedelivery','',''); ?>
&id=<?php echo $this->_tpl_vars['data']['id']; ?>
"><img border="0" title="Not Delivered" src="images/inactive.gif"></a>
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
							<td colspan="6"><?php echo $this->_tpl_vars['actionReturn']['spage']->s_get_links(); ?>
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
$this->_smarty_include(array('smarty_include_tpl_file' => 'ecomReportSearch.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
			<tr>
				<td align="center" valign="middle">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=eo.order_date&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Order Date
							<?php echo $this->_tpl_vars['obj']->getSortImage('eo.order_date',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
                            
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=total_order&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Orders
							<?php echo $this->_tpl_vars['obj']->getSortImage('total_order',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
                            
 							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=tot_quantity&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Quantity
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_quantity',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=total_amount&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Grand Total
							<?php echo $this->_tpl_vars['obj']->getSortImage('total_amount',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=total_customers&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Customers
							<?php echo $this->_tpl_vars['obj']->getSortImage('total_customers',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=total_paid&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Paid
							<?php echo $this->_tpl_vars['obj']->getSortImage('total_paid',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>		
							 					
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=total_delivered&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Delivered
							<?php echo $this->_tpl_vars['obj']->getSortImage('total_delivered',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>
							<th>Action</th>
						</tr>
						
					<?php $_from = $this->_tpl_vars['actionReturn']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
						<tr>
							<td><?php echo $this->_tpl_vars['obj']->displayDate($this->_tpl_vars['data']['order_date']); ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['total_order']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['tot_quantity']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['total_amount']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['total_customers']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['total_paid']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['total_delivered']; ?>
</td>
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Gotransall','',true); ?>
&datesearch=<?php echo $this->_tpl_vars['obj']->displayDbDate($this->_tpl_vars['data']['order_date']); ?>
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
	<?php if ($this->_tpl_vars['obj']->currentAction == 'Transmonthly'): ?>
	<tr>
	<td>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'ecomReportSearch.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
			<tr>
				<td align="center" valign="middle">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">	
											
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=eo.order_date&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Order Date
							<?php echo $this->_tpl_vars['obj']->getSortImage('eo.order_date',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
                            
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=total_order&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Orders
							<?php echo $this->_tpl_vars['obj']->getSortImage('total_order',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
 							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=tot_quantity&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Quantity
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_quantity',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=total_amount&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Grand Total
							<?php echo $this->_tpl_vars['obj']->getSortImage('total_amount',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 						
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=total_customers&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Customers
							<?php echo $this->_tpl_vars['obj']->getSortImage('total_customers',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 						
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=total_paid&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Paid
							<?php echo $this->_tpl_vars['obj']->getSortImage('total_paid',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>		
							 					
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=total_delivered&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Delivered
							<?php echo $this->_tpl_vars['obj']->getSortImage('total_delivered',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>
							 					
							<th>Action </th>

						</tr>
						
					<?php $_from = $this->_tpl_vars['actionReturn']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
						<tr>
							<td><?php echo $this->_tpl_vars['data']['ecomyear']; ?>
 <?php echo $this->_tpl_vars['data']['ecommonth']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['total_order']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['tot_quantity']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['total_amount']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['total_customers']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['total_paid']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['total_delivered']; ?>
</td>
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Gotransdaily','',true); ?>
&datesearch=<?php echo $this->_tpl_vars['obj']->displayDbDate($this->_tpl_vars['data']['order_date']); ?>
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
	<?php if ($this->_tpl_vars['obj']->currentAction == 'Transyearly'): ?>
	<tr>
	<td>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'ecomReportSearch.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
			<tr>
				<td align="center" valign="middle">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">							
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=eo.order_date&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Year
							<?php echo $this->_tpl_vars['obj']->getSortImage('eo.order_date',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=total_order&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Orders
							<?php echo $this->_tpl_vars['obj']->getSortImage('total_order',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
                            
 							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=tot_quantity&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Quantity
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_quantity',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=total_amount&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Grand Total
							<?php echo $this->_tpl_vars['obj']->getSortImage('total_amount',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 						
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=total_customers&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Customers
							<?php echo $this->_tpl_vars['obj']->getSortImage('total_customers',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 						
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=total_paid&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Paid
							<?php echo $this->_tpl_vars['obj']->getSortImage('total_paid',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>		
							 					
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=total_delivered&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Delivered
							<?php echo $this->_tpl_vars['obj']->getSortImage('total_delivered',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>
							 					
							<th>Action </th>

						</tr>
						
					<?php $_from = $this->_tpl_vars['actionReturn']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
						<tr>
							<td><?php echo $this->_tpl_vars['data']['ecomyear']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['total_order']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['tot_quantity']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['total_amount']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['total_customers']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['total_paid']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['total_delivered']; ?>
</td>
							<td>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Gotransmonthly','',true); ?>
&datesearch=<?php echo $this->_tpl_vars['obj']->displayDbDate($this->_tpl_vars['data']['order_date']); ?>
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
	
<?php if ($this->_tpl_vars['obj']->currentAction == 'Transcomplete'): ?>
	<tr>
	<td>
		<table  width="100%"  cellpadding="0" cellspacing="0" border="0">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'ecomReportSearch.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
								<tbody>
									<tr>
										<td width="50%" height="100"valign="top">
											<div class="boxList">
												<div>
													<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">		
														<th colspan="4" ><div align="center"><?php if ($this->_tpl_vars['actionReturn']['data']['0']['count'] == 0): ?>No Records Found<?php else: ?>Consolidated&nbsp; Report</div></th>
														<tr>
															<td width="125">Total Order</td>
															<td width="238"><b><?php echo $this->_tpl_vars['actionReturn']['data']['0']['count']; ?>
</b></td>
															<td width="98">Total Paid</td>
															<td width="214"><b><?php echo $this->_tpl_vars['actionReturn']['data']['0']['paid']; ?>
</b></td>
														</tr>
														<tr>
															<td>Total Delivered</td>
															<td><b><?php echo $this->_tpl_vars['actionReturn']['data']['0']['delivered']; ?>
</b></td>
															<td>Total Quantity</td>
															<td><b><?php echo $this->_tpl_vars['actionReturn']['data']['0']['total_quantity']; ?>
</b></td>
														</tr>
														<tr>
															<td>Total Customers</td>
															<td><b><?php echo $this->_tpl_vars['actionReturn']['data']['0']['tot_customers']; ?>
</b></td>
															<td width="150"></td>
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
													<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">		
														<th colspan="2" ><div align="center">Payment&nbsp; Details</div></th>
														<tr>
															<td width="125">Total Points</td>
															<td width="238"><b><?php echo $this->_tpl_vars['actionReturn']['data']['0']['tot_amount']; ?>
</b></td>
														</tr>
														<tr><td colspan="2"></td></tr>
												  </table>
										
												</div>
											</div>
											<?php endif; ?>
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
		<table  width="100%"  cellpadding="0" cellspacing="0" border="0">
							<tr>&nbsp;</tr>	
								<tbody>
									<tr>
										<td width="50%"valign="top">
											<div class="boxList"  >
												<div>
													<table width="340"  border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp" valign="top">		
														<th colspan="2" ><div align="left">Ecom Order Details</div></th>
														<tr>
															<td width="175">Order id</td>
															<td><?php echo $this->_tpl_vars['actionReturn']['data']['id']; ?>
</td>
														</tr>
														<tr>
															<td>Ordered Date</td>
															<td><?php echo $this->_tpl_vars['obj']->displayDate($this->_tpl_vars['actionReturn']['data']['order_date']); ?>
</td>
														</tr>
														<tr>
															<td>Customer Name</td>
															<td><?php echo $this->_tpl_vars['actionReturn']['data']['fullname']; ?>
</td>
														</tr>
														<tr>
															<td>Ordered IP</td>
															<td><?php echo $this->_tpl_vars['actionReturn']['data']['ip']; ?>
</td>
														</tr>
														<tr>
															<td>Application</td>
															<td><?php echo $this->_tpl_vars['obj']->Getsearchname('apps',$this->_tpl_vars['actionReturn']['data']['apps_id']); ?>
</td>
														</tr>
														<?php if ($this->_tpl_vars['actionReturn']['data']['ship_addr1']): ?>
														<tr>
															<td>Shipping Address</td>
															<td><?php echo $this->_tpl_vars['obj']->nl2br($this->_tpl_vars['actionReturn']['data']['ship_addr1']); ?>
</td>
														</tr>
														<?php endif; ?>
														<?php if ($this->_tpl_vars['actionReturn']['data']['ship_addr2']): ?>
														<tr>
															<td>Shipping Address1</td>
															<td><?php echo $this->_tpl_vars['obj']->nl2br($this->_tpl_vars['actionReturn']['data']['ship_addr2']); ?>
</td>
														</tr>
														<?php endif; ?>
														<?php if ($this->_tpl_vars['actionReturn']['data']['ship_phone']): ?>
														<tr>
															<td>Ship Phone</td>
															<td><?php echo $this->_tpl_vars['actionReturn']['data']['ship_phone']; ?>
</td>
														</tr>
														<?php endif; ?>
														<tr>
															<td>Ship Country</td>
															<td><?php echo $this->_tpl_vars['obj']->Getsearchname('country',$this->_tpl_vars['actionReturn']['data']['ship_country']); ?>
</td>
														</tr>
														<tr>
															<td>Ship State</td>
															<td><?php echo $this->_tpl_vars['obj']->Getsearchname('state',$this->_tpl_vars['actionReturn']['data']['ship_state']); ?>
</td>
														</tr>
														<?php if ($this->_tpl_vars['actionReturn']['data']['ship_zip']): ?>
														<tr>
															<td>Ship Zip</td>
															<td><?php echo $this->_tpl_vars['actionReturn']['data']['ship_zip']; ?>
</td>
														</tr>
														<?php endif; ?>
														<tr>
														<td>Paid</td>
														<td>
														<?php if ($this->_tpl_vars['actionReturn']['data']['paid_status'] == '1'): ?>
									<img src="images/active.gif" border="0" title="paid" alt="Active user"  />
								<?php else: ?>
									<img src="images/inactive.gif" border="0" title="Not Paid" alt="Inactive User"  />
														<?php endif; ?>
														</td>
														</tr>
														<tr>
														<td>Delivered</td>
														<td>
														<?php if ($this->_tpl_vars['actionReturn']['data']['deliver_status'] == '1'): ?>
									<img src="images/active.gif" border="0" title="Delivered" alt="Active user"  />
								<?php else: ?>
									<img src="images/inactive.gif" border="0" title="Not Delivered" alt="Inactive User"  />
														<?php endif; ?>
														</td>
														</tr>
														<tr>
															<td>Delivered Date</td>
															<td><?php echo $this->_tpl_vars['obj']->displayDate($this->_tpl_vars['actionReturn']['data']['deliver_date']); ?>
</td>
														</tr>
													</table>
										
												</div>
												
										</div>
										</td>	
										<td width="50%" valign="top">
											<div class="boxList" >
												<div>
													<table width="400" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp" >		
														<th colspan="2" ><div align="left">Price Details </div></th>
														<tr>
															<td width="175">Total Points</td>
															<td><?php echo $this->_tpl_vars['actionReturn']['data']['paid_point']; ?>
</td>
														</tr>
														<tr>
															<td>Total Quantity </td>
															<td><?php echo $this->_tpl_vars['actionReturn']['data']['quantity']; ?>
</td>
														</tr>
													</table>
												</div>
												<div>
													<table width="400" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">		
														<th colspan="5" ><div align="left">Product Details </div></th>
														<tr>
															<td>Category</td>
															<td>Product</td>
															<td>Quantity</td>
															<td>Unit Points</td>
															<td>Total Points</td>
														</tr>
														<?php $_from = $this->_tpl_vars['actionReturn']['prod']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
														<tr>
															<td><?php echo $this->_tpl_vars['data']['category']; ?>
</td>
															<td><?php echo $this->_tpl_vars['data']['product']; ?>
</td>
															<td><?php echo $this->_tpl_vars['data']['quanity']; ?>
</td>
															<td><?php echo $this->_tpl_vars['data']['unit_price']; ?>
</td>
															<td><?php echo $this->_tpl_vars['data']['prod_price']; ?>
</td>
														</tr>
														<?php endforeach; endif; unset($_from); ?>
													</table>
												</div>	
												<div>
													<table width="400" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">		
														<th colspan="2" ><div align="left">Customer Details</div></th>
														<tr>
															<td width="175">Customer Name</td>
															<td><?php echo $this->_tpl_vars['actionReturn']['data']['fullname']; ?>
</td>
														</tr>
														<tr>
															<td>Email </td>
															<td><?php echo $this->_tpl_vars['actionReturn']['data']['email']; ?>
</td>
														</tr>
														<tr>
															<td>Application</td>
															<td><?php echo $this->_tpl_vars['obj']->Getsearchname('apps',$this->_tpl_vars['actionReturn']['data']['customer_appid']); ?>
</td>
														</tr>
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

</table>
<?php echo '
<script type="text/javascript" src="js/tooltip.js"></script>		
'; ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
