<OBJECT ID="jatoolsPrinter" CLASSID="CLSID:B43D3361-D075-4BE2-87FE-057188254255" codebase="jatoolsPrinter.cab#version=5,7,0,0" style="display:none"></OBJECT>
<script type="text/javascript">
function doPrint(a,b,c,d,e,f,g,h)  {  
	alertMsg.confirm("确定打印！", {
			okCall: function(){
				//$.post(url, data, DWZ.ajaxDone, "json");
					var myDoc ={  
						marginIgnored:true,
						settings:{        
							paperWidth : 2100,
							paperHeight : 990,
							orientation : 1 
							},
						documents:{html:['<div style="margin-top:95px;margin-left:580px;">'+a+'</div><div style="margin-top:20px;margin-left:100px;">'+b+'</div><div style="margin-top:18px;margin-left:540px;">'+c+'</div><div style="margin-left:105px;margin-top:25px;float:left;">'+d+'</div><div style="margin-left:175px;margin-top:25px;float:left;">'+e+'</div><div style="margin-top:160px;margin-right:110px;float:right;">'+h+'</div><div style="margin-right:-120px;margin-top:25px;float:right;">'+f+'</div><br /><div style="margin-top:143px;margin-left:-160px;float:left;">'+g+'</div>']},   // 要打印的div 对象在本文档中，控件将从本文档中的 id 为 'page1' 的div对象，作为首页打印 
						copyrights:'杰创软件拥有版权  www.jatools.com'          // 版权声明,必须  
						};  
						jatoolsPrinter.print(myDoc,false);
						// 直接打印，不弹出打印机设置对话框        
			}
	});
}
</script>
<form id="pagerForm" method="post" action="index.php?action=shenyan">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="<?php echo $this->_var['numPerPage']; ?>" />
	<input type="hidden" name="carNum" value="<?php echo $_REQUEST['carNum']; ?>"/>
</form>
<div class="page">
<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=shenyan" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						车牌号:<input type="text" name="carNum" size="12" value="<?php echo $_REQUEST['carNum']; ?>"/>
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
				<li><a class="add" href="?action=shenyan&do=newyun" target="dialog" mask="true" rel="addyun"><span>新增运管审验</span></a></li>
				<li><a class="add" href="?action=shenyan&do=newche" target="dialog" mask="true" rel="addche"><span>新增车管审验</span></a></li>
			</ul>
		</div>
		<table class="list" layouth="92" style="width:1470px;">
			<thead>
			
				<tr align=center>
					<th width="20" align="center">ID</th>
					<th width="100" align="center">车牌号</th>
					<th width="150" align="center">车架号</th>
					<th width="100" align="center">车辆类型</th>
					<th width="100" align="center">运管审验日期</th>
					<th width="80" align="center">运管金额</th>
					<th width="130" align="center">运管不干胶</th>
					<th width="100" align="center">车管审验日期</th>
					<th width="80" align="center">车管金额</th>
					<th width="130" align="center">交警不干胶</th>
					<th width="80" align="center">审核人员</th>
					<th width="100" align="center">运管审核</th>
					<th width="100" align="center">车管审核</th>
					<th width="200" align="center">所属分公司</th>
				</tr>	
			</thead>
			
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" align=center>
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['carNum']; ?></td>	
					<td><?php echo $this->_var['row']['chejiaNum']; ?></td>
					<td><?php echo $this->_var['row']['carleixing']; ?></td>
					<td><?php if ($this->_var['row']['yundate'] != 0): ?><?php echo $this->_var['row']['yundate1']; ?><?php endif; ?></td>
					<td><?php if ($this->_var['row']['yunmoney'] != 0): ?><?php echo $this->_var['row']['yunmoney']; ?><?php endif; ?></td>
					<td><?php if ($this->_var['row']['yundanhao'] != 0): ?><?php echo $this->_var['yunshen']; ?><?php echo $this->_var['row']['yundanhao']; ?><?php endif; ?></td>
					<td><?php if ($this->_var['row']['chedate'] != 0): ?><?php echo $this->_var['row']['chedate1']; ?><?php endif; ?></td>
					<td><?php if ($this->_var['row']['chemoney'] != 0): ?><?php echo $this->_var['row']['chemoney']; ?><?php endif; ?></td>	
					<td><?php if ($this->_var['row']['chedanhao'] != 0): ?><?php echo $this->_var['cheshen']; ?><?php echo $this->_var['row']['chedanhao']; ?><?php endif; ?></td>
					<td><?php echo $this->_var['row']['nameshen']; ?></td>
					<td>
					<?php if ($this->_var['row']['judgeyun'] == 3): ?>
					<a class="add" align="center" href="?action=shenyan&do=sureyun1&id=<?php echo $this->_var['row']['id']; ?>" target="ajaxTodo" targetType="dialog" title="是否审核？"><span>审核</span></a>
					<?php endif; ?>
					<?php if ($this->_var['row']['judgeyun'] == 4): ?>
					<a class="print" href="javascript:void(0)" onclick="doPrint('<?php echo $this->_var['yunshen']; ?><?php echo $this->_var['row']['yundanhao']; ?>','运管所','<?php echo $this->_var['row']['company']; ?>','<?php echo $this->_var['row']['chehao']; ?>','<?php echo $this->_var['row']['carleixing']; ?>','<?php echo $this->_var['row']['chejiaNum']; ?>','<?php echo $this->_var['row']['nameshen']; ?>','<?php echo $this->_var['row']['time']; ?>')"><span>打印</span></a>
					<?php endif; ?>
					</td>
					
					<td>
					<?php if ($this->_var['row']['judgeche'] == 3): ?>
					<a class="add" align="center" href="?action=shenyan&do=sureche1&id=<?php echo $this->_var['row']['id']; ?>" target="ajaxTodo" targetType="dialog" title="是否审核？"><span>审核</span></a>
					<?php endif; ?>
					<?php if ($this->_var['row']['judgeche'] == 4): ?>
					<a class="print" href="javascript:void(0)" onclick="doPrint('<?php echo $this->_var['yunshen']; ?><?php echo $this->_var['row']['chedanhao']; ?>','车管所','<?php echo $this->_var['row']['company']; ?>','<?php echo $this->_var['row']['chehao']; ?>','<?php echo $this->_var['row']['carleixing']; ?>','<?php echo $this->_var['row']['chejiaNum']; ?>','<?php echo $this->_var['row']['nameshen']; ?>','<?php echo $this->_var['row']['time']; ?>')"><span>打印</span></a>
					<?php endif; ?>
					
					</td>
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
