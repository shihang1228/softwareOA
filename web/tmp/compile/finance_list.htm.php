<OBJECT ID="jatoolsPrinter" CLASSID="CLSID:B43D3361-D075-4BE2-87FE-057188254255" codebase="jatoolsPrinter.cab#version=5,7,0,0" style="display:none"></OBJECT>
<script type="text/javascript">
function doPrint(a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r)  { 
	alertMsg.confirm("确定打印！", {
			okCall: function(){ 
				var myDoc ={  
					marginIgnored:true,
					settings:{        
						paperWidth : 2100,
						paperHeight : 990,
						orientation : 1 
						},
					documents:{html:['<div style="margin-top:40px;margin-left:280px;"><span style="font-size:22px;">'+a+'</span></div><div style="margin-top:40px;margin-left:110px;float:left; height:20px;"><span style="font-size:12px;">'+b+'</span></div><div style="margin-top:40px;margin-left:120px;float:left; height:20px;"><span style="font-size:12px;">'+c+'</span></div><div style="margin-top:40px;margin-left:550px;height:20px;"><span style="font-size:12px;">'+d+'</span></div><div style="margin-top:50px;margin-left:65px;float:left;height:20px;"><span style="font-size:12px;">'+e+'</span></div><div style="margin-top:50px;margin-left:30px;float:left;height:20px;"><span style="font-size:12px;">'+f+'</span></div><div style="margin-top:50px;margin-left:20px;float:left;height:20px;"><span style="font-size:12px;">'+g+'</span></div><div style="margin-top:50px;margin-left:80px;float:left;height:20px;"><span style="font-size:12px;">'+h+'</span></div><div style="margin-top:50px;margin-left:45px;float:left;height:20px;"><span style="font-size:12px;">'+i+'</span></div><div style="margin-top:50px;margin-left:560px;height:20px;"><span style="font-size:12px;">'+j+'</span></div><div style="margin-top:90px;margin-left:120px;float:left;height:20px;"><span style="font-size:12px;">'+k+'</span></div><div style="margin-top:90px;margin-left:10px;float:left;height:20px;"><span style="font-size:12px;">'+l+'</span></div><div style="margin-top:90px;margin-left:350px;height:20px;"><span style="font-size:12px;">'+m+'</span></div><div style="margin-top:4px;margin-left:100px;float:left;height:20px;"><span style="font-size:12px;">'+n+'</span></div><div style="margin-top:4px;margin-left:300px;height:20px;"><span style="font-size:12px;">'+o+'</span></div><div style="margin-top:4px;margin-left:100px;"><span style="font-size:12px;">'+p+'</span></div><div style="margin-top:2px;margin-left:120px;float:left;height:20px;"><span style="font-size:12px;">'+q+'</span></div><div style="margin-top:2px;margin-left:345px;height:20px;"><span style="font-size:12px;">'+r+'</span></div>']},   // 要打印的div 对象在本文档中，控件将从本文档中的 id 为 'page1' 的div对象，作为首页打印 
					copyrights:'杰创软件拥有版权  www.jatools.com'          // 版权声明,必须  
					};  
					jatoolsPrinter.print(myDoc,false);
					// 直接打印，不弹出打印机设置对话框  
			}		
		});		
	}
</script>
<form id="pagerForm" method="post" action="index.php?action=finance">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="<?php echo $this->_var['numPerPage']; ?>" />
	<input type="hidden" name="time_start" value="<?php echo $_REQUEST['time_start']; ?>"/>
	<input type="hidden" name="time_over" value="<?php echo $_REQUEST['time_over']; ?>"/>
	 <input type="hidden" name="carNum" value="<?php echo $_REQUEST['carNum']; ?>"/> 
	 <input type="hidden" name="pname" value="<?php echo $_REQUEST['pname']; ?>"/> 
	<input type="hidden" name="roomId" value="<?php echo $_REQUEST['roomId']; ?>"/>
	<input type="hidden" name="supplierId" value="<?php echo $_REQUEST['supplierId']; ?>"/>
	<input type="hidden" name="inputer" value="<?php echo $_REQUEST['inputer']; ?>"/>
