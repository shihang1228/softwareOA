<form id="pagerForm" method="post" action="index.php?action=fuwu">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="<?php echo $this->_var['numPerPage']; ?>" />
	<input type="hidden" name="carNum" value="<?php echo $_REQUEST['carNum']; ?>"/>
	<input type="hidden" name="inputer" value="<?php echo $_REQUEST['inputer']; ?>"/>
</form>


<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=fuwu" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						车牌号:<input type="text" name="carNum" size="12" value="<?php echo $_REQUEST['carNum']; ?>"/>
					</td>
					<td>
						操作者:<input type="text" name="inputer" size="12" value="<?php echo $_REQUEST['inputer']; ?>"/>
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
				
				<li><a class="add" href="?action=fuwu&do=new" target="dialog" mask="true" width="600" height="400"><span>新增虚拟商品销售记录</span></a></li>
				
			</ul>
		</div>
		
		<table class="list" layouth="92" style="width:830px;">
			<thead>
				<tr align=center>
					<th align="center" width="50">ID</th>
					<th align="center" width="110">车牌号</th>
					<th align="center" width="120">费用类型</th>
					<th align="center" width="100">金额</th>
					<th align="center" width="130">时间</th>
					<th align="center" width="120">操作者</th>
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
					<td><?php echo $this->_var['row']['name']; ?></td>
					<td><?php echo $this->_var['row']['money']; ?></td>
					<td><?php echo $this->_var['row']['feetime']; ?></td>
					<td><?php echo $this->_var['row']['inputer']; ?></td>
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