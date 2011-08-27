<?php /* Smarty version 2.6.19, created on 2011-01-31 19:10:12
         compiled from customerInvites.tpl.html */ ?>
<?php $this->assign('actionReturn', $this->_tpl_vars['obj']->actionReturn); ?>
<?php echo '
<script type="text/javascript">
function getcombo(cid,changeId)
	{
		$.ajax({
			   type	: "GET",
			   url	: "customers.php",
			   data	: "actionvar=Getcombo&id="+cid,
			   dataType: "html",
			   success: function(msg){
				   $("#"+changeId).html(msg);
				}
			 });
	}
$(document).ready(function() {
	$("#customerInviteDetails").tooltip();
	$("#txt_date_from").datepicker();
	$("#txt_date_from").datepicker(\'option\',
	{
		showAnim:\'show\',
		dateFormat:\'yy-mm-dd\',
		changeMonth: true,
		changeYear: true,
		//minDate: -20, 
		//maxDate: \'+1M +10D\',
		showOtherMonths: true, 
		selectOtherMonths: true,
		//yearRange:\'c-50:c+10\',
		autoSize:false
	});

	$("#txt_date_to").datepicker();
	$("#txt_date_to").datepicker(\'option\',
	{
		showAnim:\'show\',
		dateFormat:\'yy-mm-dd\',
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
function changeStyle()
{
document.getElementById(\'id_search_block\').style.display=\'block\';
}
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
	<td class="pageHead"><span id="customerInviteDetails"><strong>Customer Invites</strong></div></td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>
<tr class="listTableChangeColor">
	<td valign="middle">
        <?php if ($this->_tpl_vars['actionReturn']['searchdata']['cusId'] && $this->_tpl_vars['actionReturn']['headname']): ?>
        Viewing the Referal Details of &nbsp;<strong><?php echo $this->_tpl_vars['actionReturn']['headname']; ?>
</strong>&nbsp; having a Total of &nbsp;<strong><?php echo $this->_tpl_vars['actionReturn']['spage']->totcnt; ?>
</strong>&nbsp;Invited Through Email
        <?php endif; ?>
        <?php if (! $this->_tpl_vars['actionReturn']['searchdata']['cusId']): ?> Total Of &nbsp;<strong><?php echo $this->_tpl_vars['actionReturn']['spage']->totcnt; ?>
</strong>&nbsp;Invited Through Email<?php endif; ?>
    </td>
</tr>
<tr>
	<?php if ($this->_tpl_vars['obj']->currentAction == 'Listing'): ?>
	
<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>    
	<td>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td  align="right">&nbsp;</td>
			</tr>
			
			<tr>
				<td>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
							<td width="11%">Keyword</td>	
						  <td width="15%">
							<input type="text" name="keyword" maxlength="25" id="id_keyword" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['keyword']; ?>
" />
							</td>
                          <td width="3%">Cus.Id/Email</td>
                   		<td width="11%"> <input type="text" name="cusId" maxlength="25" id="id_cusId" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['cusId']; ?>
" /></td>
							<td width="13%">
							<input name="actionvar" type="submit" class="butsubmit" value="Search" />
							</td>
						  <td width="15%">
							<input name="actionvar" type="submit" class="butsubmit" value="Reset" />
							</td>
					  <td width="16%">
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('getcsv','',true); ?>
&csv=csv" title="Export to CSV" class="Second_link">
                                <img src="images/csv.png" border="0" alt="Export to CSV" width="25" height="25" />
                                </a></td>
					  <td width="16%">
								<a href="javascript:;" id="id_search_link">
									<img src="images/search.png" border="0" width="16" height="16" />	
                                </a></td>
					  </tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<div id="id_search_block" class="cls_search_block">
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
							<tr>
							<td>
							Date From
							&nbsp;
							<input type="text" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_date_from']; ?>
" name="txt_date_from" id="txt_date_from" readonly=""  class="dateTextBox" />
							</td>
							<td>
							Date To
							&nbsp;
							<input type="text" value="<?php echo $this->_tpl_vars['actionReturn']['searchdata']['txt_date_to']; ?>
" name="txt_date_to" id="txt_date_to" readonly="" class="dateTextBox" />
							</td>
							<td>
							Join Status
							&nbsp;
							<select name="sel_status">
                            	<option value="" <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_status'] == 0): ?> selected="selected" <?php endif; ?>>Select</option>
								<option value="1" <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_status'] == 1): ?> selected="selected" <?php endif; ?>>Active</option>
								<option value="2" <?php if ($this->_tpl_vars['actionReturn']['searchdata']['sel_status'] == 2): ?> selected="selected" <?php endif; ?>>Inactive</option>
							</select>
							</td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
			<tr>
				<td align="center" valign="middle">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">	
							<th>No</th>
                            <?php if (! $this->_tpl_vars['actionReturn']['searchdata']['cusId']): ?>
							<th width="70" colspan="2"><a href="<?php echo $this->_tpl_vars['obj']->getLink('search','','false'); ?>
&sortField=fullname&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">Customer Name<?php echo $this->_tpl_vars['obj']->getSortImage('fullname',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
</th>
                            <?php endif; ?>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('search','','false'); ?>
&sortField=invite_email&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">Invite Email<?php echo $this->_tpl_vars['obj']->getSortImage('invite_email',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
</th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('search','','false'); ?>
&sortField=join_status&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Join Status
							<?php echo $this->_tpl_vars['obj']->getSortImage('join_status',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('search','','false'); ?>
&sortField=date_added&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Invited Date
							<?php echo $this->_tpl_vars['obj']->getSortImage('date_added',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
				
							</a></th>
						</tr>
					<?php $_from = $this->_tpl_vars['actionReturn']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
						<tr>
							<td><?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow+($this->_foreach['i']['iteration']-1); ?>
</td>
                            <?php if (! $this->_tpl_vars['actionReturn']['searchdata']['cusId']): ?>
							<td colspan="2"><?php echo $this->_tpl_vars['data']['fullname']; ?>
</td>
                            <?php endif; ?>
							<td><?php echo $this->_tpl_vars['data']['invite_email']; ?>
</td>
							<td><?php if ($this->_tpl_vars['data']['join_status'] == 0): ?><img src="images/inactive.gif" border="0" title="Inactive User" alt="Inactive User"/><?php endif; ?><?php if ($this->_tpl_vars['data']['join_status'] == 1): ?><img src="images/active.gif" border="0" title="Active user" alt="Active user"/><?php endif; ?></td>
							<td><?php echo $this->_tpl_vars['obj']->displayDate($this->_tpl_vars['data']['date_added']); ?>
</td>
						</tr>
					<?php endforeach; endif; unset($_from); ?>
					<tr>
                    <?php if ($this->_tpl_vars['actionReturn']['searchdata']['cusId']): ?>
                    <th colspan="4"><?php echo $this->_tpl_vars['actionReturn']['spage']->s_get_links(); ?>
</th>
                    <?php endif; ?>
                    <?php if (! $this->_tpl_vars['actionReturn']['searchdata']['cusId']): ?>
                    <td colspan="6"><?php echo $this->_tpl_vars['actionReturn']['spage']->s_get_links(); ?>
</td>
                    <?php endif; ?>
					</tr>
				</table>
				</td>
			</tr>
		<?php endif; ?>
		</table>
	</td>
	<?php endif; ?>
	<?php endif; ?>
</tr>
</table>
</form>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
