<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=install&do=updata" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<input type="hidden" style="display:none;" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>车牌号：</label>
					<input name="carNum" class="required" type="text" size="30" readonly = "readonly" value="<?php echo $this->_var['row1']['carNum']; ?>" alt=""/>
				</p>
				<p>
					<label>速度线束：</label>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row1']['line1'] == $this->_var['row']['pingjia']): ?>
					<input name="line1" class="required" type="radio" size="30" checked="checked" value="<?php echo $this->_var['row1']['line1']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php if ($this->_var['row1']['line1'] != $this->_var['row']['pingjia']): ?>
					<input name="line1" class="required" type="radio" size="30" value="<?php echo $this->_var['row']['pingjia']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					
				</p>
				<p>
					<label>常火线束：</label>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row1']['line2'] == $this->_var['row']['pingjia']): ?>
					<input name="line2" class="required" type="radio" size="30" checked="checked" value="<?php echo $this->_var['row']['line2']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php if ($this->_var['row1']['line2'] != $this->_var['row']['pingjia']): ?>
					<input name="line2" class="required" type="radio" size="30" value="<?php echo $this->_var['row']['pingjia']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</p>
				<p>
					<label>ACC线束：</label>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row1']['line3'] == $this->_var['row']['pingjia']): ?>
					<input name="line3" class="required" type="radio" size="30" checked="checked" value="<?php echo $this->_var['row']['line3']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php if ($this->_var['row1']['line3'] != $this->_var['row']['pingjia']): ?>
					<input name="line3" class="required" type="radio" size="30" value="<?php echo $this->_var['row']['pingjia']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</p>
				<p>
					<label>搭铁线束：</label>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row1']['line4'] == $this->_var['row']['pingjia']): ?>
					<input name="line4" class="required" type="radio" size="30" checked="checked" value="<?php echo $this->_var['row']['line4']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php if ($this->_var['row1']['line4'] != $this->_var['row']['pingjia']): ?>
					<input name="line4" class="required" type="radio" size="30" value="<?php echo $this->_var['row']['pingjia']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</p>
				<p>
					<label>刹车线束：</label>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row1']['line5'] == $this->_var['row']['pingjia']): ?>
					<input name="line5" class="required" type="radio" size="30" checked="checked" value="<?php echo $this->_var['row']['line5']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php if ($this->_var['row1']['line5'] != $this->_var['row']['pingjia']): ?>
					<input name="line5" class="required" type="radio" size="30" value="<?php echo $this->_var['row']['pingjia']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</p>
				<p>
					<label>远光线束：</label>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row1']['line6'] == $this->_var['row']['pingjia']): ?>
					<input name="line6" class="required" type="radio" size="30" checked="checked" value="<?php echo $this->_var['row']['line6']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php if ($this->_var['row1']['line2'] != $this->_var['row']['pingjia']): ?>
					<input name="line6" class="required" type="radio" size="30" value="<?php echo $this->_var['row']['pingjia']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</p>
				<p>
					<label>近光线束：</label>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row1']['line7'] == $this->_var['row']['pingjia']): ?>
					<input name="line7" class="required" type="radio" size="30" checked="checked" value="<?php echo $this->_var['row']['line7']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php if ($this->_var['row1']['line7'] != $this->_var['row']['pingjia']): ?>
					<input name="line7" class="required" type="radio" size="30" value="<?php echo $this->_var['row']['pingjia']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</p>
				<p>
					<label>左转向线束：</label>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row1']['line8'] == $this->_var['row']['pingjia']): ?>
					<input name="line8" class="required" type="radio" size="30" checked="checked" value="<?php echo $this->_var['row']['line8']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php if ($this->_var['row1']['line8'] != $this->_var['row']['pingjia']): ?>
					<input name="line8" class="required" type="radio" size="30" value="<?php echo $this->_var['row']['pingjia']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</p>
				<p>
					<label>右转向线束：</label>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row1']['line9'] == $this->_var['row']['pingjia']): ?>
					<input name="line9" class="required" type="radio" size="30" checked="checked" value="<?php echo $this->_var['row']['line9']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php if ($this->_var['row1']['line9'] != $this->_var['row']['pingjia']): ?>
					<input name="line9" class="required" type="radio" size="30" value="<?php echo $this->_var['row']['pingjia']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</p>
				<p>
					<label>摄像头1：</label>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row1']['camera1'] == $this->_var['row']['pingjia']): ?>
					<input name="camera1" class="required" type="radio" size="30" checked="checked" value="<?php echo $this->_var['row']['camera1']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php if ($this->_var['row1']['camera1'] != $this->_var['row']['pingjia']): ?>
					<input name="camera1" class="required" type="radio" size="30" value="<?php echo $this->_var['row']['pingjia']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</p>
				<p>
					<label>摄像头2：</label>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row1']['camera2'] == $this->_var['row']['pingjia']): ?>
					<input name="camera2" class="required" type="radio" size="30" checked="checked" value="<?php echo $this->_var['row']['camera2']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php if ($this->_var['row1']['camera2'] != $this->_var['row']['pingjia']): ?>
					<input name="camera2" class="required" type="radio" size="30" value="<?php echo $this->_var['row']['pingjia']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</p>
				<p>
					<label>摄像头3：</label>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row1']['camera3'] == $this->_var['row']['pingjia']): ?>
					<input name="camera3" class="required" type="radio" size="30" checked="checked" value="<?php echo $this->_var['row']['camera3']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php if ($this->_var['row1']['camera3'] != $this->_var['row']['pingjia']): ?>
					<input name="camera3" class="required" type="radio" size="30" value="<?php echo $this->_var['row']['pingjia']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</p>
				<p>
					<label>摄像头4：</label>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<?php if ($this->_var['row1']['camera4'] == $this->_var['row']['pingjia']): ?>
					<input name="camera4" class="required" type="radio" size="30" checked="checked" value="<?php echo $this->_var['row']['camera4']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php if ($this->_var['row1']['camera4'] != $this->_var['row']['pingjia']): ?>
					<input name="camera4" class="required" type="radio" size="30" value="<?php echo $this->_var['row']['pingjia']; ?>" alt=""/><?php echo $this->_var['row']['pingjia']; ?>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
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