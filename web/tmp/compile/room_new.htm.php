<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=room&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>仓库名称：</label>
					<input name="name" class="required" type="text" size="30" value="" alt=""/>
				</p>

				<p>
					<label>所在地区：</label>
					<input name="address" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>公司名称：</label>
					<?php echo $this->_var['company1_cn']; ?>
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