<form id="pagerForm" method="post" action="index.php?action=diaoboagree">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="24" />
	<input type="hidden" name="roomruId" value="<?php echo $_REQUEST['roomruId']; ?>"/> 
	<input type="hidden" name="roomchuId" value="<?php echo $_REQUEST['roomchuId']; ?>"/>
</form>

<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=diaoboagree" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>	
					<td>
					<label style="width:48">调入库房:</label>
					<?php echo $this->_var['roomruId_cn']; ?>
					</td>
				
					<td>
					<label style="width:48">调出库房:</label>
					<?php echo $this->_var['roomchuId_cn']; ?>
					</td>
					<td>
						登记时间:<input type="text" name="time_start" size="9" class="date" readonly="true" value="<?php echo $_REQUEST['time_start']; ?>"/>
						-<input type="text" name="time_over" size="9" class="date" readonly="true" value="<?php echo $_REQUEST['time_over']; ?>"/>
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
		
		<table class="list" layouth="66" style="width:1400px;">
			<thead>
				<tr align=center>
					<th width="50" align="center">ID</th>
					<th width="200" align="center">商品名称</th>
					<th width="150" align="center">型号</th>
					<th width="200" align="center">供货商</th>
					<th width="100" align="center">数量</th>
					<th width="150" align="center">调出库房</th>
					<th width="150" align="center">调入库房</th>
					<th width="200" align="center">时间</th>
					<th width="100" align="center">操作者</th>
					<th width="100" align="center">确认调拨</th>
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
					<td><?php echo $this->_var['row']['sname']; ?></td>
					<td><?php echo $this->_var['row']['quantity']; ?></td>
					<td><?php echo $this->_var['row']['roomchu']; ?></td>
					<td><?php echo $this->_var['row']['roomru']; ?></td>
					<td><?php echo $this->_var['row']['agreetime']; ?></td>
					<td><?php echo $this->_var['row']['person']; ?></td>
					<?php if ($this->_var['row']['judge'] == 1): ?>
					<td><a class="add" href="?action=diaoboagree&do=sure&id=<?php echo $this->_var['row']['id']; ?>" target="ajaxTodo" targetType="dialog" title="是否同意调拨？"><span>确认调拨</span></a></td><?php endif; ?>
					<?php if ($this->_var['row']['judge'] == 2): ?><td>已确认</td><?php endif; ?>
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