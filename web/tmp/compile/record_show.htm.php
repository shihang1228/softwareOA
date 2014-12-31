<div class="page">
	<div class="pageContent">
			<div class="pageFormContent" layoutH="56">
				<p>
					<label style="width:135px">道路运输证号：</label>
					<?php echo $this->_var['row']['tranNum']; ?>
				</p><br />
				<p style="clear:both;">
					<label style="width:135px">终端ID：</label>
					<?php echo $this->_var['row']['deviceId']; ?>
				</p>
				<p>
					<label style="width:135px">SIM卡卡号：</label>
					<?php echo $this->_var['row']['simNum']; ?>
				</p>
				<p>
					<label style="width:135px">所属地区：</label>
					<?php echo $this->_var['row']['city']; ?><?php echo $this->_var['row']['county']; ?>
					
				</p>
				<p>
					<label style="width:135px">车主/业户：</label>
					<?php echo $this->_var['row']['owner']; ?>
				</p>
				<p>
					<label style="width:135px">联系人：</label>
					<?php echo $this->_var['row']['linkman']; ?>
				</p>
				<p>
					<label style="width:135px">联系手机：</label>
					<?php echo $this->_var['row']['linktel']; ?>
				</p>
				<p>
					<label style="width:135px">车辆识别代码/车架号：</label>
					<?php echo $this->_var['row']['chejiaNum']; ?>
				</p>
				<p>
					<label style="width:135px">车牌号：</label>
					<?php echo $this->_var['row']['carNum']; ?>
				</p>
				<p>
					<label style="width:135px">车牌颜色：</label>
					<?php echo $this->_var['row']['paicolor']; ?>
				</p>
				<p>
					<label style="width:135px">车辆类型：</label>
					<?php echo $this->_var['row']['cartype']; ?>
				</p>
				<p>
					<label style="width:135px">车辆品牌：</label>
					<?php echo $this->_var['row']['carbrand']; ?>
				</p>
				<p>
					<label style="width:135px">车辆型号：</label>
					<?php echo $this->_var['row']['carmodel']; ?>
				</p>
				<p>
					<label style="width:135px">总质量(kg)：</label>
					<?php echo $this->_var['row']['totalweight']; ?>
				</p>
				<p>
					<label style="width:135px">核定载质量(kg)：</label>
					<?php echo $this->_var['row']['payload']; ?>
				</p>
				<p>
					<label style="width:135px">准牵引总质量(kg)：</label>
					<?php echo $this->_var['row']['pullweight']; ?>
				</p>
				<p>
					<label style="width:135px">外廓尺寸(mm)长：</label>
					<?php echo $this->_var['row']['outlength']; ?>
				</p>
				<p>
					<label style="width:135px">宽(mm)：</label>
					<?php echo $this->_var['row']['outwidth']; ?>
				</p>
				<p>
					<label style="width:135px">高(mm)：</label>
					<?php echo $this->_var['row']['outhigh']; ?>
				</p>
				<p>
					<label style="width:135px">货厢内部尺寸(mm)长：</label>
					<?php echo $this->_var['row']['inlength']; ?>
				</p>
				<p>
					<label style="width:135px">宽(mm)：</label>
					<?php echo $this->_var['row']['inwidth']; ?>
				</p>
				<p>
					<label style="width:135px">高(mm)：</label>
					<?php echo $this->_var['row']['inhigh']; ?>
				</p>
				<p>
					<label style="width:135px">轴数：</label>
					<?php echo $this->_var['row']['zhouNum']; ?>
				</p>
				<p>
					<label style="width:135px">轮胎数：</label>
					<?php echo $this->_var['row']['tiresNum']; ?>
				</p>
				<p>
					<label style="width:135px">轮胎规格：</label>
					<?php echo $this->_var['row']['tiresstandard']; ?>
				</p>
				<p style="clear:both;height:52px;">
					<label style="width:135px">车辆登记证上传:</label>
					<a target="dialog" href="?action=record&do=location1&lo=<?php echo $this->_var['row']['location1']; ?>"><img id="re1" src="/<?php echo $this->_var['row']['location1']; ?>.jpg" height="50px"/></a>
				</p><br />
				<p style="clear:both;height:52px;">
					<label style="width:135px">车辆合格证/行驶证:</label>
					<a target="dialog" href="?action=record&do=location1&lo=<?php echo $this->_var['row']['location2']; ?>"><img id="re2" src="/<?php echo $this->_var['row']['location2']; ?>.jpg" height="50px"/></a>				
				</p><br />
				<p style="clear:both;height:52px;">
					<label style="width:135px">车身照片:</label>
					<a target="dialog" href="?action=record&do=location1&lo=<?php echo $this->_var['row']['location3']; ?>"><img id="re3" src="/<?php echo $this->_var['row']['location3']; ?>.jpg" height="50px"/></a>
				</p><br />
				
				<p style="clear:both;">
					<label style="width:135px">车辆出厂时间：</label>
					<?php echo $this->_var['row']['chutime']; ?>
				</p>
				<p>
					<label style="width:135px">经营范围：</label>
					<?php echo $this->_var['row']['operascope']; ?>
				</p>
				<p>
					<label style="width:135px">车身颜色：</label>
					<?php echo $this->_var['row']['carcolor']; ?>
				</p>
				<p>
					<label style="width:135px">车辆购置方式：</label>
					<?php echo $this->_var['row']['buyway']; ?>
				</p>
				<p>
					<label style="width:135px">车辆保险到期时间：</label>
					<?php echo $this->_var['row']['insuretime']; ?>
				</p>
				<p>
					<label style="width:135px">检验有效期至：</label>
					<?php echo $this->_var['row']['checkdue']; ?>
				</p>
				<p>
					<label style="width:135px">道路运输经营许可证号：</label>
					<?php echo $this->_var['row']['licence']; ?>
				</p>
				<p1 style="clear:both;">
				<label style="width:135px">车辆保险种类：</label>
				<?php echo $this->_var['checkbox_insuresort']; ?>
				</p1>
				
			</div>
	</div>
</div>