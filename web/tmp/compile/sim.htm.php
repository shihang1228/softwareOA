<form id="pagerForm" method="post" action="index.php?action=sim&do=search">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="24" />
	<input type="hidden" name="simNum" value="<?php echo $_REQUEST['simNum']; ?>"/>
	<input type="hidden" name="simstate" value="<?php echo $_REQUEST['simstate']; ?>"/>
	<input type="hidden" name="zifei" value="<?php echo $_REQUEST['zifei']; ?>"/>
</form>
<div class="page">
<div class="pageHeader">
		<form onsubmit="return dwzSearch(this, 'dialog');" action="index.php?action=sim&do=search" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						SIM卡号:<input type="text" name="simNum" size="12" value="<?php echo $_REQUEST['simNum']; ?>"/>
					</td>
			
					<td>
					<div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div>
					</td>
					
				</tr>
			</table>
		</div>
		</form>
		</div>
	<div class="pageContent">
		<table class="list" layouth="92" style="width:570px;">
			<thead>
			
				<tr align=center>
					<th width="20" align="center">ID</th>
					<th width="100" align="center">SIM卡号</th>
					<th width="150" align="center">SIM卡状态</th>
					<th width="150" align="center">资费</th>
				</tr>	
			</thead>
			
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" align=center>
					<td><?php echo $this->_var['row']['id']; ?></td>	
					<td><?php echo $this->_var['row']['cardnum']; ?></td>
					<td><?php echo $this->_var['row']['simstate']; ?></td>
					<td><?php echo $this->_var['row']['zifei']; ?></td>
					<td>
					<a class="btnSelect" href="javascript:$.bringBack({simNum:'<?php echo $this->_var['row']['cardnum']; ?>'})" title="查找带回">选择</a>
				</td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
	
		<div class="panelBar">
			<div class="pages">
				<span>共<?php echo $this->_var['total']; ?>条</span>
			</div>
			
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="24" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>
		</div>
		
	</div>		
</div>	
