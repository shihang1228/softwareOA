<form id="pagerForm" method="post" action="index.php?action=repair">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="24" />
	<input type="hidden" name="carNum" value="<?php echo $_REQUEST['carNum']; ?>"/>
	<input type="hidden" name="carNum" value="<?php echo $_REQUEST['baoxiuqi']; ?>"/>
	<input type="hidden" name="carNum" value="<?php echo $_REQUEST['jianxiufei']; ?>"/>
	<input type="hidden" name="carNum" value="<?php echo $_REQUEST['andate']; ?>"/>
</form>

<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=repair" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						车牌号:<input type="text" name="carNum" size="12" value="<?php echo $_REQUEST['carNum']; ?>"/>
					</td>
					<td>
						<label style="width:73">是否过保修期:</label>
						<select class="combox" name="baoxiuqi">
						<option value="">请选择</option>
						<option value="是">是</option>
						<option value="否">否</option>
						</select>
					</td>
					<td>
						<label style="width:85">是否收取检修费:</label>
						<select class="combox" name="jianxiufei">
						<option value="">请选择</option>
						<option value="是">是</option>
						<option value="否">否</option>
						<option value="不收">不收</option>
						</select>
					</td>
					<td>
						日期:<input type="text" name="andate" dateFmt="yyyy-MM" class="date textInput readonly valid focus" size="12" value="<?php echo $_REQUEST['andate']; ?>"/>
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
				<li><a class="add" href="?action=repair&do=new" target="dialog" mask="true" rel="addrepair"><span>新增检修终端信息</span></a></li>
				<li><a class="edit" href="?action=repair&do=edit&id={id}" target="dialog" mask="true"><span>编辑检修终端信息</span></a></li>
				<li><a class="add" href="?action=repair&do=print&date=<?php echo $this->_var['date']; ?>" target="dwzExport" targetType="dialog" title="是要导出这些记录吗?"><span>导出EXCEL</span></a></li>
			</ul>
		</div>
		<table class="list" layouth="92" style="width:1400px;">
			<thead>
				<tr align=center>
					<th align="center" width='50'>ID</th>
					<th align="center" width='150'>公司名称</th>
					<th align="center" width='100'>车牌号</th>
					<th align="center" width='80'>型号</th>
					<th align="center" width='80'>拆取日期</th>
					<th align="center" width='80'>返厂日期</th>
					<th align="center" width='80'>返回日期</th>
					<th align="center" width='80'>安装日期</th>
					<th align="center" width='100'>是否过保修期</th>
					<th align="center" width='100'>是否收取检修费</th>
					<th align="center" width='100'>拆取人</th>
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
					<td><?php echo $this->_var['row']['model']; ?></td>
					<td><?php if ($this->_var['row']['chaidate'] != 0): ?><?php echo $this->_var['row']['chaidate']; ?><?php endif; ?></td>
					<td><?php if ($this->_var['row']['changdate'] != 0): ?><?php echo $this->_var['row']['changdate']; ?><?php endif; ?></td>
					<td><?php if ($this->_var['row']['huidate'] != 0): ?><?php echo $this->_var['row']['huidate']; ?><?php endif; ?></td>
					<td><?php if ($this->_var['row']['andate'] != 0): ?><?php echo $this->_var['row']['andate']; ?><?php endif; ?></td>
					<td><?php echo $this->_var['row']['baoxiuqi']; ?></td>
					<td><?php echo $this->_var['row']['jianxiufei']; ?></td>
					<td><?php echo $this->_var['row']['chaipeople']; ?></td>
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