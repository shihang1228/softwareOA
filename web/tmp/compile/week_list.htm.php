<div class="page">
<div class="pageHeader">
	<form onsubmit="return navTabSearch(this);" action="index.php?action=week" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						<label style="width:48">选择年份:</label>
						<?php echo $this->_var['year_cn']; ?>
					</td>
					<td>
						<label style="width:48">选择月份:</label>
						<select name="month" class="combox" id="w_combox_month" ref="w_combox_week" refurl="?action=week&do=week_combox&value={value}">
						<option value="">请选择</option>
						</select>
					</td>
					
					<td>
						<label style="width:38">选择周:</label>
						<select class="combox" name="week" id="w_combox_week">
						<option value="">请选择</option>
					</select>
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
				<li><a class="add" href="?action=week&do=print&week=<?php echo $this->_var['week']; ?>&month=<?php echo $this->_var['month']; ?>&mon=<?php echo $this->_var['mon']; ?>" target="dwzExport" targetType="dialog" title="是要导出这些记录吗?"><span>导出EXCEL</span></a></li>
			</ul>
		</div>
		<table class="list" layouth="92" style="width:1120px;">
			<thead>
			
				<tr align=center>
						<th colspan="2" width="200"> </th>
						<th colspan="2" width="115"><?php echo $this->_var['arr']['0']; ?></th>
						<th colspan="2" width="115"><?php echo $this->_var['arr']['1']; ?></th>
						<th colspan="2" width="115"><?php echo $this->_var['arr']['2']; ?></th>
						<th colspan="2" width="115"><?php echo $this->_var['arr']['3']; ?></th>
						<th colspan="2" width="115"><?php echo $this->_var['arr']['4']; ?></th>
						<th colspan="2" width="115"><?php echo $this->_var['arr']['5']; ?></th>
						<th colspan="2" width="115"><?php echo $this->_var['arr']['6']; ?></th>
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
					<th width="35">金额</th>
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
				<td><?php echo $this->_var['list4']['money']; ?></td>
			</tr>
			</tbody>
		</table>
	
		<div class="panelBar">

		</div>
	</div>		
</div>	
