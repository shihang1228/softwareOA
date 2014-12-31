<form id="pagerForm" method="post" action="index.php?action=supplier">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="<?php echo $this->_var['numPerPage']; ?>" />
	<input type="hidden" name="name" value="<?php echo $_REQUEST['name']; ?>"/>
	<input type="hidden" name="linkman" value="<?php echo $_REQUEST['linkman']; ?>"/>
</form>

<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=supplier" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						供货商名称:<input type="text" name="name" size="20" value="<?php echo $_REQUEST['name']; ?>"/>
					</td>
					<td>
						联系人:<input type="text" name="linkman" size="12" value="<?php echo $_REQUEST['linkman']; ?>"/>
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
				<li><a class="add" href="?action=supplier&do=new" target="dialog" mask="true"><span>添加供应商</span></a></li>
				<li><a class="edit" href="?action=supplier&do=edit&id={id}" target="dialog" mask="true"><span>修改供应商信息</span></a></li>
				<li><a class="delete" href="?action=supplier&do=del&id={id}" target="ajaxTodo"  title="确定要删除吗?"><span>删除供应商</span></a></li>
			</ul>
		</div>
		<table class="list" layouth="92" style="width:900px;">
			<thead>
				<tr align=center>
					<th width="100" align="center">ID</th>
					<th width="250" align="center">供货商名称</th>
					<th width="150" align="center">联系人</th>
					<th width="200" align="center">地址</th>	
					<th width="200" align="center">联系电话</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" align=center>
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['name']; ?></td>
					<td><?php echo $this->_var['row']['linkman']; ?></td>
					<td><?php echo $this->_var['row']['address']; ?></td>	
					<td><?php echo $this->_var['row']['phone']; ?></td>
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