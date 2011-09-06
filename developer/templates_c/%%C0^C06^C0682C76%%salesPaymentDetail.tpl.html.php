<?php /* Smarty version 2.6.19, created on 2011-01-22 00:53:04
         compiled from salesPaymentDetail.tpl.html */ ?>
<?php $this->assign('actionReturn', $this->_tpl_vars['obj']->actionReturn); ?>
<?php echo '
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
	<td class="pageHead"><strong>Sales Agent Payment Transaction Details - <?php echo $this->_tpl_vars['obj']->getdbsinglevalue_cond('vod_admin_users',$this->_tpl_vars['obj']->getConcat('concat(','fname',',\'  \',','lname',')'),$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['data'][0]['saleagent_id'])); ?>
</strong></td>
</tr>

<tr>
	<?php if ($this->_tpl_vars['obj']->currentAction == 'Listing'): ?>
	<td>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td  align="right">&nbsp;</td>
			</tr>
			
			<tr>
				<td>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
							<td><strong> <?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow; ?>
 - <?php echo $this->_tpl_vars['actionReturn']['spage']->endingRow; ?>
  </strong> of <strong><?php echo $this->_tpl_vars['actionReturn']['spage']->totcnt; ?>
 </strong></td>
							<td>From Date </td>
							<td>
									<input name="from_date" id="from_date" type="text" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['from_date']; ?>
" size="15"  />
							</td>
							<td>To Date </td>
							<td>
								<input name="to_date" id="to_date" type="text"  value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['to_date']; ?>
" size="15" />
							<td>							
							
							</td>
							<!--<td>
							<input type="text" name="keyword" maxlength="25" id="id_keyword" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['keyword']; ?>
" />
							</td>-->
							<td>
							<input name="actionvar" type="submit" class="butsubmit" value="Search" />
							</td>
							<td>
							<input name="actionvar" type="submit" class="butsubmit" value="Reset" />
							</td>
							<td>
							<input name="actionvar" type="submit" class="butsubmit" value="Back" />
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
			<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
			<tr>
				<td align="center" valign="middle">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">							
							<th>#</th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=name&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Deal
							<?php echo $this->_tpl_vars['obj']->getSortImage('name',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							<th>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=total&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Total Commission
							<?php echo $this->_tpl_vars['obj']->getSortImage('total',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a>	
							</th>
							<th>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=used&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Paid Commission
							<?php echo $this->_tpl_vars['obj']->getSortImage('used',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a>
							</th>
							<th>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=balance&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Balance to Pay
							<?php echo $this->_tpl_vars['obj']->getSortImage('balance',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a> 
							</th>
							<th>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=date_updated&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Updated Date
							<?php echo $this->_tpl_vars['obj']->getSortImage('date_updated',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a>
							</th>
						</tr>
					
					<?php $_from = $this->_tpl_vars['actionReturn']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
						<tr>	
							<td><?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow+($this->_foreach['i']['iteration']-1); ?>
</td>													
							<td><?php echo $this->_tpl_vars['data']['name']; ?>
</td>
							<td>$<?php echo $this->_tpl_vars['data']['total']; ?>
 </td>
							<td><a class="helpText" onmouseover="return escape('<?php echo $this->_tpl_vars['data']['payment']; ?>
')">$<?php echo $this->_tpl_vars['data']['used']; ?>
</a> </td>
							<td>$<?php echo $this->_tpl_vars['data']['balance']; ?>
</td>	
							<td><?php echo $this->_tpl_vars['obj']->displayTime($this->_tpl_vars['data']['date_updated']); ?>
</td>								
						</tr>
						<?php if ($this->_tpl_vars['data']['payment']): ?>
						<!--<tr>	
																		
							<td colspan="6">
							<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
							
							<tr align="center" valign="middle">
								<th>Paid Date</th>
								<th>Paid Amount</th>
								<th>Updated By</th>
							</tr>
							<?php $_from = $this->_tpl_vars['data']['payment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['j'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['j']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data1']):
        $this->_foreach['j']['iteration']++;
?>
							<tr align="center" valign="middle">
								<td><?php echo $this->_tpl_vars['data1']['payment_date']; ?>
</td>
								<td><?php echo $this->_tpl_vars['data1']['amount']; ?>
</td>
								<td><?php echo $this->_tpl_vars['data1']['updated_by']; ?>
</td>
							</tr>
							<?php endforeach; endif; unset($_from); ?>
							</table>
							</td>
							
						</tr>-->
						<?php endif; ?>
						
					<?php endforeach; endif; unset($_from); ?>
					<tr>
						<td colspan="6"><?php echo $this->_tpl_vars['actionReturn']['spage']->s_get_links(); ?>
</td>
					</tr>
				</table>
				</td>
			</tr>
		<?php endif; ?>
		<?php endif; ?>
		</table>
	</td>
	<?php endif; ?>
</tr>
</table>
</form>

<?php echo '
<script type="text/javascript" type="text/javascript">

$(document).ready(function() {
		var dates = $(\'#from_date, #to_date\').datepicker({
			showAnim:\'show\',
			defaultDate: "+1w",
			dateFormat:\'yy-mm-dd\',
			changeMonth: true,
			changeYear: true,
			numberOfMonths: 1,
			yearRange:\'c-50:c+1\',
			autoSize:false,
			onSelect: function(selectedDate) {
				var option = this.id == "from_date" ? "minDate" : "maxDate";
				var instance = $(this).data("datepicker");
				var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
				dates.not(this).datepicker("option", option, date);
			}
		});
	});
</script>
<script type="text/javascript" src="js/tooltip.js"></script>		
'; ?>

<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
