<form id="pagerForm" method="post" action="index.php?action=maintain">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="24" />
	<input type="hidden" name="carNum" value="<?php echo $_REQUEST['carNum']; ?>"/>
	<input type="hidden" name="backdate" value="<?php echo $_REQUEST['backdate']; ?>"/>
	<input type="hidden" name="fromcity" value="<?php echo $_REQUEST['fromcity']; ?>"/>
</form>

<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=maintain" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						车牌号:<input type="text" name="carNum" size="12" value="<?php echo $_REQUEST['carNum']; ?>"/>
					</td>
					<td>
						返回日期:<input type="text" name="backdate" dateFmt="yyyy-MM" class="date textInput readonly valid focus" size="12" value="<?php echo $_REQUEST['backdate']; ?>"/>
					</td>
					<td>
						地市:<input type="text" name="fromcity" size="12" value="<?php echo $_REQUEST['fromcity']; ?>"/>
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
				<li><a class="add" href="?action=maintain&do=new" target="dialog" mask="true" rel="addmaintain"><span>新增终端维修记录</span></a></li>
				<li><a class="edit" href="?action=maintain&do=edit&id={id}" target="dialog" mask="true"><span>编辑终端维修记录</span></a></li>
				<li><a class="delete" href="?action=maintain&do=del&id={id}" target="ajaxTodo"  title="确定要删除吗?"><span>删除维修记录</span></a></li>
				<!-- <li><a class="add" href="?action=maintain&do=print&date=<?php echo $this->_var['date']; ?>" target="dwzExport" targetType="dialog" title="是要导出这些记录吗?"><span>导出EXCEL</span></a></li> -->
				<form name="excel" method="post" action="index.php?action=maintain&do=print">
					<input type="hidden" name="search" size="12" value="<?php echo $this->_var['search']; ?>"/>
					<li><a class="add" href="###" onclick="JavaScript:document.excel.submit();" target="dwzExport" targetType="dialog" title="是要导出这些记录吗?"><span>导出EXCEL</span></a></li>
				</form>
			</ul>
		</div>
		<table class="list" layouth="92" style="width:2030px;">
			<thead>
				<tr align=center>
					<th align="center" width='50'>ID</th>
					<th align="center" width='200'>公司名称</th>
					<th align="center" width='100'>车牌号</th>
					<th align="center" width='100'>寄出时间</th>
					<th align="center" width='100'>收到时间</th>
					<th align="center" width='100'>地市</th>
					<th align="center" width='150'>终端厂家</th>
					<th align="center" width='100'>型号</th>
					<th align="center" width='100'>主机ID号</th>
					<th align="center" width='150'>返修原因</th>
					<th align="center" width='150'>检测现象</th>
					<th align="center" width='150'>维修结果(上线/定位/照片)</th>
					<th align="center" width='100'>返回时间</th>
					<th align="center" width='80'>检修次数</th>
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
					<td><?php if ($this->_var['row']['chudate'] != 0): ?><?php echo $this->_var['row']['chudate']; ?><?php endif; ?></td>
					<td><?php if ($this->_var['row']['getdate'] != 0): ?><?php echo $this->_var['row']['getdate']; ?><?php endif; ?></td>
					<td><?php echo $this->_var['row']['fromcity']; ?></td>
					<td><?php echo $this->_var['row']['name']; ?></td>
					<td><?php echo $this->_var['row']['model']; ?></td>
					<td><?php echo $this->_var['row']['zhujiId']; ?></td>
					<td><?php echo $this->_var['row']['reason']; ?></td>
					<td><?php echo $this->_var['row']['phenomenon']; ?></td>
					<td><?php echo $this->_var['row']['reasult']; ?></td>
					<td><?php if ($this->_var['row']['backdate'] != 0): ?><?php echo $this->_var['row']['backdate']; ?><?php endif; ?></td>
					<td><?php echo $this->_var['row']['mainNum']; ?></td>
					<td><?php echo $this->_var['row']['beizhu']; ?></td>
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