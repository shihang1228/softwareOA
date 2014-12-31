
<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=product&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">		
		
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>物品名称：</label>
					<input name="name" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>物品型号：</label>
					<input name="model" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>计量单位：</label>
					<input name="unit" class="required" type="text" size="30" value="" alt=""/>
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