<form id="pagerForm" method="post" action="index.php?action=beiji">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="<?php echo $this->_var['numPerPage']; ?>" />
	<input type="hidden" name="carNum" value="<?php echo $_REQUEST['carNum']; ?>"/>
	<input type="hidden" name="beichaidate" value="<?php echo $_REQUEST['beichaidate']; ?>"/>
</form>

<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=beiji" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>	
					<td>
						车牌号:<input type="text" name="carNum" size="12" value="<?php echo $_REQUEST['carNum']; ?>"/>
					</td>
					<td>
						日期:<input type="text" name="beichaidate" dateFmt="yyyy-MM" class="date textInput readonly valid focus" size="12" value="<?php echo $_REQUEST['beichaidate']; ?>"/>
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
				<li><a class="add" href="?action=beiji&do=new" target="dialog" mask="true" rel="addbeiji"><span>安装备机</span></a></li>
				<li><a class="edit" href="?action=beiji&do=edit&id={id}" target="dialog" mask="true"><span>拆取备机</span></a></li>
				<li><a class="add" href="?action=beiji&do=print&date=<?php echo $this->_var['date']; ?>" target="dwzExport" targetType="dialog" title="是要导出这些记录吗?"><span>导出EXCEL</span></a></li>
			</ul>
		</div>
		<table class="list" layouth="92" style="width:1460px;">
			<thead>
				<tr align=center>
					<th align="center" width='50'>ID</th>
					<th align="center" width='150'>公司名称</th>
					<th align="center" width='100'>车牌号</th>
					<th align="center" width='100'>拆取日期</th>
					<th align="center" width='80'>拆取人</th>
					<th align="center" width='150'>备机协议编号</th>
					<th align="center" width='100'>备机协议日期</th>
					<th align="center" width='80'>押金</th>
					<th align="center" width='100'>备机拆取日期</th>
					<th align="center" width='150'>设备型号</th>
					<th align="center" width='200'>备注</th>
					<th width="200" align="center">所属分公司</th>
				</tr>
			</thead>
			
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
			
			
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" align=center>
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['company']; ?></td>
					<td><?php echo $this->_var['row']['carNum']; ?></td>
					<td><?php if ($this->_var['row']['chaidate'] != 0): ?><?php echo $this->_var['row']['chaidate']; ?><?php endif; ?></td>
					<td><?php echo $this->_var['row']['chaipeople']; ?></td>
					<td><?php echo $this->_var['row']['agreement']; ?></td>
					<td><?php if ($this->_var['row']['agreedate'] != 0): ?><?php echo $this->_var['row']['agreedate']; ?><?php endif; ?></td>
					<td><?php if ($this->_var['row']['deposit'] != 0): ?><?php echo $this->_var['row']['deposit']; ?><?php endif; ?></td>
					<td><?php if ($this->_var['row']['beichaidate'] != 0): ?><?php echo $this->_var['row']['beichaidate']; ?><?php endif; ?></td>
					<td><?php echo $this->_var['row']['model']; ?></td>
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