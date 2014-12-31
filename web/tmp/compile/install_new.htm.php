<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=install&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>车牌号：</label>
					<input name="carNum" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>速度线束：</label>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<input name="carNum" class="required" type="radio" size="30" value="<?php echo $this->_var['row']['pingjia']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</p>
				<p>
					<label>常火线束：</label>
					<input name="carNum" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>ACC线束：</label>
					<input name="carNum" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>搭铁线束：</label>
					<input name="carNum" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>刹车线束：</label>
					<input name="carNum" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>远光线束：</label>
					<input name="carNum" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>近光线束：</label>
					<input name="carNum" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>左转向线束：</label>
					<input name="carNum" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>右转向线束：</label>
					<input name="carNum" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>摄像头1：</label>
					<input name="carNum" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>摄像头2：</label>
					<input name="carNum" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>摄像头3：</label>
					<input name="carNum" class="required" type="text" size="30" value="" alt=""/>
				</p>
				<p>
					<label>摄像头4：</label>
					<input name="carNum" class="required" type="text" size="30" value="" alt=""/>
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