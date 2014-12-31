<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=car&do=updata" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<input type="hidden" style="display:none;" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>公司名称：</label>
					<input name="company" class="required" type="text" size="25" value="<?php echo $this->_var['row']['company']; ?>" alt=""/>
					<a class="btnLook" href="?action=car&do=search" lookupGroup="" width="500">查找带回</a>
				</p>
				<p>
					<label>车牌号：</label>
					<input name="carNum" readonly="readonly" class="required" type="text" size="30" value="<?php echo $this->_var['row']['carNum']; ?>" alt=""/>
				</p>
				<p>
					<label>车架号：</label>
					<input name="chejiaNum" class="chejiaNum textInput required" type="text" size="30" value="<?php echo $this->_var['row']['chejiaNum']; ?>" alt=""/>
				</p>
				<p>
					<label>平台名称：</label>
					<?php echo $this->_var['platform_cn']; ?>
				</p>
				<p>
					<label>车辆类型：</label>
					<input name="carleixing" readonly="readonly" class="required" type="text" size="25" value="<?php echo $this->_var['row']['carleixing']; ?>" alt=""/>
					<a class="btnLook" href="?action=car&do=search1" lookupGroup="" width="500">查找带回</a>
				</p>
				<p>
					<label>车辆状态：</label>
					<?php echo $this->_var['carstateId_cn']; ?>
				</p>
				<p>
					<label>行车证审验日期：</label>
					<input name="zhengdate"  type="text" size="30" value="<?php echo $this->_var['row']['zhengdate']; ?>" alt=""/>
				</p>
				<p>
					<label>线路：</label>
					<input name="xianlu" type="text" size="30" value="<?php echo $this->_var['row']['xianlu']; ?>" alt=""/>
				</p>
				<p>
					<label>联系人：</label>
					<input name="linkname" class="required" type="text" size="30" value="<?php echo $this->_var['row']['linkname']; ?>" alt=""/>
				</p>
				<p>
					<label>联系电话：</label>
					<input name="tel" class="phone textInput required" type="text" size="30" value="<?php echo $this->_var['row']['tel']; ?>" alt=""/>
				</p>
				<p>
					<label>每年需交服务费：</label>
					<?php echo $this->_var['fuwufei_cn']; ?>
				</p>
				<p>
					<label>是否分期付款：</label>
					<select class="combox required" name="fenqi">
					<option value="<?php echo $this->_var['row']['fenqi']; ?>" selected="selected"><?php echo $this->_var['row']['fenqi']; ?></option>
					<?php if ($this->_var['row']['fenqi'] == "否"): ?><option value="是">是</option><?php endif; ?>
					<?php if ($this->_var['row']['fenqi'] == "是"): ?><option value="否">否</option><?php endif; ?>
					</select>
				</p>
				<p>
					<label>是否安装双设备：</label>
					<select class="combox required" name="doubledevice">
					<option value="<?php echo $this->_var['row']['doubledevice']; ?>" selected="selected"><?php echo $this->_var['row']['doubledevice']; ?></option>
					<?php if ($this->_var['row']['doubledevice'] == "否"): ?><option value="是">是</option><?php endif; ?>
					<?php if ($this->_var['row']['doubledevice'] == "是"): ?><option value="否">否</option><?php endif; ?>
					</select>
				</p>
				<p>
					<label>是否属于转发车辆：</label>
					<select class="combox required" name="zhuanfa">
					<option value="<?php echo $this->_var['row']['zhuanfa']; ?>" selected="selected"><?php echo $this->_var['row']['zhuanfa']; ?></option>
					<?php if ($this->_var['row']['zhuanfa'] == ""): ?><option value="是">是</option><option value="否">否</option><?php endif; ?>
					<?php if ($this->_var['row']['zhuanfa'] == "否"): ?><option value="是">是</option><?php endif; ?>
					<?php if ($this->_var['row']['zhuanfa'] == "是"): ?><option value="否">否</option><?php endif; ?>
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