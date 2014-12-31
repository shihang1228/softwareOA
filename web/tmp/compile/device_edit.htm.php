<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=device&do=updata" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<input type="hidden" style="display:none;" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>设备名称：</label>
					<?php echo $this->_var['productId_cn']; ?>
				</p>
				<p>
					<label>设备型号：</label>
					<select class="combox required" name="model" id="w_combox_model" ref="w_combox_supplier" refurl="?action=device&do=supplier_combox&value={value}">
					<option value="<?php echo $this->_var['row']['model']; ?>" selected="selected"><?php echo $this->_var['row']['model']; ?></option>
					</select>
				</p>
				<p>
					<label>设备厂家：</label>
					<select class="combox required" name="factory" id="w_combox_supplier">
					<option value="<?php echo $this->_var['row']['factory']; ?>" selected="selected"><?php echo $this->_var['row']['factory']; ?></option>
					</select>
				</p>
				<p>
					<label>设备金额：</label>
					<input name="money" class="required" type="text" size="30" value="<?php echo $this->_var['row']['money']; ?>" alt=""/>
				</p>
				<p>
					<label>安装日期：</label>
					<input name="installdate" class="date" type="text" size="30" value="<?php echo $this->_var['row']['installdate']; ?>" alt=""/>
				</p>
				<p>
					<label>安装人员：</label>
					<input name="installperson" class="required" type="text" size="30" value="<?php echo $this->_var['row']['installperson']; ?>" alt=""/>
				</p>
				<p>
					<label>合同编号：</label>
					<input name="danhao" type="text" size="30" value="<?php echo $this->_var['row']['danhao']; ?>" alt=""/>
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