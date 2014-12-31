
<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=beiji&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">		
		
			<div class="pageFormContent" layoutH="56">
				
				<p>
					<label>车牌号：</label>
					<input name="carNum" class="carNum textInput required" type="text" size="30" value="" alt=""/>
				</p>
				
				<p>
					<label>拆取日期：</label>
					<input name="chaidate" class="date" type="text" size="30" value="" alt=""/>
				</p>		
				<p>
					<label>拆取人：</label>
					<input name="chaipeople" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>备机协议编号：</label>
					<input name="agreement" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>备机协议日期：</label>
					<input name="agreedate" class="date required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>押金：</label>
					<input name="deposit" class="required" type="text" size="30" value="" alt=""/>
				</p>
				
				<p>
					<label>设备型号：</label>
					<input name="model" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>备注：</label>
					<input name="beizhu" type="text" size="30" value="" alt=""/>
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