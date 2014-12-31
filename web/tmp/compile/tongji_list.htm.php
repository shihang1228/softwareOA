<div class="page">
<div class="pageHeader">
	<form onsubmit="return navTabSearch(this);" action="index.php?action=tongji">
	<div class="searchBar">
		<table class="searchContent">
			<tr>
				<td>
				选择月份:<input type="text" name="date" dateFmt="yyyy-M" class="date textInput readonly valid focus" size="12" value="<?php echo $_REQUEST['date']; ?>"/>
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
				<li><a class="add" href="?action=tongji&do=print&date=<?php echo $this->_var['date']; ?>&date1=<?php echo $this->_var['date1']; ?>" target="dwzExport" targetType="dialog" title="是要导出这些记录吗?"><span>导出EXCEL</span></a></li>
			</ul>
		</div>
		<table class="list" layouth="92" style="width:700px;">
			<thead>
			
				<tr align=center>
					<th width="100" align="center" rowspan="2">维修人员</th>
					<th width="100" align="center" rowspan="2">本月总金额</th>
					<th width="500" align="center" colspan="3">明细</th>
				</tr>
				<tr>
					<th width="300" align="center">维修项目</th>
					<th width="100" align="center">维修次数</th>
					<th width="100" align="center">项目总金额</th>
				</tr>
			</thead>
			<tbody>
				<tr align=center>
				<?php $_from = $this->_var['list2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row2');if (count($_from)):
    foreach ($_from AS $this->_var['row2']):
?>
					<td rowspan="<?php echo $this->_var['row2']['c']; ?>"><?php echo $this->_var['row2']['name']; ?></td>
					<td rowspan="<?php echo $this->_var['row2']['c']; ?>"><?php echo $this->_var['row2']['money']; ?></td>
					<?php $_from = $this->_var['list1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row1');if (count($_from)):
    foreach ($_from AS $this->_var['row1']):
?>
					<?php if ($this->_var['row1']['name'] == $this->_var['row2']['name']): ?>
					<td><?php echo $this->_var['row1']['weixiuproject']; ?></td>
					<td><?php echo $this->_var['row1']['num']; ?></td>
					<td><?php echo $this->_var['row1']['money']; ?></td>
					
				</tr>
				<tr align=center>
				<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>		
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tr>
			</tbody>
		</table>
	
		<div class="panelBar">

		</div>
		
	</div>		
</div>	
