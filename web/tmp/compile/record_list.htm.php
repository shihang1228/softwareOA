<form id="pagerForm" method="post" action="index.php?action=record">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="<?php echo $this->_var['numPerPage']; ?>" />
	<input type="hidden" name="chejiaNum" value="<?php echo $_REQUEST['chejiaNum']; ?>"/> 
	<input type="hidden" name="carNum" value="<?php echo $_REQUEST['carNum']; ?>"/> 
	<input type="hidden" name="deviceId" value="<?php echo $_REQUEST['deviceId']; ?>"/> 
	<input type="hidden" name="simNum" value="<?php echo $_REQUEST['simNum']; ?>"/> 
	<input type="hidden" name="inputer" value="<?php echo $_REQUEST['inputer']; ?>"/> 
	<input type="hidden" name="owner" value="<?php echo $_REQUEST['owner']; ?>"/> 
	<input type="hidden" name="lasttime" value="<?php echo $_REQUEST['lasttime']; ?>"/> 
	<input type="hidden" name="judge" value="<?php echo $_REQUEST['judge']; ?>"/> 
</form>

<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=record" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						车架号:<input type="text" name="chejiaNum" size="15" value="<?php echo $_REQUEST['chejiaNum']; ?>"/>
					</td>
					<td>
						车牌号:<input type="text" name="carNum" size="15" value="<?php echo $_REQUEST['carNum']; ?>"/>
					</td>
					<td>
						终端ID:<input type="text" name="deviceId" size="15" value="<?php echo $_REQUEST['deviceId']; ?>"/>
					</td>
					<td>
						SIM卡号:<input type="text" name="simNum" size="15" value="<?php echo $_REQUEST['simNum']; ?>"/>
					</td>
					
					
				</tr>
				<td>
						操作人:<input type="text" name="inputer" size="15" value="<?php echo $_REQUEST['inputer']; ?>"/>
					</td>
					<td>
						车主/业户:<input type="text" name="owner" size="15" value="<?php echo $_REQUEST['owner']; ?>"/>
					</td>
					<td>
						操作时间:<input type="text" class="date" name="lasttime" size="15" value="<?php echo $_REQUEST['lasttime']; ?>"/>
					</td>
					<td>
						<label style="width:46px">审核状态:</label>
						<select class="combox" name="judge">
							<option value="">请选择</option>
							<option value="2">已审核</option>
							<option value="1">未审核</option>
						</select>
					</td>
					<td>
					<div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div>
					</td>
				<tr>
				
				</tr>
			</table>
		</div>
		</form>
	</div>
	<div class="pageContent">
		<div class="panelBar">
			<ul class="toolBar">
				<li><a class="add" href="?action=record&do=new" target="navTab" mask="true"><span>新增数据记录</span></a></li>
				<li><a class="delete" href="?action=record&do=del&id={id}" target="ajaxTodo"  title="确定要删除吗?"><span>删除数据记录</span></a></li>
				<li><a class="edit" href="?action=record&do=edit&id={id}" target="navTab" mask="true"><span>修改数据记录</span></a></li>
				<li><a class="add" href="?action=record&do=show&id={id}" target="navTab" mask="true"><span>明细</span></a></li>
				<li><a class="edit" href="?action=record&do=editbeizhu&id={id}" target="dialog" mask="true"><span>添加备注</span></a></li>
			</ul>
		</div>
		<table class="list" layouth="122" style="width:1585px;">
			<thead>
				<tr align=center>
					<th width="100" align="center">车牌号</th>
					<th width="150" align="center">车辆识别代码/车架号</th>
					<th width="120" align="center">终端ID</th>
					<th width="100" align="center">SIM卡号</th>
					<th width="135" align="center">车主/业户</th>
					<th width="80" align="center">联系人</th>
					<th width="100" align="center">联系手机</th>
					<th width="120" align="center">操作人</th>
					<th width="120" align="center">最后操作时间</th>
					<th width="120" align="center">审核状态</th>
					<th width="240" align="center">备注</th>
					<th width="200" align="center">所属分公司</th>
						
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" align=center>
					<td><?php echo $this->_var['row']['carNum']; ?></td>
					<td><?php echo $this->_var['row']['chejiaNum']; ?></td>
					<td><?php echo $this->_var['row']['deviceId']; ?></td>
					<td><?php echo $this->_var['row']['simNum']; ?></td>
					<td><?php echo $this->_var['row']['owner']; ?></td>
					<td><?php echo $this->_var['row']['linkman']; ?></td>
					<td><?php echo $this->_var['row']['linktel']; ?></td>
					<td><?php echo $this->_var['row']['inputer']; ?></td>	
					<td><?php if ($this->_var['row']['lasttime'] != 0): ?><?php echo $this->_var['row']['lasttime']; ?><?php endif; ?></td>		
					<td>
					<?php if ($this->_var['row']['judge'] == 1): ?>
					<a class="add" align="center" href="?action=record&do=sure&id=<?php echo $this->_var['row']['id']; ?>" target="ajaxTodo" targetType="dialog" title="是否审核？"><span>审核</span></a>
					<?php endif; ?>
					<?php if ($this->_var['row']['judge'] == 2): ?>
					已审核
					<?php endif; ?>
					</td>
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