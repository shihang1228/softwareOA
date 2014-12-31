<form id="pagerForm" method="post" action="index.php?action=storage_ru">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="<?php echo $this->_var['numPerPage']; ?>" />
	<input type="hidden" name="time_start" value="<?php echo $_REQUEST['time_start']; ?>"/>
	<input type="hidden" name="time_over" value="<?php echo $_REQUEST['time_over']; ?>"/>
	 <input type="hidden" name="pname" value="<?php echo $_REQUEST['pname']; ?>"/> 
	<input type="hidden" name="roomId" value="<?php echo $_REQUEST['roomId']; ?>"/>
	<input type="hidden" name="supplierId" value="<?php echo $_REQUEST['supplierId']; ?>"/>
	<input type="hidden" name="inputer" value="<?php echo $_REQUEST['inputer']; ?>"/>
</form>

<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=storage_ru" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						物品名称:<input type="text" name="pname" size="12" value="<?php echo $_REQUEST['pname']; ?>"/>
					</td>	
					<td>
						<label style="width:48">选择库房:</label>
						<?php echo $this->_var['roomId_cn']; ?>
					</td>
				
					<td>
						<label style="width:60">选择供货商:</label>
						<?php echo $this->_var['supplierId_cn']; ?>
					</td>
					<td>
						登记时间:<input type="text" name="time_start" size="9" class="date" readonly="true" value="<?php echo $_REQUEST['time_start']; ?>"/>
						-<input type="text" name="time_over" size="9" class="date" readonly="true" value="<?php echo $_REQUEST['time_over']; ?>"/>
					</td>
					<td>
						操作者:<input type="timestamp" name="inputer" size="12" value="<?php echo $_REQUEST['inputer']; ?>"/>
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
		
		<table class="list" layouth="66" style="width:1360px;">
			<thead>
				<tr align=center>
					<th width="50" align="center">ID</th>
					<th width="180" align="center">商品名称</th>
					<th width="100" align="center">型号</th>
					<th width="100" align="center">数量</th>
					<th width="200" align="center">供货商名称</th>
					<th width="150" align="center">库房名称</th>
					<th width="180" align="center">入库时间</th>
					<th width="100" align="center">操作者</th>
					<th width="100" align="center">确认入库</th>
					<th width="200" align="center">所属分公司</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" align=center>
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['pname']; ?></td>
					<td><?php echo $this->_var['row']['model']; ?></td>
					<td><?php echo $this->_var['row']['quantity']; ?></td>
					<td><?php echo $this->_var['row']['sname']; ?></td>
					<td><?php echo $this->_var['row']['rname']; ?></td>
					<td><?php echo $this->_var['row']['rukutime']; ?></td>
					<td><?php echo $this->_var['row']['kuguanName']; ?></td>
					<?php if ($this->_var['row']['judge'] == 1): ?>
					<td><a class="add" align="center" href="?action=storage_ru&do=sure&id=<?php echo $this->_var['row']['id']; ?>" target="ajaxTodo" targetType="dialog" title="是否确认入库？"><span>确认入库</span></a></td>
					<?php endif; ?>
					<?php if ($this->_var['row']['judge'] == 2): ?>
					<td>已入库</td>
					<?php endif; ?>
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