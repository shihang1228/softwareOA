<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=sim_sto&do=updata" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<input type="hidden" style="display:none;" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>运营商：</label>
					<select class="combox" name="tmobile">
						<option value="<?php echo $this->_var['row']['tmobile']; ?>" selected="selected"><?php echo $this->_var['row']['tmobile']; ?></option>
						<?php if ($this->_var['row']['tmobile'] == "电信"): ?><option value="移动">移动</option><option value="联通">联通</option><?php endif; ?>
						<?php if ($this->_var['row']['tmobile'] == "联通"): ?><option value="移动">移动</option><option value="电信">电信</option><?php endif; ?>
						<?php if ($this->_var['row']['tmobile'] == "移动"): ?><option value="联通">联通</option><option value="电信">电信</option><?php endif; ?>
					</select>
				</p>	
				<p>
					<label>SIM卡号：</label>
					<input name="cardnum" class="required" readonly="readonly" type="text" size="30" value="<?php echo $this->_var['row']['cardnum']; ?>" alt=""/>
				</p>
				<p>
					<label>SIM卡状态：</label>
					<?php echo $this->_var['simstateId_cn']; ?>
				</p>
				<p>
					<label>资费：</label>
					<input name="zifei" class="required" type="text" size="30" value="<?php echo $this->_var['row']['zifei']; ?>" alt=""/>
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