</form>

<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=finance" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
				    <td>
						车牌号:<input type="text" name="carNum" size="12" value="<?php echo $_REQUEST['carNum']; ?>"/>
					</td>
					
					<td>
						物品名称:<input type="text" name="pname" size="12" value="<?php echo $_REQUEST['pname']; ?>"/>
					</td>	
					<td>
						<label style="width:48">选择库房:</label>
						<?php echo $this->_var['roomId_cn']; ?>
					</td>
					
				</tr>
				<tr>
					
					<td>
						登记时间:<input type="text" name="time_start" size="9" class="date" readonly="true" value="<?php echo $_REQUEST['time_start']; ?>"/>
						-<input type="text" name="time_over" size="9" class="date" readonly="true" value="<?php echo $_REQUEST['time_over']; ?>"/>
					</td>
					<td>
						操作者:<input type="text" name="inputer" size="12" value="<?php echo $_REQUEST['inputer']; ?>"/>
					</td>
					<td>
						<label style="width:60">选择供货商:</label>
						<?php echo $this->_var['supplierId_cn']; ?>
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
	
		<table class="list" layouth="93" style="width:1300px;">
			<thead>
				<tr align=center>
					<th align="center">单号</th>
					<th align="center">公司名称</th>
					<th align="center">车牌号</th>
					<th align="center">商品名称</th>
					<th align="center">型号</th>
					<th align="center">数量</th>
					<th align="center">售价</th>
					<th align="center">供货商名称</th>
					<th align="center">库房名称</th>
					<th align="center">核对时间</th>
					<th align="center">货款合计</th>
					<th align="center">收款数量</th>
					<th align="center">收款合计</th>
					<th align="center">操作者</th>
					<th align="center">确认收款</th>
				</tr>
			</thead>
		
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr align=center>
					<td><?php echo $this->_var['qianzhui']; ?><?php echo $this->_var['row']['danhao']; ?></td>
					<td><?php echo $this->_var['row']['company']; ?></td>
					<td><?php echo $this->_var['row']['carNum']; ?></td>
					<td><?php echo $this->_var['row']['pname']; ?></td>
					<td><?php echo $this->_var['row']['model']; ?></td>
					<td><?php echo $this->_var['row']['quantity']; ?></td>
					<td><?php echo $this->_var['row']['outprice']; ?></td>
					<td><?php echo $this->_var['row']['sname']; ?></td>
					<td><?php echo $this->_var['row']['rname']; ?></td>
					<td><?php echo $this->_var['row']['checktime']; ?></td>
					<td><?php echo $this->_var['row']['heji']; ?></td>
					<td><?php echo $this->_var['row']['shouquantity']; ?></td>
					<td><?php echo $this->_var['row']['shouheji']; ?></td>
					<td><?php echo $this->_var['row']['financeName']; ?></td>
					<?php if ($this->_var['row']['judge'] == 1): ?>
					<td><a class="add" align="center" href="?action=finance&do=sure&id=<?php echo $this->_var['row']['id']; ?>" target="ajaxTodo" targetType="navTab" title="是否确认收款？"><span>确认收款</span></a></td>
					<?php endif; ?>
					<?php if ($this->_var['row']['judge'] == 2 || $this->_var['row']['judge'] == 3): ?>
					<td><a class="print" href="javascript:void(0)" onclick="doPrint('山西冀东启明科技有限公司','<?php echo $this->_var['qianzhui']; ?><?php echo $this->_var['row']['danhao']; ?>','<?php echo $this->_var['row']['pname']; ?>','<?php echo $this->_var['row']['company']; ?>','1','<?php echo $this->_var['row']['chehao']; ?>','<?php echo $this->_var['row']['chejiaNum']; ?>','<?php echo $this->_var['row']['pname']; ?>','','<?php echo $this->_var['row']['shouheji']; ?>','','','<?php echo $this->_var['row']['time']; ?>','<?php echo $this->_var['row']['financeName']; ?>','admin1','山西太原市','0351-7091699','0351-7091688')"><span>打印收据</span></a></td>
					<?php endif; ?>
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