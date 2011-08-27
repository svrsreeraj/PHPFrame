<?php /* Smarty version 2.6.19, created on 2011-01-31 18:07:29
         compiled from commisionReportAll.tpl.html */ ?>
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
	$("#CommisionReport").tooltip();
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
				<td align="left"  class="pageHead"><span id="CommisionReport"><strong><?php if ($this->_tpl_vars['obj']->currentAction == 'Transcomplete'): ?>Consolidated <?php endif; ?>Commision Report <?php if ($this->_tpl_vars['obj']->currentAction == 'Transall'): ?>All<?php endif; ?><?php if ($this->_tpl_vars['obj']->currentAction == 'Transdaily'): ?>Daily<?php endif; ?><?php if ($this->_tpl_vars['obj']->currentAction == 'Transmonthly'): ?>Monthly<?php endif; ?><?php if ($this->_tpl_vars['obj']->currentAction == 'Transyearly'): ?>Yearly<?php endif; ?> </strong></span></td>
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
$this->_smarty_include(array('smarty_include_tpl_file' => 'commisionReportSearch.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
				<tr>
					<td align="center" valign="middle">
						<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
							<tr align="center" valign="middle">							
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
&sortField=o.quantity&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Quantity
								<?php echo $this->_tpl_vars['obj']->getSortImage('o.quantity',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a></th>
								<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transallsearch','','false'); ?>
&sortField=d.name&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Deal Name
								<?php echo $this->_tpl_vars['obj']->getSortImage('d.name',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
				
								</a></th>
								<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transallsearch','','false'); ?>
&sortField=cu.fname&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Customer Name
								<?php echo $this->_tpl_vars['obj']->getSortImage('cu.fname',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
								 </a></th>
								<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transallsearch','','false'); ?>
&sortField=vc.vendor_commision&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Vendor Commision
								<?php echo $this->_tpl_vars['obj']->getSortImage('vc.vendor_commision',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a></th>
								<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transallsearch','','false'); ?>
&sortField=vc.site_commision&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Site Commision
								<?php echo $this->_tpl_vars['obj']->getSortImage('vc.site_commision',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
								 </a></th>							
								<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transallsearch','','false'); ?>
&sortField=vc.sales_commision&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Sales Commision
								<?php echo $this->_tpl_vars['obj']->getSortImage('vc.sales_commision',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
								 </a></th>							
							</tr>
							
						<?php $_from = $this->_tpl_vars['actionReturn']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
							<tr>
								<td><?php echo $this->_tpl_vars['data']['order_id']; ?>
</td>
								<td><?php echo $this->_tpl_vars['obj']->displayDate($this->_tpl_vars['data']['orderDate']); ?>
</td>
								<td><?php echo $this->_tpl_vars['data']['quantity']; ?>
</td>
								<td><a class="helpText" onmouseover="return escape('<?php echo $this->_tpl_vars['data']['dealPopUp']; ?>
')"><?php echo $this->_tpl_vars['data']['dealname']; ?>
</a></td>
								<td><?php echo $this->_tpl_vars['data']['customerfname']; ?>
 <?php echo $this->_tpl_vars['data']['customerlname']; ?>
</td>
								<td><?php echo $this->_tpl_vars['data']['vendor_commision']; ?>
</td>
								<td><?php echo $this->_tpl_vars['data']['site_commision']; ?>
</td>
								<td><?php echo $this->_tpl_vars['data']['sales_commision']; ?>
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
	
	<?php if ($this->_tpl_vars['obj']->currentAction == 'Transdaily'): ?>
	<tr>
	<td>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'commisionReportSearch.tpl', 'smarty_include_vars' => array()));
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
&sortField=tot_quantity&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Quantity
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_quantity',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
				
							</a></th>
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=tot_deals&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Deals
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_deals',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
				
							</a></th>
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=tot_customers&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Customers
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_customers',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=tot_commsn_vendor&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Vendor Commision
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_commsn_vendor',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 						
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=tot_commsn_site&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Site Commision
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_commsn_site',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 						
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transdailysearch','','false'); ?>
&sortField=tot_commsn_sales&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Sales commision
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_commsn_sales',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
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
							<td><?php echo $this->_tpl_vars['data']['tot_quantity']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['tot_deals']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_customers']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_commsn_vendor']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_commsn_site']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_commsn_sales']; ?>
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
$this->_smarty_include(array('smarty_include_tpl_file' => 'commisionReportSearch.tpl', 'smarty_include_vars' => array()));
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
&sortField=tot_quantity&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Quantity
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_quantity',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=tot_deals&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Deals
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_deals',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
				
							</a></th>
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=tot_customers&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Customers
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_customers',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=tot_commsn_vendor&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Vendor Commision
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_commsn_vendor',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 						
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=tot_commsn_site&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Site Commision
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_commsn_site',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 						
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transmonthlysearch','','false'); ?>
&sortField=tot_commsn_sales&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Sales Commision
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_commsn_sales',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
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
							<td><?php echo $this->_tpl_vars['data']['tot_quantity']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_deals']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_customers']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_commsn_vendor']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_commsn_site']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_commsn_sales']; ?>
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
$this->_smarty_include(array('smarty_include_tpl_file' => 'commisionReportSearch.tpl', 'smarty_include_vars' => array()));
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
&sortField=tot_quantity&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Quantity
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_quantity',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=tot_deals&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Deals
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_deals',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
				
							</a></th>
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=tot_customers&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Customers
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_customers',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=tot_commsn_vendor&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Vendor commision
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_commsn_vendor',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 						
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=tot_commsn_site&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Site Commision
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_commsn_site',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							 						
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Transyearlysearch','','false'); ?>
&sortField=tot_commsn_sales&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							#Sales Commision
							<?php echo $this->_tpl_vars['obj']->getSortImage('tot_commsn_sales',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
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
							<td><?php echo $this->_tpl_vars['data']['tot_quantity']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_deals']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_customers']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_commsn_vendor']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_commsn_site']; ?>
</a></td>
							<td><?php echo $this->_tpl_vars['data']['tot_commsn_sales']; ?>
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
$this->_smarty_include(array('smarty_include_tpl_file' => 'commisionReportSearch.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
								<tbody>
									<tr>
										<td width="50%" height="100"valign="top">
											<div class="boxList"  >
												<div>
													<table width="674" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">		
														<th colspan="4" ><div align="center"><?php if ($this->_tpl_vars['actionReturn']['data']['0']['tot_order'] == 0): ?>No Records Found<?php else: ?>Consolidated&nbsp; Report</div></th>
														<tr>
															<td width="150">Total Order</td>
															<td width="238"><b><?php echo $this->_tpl_vars['actionReturn']['data']['0']['tot_order']; ?>
</b></td>
															<td width="98">Total Deals</td>
															<td width="214"><b><?php echo $this->_tpl_vars['actionReturn']['data']['0']['tot_deals']; ?>
</b></td>
														</tr>
														<tr>
															<td>Total Redeemed</td>
															<td><b><?php echo $this->_tpl_vars['actionReturn']['data']['0']['tot_redeemed']; ?>
</b></td>
															<td>Total Quantity</td>
															<td><b><?php echo $this->_tpl_vars['actionReturn']['data']['0']['tot_quantity']; ?>
</b></td>
														</tr>
														<tr>
															<td width="175">Total Vendor commision</td>
															<td><b>$<?php echo $this->_tpl_vars['actionReturn']['data']['0']['tot_vendor_commsn']; ?>
</b></td>
															<td width="150">Total Site Commision</td>
															<td><b>$<?php echo $this->_tpl_vars['actionReturn']['data']['0']['tot_site_commsn']; ?>
</b></td>
														</tr>
														<tr>
															<td>Total Sales Commision</td>
															<td><b>$<?php echo $this->_tpl_vars['actionReturn']['data']['0']['tot_sales_commsn']; ?>
</b></td>
															<td></td>
															<td><a class="view-more" title="Click here to view yearly report" target="_blank" href="<?php echo $this->_tpl_vars['obj']->getLink('Gotoyearlyreport','',true); ?>
">
															view more
                            								</a></td>
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
</table>
<?php echo '
<script type="text/javascript" src="js/tooltip.js"></script>		
'; ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
