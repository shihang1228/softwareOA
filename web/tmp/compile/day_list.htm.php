<div class="page">
<div class="pageHeader">
<form onsubmit="return navTabSearch(this);" action="index.php?action=day" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						选择日期:<input type="text" name="date1" class="date" size="12" value="<?php echo $_REQUEST['date1']; ?>"/>
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
				<li><a class="add" href="?action=day&do=print&date=<?php echo $this->_var['date']; ?>" target="dwzExport" targetType="dialog" title="是要导出这些记录吗?"><span>导出EXCEL</span></a></li>
			</ul>
		</div>
		<table class="list" layouth="92" style="width:320px;">
			<thead>
			
				<tr align=center>
					<th colspan="2" width="200"> </th>
					<th colspan="2" width="120"><?php echo $this->_var['row']['date1']; ?></th>
				</tr>
				<tr align=center>
					<th width="80"> </th>
					<th width="120"> </th>
					<th width="40">数量</th>
					<th width="80">金额</th>
				</tr>
			</thead>
			<tbody>
			<tr align=center>
				<?php $_from = $this->_var['list2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row2');if (count($_from)):
    foreach ($_from AS $this->_var['row2']):
?>
					<td rowspan="<?php echo $this->_var['row2']['c']; ?>"><?php echo $this->_var['row2']['biaoshi']; ?></td>
					<?php $_from = $this->_var['list1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row1');if (count($_from)):
    foreach ($_from AS $this->_var['row1']):
?>
					<?php if ($this->_var['row1']['biaoshi'] == $this->_var['row2']['biaoshi']): ?>
					<td><?php echo $this->_var['row1']['name']; ?></td>
					<td>
					<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row_0_30595800_1416558532');if (count($_from)):
    foreach ($_from AS $this->_var['row_0_30595800_1416558532']):
?>
					<?php if ($this->_var['row_0_30595800_1416558532']['name'] == $this->_var['row1']['name'] && $this->_var['row_0_30595800_1416558532']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row_0_30595800_1416558532']['quantity']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row_0_30595800_1416558532');if (count($_from)):
    foreach ($_from AS $this->_var['row_0_30595800_1416558532']):
?>
					<?php if ($this->_var['row_0_30595800_1416558532']['name'] == $this->_var['row1']['name'] && $this->_var['row_0_30595800_1416558532']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row_0_30595800_1416558532']['money']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
				</tr>
				<tr align=center>
				<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tr>
			<tr align=center>
			<td>合 计</td>
			<td></td>
			<td></td>
			<td><?php echo $this->_var['list5']['money']; ?></td>
			</tr>
			</tbody>
		</table>
	
		<div class="panelBar">

		</div>
		
	</div>		
</div>	
