<div class="page">
	<div class="pageContent">
			<div class="pageFormContent" layoutH="56">
				<table class="list" style="width:550px;">
			<thead>
				<tr align=center>
					<th width="20" align="center">ID</th>
					<th width="100" align="center">车牌号</th>
					<th width="100" align="center">还款金额</th>
					<th width="120" align="center">还款日期</th>
					<th width="210" align="center">备注</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" align=center>
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['carNum']; ?></td>	
					<td><?php if ($this->_var['row']['getmoney'] != 0): ?><?php echo $this->_var['row']['getmoney']; ?><?php endif; ?></td>
					<td><?php if ($this->_var['row']['truedate'] != 0): ?><?php echo $this->_var['row']['truedate']; ?><?php endif; ?></td>
					<td><?php echo $this->_var['row']['beizhu']; ?></td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
			</div>
	</div>
</div>