<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=product&do=updata" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<input type="hidden" style="display:none;" name="id" value="<?php echo $this->_var['row']['id']; ?>"/>
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>物品名称：</label>
					<input name="name" class="required" type="text" size="30" value="<?php echo $this->_var['row']['name']; ?>" alt=""/>
				</p>
				
				<p>
					<label>物品型号：</label>
					<input name="model" class="required" type="text" size="30" value="<?php echo $this->_var['row']['model']; ?>" alt=""/>
				</p>
				
				<p>
					<label>计量单位：</label>
					<input name="unit" class="required" type="text" size="30" value="<?php echo $this->_var['row']['unit']; ?>" alt=""/>
				</p>
				
				<p>
					<label>物品类别：</label>					
					<?php echo $this->_var['sortid_cn']; ?>
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