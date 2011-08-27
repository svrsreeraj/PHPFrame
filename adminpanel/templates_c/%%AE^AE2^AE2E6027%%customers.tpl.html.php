<?php /* Smarty version 2.6.19, created on 2011-02-22 14:49:16
         compiled from customers.tpl.html */ ?>
<?php $this->assign('actionReturn', $this->_tpl_vars['obj']->actionReturn); ?>

<?php echo '
<script type="text/javascript" src="js/highslide/highslide.js"></script>
<link rel="stylesheet" type="text/css" href="js/highslide/highslide.css" />
<link type="text/css" href="js/ui/themes/base/jquery.ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="js/ui/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/ui/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="js/ui/ui/jquery.ui.mouse.js"></script>
<script type="text/javascript" src="js/ui/ui/jquery.ui.draggable.js"></script>
<script type="text/javascript" src="js/ui/ui/jquery.ui.sortable.js"></script>

<script type="text/javascript">
function getcombo(cid,changeId)
	{
		$("#"+changeId).html("Loading...");
		$.ajax({
			   type	: "GET",
			   url	: "customers.php",
			   data	: "actionvar=Getstatecombo&cid="+cid,
			   dataType: "html",
			   success: function(msg){
				   $("#"+changeId).html(msg); 	
				}
			 });
	}
