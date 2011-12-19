<?php /* Smarty version Smarty-3.0.7, created on 2011-12-17 14:37:14
         compiled from "./templates/categorysearch.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16061617084eec5bc272c6f8-12756319%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '909ea499771626b7f93e28d25c83e533821f5610' => 
    array (
      0 => './templates/categorysearch.tpl',
      1 => 1324112833,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16061617084eec5bc272c6f8-12756319',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<td>
		<form action="" name="fromName" method="post" enctype="multipart/form-data">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
			<tr>
				<td> <strong><?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->startingRow;?>
 - <?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->endingRow;?>
  </strong> of <strong><?php echo $_smarty_tpl->getVariable('actionReturn')->value['spage']->totcnt;?>
 </strong> </td>							
				<td>
				Keyword </td><td><input type="text"  size="14" name="keyword" maxlength="25" id="id_keyword" value="<?php echo $_smarty_tpl->getVariable('actionReturn')->value['searchdata']['keyword'];?>
" />
				</td>
				<td>
				Category</td><td><?php echo $_smarty_tpl->getVariable('actionReturn')->value['cat_combo'];?>

				</td>
				<td>
				<input name="actionvar" type="submit" class="butsubmit" value="Search" />
				</td>
				<td>
				<input name="actionvar" type="submit" class="butsubmit" value="Reset" />
				</td>
				<td>
				<input name="actionvar" type="submit" class="butsubmit" value="Add New" />
				</td>
				
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>
			<div id="id_search_block" class="cls_search_block">
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="searchTable">
					<tr>
						<td>Quick Links
						<input type="checkbox" name="quick_links" value="1" <?php if ($_smarty_tpl->getVariable('actionReturn')->value['data']['quick_links']==1){?> checked="checked"<?php }?> /> <br />
						</td>
					</tr>           		
				</table>
			</div>
			</form>
		</td>
	</tr>
		