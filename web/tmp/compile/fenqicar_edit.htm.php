<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=fenqicar&do=updata" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<input type="hidden" style="display:none;" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>还款金额：</label>
					<input name="getmoney" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>还款日期：</label>
					<input type="text" name="repaydate" dateFmt="MM" class="date textInput readonly valid focus" size="12" value="<?php echo $_REQUEST['repaydate']; ?>"/>
				</p>
				<p>
					<label>总金额：</label>
					<input name="totalmoney" class="required" type="text" size="30" value="<?php echo $this->_var['row']['totalmoney']; ?>" alt=""/>
				</p>
				<p>
					<label>总年限：</label>
					<input name="totalyear" class="required" type="text" size="30" value="<?php echo $this->_var['row']['totalyear']; ?>" alt=""/>
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