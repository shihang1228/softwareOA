<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=user&do=updatapass" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
			<input type="hidden" style="display:none;"  name="id" value="<?php echo $_SESSION['userid']; ?>"/>
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>用户名：</label>
					<input type="text" name="username" class="required" size="30" value="<?php echo $_SESSION['username']; ?>" readonly/>
				</p>
				<p>
					<label>密   码：</label>
					<input id="psw" name="password" class="required alphanumeric"  minlength="6" maxlength="20" type="password" size="30" alt="最少6位"/>
				</p>
				<p>
					<label>确认密码：</label>
					<input class="required" name="repassword" type="password" size="30" equalto="#psw"/>
				</p>
			</div>
			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				</ul>
			</div>
		</form>
	</div>
</div>