$(document).ready(function() {
	$("#customerdetails").tooltip();
	$("#totalrefreral").tooltip();
	$("#totaljoined").tooltip();
	$("#totalnotjoined").tooltip();
	$("#productiveusers").tooltip();
	$("#customerdetails").tooltip();
	$("#image").tooltip();
	$("#totalsitepoint").tooltip();
	$("#balancesitepoint").tooltip();
	$("#usedsitepoints").tooltip();
	$("#totalvoteddeal").tooltip();
	$("#votedandpurchsed").tooltip();
	$("#voednotpurchased").tooltip();
	
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
		defaultDate:\'2010-11-24\',
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
		defaultDate:\'2010-11-24\',
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
	<td class="pageHead"><span id="customerdetails"><strong>Customers <?php if (( $this->_tpl_vars['obj']->currentAction == 'Listing' )): ?>Listing<?php endif; ?><?php if (( $this->_tpl_vars['obj']->currentAction == 'Editform' )): ?>Edit : <?php echo $this->_tpl_vars['actionReturn']['data']['fname']; ?>
<?php endif; ?> </strong></span></td>
</tr>
<?php if (( $this->_tpl_vars['obj']->currentAction == 'Editform' )): ?>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				<th colspan="2">Manage Customers</th>
			</tr>
			<tr>
				<td width="150">First Name </td>
				<td><input type="text"  name="fname" valtype="emptyCheck-Please enter the  first name "  value="<?php echo $this->_tpl_vars['actionReturn']['data']['fname']; ?>
" id="fnameId" class="alphaNumeric" /></td>
			</tr>
			<tr>
				<td>Last Name </td>
				<td><input type="text" valtype="emptyCheck-Please enter the last name"  name="lname" value="<?php echo $this->_tpl_vars['actionReturn']['data']['lname']; ?>
" id="lanmeId" class="alphaNumeric" /></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="text" valtype="emptyCheck-Please enter the Email address|emailCheck-please enter a valid Email address"   name="email" value="<?php echo $this->_tpl_vars['actionReturn']['data']['email']; ?>
" id="emailId"  class="emailValidate" /></td>
			</tr>
			<tr>
				<td id="image">Image</td>
					<td><input type="file"  name="fileImage" value="<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" id="fileImageId" />&nbsp;
					<?php if ($this->_tpl_vars['actionReturn']['data']['image']): ?>
						<a  href="../images/customers/<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" class="highslide" onclick="return hs.expand(this)">
						<img src="../images/customers/thumb/<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" width="25" height="25" ; />
						</a><?php endif; ?>
						</td>
				</tr>
				
									<tr>
				<td>Subcategory </td>
				<td><?php echo $this->_tpl_vars['actionReturn']['subcat_combo']; ?>
</td>
			</tr>			
			<tr>
				<td>Password</td>
				<td><input type="password" valtype="emptyCheck-Please enter the password" name="password" value="<?php echo $this->_tpl_vars['actionReturn']['data']['password']; ?>
" id="passwordId"   /></td>
			</tr>
		
			<tr>
				<td>Country</td>
				<td><?php echo $this->_tpl_vars['actionReturn']['country_combo']; ?>
</td>
			</tr>
	
			<tr>
				<td>State</td>
				<td><div id="stateDivId"><?php echo $this->_tpl_vars['actionReturn']['state_combo']; ?>
</div></td>
			</tr>	
		
			<tr>
				<td>Zip</td>
				<td><input type="text" valtype="emptyCheck-Please enter the zip code " name="zip" value="<?php echo $this->_tpl_vars['actionReturn']['data']['zip']; ?>
" id="zipId" class="validatezip"/></td>
			</tr>
		
			<tr>
				<td>Mobile</td>
				<td><input type="text" valtype="emptyCheck-Please enter the mobile number|checkNumber-Please enter a valid number"  name="mobile" value="<?php echo $this->_tpl_vars['actionReturn']['data']['mobile']; ?>
" id="mobileId" class="nummberOnly"  maxlength="15" /></td>
			</tr>
	
			<tr>
				<td>Email Update</td>
				<td>				
				<input type="checkbox"  name="email_update"  id="email_updateId" value="1" <?php if ($this->_tpl_vars['actionReturn']['data']['email_update'] == '1'): ?>  checked="checked" <?php endif; ?>/>
				</td>
				</tr>
	
			<tr>
				<td>SMS Update</td>
				<td><input type="checkbox"  name="sms_update"  id="sms_updateId" value="1" <?php if ($this->_tpl_vars['actionReturn']['data']['sms_update'] == '1'): ?> checked="checked"  <?php endif; ?>/> </td>
			</tr>
				<td>&nbsp;</td>
				<td>
				<?php if ($this->_tpl_vars['obj']->currentAction == 'Editform'): ?>
					<?php if ($this->_tpl_vars['obj']->permissionCheck('Edit')): ?>
					<input type="submit" class="butsubmit" valcheck="true"  name="actionvar" value="Update" id="saveDataId" />
					<?php endif; ?>
				<?php endif; ?>
					<input type="submit" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
				</td>
			</tr>
		</table>
	</td>
</tr>
<?php endif; ?>	


<?php if (( $this->_tpl_vars['obj']->currentAction == 'Viewform' )): ?>
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
		
		<tr>
		<td width="50%">
			<div class="boxList">
				
					<div>
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
						<tr>
							<th colspan="3" >Customer Personal Profile</th>
							</tr>
							<?php if ($this->_tpl_vars['actionReturn']['data']['fname']): ?>
							<tr>
								<td>Name</td>
								<td ><?php echo $this->_tpl_vars['actionReturn']['data']['fname']; ?>
 <?php echo $this->_tpl_vars['actionReturn']['data']['lname']; ?>

								</td>
								<td rowspan	="5" valign="top">
											<?php if ($this->_tpl_vars['actionReturn']['data']['image']): ?>
											<a  href="../images/customers/<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" class="highslide" onclick="return hs.expand(this)">
											<img src="../images/customers/thumb/<?php echo $this->_tpl_vars['actionReturn']['data']['image']; ?>
" style="float:right;"/>
											</a><?php endif; ?><?php echo $this->_tpl_vars['actionReturn']['data']['description']; ?>
 
								</td>
							</tr>
							<?php endif; ?>
								
							<?php if ($this->_tpl_vars['actionReturn']['data']['email']): ?>
							<tr>
								<td>Email</td>
								<td ><?php echo $this->_tpl_vars['actionReturn']['data']['email']; ?>
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
							<?php if ($this->_tpl_vars['actionReturn']['data']['mobile']): ?>
							<tr>
								<td >Mobile</td>
								<td ><?php echo $this->_tpl_vars['obj']->getUSPhoneDisplay($this->_tpl_vars['actionReturn']['data']['mobile']); ?>
</td>
							</tr>
							<?php endif; ?>			
							<tr>
								<td>SMS Update</td>
								<td>
								<?php if ($this->_tpl_vars['actionReturn']['data']['sms_update'] == 1): ?>
									<img src="images/active.gif" border="0" title="SMS update is On" alt="SMS update is On"  />
								<?php else: ?>
									<img src="images/inactive.gif" border="0" title="SMS update is Off" alt="SMS update is Off"  />
								<?php endif; ?>
								</td>
								
							</tr>
							<tr>
								<td>Email Updates</td>
								<td  >
								<?php if ($this->_tpl_vars['actionReturn']['data']['email_update'] == 1): ?>
									<img src="images/active.gif" border="0" title="Email update is On" alt="Email update is On"  />
								<?php else: ?>
									<img src="images/inactive.gif" border="0" title="Email update is Off" alt="Email update is Off"  />
								<?php endif; ?>
				
								</td>
								
								
							</tr>
							<?php if ($this->_tpl_vars['actionReturn']['country']): ?>
							<tr>
								<td>Country</td>
								<td colspan="2"><?php echo $this->_tpl_vars['actionReturn']['country']; ?>
</td>
							</tr>
							<?php endif; ?>
							<?php if ($this->_tpl_vars['actionReturn']['state']): ?>
							<tr>
								<td>State</td>
								<td colspan="2" ><?php echo $this->_tpl_vars['actionReturn']['state']; ?>
</td>
							</tr>
							<?php endif; ?>
							<?php if ($this->_tpl_vars['actionReturn']['data']['zip']): ?>
							<tr>
								<td>Zip</td>
								<td colspan="2" ><?php echo $this->_tpl_vars['actionReturn']['data']['zip']; ?>
</td>
							</tr>
							<?php endif; ?>
							<tr>
								<td>Face Book User</td>
								<td colspan="2">
								<?php if ($this->_tpl_vars['actionReturn']['data']['from_fb'] == '1'): ?>
									<img src="images/active.gif" border="0" title="Face Book User" alt="Face Book User"  />
								<?php else: ?>
									<img src="images/inactive.gif" border="0" title="Not a Face Book User" alt="Not a Face Book User"  />
								<?php endif; ?>
								</td>
							</tr>
							<?php if ($this->_tpl_vars['actionReturn']['fb_id']): ?>
							<tr>
								<td>Face book Id</td>
								<td colspan="2"><?php echo $this->_tpl_vars['actionReturn']['data']['fb_id']; ?>
</td>
							</tr>
							<?php endif; ?>
							<?php if ($this->_tpl_vars['actionReturn']['ip']): ?>
							<tr>
								<td>Joined IP</td>
								<td colspan="2"><?php echo $this->_tpl_vars['actionReturn']['data']['ip']; ?>
</td>
							</tr>
							<?php endif; ?>
							<tr>
								<td>Status</td>
								<td colspan="2">
								<?php if ($this->_tpl_vars['actionReturn']['data']['status'] == 1): ?>
									<img src="images/active.gif" border="0" title="Active user" alt="Active user"  />
								<?php else: ?>
									<img src="images/inactive.gif" border="0" title="Inactive User" alt="Inactive User"  />
								<?php endif; ?>
								</td>
							</tr>
							<?php if ($this->_tpl_vars['actionReturn']['data']['date_added']): ?>
							<tr>
								<td>Joined Date</td>
								<td colspan="2"><?php echo $this->_tpl_vars['obj']->displayDate($this->_tpl_vars['actionReturn']['data']['date_added']); ?>
</td>
							</tr>
							<?php endif; ?>
							<?php if ($this->_tpl_vars['actionReturn']['data']['catData']): ?>
							<tr>
								<td>Interested Categories </td>
								<td>
									<?php $_from = $this->_tpl_vars['actionReturn']['data']['catData']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['cdata']):
        $this->_foreach['i']['iteration']++;
?>
										<?php echo $this->_tpl_vars['cdata']['category']; ?>
 - <?php echo $this->_tpl_vars['cdata']['subcatlist']; ?>
 
										<br />
									<?php endforeach; endif; unset($_from); ?>
								</td>
							</tr>
							<?php endif; ?>
						</table>
					</div>
					
					<div>
						<?php if ($this->_tpl_vars['actionReturn']['refdata']): ?>
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
						<tr>
							<th  colspan="3">Customer Invite Details</th>
						</tr>
						<tr>
							<td><span id="totalrefreral">Total Invited</span></td>
							<td><?php echo $this->_tpl_vars['actionReturn']['refdata']['totalReferal']; ?>
</td>
							<td ><a target="_blank" class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Linktotalref','',true); ?>
">
							view more
                            </a></td>
						</tr>
						<tr>
							<td><span id="totaljoined">Total Joined</span></td>
							<td><?php echo $this->_tpl_vars['actionReturn']['refdata']['totalJoined']; ?>
</td>
							<td><a target="_blank" class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Linktotaljnd','',true); ?>
">
                            view more
                            </a></td>
						</tr>
						<tr>
							<td><span id="totalnotjoined">Total Not Joined</span></td>
							<td><?php echo $this->_tpl_vars['actionReturn']['refdata']['totalNotJoined']; ?>
</td>
							<td><a target="_blank" class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Linktotalnotjnd','',true); ?>
">
                            view more
                            </a></td>
						</tr>
						<tr>
							<td><span id="productiveusers">Productive users</span></td>
							<td colspan="2"><?php echo $this->_tpl_vars['actionReturn']['refdata']['productiveUsers']; ?>
</td>
						 </tr>
						 </table>
						<?php endif; ?>
					</div>
					
					<div>
						<?php if ($this->_tpl_vars['actionReturn']['custorders']['count']): ?>
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
						<tr>
							<th  colspan="3">Customer Order Details</th>
						</tr>
						<tr>
							<td>Purchased Deals</td>
							<td><?php echo $this->_tpl_vars['actionReturn']['custorders']['count']; ?>
</td>
							<td><a target="_blank" class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Linktopurchsdeal','',true); ?>
">
							view more
                            </a></td>
						</tr>
						<tr>
							<td>Coupon Redeemed</td>
							<td><?php echo $this->_tpl_vars['actionReturn']['custorders']['couponRedeemed']; ?>
</td>
							<td><a target="_blank" class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Linktocouponredmd','',true); ?>
">
							view more
                            </a></td>
						</tr>
						<tr>
							<td>Coupon To Be Redeemed</td>
							<td><?php echo $this->_tpl_vars['actionReturn']['custorders']['couponTobeRedeemed']; ?>
</td>
							<td><a target="_blank" class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Linktocoupontbredmd','',true); ?>
">
							view more
                            </a></td>
						</tr>
						<tr>
							<td>Coupon Shared</td>
							<td><?php echo $this->_tpl_vars['actionReturn']['custorders']['couponShared']; ?>
</td>
							<td><a target="_blank" class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Linktocouponshrd','',true); ?>
">
							view more
                            </a></td>
						</tr>
						<tr>
							<td>Total Amount paid</td>
							<td colspan="2"><?php echo $this->_tpl_vars['actionReturn']['custorders']['sum']; ?>
</td>
						</tr>
						</table>
						<?php endif; ?>
					</div>
					
				</div>
			</td>
			<td>
				<div class="boxList">
					<div>
						<?php if ($this->_tpl_vars['actionReturn']['sitepoints']): ?>
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
						<tr>
							<th  colspan="3">Customer SitePoints</th>
							</tr>
						<tr>
							<td><span id="totalsitepoint">Total site Points</span></td>
							<td colspan="2"><?php echo $this->_tpl_vars['actionReturn']['sitepoints']['total_points']; ?>
</td>
						 </tr>
						<tr>
							<td><span id="balancesitepoint">Balance Site Points</span></td>
							<td colspan="2"><?php echo $this->_tpl_vars['actionReturn']['sitepoints']['balance_points']; ?>
</td>
						 </tr>
						<tr>
							<td><span id="usedsitepoints">Used Site Points</span></td>
							<td><?php echo $this->_tpl_vars['actionReturn']['sitepoints']['used_points']; ?>
</td>
							<td><a target="_blank" class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Linktositepoints','',true); ?>
">
							view more
                            </a></td>
						</tr>
						</table>
						<?php endif; ?>

					</div>
					<div>
						<?php if ($this->_tpl_vars['actionReturn']['sitecredit']): ?>
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
						<tr>
							<th  colspan="3">Customer SiteCredits</th>
							</tr>
						<tr>
							<td><span id="totalcredit">Total Credit</span> </td>
							<td colspan="2"><?php echo $this->_tpl_vars['actionReturn']['sitecredit']['total_credit']; ?>
</td>
						</tr>
						<tr>
							<td><span id="usedcredit">Used Credit</span></td>
							<td colspan="2"><?php echo $this->_tpl_vars['actionReturn']['sitecredit']['used_credit']; ?>
</td>
						</tr>
						<tr>
							<td><span id="balancedcredit">Balance Credit</span></td>
							<td colspan="2"><?php echo $this->_tpl_vars['actionReturn']['sitecredit']['balance_credit']; ?>
</td>
						</tr>
						<tr>
							<td>Date Updated</td>
							<td><?php echo $this->_tpl_vars['actionReturn']['sitecredit']['date_updated']; ?>
</td>
							<td><a target="_blank"  class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Linktositecredits','',true); ?>
">
							view more
                            </a></td>
						 </tr>
						 </table>
						<?php endif; ?>
					</div>
					<div>
						<?php if ($this->_tpl_vars['actionReturn']['vote']): ?>
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
						<tr>
							<th  colspan="3">Customer Votes</th>
							</tr>
						<tr>
							<td><span id="totalvoteddeal">Total Voted Deals</span></td>
							<td colspan="2"><?php echo $this->_tpl_vars['actionReturn']['vote']['totalVotdDeal']; ?>
</td>
						</tr>
						<tr>
							<td><span id="votedandpurchsed">Voted and Purchased</span></td>
							<td colspan="2"><?php echo $this->_tpl_vars['actionReturn']['vote']['VotdPurchsd']; ?>
</td>
						</tr>
						<tr>
						  <td><span id="voednotpurchased">Voted Not Purchased</span></td>
						  <td><?php echo $this->_tpl_vars['actionReturn']['vote']['VotdNotPurchsd']; ?>
</td>
							<td><a target="_blank" class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Linktovotes','',true); ?>
">
							view more
                            </a></td>
						</tr>
						</table>
						<?php endif; ?>
					
					</div>
					<div>
						<?php if ($this->_tpl_vars['actionReturn']['ecomData']): ?>
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
						<tr>
							<th  colspan="3">Customer E-commerce Orders</th>
							</tr>
						<tr>
							<td> Total number of orders </td>
							<td colspan="2"><?php echo $this->_tpl_vars['actionReturn']['ecomData']['count']; ?>
</td>
						</tr>
						<tr>
						  <td>Total amount spent </td>
						  <td><?php echo $this->_tpl_vars['actionReturn']['ecomData']['sum']; ?>
</td>
							<td><a target="_blank" class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('LinktoecomData','',true); ?>
">
							view more
                            </a></td>
						</tr>
						</table>
						<?php endif; ?>
					
					</div>
					<div>
						<?php if ($this->_tpl_vars['actionReturn']['questncount']): ?>
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
						<tr>
							<th  colspan="3">Customer Questionnaire Details</th>
							</tr>
						<tr>
							<td width="170"> Attended Questions</td>
							<td><?php echo $this->_tpl_vars['actionReturn']['questncount']; ?>
</td>
							<td><a target="_blank" class="view-more" href="<?php echo $this->_tpl_vars['obj']->getLink('Linktoquestionnaire','',true); ?>
">
							view more
                            </a></td>
						</tr>
						</table>
						<?php endif; ?>
					</div>
					<div>
						<?php if ($this->_tpl_vars['actionReturn']['tot_ref']): ?>
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="listTablePopUp">
						<tr>
							<th  colspan="3">Customer Referals</th>
							</tr>
						<tr>
							<td width="170"> Total Referals</td>
							<td><?php echo $this->_tpl_vars['actionReturn']['tot_ref']; ?>
</td>
							<td></td>
						</tr>
						</table>
						<?php endif; ?>
					</div>
			</div>
		</td>
		</tr>
		<tr>
		<td></td>
			<td >
				<input type="submit" class="butsubmit"  name="actionvar" value="Back" id="cancelId" />
			</td>
		</tr>
		</table>
	</td>
</tr>
<?php endif; ?>	

<tr>
	<?php if ($this->_tpl_vars['obj']->currentAction == 'Listing'): ?>
	<td>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'customerSearch.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php if ($this->_tpl_vars['actionReturn']['data']): ?>
			<tr>
				<td align="center" valign="middle">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
						<tr align="center" valign="middle">							
							<th>No</th>
							<th colspan="2"><a href="<?php echo $this->_tpl_vars['obj']->getLink('search','','false'); ?>
&sortField=fullname&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Customer Name
							<?php echo $this->_tpl_vars['obj']->getSortImage('fullname',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
				
							</a></th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('search','','false'); ?>
&sortField=email&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Email
							<?php echo $this->_tpl_vars['obj']->getSortImage('email',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>

							</a></th>
							<th><a href="<?php echo $this->_tpl_vars['obj']->getLink('search','','false'); ?>
&sortField=mobile&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Mobile
							<?php echo $this->_tpl_vars['obj']->getSortImage('mobile',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>	
							<th>Status</a></th>	
                            <th><a href="<?php echo $this->_tpl_vars['obj']->getLink('search','','false'); ?>
&sortField=date_added&sortMethod=<?php echo $this->_tpl_vars['obj']->getNegativeSort($this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
">
							Added Date
							<?php echo $this->_tpl_vars['obj']->getSortImage('date_added',$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortField'],$this->_tpl_vars['actionReturn']['searchdata']['sortData']['sortMethod']); ?>
 
							 </a></th>						
							<th>Action </th>
						</tr>
					<?php $_from = $this->_tpl_vars['actionReturn']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['i'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['i']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data']):
        $this->_foreach['i']['iteration']++;
?>
						<tr>
							<td><?php echo $this->_tpl_vars['actionReturn']['spage']->startingRow+($this->_foreach['i']['iteration']-1); ?>
</td>
							<td colspan="2"><?php echo $this->_tpl_vars['data']['fullname']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['email']; ?>
</td>
							<td><?php echo $this->_tpl_vars['data']['mobile']; ?>
</td>
                            <td><?php if ($this->_tpl_vars['data']['status'] == 1): ?> <img src="images/active.gif" border="0" title="Active User"><?php else: ?><img src="images/inactive.gif" border="0" title="Inactive User"><?php endif; ?></td>
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
							<?php if ($this->_tpl_vars['obj']->permissionCheck('View')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('viewform','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link">
							<img src="images/view.gif" border="0" title="Click here to view"> </a>
							<?php endif; ?>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Edit')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('editform','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link">
							<img src="images/edit.gif" border="0" title="Click here to edit"></a> 
							<?php endif; ?>
							<?php if ($this->_tpl_vars['obj']->permissionCheck('Delete')): ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('deleteform','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link">
							<img src="images/delete.gif" border="0" title="Click here to delete"> </a>
							<?php endif; ?>
							<?php if ($this->_tpl_vars['data']['status'] == 1): ?> 
							  <span title="Already activated this account">---</span>
							<?php else: ?>
							<a href="<?php echo $this->_tpl_vars['obj']->getLink('Sendmail','',true,$this->_tpl_vars['obj']->getConcat('id=',$this->_tpl_vars['data']['id'])); ?>
" class="Second_link">
							<img src="images/reply_icon.gif" border="0" title="Click here to send activation mail to <?php echo $this->_tpl_vars['data']['fullname']; ?>
"> 
							</a>
							<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; endif; unset($_from); ?>
					<tr>
						<td></td>
						<td colspan="8"><?php echo $this->_tpl_vars['actionReturn']['spage']->s_get_links(); ?>
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
</table>
<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "footer.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
