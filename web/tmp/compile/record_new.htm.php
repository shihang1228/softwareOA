<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=record&do=add" enctype="multipart/form-data" class="pageForm required-validate1" onsubmit="return iframeCallback(this, navTabAjaxDone);">
		<input type="hidden" name="id" value="1" />	
			<div class="pageFormContent" layoutH="56" style="width:1200px;">
				<p>
					<label style="width:135px">道路运输证号：</label>
					<input name="tranNum" type="text" size="20" value="" alt=""/>
				</p><br />
				<p style="clear:both;">
					<label style="width:135px">终端ID：</label>
					<input name="deviceId" class="required" type="text" size="20" value="" alt=""/>
				</p>
				<p>
					<label style="width:135px">SIM卡卡号：</label>
					<input name="simNum" class="phone textInput required" type="text" size="20" value="" alt=""/>
				</p>
				<p>
					<label style="width:135px">所属地区：<?php echo $this->_var['city']; ?></label>
					<?php echo $this->_var['county_cn']; ?>
					</select>
				</p>
				<p>
					<label style="width:135px">车主/业户：</label>
					<input name="owner" class="required" type="text" size="20" value="" alt=""/>
				</p>
				<p>
					<label style="width:135px">联系人：</label>
					<input name="linkman" class="required" type="text" size="20" value="" alt=""/>
				</p>
				<p>
					<label style="width:135px">联系手机：</label>
					<input name="linktel" class="phone textInput required" type="text" size="20" value="" alt=""/>
				</p>
				<p>
					<label style="width:135px">车辆识别代码/车架号：</label>
					<input name="chejiaNum" class="chejiaNum textInput required" type="text" size="20" value="" alt=""/>
				</p>
				<p>
					<label style="width:135px">车牌号：</label>
					<input name="carNum" class="carNum textInput required" type="text" size="20" value="" alt=""/>
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
					<input name="carbrand" class="required" type="text" size="20" value="" alt=""/>
				</p>
				<p>
					<label style="width:135px">车辆型号：</label>
					<input name="carmodel" class="required" type="text" size="20" value="" alt=""/>
				</p>
				<p>
					<label style="width:135px">总质量(kg)：</label>
					<input name="totalweight" class="required" type="text" size="20" value="" alt=""/>
				</p>
				<p>
					<label style="width:135px">核定载质量(kg)：</label>
					<input name="payload" class="required" type="text" size="20" value="" alt=""/>
				</p>
				<p>
					<label style="width:135px">准牵引总质量(kg)：</label>
					<input name="pullweight" class="required" type="text" size="20" value="" alt=""/>
				</p>
				<p>
					<label style="width:135px">外廓尺寸(mm)长：</label>
					<input name="outlength" class="required" type="text" size="20" value="" alt=""/>
				</p>
				<p>
					<label style="width:135px">宽(mm)：</label>
					<input name="outwidth" class="required" type="text" size="20" value="" alt=""/>
				</p>
				<p>
					<label style="width:135px">高(mm)：</label>
					<input name="outhigh" class="required" type="text" size="20" value="" alt=""/>
				</p>
				<p>
					<label style="width:135px">货厢内部尺寸(mm)长：</label>
					<input name="inlength" class="required" type="text" size="20" value="" alt=""/>
				</p>
				<p>
					<label style="width:135px">宽(mm)：</label>
					<input name="inwidth" class="required" type="text" size="20" value="" alt=""/>
				</p>
				<p>
					<label style="width:135px">高(mm)：</label>
					<input name="inhigh" class="required" type="text" size="20" value="" alt=""/>
				</p>
				<p>
					<label style="width:135px">轴数：</label>
					<input name="zhouNum" class="required" type="text" size="20" value="" alt=""/>
				</p>
				<p>
					<label style="width:135px">轮胎数：</label>
					<input name="tiresNum" type="text" size="20" value="" alt=""/>
				</p>
				<p>
					<label style="width:135px">轮胎规格：</label>
					<input name="tiresstandard" type="text" size="20" value="" alt=""/>
				</p><br /><br /><br />
				<p style="clear:both;width:800px;">
					<label style="width:135px">车辆登记证上传:</label>
					<input type="file" name="file1"/>图片上传，小于2M，jpg、jpeg格式
				</p><br />
				<p style="clear:both;width:800px;">
					<label style="width:135px">车辆合格证/行驶证:</label>
					<input type="file" name="file2"/>图片上传，小于2M，jpg、jpeg格式
				</p><br />
				<p style="clear:both;width:800px;">
					<label style="width:135px">车身照片:</label>
					<input type="file" name="file3"/>图片上传，小于2M，jpg、jpeg格式
				</p><br /><br />
				<p style="clear:both;">
					<label style="width:135px">车辆出厂时间：</label>
					<input name="chutime" class=" date" type="text" size="20" value="" alt=""/>
				</p>
				<p>
					<label style="width:135px">经营范围：</label>
					<input name="operascope" type="text" size="20" value="" alt=""/>
				</p>
				<p>
					<label style="width:135px">车身颜色：</label>
					<input name="carcolor" type="text" size="20" value="" alt=""/>
				</p>
				<p>
					<label style="width:135px">车辆购置方式：</label>
					<select class="combox" name="buyway">
						<option value="">请选择</option>
						<option value="分期付款">分期付款</option>
						<option value="一次性付清">一次性付清</option>
					</select>
				</p>
				<p>
					<label style="width:135px">车辆保险到期时间：</label>
					<input name="insuretime" class="date" type="text" size="20" value="" alt=""/>
				</p>
				<p>
					<label style="width:135px">检验有效期至：</label>
					<input name="checkdue" class="date" type="text" size="20" value="" alt=""/>
				</p>
				<p>
					<label style="width:135px">道路运输经营许可证号：</label>
					<input name="licence" type="text" size="20" value="" alt=""/>
				</p>
				<p1 style="clear:both;">
				<label style="width:135px">车辆保险种类：</label>
				<?php echo $this->_var['checkbox_insuresort']; ?>
				</p1>
				
			</div>
			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit">完成注册</button></div></div></li>
					<li><div class="button"><div class="buttonContent"><button type="button" class="close">关闭</button></div></div></li>
				</ul>
			</div>
		</form>
	</div>
</div>