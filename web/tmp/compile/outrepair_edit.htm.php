<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=outrepair&do=updata" enctype="multipart/form-data" class="pageForm required-validate1" onsubmit="return iframeCallback(this, navTabAjaxDone);">
		<input type="hidden" style="display:none;" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<p style="clear:both;">
					<label>维修项目：</label>
					<?php echo $this->_var['pro_cn']; ?>
				</p>
				<p style="clear:both;">
					<label>故障：</label>
					<input name="reason" class="required" type="text" size="30" value="<?php echo $this->_var['row']['reason']; ?>" alt=""/>
				</p><br/>
				<p style="clear:both;">
					<label>维修结果：</label>
					<input name="result" class="required" type="text" size="30" value="<?php echo $this->_var['row']['result']; ?>" alt=""/>
				</p><br/>
				<p style="clear:both;width:800px;height:50px;">
					<label style="line-height:50px;">故障照片:</label>
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
					<label style="line-height:50px">完成照片:</label>
					<input type="file" name="file2"/>
					<?php if ($this->_var['row']['location2'] != ""): ?>
					<a target="dialog" href="?action=record&do=location1&lo=<?php echo $this->_var['row']['location2']; ?>" style="vertical-align:middle"><img id="re1" src="/<?php echo $this->_var['row']['location2']; ?>.jpg" height="50px"/></a>
					<?php endif; ?>
					<?php if ($this->_var['row']['location2'] == ""): ?>
					<img id="re1" src="/uploads/error.jpg" height="50px"/>
					<?php endif; ?>
					图片上传，小于2M，jpg、jpeg格式
				</p><br />
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