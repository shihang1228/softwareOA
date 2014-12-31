<div class="page">
<div class="pageHeader">
<form onsubmit="return navTabSearch(this);" action="index.php?action=month" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						<label style="width:48">选择年份:</label>
						<?php echo $this->_var['year_cn']; ?>
					</td>
					<td>
						<label style="width:48">选择月份:</label>
						<select name="month" class="combox">
						<option value="">请选择</option>
						<option value="1">1月</option>
						<option value="2">2月</option>
						<option value="3">3月</option>
						<option value="4">4月</option>
						<option value="5">5月</option>
						<option value="6">6月</option>
						<option value="7">7月</option>
						<option value="8">8月</option>
						<option value="9">9月</option>
						<option value="10">10月</option>
						<option value="11">11月</option>
						<option value="12">12月</option>
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
				<li><a class="add" href="?action=month&do=print&date=<?php echo $this->_var['date']; ?>&date1=<?php echo $this->_var['date1']; ?>" target="dwzExport" targetType="dialog" title="是要导出这些记录吗?"><span>导出EXCEL</span></a></li>
			</ul>
		</div>
		<table class="list" layouth="92" style="width:1005px;">
			<thead>
			
				<tr align=center>
					<th colspan="2" width="200"> </th>
					<th colspan="2" width="115">第一周</th>
					<th colspan="2" width="115">第二周</th>
					<th colspan="2" width="115">第三周</th>
					<th colspan="2" width="115">第四周</th>
					<th colspan="2" width="115">第五周</th>
					<th colspan="2" width="115">第六周</th>
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
					<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 1 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['quantity']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 1 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['money']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 2 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['quantity']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 2 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['money']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 3 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['quantity']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 3 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['money']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 4 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['quantity']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 4 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['money']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 5 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['quantity']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 5 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['money']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 6 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['quantity']; ?><?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row']['a'] == 6 && $this->_var['row']['name'] == $this->_var['row1']['name'] && $this->_var['row']['biaoshi'] == $this->_var['row1']['biaoshi']): ?><?php echo $this->_var['row']['money']; ?><?php endif; ?>
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
			 <?php $_from = $this->_var['list5']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row5');if (count($_from)):
    foreach ($_from AS $this->_var['row5']):
?>
			 <?php if ($this->_var['row5']['a'] == 1): ?><?php echo $this->_var['row5']['money']; ?><?php endif; ?>
			 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			 </td>
			  <td></td>
			 <td> 
			 <?php $_from = $this->_var['list5']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row5');if (count($_from)):
    foreach ($_from AS $this->_var['row5']):
?>
			 <?php if ($this->_var['row5']['a'] == 2): ?><?php echo $this->_var['row5']['money']; ?><?php endif; ?>
			 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			 </td>
			  <td></td>
			 <td> 
			 <?php $_from = $this->_var['list5']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row5');if (count($_from)):
    foreach ($_from AS $this->_var['row5']):
?>
			 <?php if ($this->_var['row5']['a'] == 3): ?><?php echo $this->_var['row5']['money']; ?><?php endif; ?>
			 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			 </td>
			  <td></td>
			 <td> 
			 <?php $_from = $this->_var['list5']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row5');if (count($_from)):
    foreach ($_from AS $this->_var['row5']):
?>
			 <?php if ($this->_var['row5']['a'] == 4): ?><?php echo $this->_var['row5']['money']; ?><?php endif; ?>
			 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			 </td>
			  <td></td>
			 <td> 
			 <?php $_from = $this->_var['list5']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row5');if (count($_from)):
    foreach ($_from AS $this->_var['row5']):
?>
			 <?php if ($this->_var['row5']['a'] == 5): ?><?php echo $this->_var['row5']['money']; ?><?php endif; ?>
			 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			 </td>
			  <td></td>
			 <td> 
			 <?php $_from = $this->_var['list5']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row5');if (count($_from)):
    foreach ($_from AS $this->_var['row5']):
?>
			 <?php if ($this->_var['row5']['a'] == 6): ?><?php echo $this->_var['row5']['money']; ?><?php endif; ?>
			 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			 </td>
			 <td></td>
			 <td><?php echo $this->_var['list6']['money']; ?></td>
			</tr>
			</tbody>
		</table>
	
		<div class="panelBar">

		</div>
		
	</div>		
</div>	
