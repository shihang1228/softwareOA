<div class="page">
	<div class="pageContent">
	 
		<form method="post" action="?action=device&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
			<div class="pageFormContent" layoutH="56">
				<p style="width:550px">
					<label>车牌号：</label>
					<input name="carNum" class="carNum textInput required" type="text" size="20" value="" alt=""/>
					<a class="btnLook" href="?action=device&do=search" lookupGroup="" width="600">查找带回</a>
					<span class="info">注：车牌号和车架号可以只输入一个，<br>若两个都输二者必须对应</span>
				</p>
				<p>
					<label>车架号：</label>
					<input name="chejiaNum" class="chejiaNum textInput" type="text" size="25" value="" alt=""/>
				</p>
				<p>
					<label>设备名称：</label>
					<?php echo $this->_var['productId_cn']; ?>
				</p>
				<p>
					<label>设备型号：</label>
					<select class="combox required" name="model" id="w_combox_model" ref="w_combox_supplier" refurl="?action=device&do=supplier_combox&value={value}">
					<option value="">所有型号</option>
					</select>
				</p>
				<p>
					<label>设备厂家：</label>
					<select class="combox required" name="factory" id="w_combox_supplier" ref="w_combox_room" refurl="?action=device&do=room_combox&value={value}">
					<option value="">所有设备厂家</option>
					</select>
				</p>
				<p>
					<label>库房名称：</label>					
					<select class="combox required" name="roomId" id="w_combox_room">
					<option value="">所有库房</option>
					</select>
				</p>
				<p>
					<label>设备金额：</label>
					<input name="money" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>主机ID号：</label>
					<input name="zhujiId" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>安装日期：</label>
					<input name="installdate" class="date" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>安装人员：</label>
					<input name="installperson" class="required" type="text" size="30" value="" alt=""/>
				</p>
				
				<p>
					<label>合同编号：</label>
					<input name="danhao" type="text" size="30" value="" alt=""/>
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