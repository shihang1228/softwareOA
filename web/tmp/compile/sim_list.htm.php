<form id="pagerForm" method="post" action="index.php?action=sim">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="<?php echo $this->_var['numPerPage']; ?>" />
	<input type="hidden" name="carNum" value="<?php echo $_REQUEST['carNum']; ?>"/>
	<input type="hidden" name="simNum" value="<?php echo $_REQUEST['simNum']; ?>"/>
</form>
<div class="page">
<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=sim" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						车牌号:<input type="text" name="carNum" size="12" value="<?php echo $_REQUEST['carNum']; ?>"/>
					</td>
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
	
		<div class="panelBar">
			<ul class="toolBar">
				<li><a class="add" href="?action=sim&do=new" target="dialog" mask="true" rel="addsim"><span>新增SIM卡号</span></a></li>
				<!-- <li><a class="delete" href="?action=sim&do=del&id={id}" target="ajaxTodo"  title="确定要删除吗?"><span>删除SIM卡号</span></a></li> -->
				<li><a class="edit" href="?action=sim&do=edit&id={id}" target="dialog" mask="true" rel="editsim"><span>修改SIM卡号</span></a></li>
				
				
			</ul>
		</div>
		<table class="list" layouth="92" style="width:1200px;">
			<thead>
			
				<tr align=center>
					<th width="50" align="center">ID</th>
					<th width="100" align="center">车牌号</th>
					<th width="150" align="center">车架号</th>
					<th width="100" align="center">SIM卡号</th>
					<th width="100" align="center">资费</th>
					<th width="100" align="center">资费变更日期</th>
					<th width="150" align="center">SIM卡状态</th>
					<th width="100" align="center">卡状态变更日期</th>
					<th width="150" align="center">备注</th>
					<th width="200" align="center">所属分公司</th>
				</tr>	
			</thead>
			
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" align=center>
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['carNum']; ?></td>	
					<td><?php echo $this->_var['row']['chejiaNum']; ?></td>
					<td><?php echo $this->_var['row']['simNum']; ?></td>
					<td><?php echo $this->_var['row']['zifei']; ?></td>
					<td><?php if ($this->_var['row']['zichangedate'] != 0): ?><?php echo $this->_var['row']['zichangedate']; ?><?php endif; ?></td>
					<td><?php echo $this->_var['row']['simstate']; ?></td>
					<td><?php if ($this->_var['row']['changedate'] != 0): ?><?php echo $this->_var['row']['changedate']; ?><?php endif; ?></td>	
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
						<option value="20">20</option>
						<option value="50">50</option>
						<option value="100">100</option>
						<option value="200">200</option>
					</select>
				<span>条</span>
				<span>共<?php echo $this->_var['total']; ?>条</span>
			</div>
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="<?php echo $this->_var['numPerPage']; ?>" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>
		</div>
		
	</div>		
</div>	
