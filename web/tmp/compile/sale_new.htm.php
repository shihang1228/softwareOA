<script type="text/javascript">
 function al(obj) {
			//alert(val)
			attr("w_combox_model".refurl="?action=sale&do=supplier_combox&value={value}&val="+obj.value)
        }
</script>
<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=sale&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">		
	
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>商品名称：</label>
					<?php echo $this->_var['productId_cn']; ?>
				</p>
				
				<p>
					<label>型号：</label>					
					<select class="combox required" name="model" id="w_combox_model" ref="w_combox_supplier" refurl="?action=sale&do=supplier_combox&value={value}">
					<option value="">所有型号</option>
					</select>
				</p>
				
				
				<p>
					<label>车牌号：</label>
					<input name="carNum" class="carNum textInput required" type="text" size="30" value="" alt=""/>
				</p>		
				<p>
					<label>数量：</label>
					<input name="quantity" class="required" type="text" size="30" value="" alt=""/>
				</p>		
				<p>
					<label>售价：</label>
					<input name="outprice" class="required" type="text" size="30" value="" alt=""/>
				</p>
				
				
				<p>
					<label>供货商名称：</label>					
					<select class="combox required" name="supplierId" id="w_combox_supplier" ref="w_combox_room" refurl="?action=sale&do=room_combox&value={value}">
					<option value="">所有供应商</option>
					</select>
				</p>
				
				<p>
					<label>库房名称：</label>					
					<select class="combox required" name="roomId" id="w_combox_room">
					<option value="">所有库房</option>
					</select>
				</p>
				
				<p>
					<label>收款数量：</label>
					<input name="shouquantity" class="required" type="text" size="30" value="" alt=""/>
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