<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=weixiuproject&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>维修项目：</label>
					<input name="name" class="required" type="text" size="30" value="" alt=""/>
				</p>

				<p>
					<label>价格：</label>
					<input name="price" class="required" type="text" size="30" value="" alt=""/>
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