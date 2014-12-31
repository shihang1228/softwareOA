<form id="pagerForm" method="post" action="index.php?action=car">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="<?php echo $this->_var['numPerPage']; ?>" />
	<input type="hidden" name="company" value="<?php echo $_REQUEST['company']; ?>"/>
	<input type="hidden" name="carNum" value="<?php echo $_REQUEST['carNum']; ?>"/>
	<input type="hidden" name="carleixing" value="<?php echo $_REQUEST['carleixing']; ?>"/>
	<input type="hidden" name="carstateId" value="<?php echo $_REQUEST['carstateId']; ?>"/>
	<input type="hidden" name="platform" value="<?php echo $_REQUEST['platform']; ?>"/>
</form>
<div class="page">
<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=car" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						<label style="width:48">公司名称:</label>
						<?php echo $this->_var['company_cn']; ?>
					</td>
					<td>
						车牌号:<input type="text" name="carNum" size="12" value="<?php echo $_REQUEST['carNum']; ?>"/>
					</td>
					<td>
						<label style="width:48">车辆类型:</label>
						<?php echo $this->_var['carleixing_cn']; ?>
					</td>
					<td>
						<label style="width:48">车辆状态:</label>
						<?php echo $this->_var['carstateId_cn']; ?>
					</td>
				</tr>
				<tr>
					<td>
						<label style="width:48">选择平台:</label>
						<?php echo $this->_var['platform_cn']; ?>
					</td>
					<td>
						<label style="width:82">是否安装双设备:</label>
						<select class="combox required" name="doubledevice">
						<option value="">请选择</option>
						<option value="是">是</option>
						<option value="否">否</option>
						<option value="特殊">特殊</option>
						</select>
					</td>
					<td>
						<label style="width:95">是否属于转发车辆:</label>
						<select class="combox required" name="zhuanfa">
						<option value="">请选择</option>
						<option value="是">是</option>
						<option value="否">否</option>
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
				<li><a class="add" href="?action=car&do=new" target="dialog" mask="true" rel="addcar"><span>新增车辆</span></a></li>
				<!-- <li><a class="delete" href="?action=car&do=del&id={id}" target="ajaxTodo"  title="确定要删除吗?"><span>删除车辆</span></a></li> -->
				<li><a class="edit" href="?action=car&do=edit&id={id}" target="dialog" mask="true" rel="editcar"><span>修改车辆信息</span></a></li>
				<!-- <li><a class="edit" href="?action=car&do=editfuwufei&id={id}" target="dialog" mask="true"><span>修改车辆服务费</span></a></li> -->
				<li><a class="edit" href="?action=car&do=editstop&id={id}" target="dialog" mask="true"><span>编辑停运车辆信息</span></a></li>
				<li><a class="edit" href="?action=car&do=edittransfer&id={id}" target="dialog" mask="true"><span>编辑更新车辆信息</span></a></li>
			</ul>
		</div>
		<table class="list" layouth="120" style="width:2050px;word-break:break-all;">
			<thead>
			
				<tr align=center>
					<th width="50" align="center">ID</th>
					<th width="200" align="center">公司名称</th>
					<th width="100" align="center">车牌号</th>
					
					<th width="180" align="center">车架号</th>
					<th width="160" align="center">平台</th>
					<th width="100" align="center">车辆类型</th>
					<th width="80" align="center">车辆状态</th>
					<th width="150" align="center">行车证审验日期</th>
					<th width="120" align="center">线路</th>
					<th width="150" align="center">联系人</th>
					<th width="100" align="center">联系电话</th>
					<th width="80" align="center">每年需交服务费</th>
					<th width="80" align="center">是否转发车辆</th>
					<th width="150" align="center">停运日期</th>
					<th width="150" align="center">恢复运营日期</th>
					<th width="100" align="center">是否办理减款</th>
					<th width="200" align="center">所属分公司</th>
				</tr>	
			</thead>
			
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" align=center>
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td width="200px" style="word-break:break-all;"><?php echo $this->_var['row']['company']; ?></td>	
					<td><?php echo $this->_var['row']['carNum']; ?></td>

					<td><?php echo $this->_var['row']['chejiaNum']; ?></td>
					<td><?php echo $this->_var['row']['platform']; ?></td>
					<td><?php echo $this->_var['row']['carleixing']; ?></td>
					<td><?php echo $this->_var['row']['carstate']; ?></td>
					<td><?php if ($this->_var['row']['zhengdate'] != 0): ?><?php echo $this->_var['row']['zhengdate']; ?><?php endif; ?></td>
					<td><?php echo $this->_var['row']['xianlu']; ?></td>
					<td><?php echo $this->_var['row']['linkname']; ?></td>	
					<td><?php echo $this->_var['row']['tel']; ?></td>	
					<td><?php if ($this->_var['row']['fuwufei'] != 0): ?><?php echo $this->_var['row']['fuwufei']; ?><?php endif; ?></td>
					<td><?php echo $this->_var['row']['zhuanfa']; ?></td>						
					<td><?php if ($this->_var['row']['stopdate'] != 0): ?><?php echo $this->_var['row']['stopdate']; ?><?php endif; ?></td>	
					<td><?php if ($this->_var['row']['startdate'] != 0): ?><?php echo $this->_var['row']['startdate']; ?><?php endif; ?></td>
					<?php if ($this->_var['row']['judge'] == 0): ?>
					<td></td>	
					<?php endif; ?>	
					<?php if ($this->_var['row']['judge'] == 1): ?>
					<td><a class="add" align="center" href="?action=car&do=sure&id=<?php echo $this->_var['row']['id']; ?>" target="ajaxTodo" targetType="navTab" title="是否减款？"><span>减款</span></a></td>
					<?php endif; ?>
					<?php if ($this->_var['row']['judge'] == 2): ?>
					<td>已减款</td>
					<?php endif; ?>
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
