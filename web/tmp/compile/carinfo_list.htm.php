<form id="pagerForm" method="post" action="index.php?action=carinfo">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="<?php echo $this->_var['numPerPage']; ?>" />
	<input type="hidden" name="company" value="<?php echo $_REQUEST['company']; ?>"/>
	<input type="hidden" name="carNum" value="<?php echo $_REQUEST['carNum']; ?>"/>
	<input type="hidden" name="carleixing" value="<?php echo $_REQUEST['carleixing']; ?>"/>
	<input type="hidden" name="carstateId" value="<?php echo $_REQUEST['carstateId']; ?>"/>
	<input type="hidden" name="fwjzdate" value="<?php echo $_REQUEST['fwjzdate']; ?>"/>
</form>
<div class="page">
<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=carinfo" method="post">
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
						服务费交至日期:<input type="text" name="fwjzdate" dateFmt="yyyy-M" class="date textInput readonly valid focus" size="12" value="<?php echo $_REQUEST['backdate']; ?>"/>
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
				<li><a class="edit" href="?action=carinfo&do=edit&id={id}" target="dialog" mask="true"><span>添加备注</span></a></li>
				<form name="excel" method="post" action="index.php?action=carinfo&do=print">
					<input type="hidden" name="search" size="12" value="<?php echo $this->_var['search']; ?>"/>
					<li><a class="add" href="###" onclick="JavaScript:document.excel.submit();" target="dwzExport" targetType="dialog" title="是要导出这些记录吗?"><span>导出EXCEL</span></a></li>
				</form>
			</ul>
		</div>
		<table class="list" layouth="120" style="width:3860px;word-break:break-all;">
			<thead>
				<tr align=center>
					<th width="50" align="center">ID</th>
					<th width="200" align="center">公司名称</th>
					<th width="80" align="center">车辆类型</th>
					<th width="80" align="center">车牌号</th>
					<th width="150" align="center">车架号</th>
					<th width="150" align="center">平台</th>
					
					<th width="50" align="center">车辆状态</th>
					<th width="150" align="center">备注</th>
					<th width="80" align="center">SIM卡号</th>
					<th width="50" align="center">状态</th>
					<th width="80" align="center">卡状态变更日期</th>
					<th width="80" align="center">安装日期</th>
					<th width="80" align="center">安装人员</th>
					<th width="50" align="center">资费</th>
					
					<th width="80" align="center">运管审验日期</th>
					<th width="50" align="center">运管金额</th>
					<th width="80" align="center">车管审验日期</th>
					<th width="50" align="center">车管金额</th>
					<th width="50" align="center">总金额</th>
					<th width="80" align="center">服务费交至日期</th>
					<th width="80" align="center">下次缴费日期</th>
					<th width="80" align="center">行车证审验日期</th>
					
					<th width="100" align="center">合同编号</th>
					<th width="100" align="center">设备名称</th>
					<th width="150" align="center">设备型号</th>
					<th width="210" align="center">设备厂家</th>
					<th width="100" align="center">设备金额</th>
					<th width="100" align="center">线路</th>
					<th width="80" align="center">备机安装日期</th>
					<th width="80" align="center">备机拆取日期</th>
					<th width="200" align="center">备注备机</th>
					<th width="80" align="center">终端拆取日期</th>
					<th width="80" align="center">终端安装日期</th>
					<th width="200" align="center">联系人</th>
					<th width="100" align="center">联系电话</th>
					<th width="200" align="center">所属分公司</th>
				</tr>
				
			</thead>
			
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" align=center>
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td width="200px" style="word-break:break-all;"><?php echo $this->_var['row']['name']; ?></td>	
					<td><?php echo $this->_var['row']['carleixing']; ?></td>
					<td><?php echo $this->_var['row']['carNum']; ?></td>
					<td><?php echo $this->_var['row']['chejiaNum']; ?></td>
					<td><?php echo $this->_var['row']['platform']; ?></td>
					
					<td><?php echo $this->_var['row']['carstate']; ?></td>
					<td><?php echo $this->_var['row']['beizhu']; ?></td>
					<td><?php echo $this->_var['row']['simNum']; ?></td>	
					<td><?php echo $this->_var['row']['simstate']; ?></td>	
					<td><?php if ($this->_var['row']['changedate'] != 0): ?><?php echo $this->_var['row']['changedate']; ?><?php endif; ?></td>	
					<td><?php if ($this->_var['row']['installdate'] != 0): ?><?php echo $this->_var['row']['installdate']; ?><?php endif; ?></td>	
					<td><?php echo $this->_var['row']['installperson']; ?></td>	
					<td><?php echo $this->_var['row']['zifei']; ?></td>	
					
					<td><?php if ($this->_var['row']['yundate'] != 0): ?><?php echo $this->_var['row']['yundate']; ?><?php endif; ?></td>	
					<td><?php if ($this->_var['row']['yunmoney'] != 0): ?><?php echo $this->_var['row']['yunmoney']; ?><?php endif; ?></td>	
					<td><?php if ($this->_var['row']['chedate'] != 0): ?><?php echo $this->_var['row']['chedate']; ?><?php endif; ?></td>	
					<td><?php if ($this->_var['row']['chemoney'] != 0): ?><?php echo $this->_var['row']['chemoney']; ?><?php endif; ?></td>	
					<td><?php if ($this->_var['row']['money'] != 0): ?><?php echo $this->_var['row']['money']; ?><?php endif; ?></td>
					<td><?php if ($this->_var['row']['a'] != 0): ?><?php echo $this->_var['row']['a']; ?><?php endif; ?></td>
					<td><?php if ($this->_var['row']['fwjzdate'] != 0): ?><?php echo $this->_var['row']['fwjzdate']; ?><?php endif; ?></td>
					<td><?php if ($this->_var['row']['zhengdate'] != 0): ?><?php echo $this->_var['row']['zhengdate']; ?><?php endif; ?></td>

					<td><?php echo $this->_var['row']['danhao']; ?></td>
					<td><?php echo $this->_var['row']['deviceName']; ?></td>					
					<td><?php echo $this->_var['row']['model']; ?></td>
					<td><?php echo $this->_var['row']['factory']; ?></td>
					<td><?php if ($this->_var['row']['devicemoney'] != 0): ?><?php echo $this->_var['row']['devicemoney']; ?><?php endif; ?></td>					
					<td><?php echo $this->_var['row']['xianlu']; ?></td>
					<td><?php if ($this->_var['row']['chaidate'] != 0): ?><?php echo $this->_var['row']['chaidate']; ?><?php endif; ?></td>
					<td><?php if ($this->_var['row']['beichaidate'] != 0): ?><?php echo $this->_var['row']['beichaidate']; ?><?php endif; ?></td>
					<td><?php echo $this->_var['row']['beibeizhu']; ?></td>
					<td><?php echo $this->_var['row']['terminalchaidate']; ?></td>
					<td><?php if ($this->_var['row']['terminalandate'] != 0): ?><?php echo $this->_var['row']['terminalandate']; ?><?php endif; ?></td>
					<td><?php echo $this->_var['row']['linkname']; ?></td>
					<td><?php if ($this->_var['row']['tel'] != 0): ?><?php echo $this->_var['row']['tel']; ?><?php endif; ?></td>
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
