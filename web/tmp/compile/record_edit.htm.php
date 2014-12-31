<form id="pagerForm" method="post" action="index.php?action=room">
	<input type="hidden" name="pageNum" value="<?php echo $this->_var['pageNum']; ?>" />
    <input type="hidden" name="numPerPage" value="<?php echo $this->_var['numPerPage']; ?>" />
</form>
<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=record&do=updata" enctype="multipart/form-data" class="pageForm required-validate1" onsubmit="return iframeCallback(this, navTabAjaxDone);">
		<input type="hidden" style="display:none;" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
			<div class="pageFormContent" layoutH="56" style="width:1200px;">
				<p>
					<label style="width:135px">道路运输证号：</label>
					<input name="tranNum" type="text" size="20" value="<?php echo $this->_var['row']['tranNum']; ?>" alt=""/>
				</p><br>
			    <p style="clear:both;">
					<label style="width:135px">终端ID：</label>
					<input name="deviceId" class="required" type="text" size="20" value="<?php echo $this->_var['row']['deviceId']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">SIM卡卡号：</label>
					<input name="simNum" class="phone textInput required" type="text" size="20" value="<?php echo $this->_var['row']['simNum']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">所属地区：</label>
					<?php echo $this->_var['city_cn']; ?>
					<select class="combox required" name="county" id="w_combox_county">
					<option value="<?php echo $this->_var['row']['county']; ?>" selected="selected"><?php echo $this->_var['row']['county']; ?></option>
					</select>
				</p>
				<p>
					<label style="width:135px">车主/业户：</label>
					<input name="owner" class="required" type="text" size="20" value="<?php echo $this->_var['row']['owner']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">联系人：</label>
					<input name="linkman" class="required" type="text" size="20" value="<?php echo $this->_var['row']['linkman']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">联系手机：</label>
					<input name="linktel" class="phone textInput required" type="text" size="20" value="<?php echo $this->_var['row']['linktel']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">车辆识别代码/车架号：</label>
					<input name="chejiaNum" class="chejiaNum textInput required" type="text" size="20" value="<?php echo $this->_var['row']['chejiaNum']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">车牌号：</label>
					<input name="carNum" class="carNum textInput  required" type="text" size="20" value="<?php echo $this->_var['row']['carNum']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">车牌颜色：</label>
					<?php echo $this->_var['paicolor_cn']; ?>
				</p>
				<p>
					<label style="width:135px">车辆类型：</label>
					<?php echo $this->_var['cartype_cn']; ?>
				</p>
				<p>
					<label style="width:135px">车辆品牌：</label>
					<input name="carbrand" class="required" type="text" size="20" value="<?php echo $this->_var['row']['carbrand']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">车辆型号：</label>
					<input name="carmodel" class="required" type="text" size="20" value="<?php echo $this->_var['row']['carmodel']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">总质量(kg)：</label>
					<input name="totalweight" class="required" type="text" size="20" value="<?php echo $this->_var['row']['totalweight']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">核定载质量(kg)：</label>
					<input name="payload" class="required" type="text" size="20" value="<?php echo $this->_var['row']['payload']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">准牵引总质量(kg)：</label>
					<input name="pullweight" class="required" type="text" size="20" value="<?php echo $this->_var['row']['pullweight']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">外廓尺寸(mm)长：</label>
					<input name="outlength" class="required" type="text" size="20" value="<?php echo $this->_var['row']['outlength']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">宽(mm)：</label>
					<input name="outwidth" class="required" type="text" size="20" value="<?php echo $this->_var['row']['outwidth']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">高(mm)：</label>
					<input name="outhigh" class="required" type="text" size="20" value="<?php echo $this->_var['row']['outhigh']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">货厢内部尺寸(mm)长：</label>
					<input name="inlength" class="required" type="text" size="20" value="<?php echo $this->_var['row']['inlength']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">宽(mm)：</label>
					<input name="inwidth" class="required" type="text" size="20" value="<?php echo $this->_var['row']['inwidth']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">高(mm)：</label>
					<input name="inhigh" class="required" type="text" size="20" value="<?php echo $this->_var['row']['inhigh']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">轴数：</label>
					<input name="zhouNum" class="required" type="text" size="20" value="<?php echo $this->_var['row']['zhouNum']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">轮胎数：</label>
					<input name="tiresNum" type="text" size="20" value="<?php echo $this->_var['row']['tiresNum']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">轮胎规格：</label>
					<input name="tiresstandard" type="text" size="20" value="<?php echo $this->_var['row']['tiresstandard']; ?>" alt=""/>
				</p>
				<p style="clear:both;width:800px;height:50px;">
					<label style="width:135px;line-height:50px;">车辆登记证上传:</label>
					<input type="file" name="file1"/>
					<?php if ($this->_var['row']['location1'] != ""): ?>
					<a target="dialog" href="?action=record&do=location1&lo=<?php echo $this->_var['row']['location1']; ?>" style="vertical-align:middle"><img id="re1" src="/<?php echo $this->_var['row']['location1']; ?>.jpg" height="50px"/></a>
					<?php endif; ?>
					<?php if ($this->_var['row']['location1'] == ""): ?>
					<img id="re1" src="/uploads/error.jpg" height="50px"/>
					<?php endif; ?>
					图片上传，小于2M，jpg、jpeg格式
				</p><br />
				<p style="clear:both;width:800px;height:50px;">
					<label style="width:135px;line-height:50px">车辆合格证/行驶证:</label>
					<input type="file" name="file2"/>
					<?php if ($this->_var['row']['location2'] != ""): ?>
					<a target="dialog" href="?action=record&do=location1&lo=<?php echo $this->_var['row']['location2']; ?>" style="vertical-align:middle"><img id="re1" src="/<?php echo $this->_var['row']['location2']; ?>.jpg" height="50px"/></a>
					<?php endif; ?>
					<?php if ($this->_var['row']['location2'] == ""): ?>
					<img id="re1" src="/uploads/error.jpg" height="50px"/>
					<?php endif; ?>
					图片上传，小于2M，jpg、jpeg格式
				</p><br />
				<p style="clear:both;width:800px;height:50px;">
					<label style="width:135px;line-height:50px">车身照片:</label>
					<input type="file" name="file3"/>
					<?php if ($this->_var['row']['location3'] != ""): ?>
					<a target="dialog" href="?action=record&do=location1&lo=<?php echo $this->_var['row']['location3']; ?>" style="vertical-align:middle"><img id="re1" src="/<?php echo $this->_var['row']['location3']; ?>.jpg" height="50px"/></a>
					<?php endif; ?>
					<?php if ($this->_var['row']['location3'] == ""): ?>
					<img id="re1" src="/uploads/error.jpg" height="50px"/>
					<?php endif; ?>
					图片上传，小于2M，jpg、jpeg格式
				</p><br />

				<p style="clear:both;">
					<label style="width:135px">车辆出厂时间：</label>
					<input name="chutime" class=" date" type="text" size="20" value="<?php echo $this->_var['row']['chutime']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">经营范围：</label>
					<input name="operascope" type="text" size="20" value="<?php echo $this->_var['row']['operascope']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">车身颜色：</label>
					<input name="carcolor" type="text" size="20" value="<?php echo $this->_var['row']['carcolor']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">车辆购置方式：</label>
					<select class="combox" name="buyway">
						<option value="<?php echo $this->_var['row']['buyway']; ?>" selected="selected"><?php echo $this->_var['row']['buyway']; ?></option>
						<?php if ($this->_var['row']['buyway'] == null): ?>
						<option value="">请选择</option>
						<option value="分期付款">分期付款</option>
						<option value="一次性付清">一次性付清</option>
						<?php endif; ?>
						<?php if ($this->_var['row']['buyway'] == "一次性付清"): ?><option value="分期付款">分期付款</option><?php endif; ?>
						<?php if ($this->_var['row']['buyway'] == "分期付款"): ?><option value="一次性付清">一次性付清</option><?php endif; ?>
					</select>
				</p>
				<p>
					<label style="width:135px">车辆保险到期时间：</label>
					<input name="insuretime" class="date" type="text" size="20" value="<?php echo $this->_var['row']['insuretime']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">检验有效期至：</label>
					<input name="checkdue" class="date" type="text" size="20" value="<?php echo $this->_var['row']['checkdue']; ?>" alt=""/>
				</p>
				<p>
					<label style="width:135px">道路运输经营许可证号：</label>
					<input name="licence" type="text" size="20" value="<?php echo $this->_var['row']['licence']; ?>" alt=""/>
				</p>
				<p1 style="clear:both;">
				<label style="width:135px">车辆保险种类：</label>
				<?php echo $this->_var['checkbox_insuresort']; ?>
				</p1>
				
				
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
<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="<?php echo $this->_var['numPerPage']; ?>" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>