<script type="text/javascript" > 
$("document").ready(function(){     
     $("#action_all").click(function(){   
		if(this.checked){   
			$("input[name='areaid[]']").each(function(){this.checked=true;});
			$("#btn1").html("反选");   
		}else{   
			$("input[name='areaid[]']").each(function(){this.checked=false;});   
			$("#btn1").html("全选"); 
		}   
	 });   
});
</script>
<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=user&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">		
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>登录名：</label>
					<input type="text" name="username" class="required" size="30" value=""/>
				</p>
				<p>
					<label>密 码：</label>
					<input name="password" class="required" type="password" size="30"/>
				</p>
				<p>
					<label>角 色：</label>
					<?php echo $this->_var['select_role_cn']; ?>
				</p>
				<p>
					<label>用户名：</label>
					<input type="text" name="trueName" class="required" size="30" value=""/>
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