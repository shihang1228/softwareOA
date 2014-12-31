<form id="pagerForm" method="post" action="index.php?action=detail">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="<?php echo $this->_var['numPerPage']; ?>" />
	<input type="hidden" name="year" value="<?php echo $_REQUEST['year']; ?>"/>
	<input type="hidden" name="month" value="<?php echo $_REQUEST['month']; ?>"/>
</form>

<div class="page">
<div class="pageHeader">
<form onsubmit="return navTabSearch(this);" action="index.php?action=detail" method="post">
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
			<?php if ($this->_var['date3'] == $this->_var['date1']): ?>
				<li><a class="edit" href="?action=detail&do=edit&id={id}" target="dialog" mask="true"><span>添加备注</span></a></li>
			<?php endif; ?>
				<li><a class="add" href="?action=detail&do=print&date=<?php echo $this->_var['date']; ?>" target="dwzExport" targetType="dialog" title="是要导出这些记录吗?"><span>导出EXCEL</span></a></li>
			</ul>
		</div>
		<table class="list" layouth="92" style="width:1300px;">
			<thead>
				<tr align=center>
					<th align="center" width='50'>ID</th>
					<th align="center" width='130'>商品名称</th>
					<th align="center" width='100'>型号</th>
					<th align="center" width='200'>供货商</th>
					<th align="center" width='100'>库房名称</th>
					<th align="center" width='60'>接上月库存</th>
					<th align="center" width='60'>本月入库数量</th>
					<th align="center" width='60'>本月出库数量</th>
					<th align="center" width='60'>出库收款数量</th>
					<th align="center" width='60'>当前库存</th>
					<th align="center" width='200'>备注</th>
					<th align="center" width='80'>操作者</th>
					<th align="center" width='70'>本年累计入库数</th>
					<th align="center" width='70'>本年累计出库数</th>
				</tr>
			</thead>
			
			<tbody>			
			<?php $_from = $this->_var['name_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" align=center>
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['pname']; ?></td>
					<td><?php echo $this->_var['row']['model']; ?></td>
					<td><?php echo $this->_var['row']['sname']; ?></td>
					<td><?php echo $this->_var['row']['rname']; ?></td>
					<td>
					<?php $_from = $this->_var['last_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row4');if (count($_from)):
    foreach ($_from AS $this->_var['row4']):
?>
					<?php if ($this->_var['row']['pname'] == $this->_var['row4']['pname'] && $this->_var['row']['model'] == $this->_var['row4']['model'] && $this->_var['row']['sname'] == $this->_var['row4']['sname'] && $this->_var['row']['rname'] == $this->_var['row4']['rname']): ?>
					<?php echo $this->_var['row4']['lastkucun']; ?>
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row2');if (count($_from)):
    foreach ($_from AS $this->_var['row2']):
?>
					<?php if ($this->_var['row']['pname'] == $this->_var['row2']['pname'] && $this->_var['row']['model'] == $this->_var['row2']['model'] && $this->_var['row']['sname'] == $this->_var['row2']['sname'] && $this->_var['row']['rname'] == $this->_var['row2']['rname']): ?>
					<?php echo $this->_var['row2']['curruquantity']; ?>
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row2');if (count($_from)):
    foreach ($_from AS $this->_var['row2']):
?>
					<?php if ($this->_var['row']['pname'] == $this->_var['row2']['pname'] && $this->_var['row']['model'] == $this->_var['row2']['model'] && $this->_var['row']['sname'] == $this->_var['row2']['sname'] && $this->_var['row']['rname'] == $this->_var['row2']['rname']): ?>
					<?php echo $this->_var['row2']['curchuquantity']; ?>
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row2');if (count($_from)):
    foreach ($_from AS $this->_var['row2']):
?>
					<?php if ($this->_var['row']['pname'] == $this->_var['row2']['pname'] && $this->_var['row']['model'] == $this->_var['row2']['model'] && $this->_var['row']['sname'] == $this->_var['row2']['sname'] && $this->_var['row']['rname'] == $this->_var['row2']['rname']): ?>
					<?php echo $this->_var['row2']['shouquantity']; ?>
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row2');if (count($_from)):
    foreach ($_from AS $this->_var['row2']):
?>
					<?php if ($this->_var['row']['pname'] == $this->_var['row2']['pname'] && $this->_var['row']['model'] == $this->_var['row2']['model'] && $this->_var['row']['sname'] == $this->_var['row2']['sname'] && $this->_var['row']['rname'] == $this->_var['row2']['rname']): ?>
					<?php echo $this->_var['row2']['kucun']; ?>
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row2');if (count($_from)):
    foreach ($_from AS $this->_var['row2']):
?>
					<?php if ($this->_var['row']['pname'] == $this->_var['row2']['pname'] && $this->_var['row']['model'] == $this->_var['row2']['model'] && $this->_var['row']['sname'] == $this->_var['row2']['sname'] && $this->_var['row']['rname'] == $this->_var['row2']['rname']): ?>
					<?php echo $this->_var['row2']['beizhu']; ?>
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row2');if (count($_from)):
    foreach ($_from AS $this->_var['row2']):
?>
					<?php if ($this->_var['row']['pname'] == $this->_var['row2']['pname'] && $this->_var['row']['model'] == $this->_var['row2']['model'] && $this->_var['row']['sname'] == $this->_var['row2']['sname'] && $this->_var['row']['rname'] == $this->_var['row2']['rname']): ?>
					<?php echo $this->_var['row2']['inputer']; ?>
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					
					<td>
					<?php $_from = $this->_var['year_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row3');if (count($_from)):
    foreach ($_from AS $this->_var['row3']):
?>
					<?php if ($this->_var['row']['pname'] == $this->_var['row3']['pname'] && $this->_var['row']['model'] == $this->_var['row3']['model'] && $this->_var['row']['sname'] == $this->_var['row3']['sname'] && $this->_var['row']['rname'] == $this->_var['row3']['rname']): ?>
					<?php echo $this->_var['row3']['yearruquantity']; ?>
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					<td>
					<?php $_from = $this->_var['year_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row3');if (count($_from)):
    foreach ($_from AS $this->_var['row3']):
?>
					<?php if ($this->_var['row']['pname'] == $this->_var['row3']['pname'] && $this->_var['row']['model'] == $this->_var['row3']['model'] && $this->_var['row']['sname'] == $this->_var['row3']['sname'] && $this->_var['row']['rname'] == $this->_var['row3']['rname']): ?>
					<?php echo $this->_var['row3']['yearchuquantity']; ?>
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</td>
					
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