<div class="page">
	<div class="pageContent">
	 
		<form method="post" action="?action=sim&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
			<div class="pageFormContent" layoutH="56">
				<p style="width:550px">
					<label>车牌号：</label>
					<input name="carNum" class="carNum textInput required" type="text" size="25" value="" alt=""/>
					<a class="btnLook" href="?action=device&do=search" lookupGroup="" width="600">查找带回</a>
					<span class="info">注：车牌号和车架号可以只输入一个，若两个都输二者必须对应</span>
					
				</p>
				<p>
					<label>车架号：</label>
					<input name="chejiaNum" class="chejiaNum textInput" type="text" size="25" value="" alt=""/>
				</p>
				
				<p>
					<label>SIM卡号：</label>
					<input class="phone textInput required" name="simNum" size="25" value="" type="text"/>
					<a class="btnLook" href="?action=sim&do=search" lookupGroup="" width="620">查找带回</a>	
					
				</p>
				
				<p>
					<label>备注：</label>
					<input name="beizhu" type="text" size="25" value="" alt=""/>
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