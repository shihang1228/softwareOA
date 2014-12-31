<div class="page">
	<div class="pageContent">
	 
		<form method="post" action="?action=car&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>公司名称：</label>
					<input name="company" class="required" readonly="readonly" type="text" size="20" value="" alt=""/>
					<a class="btnLook" href="?action=car&do=search" lookupGroup="" width="500">查找带回</a>
				</p>
				<p>
					<label>车牌号：</label>
					<input name="carNum" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>车架号：</label>
					<input name="chejiaNum" class="chejiaNum textInput required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>平台名称：</label>
					<?php echo $this->_var['platform_cn']; ?>
				</p>
				<p>
					<label>车辆类型：</label>
					<?php echo $this->_var['carleixing_cn']; ?>
				</p>
				<p>
					<label>车辆状态：</label>
					<?php echo $this->_var['carstateId_cn']; ?>
				</p>
				<p>
					<label>行车证审验日期：</label>
					<input name="zhengdate" type="text" class="required" size="30" value="" alt=""/>
				</p>
				<p>
					<label>线路：</label>
					<input name="xianlu" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>联系人：</label>
					<input name="linkname" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>联系电话：</label>
					<input name="tel" class="phone textInput required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>每年需交服务费：</label>
					<?php echo $this->_var['fuwufei_cn']; ?>
				</p>
				<p>
					<label>是否分期付款：</label>
					<select class="combox required" name="fenqi">
					<option value="">请选择</option>
					<option value="是">是</option>
					<option value="否">否</option>
					</select>
				</p>
				<p>
					<label>是否安装双设备：</label>
					<select class="combox required" name="doubledevice">
					<option value="">请选择</option>
					<option value="是">是</option>
					<option value="否">否</option>
					<option value="特殊">特殊</option>
					</select>
				</p>
				<p>
					<label>是否属于转发车辆：</label>
					<select class="combox required" name="zhuanfa">
					<option value="">请选择</option>
					<option value="是">是</option>
					<option value="否">否</option>
					</select>
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