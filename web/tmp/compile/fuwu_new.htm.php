<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=fuwu&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">		
	
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>车牌号：</label>
					<input name="carNum" type="text" class="carNum textInput required" size="30" value="" alt=""/>
				</p>		

				<p>
					<label>费用类型：</label>
					<?php echo $this->_var['feetype_cn']; ?>
				</p>
				<p>
					<label>金额：</label>
					<input name="money" type="text" class="required" size="30" value="" alt=""/>
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