
<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=diaobo&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">		
		
			<div class="pageFormContent" layoutH="56">
			   <input type="hidden" style="display:none;"  name="id" value="<?php echo $_SESSION['id']; ?>">
				<p>
					<label>商品名称：</label>
					<?php echo $this->_var['productId_cn']; ?>
				</p>
				<p>
					<label>型号：</label>					
					<select class="combox required" name="model" id="w_combox_model" ref="w_combox_supplier" refurl="?action=diaobo&do=supplier_combox&value={value}">
					<option value="">所有型号</option>
					</select>
				</p>
				
				<p>
					<label>供货商名称：</label>					
					<select class="combox required" name="supplierId" id="w_combox_supplier" ref="w_combox_roomchu" refurl="?action=diaobo&do=roomchu_combox&value={value}">
					<option value="">所有供应商</option>
					</select>
				</p>
				<p>
					<label>数量：</label>
					<input name="quantity" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>调出库房：</label>					
					<select class="combox required" name="roomchuId" id="w_combox_roomchu" ref="w_combox_roomru" refurl="?action=diaobo&do=roomru_combox&value={value}">
					<option value="">所有库房</option>
					</select>
				</p>
				<p>
					<label>调入库房：</label>					
					<select class="combox required" name="roomruId" id="w_combox_roomru">
					<option value="">所有库房</option>
					</select>
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