
<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=repair&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">		
		
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>车牌号：</label>
					<input name="carNum" class="carNum textInput required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>型号：</label>
					<input name="model" class="required" type="text" size="30" value="" alt=""/>
				</p>
				
				<p>
					<label>拆取日期：</label>
					<input name="chaidate" class="date" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>返厂日期：</label>
					<input name="changdate" class="date" type="text" size="30" value="" alt=""/>
				</p>	
				<p>
					<label>返回日期：</label>
					<input name="huidate" class="date" type="text" size="30" value="" alt=""/>
				</p>	
				<p>
					<label>安装日期：</label>
					<input name="andate" class="date" type="text" size="30" value="" alt=""/>
				</p>	
				<p>
					<label>是否过保修期：</label>
					<select class="combox required" name="baoxiuqi">
					<option value="">请选择</option>
					<option value="是">是</option>
					<option value="否">否</option>
					</select>
				</p>	
				<p>
					<label>是否收取检修费：</label>
					<select class="combox required" name="jianxiufei">
					<option value="">请选择</option>
					<option value="是">是</option>
					<option value="否">否</option>
					<option value="不收">不收</option>
					</select>
				</p>							
				<p>
					<label>拆取人：</label>
					<input name="chaipeople" class="required" type="text" size="30" value="" alt=""/>
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