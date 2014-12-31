<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=sim&do=updata" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<input type="hidden" style="display:none;" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>SIM卡号：</label>
					<input name="simNum" class="phone textInput required" type="text" size="30" value="<?php echo $this->_var['row']['simNum']; ?>" alt=""/>
				</p>
				<p>
					<label>资费：</label>
					<input name="zifei" type="text" size="30" value="<?php echo $this->_var['row']['zifei']; ?>" alt=""/>
				</p>
				<p>
					<label>资费变更日期：</label>
					<input name="zichangedate" class="date" type="text" size="30" value="<?php echo $this->_var['row']['zichangedate']; ?>" alt=""/>
				</p>
				<p>
					<label>SIM卡状态：</label>
					<?php echo $this->_var['simstateId_cn']; ?>
				</p>
				<p>
					<label>卡状态变更日期：</label>
					<input name="changedate" class="date" type="text" size="30" value="<?php echo $this->_var['row']['changedate']; ?>" alt=""/>
				</p>
				<p>
					<label>串号：</label>
					<input name="imei" type="text" size="30" value="<?php echo $this->_var['row1']['imei']; ?>" alt=""/>
				</p>
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