<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=sort&do=updata" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<input type="hidden" style="display:none;" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>类别名称：</label>
					<input name="category" class="required" type="text" size="30" value="<?php echo $this->_var['row']['category']; ?>" alt=""/>
				</p>
				<p>
					<label>是否属于终端：</label>
					<select class="combox required" name="terminal">
					<option value="<?php echo $this->_var['row']['terminal']; ?>"><?php echo $this->_var['row']['terminal']; ?></option>
					<?php if ($this->_var['row']['terminal'] == "否"): ?><option value="是">是</option><?php endif; ?>
					<?php if ($this->_var['row']['terminal'] == "是"): ?><option value="否">否</option><?php endif; ?>
					</select>
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