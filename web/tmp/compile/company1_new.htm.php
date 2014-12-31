<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=company1&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>父类公司：</label>
						<?php echo $this->_var['company1_cn']; ?>
				</p>

				<p>
					<label>等级：</label>
					<select class="combox" name="dengji">
						<option value="2">二级</option>
						<option value="3">三级</option>
						<option value="4">四级</option>
						<option value="5">五级</option>
					</select>
				</p>
				<p>
					<label>公司名称：</label>
					<input name="company1" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>所在市区：</label>
					<?php echo $this->_var['city_cn']; ?>
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