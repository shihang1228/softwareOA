<form id="pagerForm" method="post" action="index.php?action=fenqicar">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="<?php echo $this->_var['numPerPage']; ?>" />
	<input type="hidden" name="company" value="<?php echo $_REQUEST['company']; ?>"/> 
	<input type="hidden" name="carNum" value="<?php echo $_REQUEST['carNum']; ?>"/>
</form>

<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=fenqicar" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						<label style="width:48">公司名称:</label>
						<?php echo $this->_var['company_cn']; ?>
					</td>
					<td>
						车牌号:<input type="text" name="carNum" size="12" value="<?php echo $_REQUEST['carNum']; ?>"/>
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
				<li><a class="add" href="?action=fenqicar&do=new" target="dialog" mask="true"><span>还款</span></a></li>
				<li><a class="add" href="?action=fenqicar&do=show&id={id}" target="dialog" mask="true"><span>明细</span></a></li>
				<form name="excel" method="post" action="index.php?action=carinfo&do=print">
					<input type="hidden" name="search" size="12" value="<?php echo $this->_var['search']; ?>"/>
					<li><a class="add" href="###" onclick="JavaScript:document.excel.submit();" target="dwzExport" targetType="dialog" title="是要导出这些记录吗?"><span>导出EXCEL</span></a></li>
				</form>
			</ul>
		</div>
		<table class="list" layouth="92" style="width:1450px;" style='word-break:break-all;word-wrap:break-word'>
			<thead>
				<tr align=center>
					<th width="50" align="center">ID</th>
					<th width="200" align="center">公司名称</th>
					<th width="100" align="center">车牌号</th>
					<th width="120" align="center">已还金额</th>
					<th width="120" align="center">还款日期</th>
					<th width="120" align="center">总金额</th>
					<th width="120" align="center">总年限</th>
					<th width="120" align="center">剩余金额</th>
					<th width="150" align="center">备注</th>
					<th width="150" align="center">编辑分期付款信息</th>
					<th width="200" align="center">所属分公司</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" align=center>
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td width="200px" style="word-break:break-all;"><?php echo $this->_var['row']['company']; ?></td>
					<td><?php echo $this->_var['row']['carNum']; ?></td>	
					<td><?php if ($this->_var['row']['money'] != 0): ?><?php echo $this->_var['row']['money']; ?><?php endif; ?></td>
					<td><?php if ($this->_var['row']['repaydate'] != 0): ?><?php echo $this->_var['row']['repaydate']; ?>月<?php endif; ?></td>
					<td><?php if ($this->_var['row']['totalmoney'] != 0): ?><?php echo $this->_var['row']['totalmoney']; ?><?php endif; ?></td>
					<td><?php echo $this->_var['row']['totalyear']; ?></td>
					<td><?php if ($this->_var['row']['lastmoney'] != 0): ?><?php echo $this->_var['row']['lastmoney']; ?><?php endif; ?></td>
					<td><?php echo $this->_var['row']['beizhu']; ?></td>
					<td>
					<?php if ($this->_var['row']['judge'] == 1): ?>
					<li><a class="edit" href="?action=fenqicar&do=edit&id=<?php echo $this->_var['row']['id']; ?>" target="dialog" mask="true"><span>编辑信息</span></a></li>
					<?php endif; ?>
					</td>
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