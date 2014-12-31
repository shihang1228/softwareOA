<form id="pagerForm" method="post" action="index.php?action=install">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="<?php echo $this->_var['numPerPage']; ?>" />
	<input type="hidden" name="anperson" value="<?php echo $_REQUEST['anperson']; ?>"/>
	<input type="hidden" name="installdate" value="<?php echo $_REQUEST['installdate']; ?>"/>
</form>

<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=install" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						安装人员:<input type="text" name="anperson" size="12" value="<?php echo $_REQUEST['anperson']; ?>"/>
					</td>
					<td>
						安装日期:<input type="text" name="installdate" class="date" size="12" value="<?php echo $_REQUEST['installdate']; ?>"/>
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
				<li><a class="add" href="?action=install&do=new" target="dialog" mask="true"><span>新增安装信息</span></a></li>
				<li><a class="delete" href="?action=install&do=del&id={id}" target="ajaxTodo"  title="确定要删除吗?"><span>删除安装信息</span></a></li>
				<li><a class="edit" href="?action=install&do=edit&id={id}" target="dialog" mask="true"><span>修改安装信息</span></a></li>
				
			</ul>
		</div>
		<table class="list" layouth="92" style="width:1440px;">
			<thead>
				<tr align=center>
					<th width="40" align="center">ID</th>
					<th width="100" align="center">车牌号</th>
					<th width="100" align="center">速度线束</th>
					<th width="100" align="center">常火线束</th>
					<th width="100" align="center">ACC线束</th>
					<th width="100" align="center">搭铁线束</th>
					<th width="100" align="center">刹车线束</th>
					<th width="100" align="center">远光线束</th>
					<th width="100" align="center">近光线束</th>
					<th width="100" align="center">左转向线束</th>
					<th width="100" align="center">右转向线束</th>
					<th width="100" align="center">摄像头1</th>
					<th width="100" align="center">摄像头2</th>
					<th width="100" align="center">摄像头3</th>
					<th width="100" align="center">摄像头4</th>			
					<th width="300" align="center">所属分公司</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" align=center>
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['carNum']; ?></td>	
					<td><?php echo $this->_var['row']['line1']; ?></td>	
					<td><?php echo $this->_var['row']['line2']; ?></td>	
					<td><?php echo $this->_var['row']['line3']; ?></td>	
					<td><?php echo $this->_var['row']['line4']; ?></td>	
					<td><?php echo $this->_var['row']['line5']; ?></td>	
					<td><?php echo $this->_var['row']['line6']; ?></td>	
					<td><?php echo $this->_var['row']['line7']; ?></td>
					<td><?php echo $this->_var['row']['line8']; ?></td>
					<td><?php echo $this->_var['row']['line9']; ?></td>
					<td><?php echo $this->_var['row']['camera1']; ?></td>
					<td><?php echo $this->_var['row']['camera2']; ?></td>
					<td><?php echo $this->_var['row']['camera3']; ?></td>
					<td><?php echo $this->_var['row']['camera4']; ?></td>
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