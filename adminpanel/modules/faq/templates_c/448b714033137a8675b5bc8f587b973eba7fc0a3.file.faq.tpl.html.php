<?php /* Smarty version Smarty-3.0.7, created on 2011-12-17 10:18:46
         compiled from "./templates/faq.tpl.html" */ ?>
<?php /*%%SmartyHeaderCode:1754998374eec1f2ebedeb9-26692669%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '448b714033137a8675b5bc8f587b973eba7fc0a3' => 
    array (
      0 => './templates/faq.tpl.html',
      1 => 1324097086,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1754998374eec1f2ebedeb9-26692669',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo smarty_function_call_module_header(array('title'=>"FAQ"),$_smarty_tpl);?>


<script type="text/javascript" src="js/ui/ui/jquery.ui.core.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$("#faq").tooltip();
$("[valcheck='true']").click(function()
	{
			var oEditor 		= FCKeditorAPI.GetInstance('question') ;
			var jsArticleBody 	= oEditor.GetXHTML(true) ;
			var len				=	jsArticleBody.length;
			var errcount		=	0;
			 if(len==0)
				{
					errcount++;	
					$("#questionerror").html("<span class='val_error_alert'>&nbsp;please enter a question</span>");
					
				}
			var oEditor 		= FCKeditorAPI.GetInstance('answer') ;
			var jsArticleBody 	= oEditor.GetXHTML(true) ;
			var len				=	jsArticleBody.length;
			 if(len==0)
				{
					errcount++;
					$("#answererror").html("<span class='val_error_alert'>&nbsp;please enter an answer</span>");
					
				}	
			if(errcount!=0)
				{
					return false;
				}
	});
	
	});
</script>


<?php $_smarty_tpl->tpl_vars["actionReturn"] = new Smarty_variable($_smarty_tpl->getVariable('obj')->value->actionReturn, null, null);?>
<form action="" name="fromName" method="post" enctype="multipart/form-data" >
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_style">
<?php if ($_smarty_tpl->getVariable('obj')->value->getPageError()){?>
<tr>
	<td class="errorMessage"><?php echo $_smarty_tpl->getVariable('obj')->value->popPageError();?>
</td>
</tr>
<?php }?>
<tr>
	<td class="pageHead"><span id="faq"><strong> Manage FAQ </strong></span></td>
</tr>
<?php if (($_smarty_tpl->getVariable('obj')->value->currentAction=="Addform")||($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform")){?>

<tr>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="formTable">
			<tr>
				<th colspan="2">Manage FAQ</th>
			</tr>
			<tr>
				<td>FAQ Group</td>
				<td><?php echo $_smarty_tpl->getVariable('actionReturn')->value['faq_combo'];?>
</td>
			</tr>
			<tr>
				<td>Question</td>
				<td><!--<?php echo $_smarty_tpl->getVariable('obj')->value->get_fck("question",$_smarty_tpl->getVariable('actionReturn')->value['data']['question']);?>
-->
				
				<textarea id="questionId" name="question" rows="5" cols="50"/><?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['question'];?>
</textarea>
				</td>
			</tr>
			<tr><td></td><td id="questionerror"></td></tr>
			<tr>
				<td>Answer</td>
				<td>
				
				<textarea id="answerId" name="answer" rows="5" cols="50"/><?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['answer'];?>
</textarea>
				
				<!--<?php echo $_smarty_tpl->getVariable('obj')->value->get_fck("answer",$_smarty_tpl->getVariable('actionReturn')->value['data']['answer']);?>
	-->
				
				</td>
			</tr>
			<tr><td></td> <td id="answererror"></td></tr>
			<?php if ($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform"){?>
			<tr>
				<td >Sort Order</td>
				<td >
				<input name="txtpreference" type="text" valtype="checkNumber-Please enter a number" id="preferenceId" size="10" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['data']['preference'];?>
"
				class="textBox" maxlength="40">
				</td>
			</tr>
			<?php }?>
			
			<tr>
				<td>&nbsp;</td>
				<td>
				<?php if ($_smarty_tpl->getVariable('obj')->value->currentAction=="Editform"){?>
				
					<input type="submit" class="butsubmit" valcheck="true" name="actionvar" value="Update" id="saveDataId" />
				
				<?php }else{ ?>
					
					<input type="submit" class="butsubmit" valcheck="true" name="actionvar" value="Save" id="saveDataId" />
				
				<?php }?>
					<input type="submit" valcheck="faq" class="butsubmit"  name="actionvar" value="Cancel" id="cancelId" />
				</td>
			</tr>
		</table>
	</td>
</tr>	
<?php }?>



<tr>
	<?php if ($_smarty_tpl->getVariable('obj')->value->currentAction=="Listing"){?>
	
	<td>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td  align="right">&nbsp;</td>
			</tr>
			
			<tr>
				<td>
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
						<tr>
							<td>  <strong> <?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->startingRow;?>
 - <?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->endingRow;?>
 </strong> 
							of <strong><?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->totcnt;?>
 </strong>  </td>
							<td>FAQ Group:</td>
							<td>
								<?php echo $_smarty_tpl->getVariable('actionReturn')->value['searchdata']['searchCombo'];?>

							</td>
							<td>
							<input type="text" name="keyword" maxlength="25" id="id_keyword" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['searchdata']['keyword'];?>
" />
							</td>
							<td>
							<input name="actionvar" type="submit" class="butsubmit" value="Search" />
							</td>
							<td>
							<input name="actionvar" type="submit" class="butsubmit" value="Reset" />
							</td>
							<td>
							<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Add")){?>
							<input name="actionvar" type="submit" class="butsubmit" value="Add New" />
							<?php }?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("View")){?>
			<?php if ($_smarty_tpl->getVariable('actionReturn')->value['data']){?>
                <tr>
                    <td align="center" valign="middle">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="listTable">
                            <tr align="center" valign="middle">							
                                <th  <?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Delete")){?> width="70" <?php }?>>
                                    <?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Delete")){?>
                                    <input type="checkbox" name="checkall" id="id_check_all" >
                                    <?php }?>
                                </th>
                                <th><a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=f.group&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
                                Faq Group<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('f.group',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
</a></th>
                                <th><a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=fg.question&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
                                Question<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('fg.question',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

                                    </a></th>
                                <th><a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=fg.answer&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
                                Answer<?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('fg.answer',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

                                    </a></th>
                                    <th>
                                    <a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Search','',false);?>
&sortField=fg.preference&sortMethod=<?php echo $_smarty_tpl->getVariable('obj')->value->getNegativeSort($_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>
">
                                    Order
    <?php echo $_smarty_tpl->getVariable('obj')->value->getSortImage('fg.preference',$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortField'],$_smarty_tpl->getVariable('actionReturn')->value['searchdata']['sortData']['sortMethod']);?>

                                    </a>
                                    </th>
                                <th>Action </th>
                            </tr>
                        
                        <?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('actionReturn')->value['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value){
?>
                                <tr>
                                    <td>
                                        <?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Delete")){?>
                                        	<input type="checkbox" name="checkone[]" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" >
                                        <?php }?>
                                    </td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['data']->value['group'];?>
</td>
                                    <td><?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->getVariable('obj')->value->getLimitedText($_smarty_tpl->tpl_vars['data']->value['question'],80));?>
</td>
                                    <td><?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->getVariable('obj')->value->getLimitedText($_smarty_tpl->tpl_vars['data']->value['answer'],80));?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['data']->value['preference'];?>
</td>
                                    <td>
                                    <?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Status")){?>
                          				  <a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('Stauschange','',true,$_smarty_tpl->getVariable('obj')->value->getConcat('id=',$_smarty_tpl->tpl_vars['data']->value['id']));?>
" class="Second_link">
                            <?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['data']->value['status']==1){?> 
                                    	<img src="images/active.gif" border="0" title="Click here to inactivate">
                                     <?php }else{ ?> 							 
                                     	<img src="images/inactive.gif" border="0" title="Click here to activate">
                                     <?php }?>
                            <?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Status")){?>
                             </a> 
                            <?php }?>	
                                    
                                    <?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Edit")){?>
                                   		 <a href="<?php echo $_smarty_tpl->getVariable('obj')->value->getLink('editform','',true,$_smarty_tpl->getVariable('obj')->value->getConcat('id=',$_smarty_tpl->tpl_vars['data']->value['id']));?>
" class="Second_link">
                                   		 <img src="images/edit.gif" border="0" title="Click here to edit">							
                                    </a> 
                                    <?php }?>							
                                    </td>
                                </tr>
                           <?php }} ?>
                        <tr>
                            <td>
                            <?php if ($_smarty_tpl->getVariable('obj')->value->permissionCheck("Delete")){?>
                            	<input class="cls_btn_hide" value="Delete" type="submit" name="actionvar" id="id_btn_delete" msg="Are you sure you want to delete these records?">
                            <?php }?> 
                            </td>
                            <td colspan="5"><?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->s_get_links();?>
</td>
                        </tr>
                    </table>
                    </td>
                </tr>
			<?php }?>
		<?php }?>
		
		</table>
	</td>
	<?php }?>
	
</tr>
</table>
</form>
<?php echo smarty_function_call_module_footer(array(),$_smarty_tpl);?>


