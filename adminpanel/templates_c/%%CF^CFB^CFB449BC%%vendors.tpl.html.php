<?php /* Smarty version 2.6.19, created on 2011-03-02 15:29:50
         compiled from vendors.tpl.html */ ?>
<?php $this->assign('actionReturn', $this->_tpl_vars['obj']->actionReturn); ?>
<?php echo '
<script type="text/javascript">

function getStates(cid,changeId)
	{
		$("#"+changeId).html("Loading...");
		$.ajax({
			   type	: "GET",
			   url	: "vendors.php",
			   data	: "actionvar=Getstatecombo&cid="+cid,
			   dataType: "html",
			   success: function(msg){
				   $("#"+changeId).html(msg);
				}
			 });
	}
function getcombo(cid,changeId)
	{
		$.ajax({
			   type	: "GET",
			   url	: "vendors.php",
			   data	: "actionvar=Getcombo&id="+cid,
			   dataType: "html",
			   success: function(msg){
				   $("#"+changeId).html(msg);
				}
			 });
	}
$(document).ready(function() {
	$("#vendor").tooltip();
	$("#runningdeal").tooltip();
	$("#rejecteddeal").tooltip();
	$("#cooldown").tooltip();
	$("#unlocked").tooltip();
	$("#lockeddeal").tooltip();
	$("#queueddeal").tooltip();
	$("#Expired").tooltip();
	$("#totalcomm").tooltip();
	$("#balancecomm").tooltip();
	$("#totalEarned").tooltip();
	
	$("#txt_join_from").datepicker();
	$("#txt_join_from").datepicker(\'option\',
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

$("#txt_join_to").datepicker();
	$("#txt_join_to").datepicker(\'option\',
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
</script>

<link type="text/css" href="js/ui/themes/base/jquery.ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="js/ui/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/ui/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="js/ui/ui/jquery.ui.datepicker.js"></script>

'; ?>



<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">
<?php if ($this->_tpl_vars['obj']->getPageError()): ?>
<tr>
	<td class="errorMessage"><?php echo $this->_tpl_vars['obj']->popPageError(); ?>
</td>
</tr>
<?php endif; ?>
<tr>
	<td class="pageHead"><span id="vendor"><strong>Vendor <?php if (( $this->_tpl_vars['obj']->currentAction == 'Listing' )): ?>Listing<?php endif; ?> <?php if (( $this->_tpl_vars['obj']->currentAction == 'Editform' )): ?>Edit : <?php echo $this->_tpl_vars['actionReturn']['data']['business_name']; ?>
  <?php endif; ?> </strong>
</span></td></tr>
<?php if (( $this->_tpl_vars['obj']->currentAction == 'Editform' )): ?>
<?php if ($this->_tpl_vars['obj']->permissionCheck('Edit')): ?>                                                     
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
	<form action="" name="fromName" method="post" enctype="multipart/form-data">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				
			</tr>
			<tr>
				<td width="150">Sales Agent</td>
				<td><?php echo $this->_tpl_vars['actionReturn']['combo']; ?>
</td>
			</tr>
			<tr>
				<td>Business Name </td>
				<td><input type="text" valtype="emptyCheck-Please enter your bussiness name" name="business_name" value="<?php echo $this->_tpl_vars['actionReturn']['data']['business_name']; ?>
" id="business_nameId"  />
				</td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="text" valtype="emptyCheck-Please enter your Email|emailCheck-Please enter a valid Email" name="email" value="<?php echo $this->_tpl_vars['actionReturn']['data']['email']; ?>
" id="emailId" class="emailValidate" /></td>
			</tr>
			<tr>
				<td>Contact Person </td>
				<td><input type="text"  name="contact_person" valtype="emptyCheck-Please enter the contact person" value="<?php echo $this->_tpl_vars['actionReturn']['data']['contact_person']; ?>
" id="contact_personId" class="alphaNumeric" /></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password"  name="password" valtype="emptyCheck-Please enter a password" value="<?php echo $this->_tpl_vars['actionReturn']['data']['password']; ?>
" id="passwordId" /></td>
			</tr>
		
			<tr>
				<td>Address</td>
				<td><textarea  name="address" id="addressId" valtype="emptyCheck-Please enter an Address " class="validateText"><?php echo $this->_tpl_vars['actionReturn']['data']['address']; ?>
 </textarea></td>
			</tr>
		
			<tr>
				<td>Country</td>
				<td><?php echo $this->_tpl_vars['actionReturn']['country_combo']; ?>
</td>
			</tr>
	
			<tr>
				<td>State</td>
				<td><div id="stateDivId"><?php echo $this->_tpl_vars['actionReturn']['country_state']; ?>
</div></td>
			</tr>	
			
			<tr>
				<td>Zip</td>
				<td><input type="text" valtype="emptyCheck-Please enter your zipcode"  name="zip" value="<?php echo $this->_tpl_vars['actionReturn']['data']['zip']; ?>
" id="zipId" class="validatezip" maxlength="7" /></td>
			</tr>
		
			<tr>
				<td>Mobile</td>
				<td><input type="text"  name="mobile" valtype="emptyCheck-Please enter the phone number|checkNumber-please enter a valid phone number" value="<?php echo $this->_tpl_vars['actionReturn']['data']['mobile']; ?>
" id="mobileId" class="nummberOnly"  maxlength="15"/></td>
			</tr>
		
			<tr>
				<td>Latitude</td>
				<td><input type="text"  name="latitude" value="<?php echo $this->_tpl_vars['actionReturn']['data']['latitude']; ?>
" id="latitudeId" /></td>
			</tr>
	
			<tr>
				<td>Longitude</td>
				<td><input type="text"  name="longitude" value="<?php echo $this->_tpl_vars['actionReturn']['data']['longitude']; ?>
" id="longitudeId"  /></td>
			</tr>
			
			<tr>
				<td>Website</td>
				<td><input type="text"  name="website" value="<?php echo $this->_tpl_vars['actionReturn']['data']['website']; ?>
" id="websiteId"  /></td>
			</tr>
		
		
			<!--<tr>
				<td>Tax</td>
				<td><input type="text" valtype="emptyCheck-Please enter the tax percentage" name="tax" value="<?php echo $this->_tpl_vars['actionReturn']['data']['tax']; ?>
" id="taxId" class="nummberOnly" maxlength="3"  /></td>
			</tr>-->
			<tr>
				<td>Products</td>
				<td><?php echo $this->_tpl_vars['actionReturn']['combo_products']; ?>
</td>
			</tr>
			<tr>
				<td>Industries</td>
				<td><?php echo $this->_tpl_vars['actionReturn']['combo_industries']; ?>
</td>
			</tr>
	
			<tr>
				<td>Email Update</td>
				<td>
				<input type="checkbox"  name="email_update"  id="email_updateId" value="1"  
				<?php if ($this->_tpl_vars['actionReturn']['data']['email_update'] == '1'): ?>  checked="checked" <?php endif; ?>/>
				</td>
			</tr>
	
			<tr>
				<td>SMS Update</td>
				<td><input type="checkbox"  name="sms_update"  id="sms_updateId" value="1" 
				<?php if ($this->_tpl_vars['actionReturn']['data']['sms_update'] == '1'): ?> checked="checked"  <?php endif; ?>/> </td>
			</tr>
				<td>&nbsp;</td>
				<td>
				<?php if ($this->_tpl_vars['obj']->currentAction == 'Editform'): ?>
					<?php if ($this->_tpl_vars['obj']->permissionCheck('Edit')): ?>
					<input type="submit" class="butsubmit" valcheck="true" name="actionvar" value="Update" id="saveDataId" />
					<?php endif; ?>
				<?php else: ?>
					<?php if ($this->_tpl_vars['obj']->permissionCheck('Add')): ?>
					<input type="submit" class="butsubmit" valcheck="true" name="actionvar" value="Save" id="saveDataId" />
					<?php endif; ?>
				<?php endif; ?>
					<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
				</td>
			</tr>
		</table>
			</form>
	</td>
</tr>
<?php endif; ?>	
<?php endif; ?>


<?php if (( $this->_tpl_vars['obj']->currentAction == 'Viewform' )): ?>
<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>                                                     
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
		<form action="" name="fromName" method="post" enctype="multipart/form-data" >
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
				<tbody>
					<tr>
						<td width="50%">
							<div class="boxList" >
								<table width="340" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
									<tr>
										<th colspan="3">Vendor Personal Profile</th>
									</tr>
								
								<?php if ($this->_tpl_vars['actionReturn']['data']['business_name']): ?>
									<tr>
										<td>Busines Name </td>
										<td><?php echo $this->_tpl_vars['actionReturn']['data']['business_name']; ?>
</td>
									</tr>
								<?php endif; ?>
								<?php if ($this->_tpl_vars['actionReturn']['data']['salesagent'] <> 0): ?>
									<tr><td>Sales Agent</td>
										<td><?php echo $this->_tpl_vars['actionReturn']['salesagent']['salesagent']; ?>
</td>
									</tr>
								<?php endif; ?>
								<?php if ($this->_tpl_vars['actionReturn']['data']['email']): ?>
									<tr>
									<td>Email</td>
									<td><?php echo $this->_tpl_vars['actionReturn']['data']['email']; ?>
</td>
									</tr>
								<?php endif; ?>
								<?php if ($this->_tpl_vars['actionReturn']['data']['contact_person']): ?>
									<tr>
										<td>Contact Person </td>
										<td><?php echo $this->_tpl_vars['actionReturn']['data']['contact_person']; ?>
</td>
									</tr>
								<?php endif; ?>
								<?php if ($this->_tpl_vars['actionReturn']['data']['password']): ?>
								<tr>
									<td>Password</td>
									<td><?php echo $this->_tpl_vars['actionReturn']['data']['password']; ?>
</td>
								</tr>
								<?php endif; ?>
								<?php if ($this->_tpl_vars['actionReturn']['data']['address']): ?>
								<tr>
									<td>Address</td>
									<td><?php echo $this->_tpl_vars['obj']->nl2br($this->_tpl_vars['actionReturn']['data']['address']); ?>
</td>
								</tr>
								<?php endif; ?>
									<?php if ($this->_tpl_vars['actionReturn']['country_combo']): ?>
								<tr>
									<td>Country</td>
									<td><?php echo $this->_tpl_vars['actionReturn']['country_combo']; ?>
</td>
								</tr>
								<?php endif; ?>
								<?php if ($this->_tpl_vars['actionReturn']['country_state']): ?>
								<tr>
									<td>State</td>
									<td><?php echo $this->_tpl_vars['actionReturn']['country_state']; ?>
</td>
								</tr>	
								<?php endif; ?>
								<?php if ($this->_tpl_vars['actionReturn']['data']['zip']): ?>
								<tr>
									<td>Zip</td>
									<td><?php echo $this->_tpl_vars['actionReturn']['data']['zip']; ?>
</td>
								</tr>
								<?php endif; ?>
								<?php if ($this->_tpl_vars['actionReturn']['data']['mobile']): ?>
								<tr>
									<td>Mobile</td>
									<td><?php echo $this->_tpl_vars['obj']->getUSPhoneDisplay($this->_tpl_vars['actionReturn']['data']['mobile']); ?>
</td>
								</tr>
								<tr>
									<td>Date Added</td>
									<td><?php echo $this->_tpl_vars['obj']->displayDate($this->_tpl_vars['actionReturn']['data']['date_added']); ?>
</td>
									
								</tr>
								<?php endif; ?>
								<?php if ($this->_tpl_vars['actionReturn']['data']['latitude']): ?>
								<tr>
									<td>Latitude</td>
									<td><?php echo $this->_tpl_vars['actionReturn']['data']['latitude']; ?>
</td>
								</tr>
								<?php endif; ?>
								<?php if ($this->_tpl_vars['actionReturn']['data']['longitude']): ?>
								<tr>
									<td>Longitude</td>
									<td><?php echo $this->_tpl_vars['actionReturn']['data']['longitude']; ?>
</td>
								</tr>
								<?php endif; ?>
								<?php if ($this->_tpl_vars['actionReturn']['data']['website']): ?>
								<tr>
									<td>Website</td>
									<td><?php echo $this->_tpl_vars['actionReturn']['data']['website']; ?>
</td>
								</tr>
								<?php endif; ?>
								<?php if ($this->_tpl_vars['actionReturn']['data']['twitter_link']): ?>
								<tr>
									<td>Twitter Link</td>
									<td><?php echo $this->_tpl_vars['actionReturn']['data']['twitter_link']; ?>
</td>
								</tr>
								<?php endif; ?>
								<?php if ($this->_tpl_vars['actionReturn']['data']['fb_link']): ?>
								<tr>
									<td>Facebook Fan Page Link</td>
									<td><?php echo $this->_tpl_vars['actionReturn']['data']['fb_link']; ?>
</td>
								</tr>
								<?php endif; ?>
								<?php if ($this->_tpl_vars['actionReturn']['data']['tax']): ?>
								<tr>
									<td>Tax</td>
									<td><?php echo $this->_tpl_vars['actionReturn']['data']['tax']; ?>
</td>
								</tr>
								<?php endif; ?>
								<tr>
									<td>Email Update</td>
									<td><?php if ($this->_tpl_vars['actionReturn']['data']['email_update'] == 1): ?>Yes<?php else: ?> No  <?php endif; ?></td>
								</tr>
								<tr>
									<td>SMS Update</td>
									<td><?php if ($this->_tpl_vars['actionReturn']['data']['sms_update'] == 1): ?>Yes  <?php else: ?> No <?php endif; ?> </td>
								</tr>
								
								<?php if ($this->_tpl_vars['actionReturn']['combo_products']): ?>
								<tr>
									<td>Intrested products</td>
									<td><?php echo $this->_tpl_vars['actionReturn']['combo_products']; ?>
</td>
								</tr>
								<?php endif; ?>
								<?php if ($this->_tpl_vars['actionReturn']['combo_industries']): ?>
								<tr>
									<td>Intrested Industries</td>
									<td><?php echo $this->_tpl_vars['actionReturn']['combo_industries']; ?>
</td>
								</tr>
								<?php endif; ?>
								</table>
							
							
							</div>
						</td>
						<td width="50%">
							<div class="boxList" >
										<table width="340" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">		
											<?php if ($this->_tpl_vars['actionReturn']['deal_details']): ?>
											<tr>
												<th colspan="3">Deals</th>
											</tr>
											<?php $_from = $this->_tpl_vars['actionReturn']['deal_details']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
												<?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data2']):
        $this->_foreach['i']['iteration']++;
?>
													<?php endforeach; endif; unset($_from); ?>
												<tr>
													<td><span id="runningdeal">Running Deals</span></td>
													<td><?php echo $this->_tpl_vars['data']['running']; ?>
</td>
													<td>
													<?php if ($this->_tpl_vars['data']['running'] > 0): ?>
													<a class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Viewrunningdeal','vendors.php',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['data']['id'])); ?>
" target="window_name">View More</a>
													<?php endif; ?>
													</td>
												</tr>
												<tr>
													<td><span id="rejecteddeal">Rejected Deals</span></td>
													<td><?php echo $this->_tpl_vars['data']['rejected']; ?>
</td>
													<td>
													<?php if ($this->_tpl_vars['data']['rejected'] > 0): ?>
													<a class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('ViewRejecteddeal','vendors.php',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['data']['id'])); ?>
" target="window_name">View More</a>
													<?php endif; ?>
													</td>
												</tr>
												<tr>
													<td><span id="queueddeal">Queued Deals</span></td>
													<td><?php echo $this->_tpl_vars['data']['queued']; ?>
</td>
													<td>
													<?php if ($this->_tpl_vars['data']['queued'] > 0): ?>
													<a class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Viewqueueddeal','vendors.php',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['data']['id'])); ?>
" target="window_name">View More</a>
													<?php endif; ?>
													</td>
												</tr>
												<tr>
													<td><span id="cooldown">Cooldown Deals</span></td>
													<td><?php echo $this->_tpl_vars['data']['cooldown']; ?>
</td>
													<td>
													<?php if ($this->_tpl_vars['data']['cooldown'] > 0): ?>
													<a class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Viewcooldowndeal','vendors.php',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['data']['id'])); ?>
"target="window_name">View More</a>
													<?php endif; ?>
													</td>
												</tr>
												<tr>
													<td><span id="lockeddeal">Locked Deals</span></td>
													<td><?php echo $this->_tpl_vars['data']['locked']; ?>
</td>
													<td>
													<?php if ($this->_tpl_vars['data']['locked'] > 0): ?>
													<a  class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Viewlockeddeal','vendors.php',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['data']['id'])); ?>
" target="window_name">View More</a>
													<?php endif; ?>
													</td>
												</tr>
												<tr>
													<td><span id="unlocked">Unlocked Deals</span></td>
													<td><?php echo $this->_tpl_vars['data']['unlocked']; ?>
</td>
													<td>
													<?php if ($this->_tpl_vars['data']['unlocked'] > 0): ?>
													<a class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('ViewUnlockeddeal','vendors.php',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['data']['id'])); ?>
" target="window_name">View More</a>
													<?php endif; ?>
													</td>
												</tr>
												<tr>
													<td><span id="Expired">Expired Deals</span></td>
													<td><?php echo $this->_tpl_vars['data']['expired']; ?>
</td>
													<td>
													<?php if ($this->_tpl_vars['data']['expired'] > 0): ?>
													<a  class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Viewexpireddeal','vendors.php',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['data']['id'])); ?>
" target="window_name">View More</a>
													<?php endif; ?>
													</td>
												</tr>
											<?php endforeach; endif; unset($_from); ?>
										<?php endif; ?>
											
										</table>
							
							<div class="boxList" >
							<?php if ($this->_tpl_vars['actionReturn']['vendor_payment']): ?>
							<table width="340" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
								
								
									<th colspan="3">Payment Details</th>
										
										<tr>
											<td><span id="totalcomm">Total Commision</span></td><td><?php echo $this->_tpl_vars['actionReturn']['vendor_payment']['total_comm_vendor']; ?>
</td>		
											<td>
											<?php if ($this->_tpl_vars['actionReturn']['vendor_payment']['total_comm_vendor'] > 0): ?>
											<a class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Viewtotalcommision','vendors.php',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['data']['id'])); ?>
" target="window_name">View More</a>
											<?php endif; ?>
											</td>
										</tr>
										<tr>
											<td><span id="balancecomm">Balance Commision</span></td><td><?php echo $this->_tpl_vars['actionReturn']['vendor_payment']['balance_comm_vendor']; ?>
</td>
											<td>
											<?php if ($this->_tpl_vars['actionReturn']['vendor_payment']['balance_comm_vendor'] > 0): ?>
											<a class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Viewbalancecommision','vendors.php',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['data']['id'])); ?>
" target="window_name">View More</a>
											<?php endif; ?>
											</td>
										</tr>
										<tr>
											<td><span id="totalEarned">Total Earned Commision</span></td><td><?php echo $this->_tpl_vars['actionReturn']['vendor_payment']['total_earned_comm_vendor']; ?>
</td>		
											<td>
												<?php if ($this->_tpl_vars['actionReturn']['vendor_payment']['total_earned_comm_vendor'] > 0): ?>
											<a class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Viewtotalearnedcommision','vendors.php',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['actionReturn']['data']['id'])); ?>
" target="window_name">View More</a>
											<?php endif; ?>
											</td>
										</tr>
									</table>
									<?php endif; ?>
								</div>
						</td>	
						</tr>
				
			<tr>	<td>&nbsp;</td>
				<td>
					<input type="submit" class="butsubmit"  name="actionvar" value="Back" id="cancelId" />
				</td>
			</tr>
			
		</table>
		</form>
	</td>
</tr>
<?php endif; ?>	
<?php endif; ?>

<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
<tr>
	<?php if ($this->_tpl_vars['obj']->currentAction == 'Listing'): ?>
	<td>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td  align="right">&nbsp;</td>
			</tr>
				
			<tr>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "vendorsearch.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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
							<th>ID</th>
								<th>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=business_name&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Business Name
								<?php echo $this->_tpl_vars['obj']->getSortImage('business_name',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
							</th>	
								<th>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=email&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Email
								<?php echo $this->_tpl_vars['obj']->getSortImage('email',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
							</th>	
							<th>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=mobile&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Mobile
								<?php echo $this->_tpl_vars['obj']->getSortImage('mobile',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
							</th>	
							<th>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Search','',false); ?>
&sortField=date_added&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
								Joining Date
								<?php echo $this->_tpl_vars['obj']->getSortImage('date_added',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

								</a>
							</th>		
							<th colspan="6" >Action </th>

						</tr>
					<?php $_from = $this->_tpl_vars['actionReturn']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
						<tr>
							<td><?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow+($this->_foreach['i']['iteration']-1); ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['id']; ?>
</td>
							<td><span title="<?php echo $this->_tpl_vars['data']['business_name']; ?>
" ><?php echo $this->_tpl_vars['obj']->getLimitedText($this->_tpl_vars['data']['business_name'],25); ?>
</span>
							</td>
							<td><span title="<?php echo $this->_tpl_vars['data']['email']; ?>
" ><?php echo $this->_tpl_vars['obj']->getLimitedText($this->_tpl_vars['data']['email'],30); ?>
</span>
							</td>
							<td><?php echo $this->_tpl_vars['data']['mobile']; ?>
</td>
							<td><?php echo $this->_tpl_vars['obj']->displayDate($this->_tpl_vars['data']['date_added']); ?>
</td>
							<td>
							
							
								<?php if ($this->_tpl_vars['obj']->permissionCheck('Status')): ?>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Stauschange','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link">
								<?php endif; ?>
										<?php if ($this->_tpl_vars['data']['status'] == 1): ?> 
										<img src="images/active.gif" border="0" title="Click here to inactivate">
										 <?php else: ?> 							 
										 <img src="images/inactive.gif" border="0" title="Click here to activate">
										 <?php endif; ?>
								<?php if ($this->_tpl_vars['obj']->permissionCheck('Status')): ?>
								 </a> 
								<?php endif; ?>
					
							</td>
							<td>
								<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('viewform','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link">
								<img src="images/view.gif" border="0"  title="Click here to view"> </a>
								<?php endif; ?>
							
							</td>
							<td>
								<?php if ($this->_tpl_vars['obj']->permissionCheck('Edit')): ?>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('editform','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link">
								<img src="images/edit.gif" border="0" title="Click here to edit"></a> 
								<?php endif; ?>
							</td>
							
							<td>
							
								<?php if ($this->_tpl_vars['obj']->permissionCheck('Delete')): ?>
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('deleteform','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link">
								<img src="images/delete.gif" border="0" title="Click here to delete"> </a>
								<?php endif; ?>
							</td>
							<td>
							
								<?php if ($this->_tpl_vars['data']['vendorPost']): ?>							
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Dealpost','',true); ?>
&id=<?php echo $this->_tpl_vars['data']['id']; ?>
" class="Second_link"  title="Click here to post new deal">
								Deal </a>
								<?php else: ?> <span title="Sorry! This vendor is not allowed to post any deals at this time"> ---
								<?php endif; ?>
							</td>
							<td>
							
								<?php if ($this->_tpl_vars['data']['vendorPays']): ?>							
								<a href="<?php echo $this->_tpl_vars['obj']->getLink('Commisionpay','',true); ?>
&id=<?php echo $this->_tpl_vars['data']['id']; ?>
" class="Second_link"  title="Click here to make payment">
								Pay </a>
								<?php else: ?> <span title="Sorry! This vendor have no expired or cooldown deals"> ---
								<?php endif; ?>
							
							</td>
						</tr>
					<?php endforeach; endif; unset($_from); ?>
					<tr>
	<td colspan="12"><?php echo $this->_tpl_vars['actionReturn']['spage']->s_get_links(); ?>
</td>
					</tr>
				</table>
				</td>
			</tr>
		<?php endif; ?>
		
		</table>
	</td>
	<?php endif; ?>
</tr>
<?php endif; ?>
</table>


<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
