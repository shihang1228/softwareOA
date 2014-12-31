<div class="page">
<div class="pageHeader">
	<form onsubmit="return navTabSearch(this);" action="index.php?action=year">
	<div class="searchBar">
		<table class="searchContent">
			<tr>
				<td>
				<label style="width:48">选择年份:</label>
				<?php echo $this->_var['year_cn']; ?>
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
				<li><a class="add" href="?action=year&do=print&date=<?php echo $this->_var['date']; ?>&date2=<?php echo $this->_var['date2']; ?>&year=<?php echo $this->_var['year']; ?>" target="dwzExport" targetType="dialog" title="是要导出这些记录吗?"><span>导出EXCEL</span></a></li>
			</ul>
		</div>
		<table class="list" layouth="92" style="width:1695px;">
			<thead>
			
				<tr align=center>
					<th colspan="2" width="200"> </th>
					<th colspan="2" width="115">一月</th>
					<th colspan="2" width="115">二月</th>
					<th colspan="2" width="115">三月</th>
					<th colspan="2" width="115">四月</th>
					<th colspan="2" width="115">五月</th>
					<th colspan="2" width="115">六月</th>
					<th colspan="2" width="115">七月</th>
					<th colspan="2" width="115">八月</th>
					<th colspan="2" width="115">九月</th>
					<th colspan="2" width="115">十月</th>
					<th colspan="2" width="115">十一月</th>
					<th colspan="2" width="115">十二月</th>
					<th colspan="2" width="115">合计</th>
				</tr>
				<tr align=center>
					<th width="80"> </th>
					<th width="120"> </th>
					<th width="35">数量</th>
					<th width="80">金额</th>
					<th width="35">数量</th>
					<th width="80">金额</th>
					<th width="35">数量</th>
					<th width="80">金额</th>
					<th width="35">数量</th>
					<th width="80">金额</th>
					<th width="35">数量</th>
					<th width="80">金额</th>
					<th width="35">数量</th>
					<th width="80">金额</th>
					<th width="35">数量</th>
					<th width="80">金额</th>
					<th width="35">数量</th>
					<th width="80">金额</th>
					<th width="35">数量</th>
					<th width="80">金额</th>
					<th width="35">数量</th>
					<th width="80">金额</th>
					<th width="35">数量</th>
					<th width="80">金额</th>
					<th width="35">数量</th>
					<th width="80">金额</th>
					<th width="35">数量</th>
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
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 1 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['quantity']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 1 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['money']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 2 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['quantity']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 2 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['money']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 3 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['quantity']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 3 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['money']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 4 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['quantity']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 4 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['money']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 5 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['quantity']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 5 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['money']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 6 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['quantity']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 6 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['money']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 7 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['quantity']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 7 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['money']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 8 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['quantity']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 8 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['money']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 9 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['quantity']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 9 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['money']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 10 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['quantity']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 10 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['money']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 11 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['quantity']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 11 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['money']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 12 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['quantity']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 12 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['money']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php echo $this->_var['row1']['q']; ?>
					</td>
					<td>
					<?php echo $this->_var['row1']['m']; ?>
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
				<td>
				<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row3');if (count($_from)):
    foreach ($_from AS $this->_var['row3']):
?>
				<?php if ($this->_var['row3']['a'] == 1): ?><?php echo $this->_var['row3']['money']; ?><?php endif; ?>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</td>
				<td></td>
				<td>
				<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row3');if (count($_from)):
    foreach ($_from AS $this->_var['row3']):
?>
				<?php if ($this->_var['row3']['a'] == 2): ?><?php echo $this->_var['row3']['money']; ?><?php endif; ?>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</td>
				<td></td>
				<td>
				<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row3');if (count($_from)):
    foreach ($_from AS $this->_var['row3']):
?>
				<?php if ($this->_var['row3']['a'] == 3): ?><?php echo $this->_var['row3']['money']; ?><?php endif; ?>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</td>
				<td></td>
				<td>
				<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row3');if (count($_from)):
    foreach ($_from AS $this->_var['row3']):
?>
				<?php if ($this->_var['row3']['a'] == 4): ?><?php echo $this->_var['row3']['money']; ?><?php endif; ?>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</td>
				<td></td>
				<td>
				<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row3');if (count($_from)):
    foreach ($_from AS $this->_var['row3']):
?>
				<?php if ($this->_var['row3']['a'] == 5): ?><?php echo $this->_var['row3']['money']; ?><?php endif; ?>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</td>
				<td></td>
				<td>
				<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row3');if (count($_from)):
    foreach ($_from AS $this->_var['row3']):
?>
				<?php if ($this->_var['row3']['a'] == 6): ?><?php echo $this->_var['row3']['money']; ?><?php endif; ?>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</td>
				<td></td>
				<td>
				<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row3');if (count($_from)):
    foreach ($_from AS $this->_var['row3']):
?>
				<?php if ($this->_var['row3']['a'] == 7): ?><?php echo $this->_var['row3']['money']; ?><?php endif; ?>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</td>
				<td></td>
				<td>
				<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row3');if (count($_from)):
    foreach ($_from AS $this->_var['row3']):
?>
				<?php if ($this->_var['row3']['a'] == 8): ?><?php echo $this->_var['row3']['money']; ?><?php endif; ?>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</td><td></td>
				<td>
				<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row3');if (count($_from)):
    foreach ($_from AS $this->_var['row3']):
?>
				<?php if ($this->_var['row3']['a'] == 9): ?><?php echo $this->_var['row3']['money']; ?><?php endif; ?>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</td><td></td>
				<td>
				<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row3');if (count($_from)):
    foreach ($_from AS $this->_var['row3']):
?>
				<?php if ($this->_var['row3']['a'] == 10): ?><?php echo $this->_var['row3']['money']; ?><?php endif; ?>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</td>
				<td></td>
				<td>
				<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row3');if (count($_from)):
    foreach ($_from AS $this->_var['row3']):
?>
				<?php if ($this->_var['row3']['a'] == 11): ?><?php echo $this->_var['row3']['money']; ?><?php endif; ?>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</td>
				<td></td>
				<td>
				<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row3');if (count($_from)):
    foreach ($_from AS $this->_var['row3']):
?>
				<?php if ($this->_var['row3']['a'] == 12): ?><?php echo $this->_var['row3']['money']; ?><?php endif; ?>
				<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</td>
				<td></td>
				<td><?php echo $this->_var['list4']['money']; ?></td>
				
			</tr>
			</tbody>
		</table>
	
		<div class="panelBar">

		</div>
		
	</div>		
</div>	
