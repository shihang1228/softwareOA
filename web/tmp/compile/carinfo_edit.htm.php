<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=carinfo&do=updata" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<input type="hidden" style="display:none;" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
			<div class="pageFormContent" layoutH="56">
				
				<p>
					<label>备注：</label>
					<input name="beizhu" type="text" size="30" value="<?php echo $this->_var['row']['beizhu']; ?>" alt=""/>
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