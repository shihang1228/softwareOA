
<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=supplier&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">		
		<input type="hidden" style="display:none;"  name="salesid" value="">
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>供货商名称：</label>
					<input name="name" class="required" type="text" size="30" value="<?php echo $this->_var['row']['name']; ?>" alt=""/>
				</p>
				<p>
					<label>联系人：</label>
					<input name="linkman" class="required" type="text" size="30" value="<?php echo $this->_var['row']['linkman']; ?>" alt=""/>
				</p>	
				<p>
					<label>地址：</label>
					<input name="address" class="required" type="text" size="30" value="<?php echo $this->_var['row']['address']; ?>" alt=""/>
				</p>
				<p>
					<label>联系电话：</label>
					<input name="phone" class="required" type="text" size="30" value="<?php echo $this->_var['row']['phone']; ?>" alt=""/>
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