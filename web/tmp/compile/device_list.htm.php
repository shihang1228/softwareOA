<form id="pagerForm" method="post" action="index.php?action=device">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="<?php echo $this->_var['numPerPage']; ?>" />
	<input type="hidden" name="carNum" value="<?php echo $_REQUEST['carNum']; ?>"/>
</form>
<div class="page">
<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=device" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						车牌号:<input type="text" name="carNum" size="12" value="<?php echo $_REQUEST['carNum']; ?>"/>
					</td>
					<td>
						安装人员:<input type="text" name="installperson" size="12" value="<?php echo $_REQUEST['installperson']; ?>"/>
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
				<li><a class="add" href="?action=device&do=new" target="dialog" mask="true" rel="adddevice"><span>新增设备</span></a></li>
				<!-- <li><a class="delete" href="?action=device&do=del&id={id}" target="ajaxTodo"  title="确定要删除吗?"><span>删除设备</span></a></li> -->
				<li><a class="edit" href="?action=device&do=edit&id={id}" target="dialog" mask="true"><span>修改设备信息</span></a></li>
				
			</ul>
		</div>
		<table class="list" layouth="92" style="width:1550px;word-break:break-all;">
			<thead>
			
				<tr align=center>
					<th width="50" align="center">ID</th>
					<th width="100" align="center">车牌号</th>
					<th width="150" align="center">车架号</th>
					<th width="150" align="center">设备名称</th>
					<th width="200" align="center">设备厂家</th>
					<th width="150" align="center">型号</th>
					<th width="100" align="center">主机ID号</th>
					<th width="150" align="center">安装日期</th>
					<th width="100" align="center">安装人员</th>
					<th width="100" align="center">设备金额</th>
					<th width="100" align="center">合同编号</th>
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
					<td><?php echo $this->_var['row']['name']; ?></td>
					<td><?php echo $this->_var['row']['factory']; ?></td>
					<td><?php echo $this->_var['row']['model']; ?></td>
					<td><?php echo $this->_var['row']['zhujiId']; ?></td>
					<td><?php if ($this->_var['row']['installdate'] != 0): ?><?php echo $this->_var['row']['installdate']; ?><?php endif; ?></td>
					<td><?php echo $this->_var['row']['installperson']; ?></td>
					<td><?php if ($this->_var['row']['money'] != 0): ?><?php echo $this->_var['row']['money']; ?><?php endif; ?></td>
					<td><?php echo $this->_var['row']['danhao']; ?></td>	
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
