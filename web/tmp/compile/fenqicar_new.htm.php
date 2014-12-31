<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=fenqicar&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<input type="hidden" name="id" value="1" />	
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>车牌号：</label>
					<input name="carNum" class="carNum textInput" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>还款金额：</label>
					<input name="getmoney" class="required" type="text" size="30" value="" alt=""/>
				</p>
				
				<p>
					<label>备注：</label>
					<input name="beizhu" type="text" size="30" value="" alt=""/>
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