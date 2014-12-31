<form id="pagerForm" method="post" action="index.php?action=cards">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="<?php echo $this->_var['numPerPage']; ?>" />
	<input type="hidden" name="tmobile" value="<?php echo $_REQUEST['tmobile']; ?>"/>
	<input type="hidden" name="cardnum" value="<?php echo $_REQUEST['cardnum']; ?>"/>
	<input type="hidden" name="state" value="<?php echo $_REQUEST['state']; ?>"/>
	<input type="hidden" name="tariff" value="<?php echo $_REQUEST['tariff']; ?>"/>
	<input type="hidden" name="date" value="<?php echo $_REQUEST['date']; ?>"/>
</form>

	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=cards" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						<label style="width:40">运营商:</label>
						<select class="combox" name="tmobile">
						<option value="">请选择</option>
						<option value="移动">移动</option>
						<option value="联通">联通</option>
						<option value="电信">电信</option>
					</select>
					</td>
					<td>
						卡号:<input type="text" name="cardnum" size="12" value="<?php echo $_REQUEST['cardnum']; ?>"/>
					</td>
					<td>
						<label style="width:55">SIM卡状态:</label>
						<?php echo $this->_var['state_cn']; ?>
					</td>
					<td>
						<label style="width:48">资费标准:</label>
						<?php echo $this->_var['tariff_cn']; ?>
					</td>
					<td>
						日期:<input type="text" name="date" dateFmt="yyyy-MM" class="date textInput readonly valid focus" size="12" value="<?php echo $_REQUEST['date']; ?>"/>
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
		<div class="panelBar">
			<ul class="toolBar">
				<li><a class="delete" href="?action=cards&do=del&id={id}" target="ajaxTodo"  title="确定要删除吗?"><span>删除卡号</span></a></li>
				<li><a class="edit" href="?action=cards&do=edit&id={id}" target="dialog" mask="true"><span>修改卡号信息</span></a></li>
				<li><a class="add" href="?action=cards&do=print&date=<?php echo $this->_var['date']; ?>" target="dwzExport" targetType="dialog" title="是要导出这些记录吗?"><span>导出EXCEL</span></a></li>
				
			</ul>
		</div>
		
		<table class="list" layouth="92" style="width:1180px;">
			<thead>
				<tr align=center>
					<th align="center" width='50'>ID</th>
					<th align="center" width='100'>运营商</th>
					<th align="center" width='100'>卡号</th>
					<th align="center" width='80'>卡状态</th>
					<th align="center" width='100'>卡状态变更日期</th>
					<th align="center" width='100'>串号</th>
					<th align="center" width='80'>资费</th>
					<th align="center" width='100'>资费变更日期</th>
					<th align="center" width='150'>备注</th>
					<th width="200" align="center">所属分公司</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" align=center>
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['tmobile']; ?></td>	
					<td><?php echo $this->_var['row']['cardnum']; ?></td>
					<td><?php echo $this->_var['row']['simstate']; ?></td>
					<td><?php if ($this->_var['row']['changedate'] != 0): ?><?php echo $this->_var['row']['changedate']; ?><?php endif; ?></td>
					<td><?php if ($this->_var['row']['imei'] != 0): ?><?php echo $this->_var['row']['imei']; ?><?php endif; ?></td>	
					<td><?php echo $this->_var['row']['tariff']; ?></td>	
					<td><?php echo $this->_var['row']['tariffdate']; ?></td>
					<td><?php echo $this->_var['row']['beizhu']; ?></td>	
					<td><?php echo $this->_var['row']['company1']; ?></td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
		<div class="panelBar">
			<div class="pages">
				<span>每页显示</span>
					<select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
						<option value="24" <?php if ($this->_var['numPerPage'] == 24): ?>selected="selected"<?php endif; ?>>24</option>
						<option value="50" <?php if ($this->_var['numPerPage'] == 50): ?>selected="selected"<?php endif; ?>>50</option>
						<option value="100" <?php if ($this->_var['numPerPage'] == 100): ?>selected="selected"<?php endif; ?>>100</option>
						<option value="200" <?php if ($this->_var['numPerPage'] == 200): ?>selected="selected"<?php endif; ?>>200</option>
					</select>
				<span>条</span>
				<span>共<?php echo $this->_var['total']; ?>条</span>
			</div>
			
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="<?php echo $this->_var['numPerPage']; ?>" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>
		</div>
	</div>
</div>
			
