<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=car&do=updatatransfer" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<input type="hidden" style="display:none;" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>公司名称：</label>
					<input name="company" class="required" type="text" size="30" value="<?php echo $this->_var['row']['company']; ?>" alt=""/>
				</p>
				<p>
					<label>车牌号：</label>
					<input name="carNum" class="carNum textInput required" type="text" size="30" value="<?php echo $this->_var['row']['carNum']; ?>" alt=""/>
				</p>
				<p>
					<label>车架号：</label>
					<input name="chejiaNum" class="chejiaNum textInput" type="text" size="30" value="<?php echo $this->_var['row']['chejiaNum']; ?>" alt=""/>
				</p>
				<p>
					<label>联系人：</label>
					<input name="linkname" class="required" type="text" size="30" value="<?php echo $this->_var['row']['linkname']; ?>" alt=""/>
				</p>
				<p>
					<label>联系电话：</label>
					<input name="tel" class="phone textInput required" type="text" size="30" value="<?php echo $this->_var['row']['tel']; ?>" alt=""/>
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