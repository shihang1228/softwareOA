
<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=sim_sto&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">		
	
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>运营商：</label>
					<select class="combox required" name="tmobile">
						<option value="">请选择</option>
						<option value="移动">移动</option>
						<option value="联通">联通</option>
						<option value="电信">电信</option>
					</select>
				</p>	
				<p>
					<label>SIM卡号：</label>
					<input name="cardnum" class="phone textInput required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>SIM卡状态：</label>
					<?php echo $this->_var['simstateId_cn']; ?>
				</p>
				<p>
					<label>资费：</label>
					<?php echo $this->_var['simzifei_cn']; ?>
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