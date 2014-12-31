
<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=maintain&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">		
		
			<div class="pageFormContent" layoutH="56">
				
				<p>
					<label>车牌号：</label>
					<input name="carNum" class="required readonly" type="text" size="25" value="" alt=""/>
					<a class="btnLook" href="?action=device&do=search" lookupGroup="" width="650">查找带回</a>
				</p>
				<p>
					<label>公司名称：</label>
					<input name="company" class="required" readonly="readonly" type="text" size="25" value="" alt=""/>
					
				</p>
				<p>
					<label>寄出时间：</label>
					<input name="chudate" class="date required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>地市：</label>
					<input name="fromcity" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>终端厂家：</label>
					<?php echo $this->_var['supplierId_cn']; ?>
				</p>
				<p>
					<label>型号：</label>
					<input name="model" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>主机ID：</label>
					<input name="zhujiId" class="required" type="text" size="30" value="" alt=""/>
				</p>
				
				<p>
					<label>备注：</label>
					<input name="beizhu" type="text" size="30" value="" alt=""/>
				</p>				
				
			</div>
			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
					<li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
				</ul>
			</div>
		</form>
	</div>
</div>