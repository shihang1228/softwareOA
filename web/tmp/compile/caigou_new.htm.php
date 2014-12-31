
<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=caigou&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">		
	
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>商品名称：</label>
					<input name="name" class="required" type="text" size="20" value="" alt=""/>
					<a class="btnLook" href="?action=caigou&do=search" lookupGroup="" width="600">查找带回</a>
				</p>
				
				<p>
					<label>型号：</label>					
					<select class="combox required" name="model" id="w_combox_model">
					<option value="">所有型号</option>
					</select>
				</p>
				
				<p>
					<label>数量：</label>
					<input name="quantity" class="required" type="text" size="30" value="" alt=""/>
				</p>	
				
				<p>
					<label>进价：</label>
					<input name="inprice" class="required" type="text" size="30" value="" alt=""/>
				</p>
				
				<p>
					<label>供货商名称：</label>					
					<?php echo $this->_var['supplierId_cn']; ?>
				</p>
				
				<p>
					<label>库房名称：</label>					
					<?php echo $this->_var['roomId_cn']; ?>
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