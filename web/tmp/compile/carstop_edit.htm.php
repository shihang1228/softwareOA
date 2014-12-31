<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=car&do=updatastop" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<input type="hidden" style="display:none;" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>公司名称：</label>
					<input name="company" class="required" type="text" size="30" value="<?php echo $this->_var['row']['company']; ?>" alt=""/>
				</p>
				<p>
					<label>车牌号：</label>
					<input name="carNum" readonly="readonly" class="required" type="text" size="30" value="<?php echo $this->_var['row']['carNum']; ?>" alt=""/>
				</p>
				<p>
					<label>车辆状态：</label>
					<?php echo $this->_var['carstateId_cn']; ?>
				</p>
				
				<p>
					<label>停运日期：</label>
					<input name="stopdate" class="date" type="text" size="30" value="<?php echo $this->_var['row']['stopdate']; ?>"/>
				</p>
				<p>
					<label>恢复运营日期：</label>
					<input name="startdate" class="date" type="text" size="30" value="<?php echo $this->_var['row']['startdate']; ?>"/>
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