<div class="page">
	<div class="pageContent">
	 
		<form method="post" action="?action=shenyan&do=addche" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
			<div class="pageFormContent" layoutH="56">
				<p style="width:550px">
					<label>车牌号：</label>
					<input name="carNum" class="carNum textInput" type="text" size="30" value="" alt=""/>
					<span class="info">注：车牌号和车架号可以只输入一个，<br>若两个都输二者必须对应</span>
				</p>
				<p>
					<label>车架号：</label>
					<input name="chejiaNum" class="chejiaNum textInput" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>车管金额：</label>
					<input name="chemoney" type="text" size="30" value="" alt=""/>
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