<form id="pagerForm" method="post" action="index.php?action=outrepair">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="24" />
	<input type="hidden" name="carNum" value="<?php echo $_REQUEST['carNum']; ?>"/>
	<input type="hidden" name="company" value="<?php echo $_REQUEST['company']; ?>"/>
	<input type="hidden" name="wangdian" value="<?php echo $_REQUEST['wangdian']; ?>"/>
	<input type="hidden" name="weixiuproject" value="<?php echo $_REQUEST['weixiuproject']; ?>"/>
</form>

<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=outrepair" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						车牌号:<input type="text" name="carNum" size="12" value="<?php echo $_REQUEST['carNum']; ?>"/>
					</td>
					<td>
						公司名称:<input type="text" name="company" size="12" value="<?php echo $_REQUEST['company']; ?>"/>
					</td>
					<td>
						<label style="width:48">维修项目:</label>
						<?php echo $this->_var['pro_cn']; ?>
					</td>
					<td>
						维修网点:<input type="text" name="wangdian" size="12" value="<?php echo $_REQUEST['wangdian']; ?>"/>
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
				<li><a class="add" href="?action=outrepair&do=new" target="dialog" mask="true" rel="addmaintain"><span>新增网点维修车辆</span></a></li>
				<li><a class="edit" href="?action=outrepair&do=edit&id={id}" target="navTab" mask="true"><span>编辑维修结果</span></a></li>
				<li><a class="delete" href="?action=outrepair&do=del&id={id}" target="ajaxTodo"  title="确定要删除吗?"><span>删除车辆</span></a></li>
				<!-- <form name="excel" method="post" action="index.php?action=outrepair&do=print">
					<input type="hidden" name="search" size="12" value="<?php echo $this->_var['search']; ?>"/>
					<li><a class="add" href="###" onclick="JavaScript:document.excel.submit();" target="dwzExport" targetType="dialog" title="是要导出这些记录吗?"><span>导出EXCEL</span></a></li>
				</form> -->
			</ul>
		</div>
		<table class="list" layouth="92" style="width:1600px;">
			<thead>
				<tr align=center>
					<th align="center" width='50'>ID</th>
					<th align="center" width='200'>公司名称</th>
					<th align="center" width='100'>车牌号</th>
					<th align="center" width='100'>发出日期</th>
					<th align="center" width='100'>发出人员</th>
					<th align="center" width='100'>维修人员</th>
					<th align="center" width='150'>维修网点</th>
					<th align="center" width='100'>维修项目</th>
					<th align="center" width='150'>故障</th>
					<th align="center" width='150'>维修结果</th>
					<th align="center" width='100'>完成日期</th>
					<th align="center" width='100'>审验</th>
					<th align="center" width='200'>所属分公司</th>
					
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
					<td><?php if ($this->_var['row']['fachudate'] != 0): ?><?php echo $this->_var['row']['fachudate']; ?><?php endif; ?></td>
					<td><?php echo $this->_var['row']['fachuperson']; ?></td>
					<td><?php echo $this->_var['row']['weixiuperson']; ?></td>
					<td><?php echo $this->_var['row']['wangdian']; ?></td>
					<td><?php echo $this->_var['row']['weixiuproject']; ?></td>
					<td><?php echo $this->_var['row']['reason']; ?></td>
					<td><?php echo $this->_var['row']['result']; ?></td>
					<td><?php if ($this->_var['row']['finishdate'] != 0): ?><?php echo $this->_var['row']['finishdate']; ?><?php endif; ?></td>
					<td>
					<?php if ($this->_var['row']['judge'] == 1): ?>
					<a class="add" align="center" href="?action=outrepair&do=sure&id=<?php echo $this->_var['row']['id']; ?>" target="ajaxTodo" targetType="dialog" title="是否审核？"><span>审核</span></a>
					<?php endif; ?>
					<?php if ($this->_var['row']['judge'] == 2): ?>
					已审核
					<?php endif; ?>
					</td>
					<td><?php echo $this->_var['row']['company1']; ?></td>
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