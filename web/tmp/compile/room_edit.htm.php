<form id="pagerForm" method="post" action="index.php?action=room">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="<?php echo $this->_var['numPerPage']; ?>" />
</form>
<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=room&do=updata" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<input type="hidden" style="display:none;" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>仓库名称：</label>
					<input name="name" class="required" type="text" size="30" value="<?php echo $this->_var['row']['name']; ?>" alt=""/>
				</p>
				<p>
					<label>所在地区：</label>					
					<input name="address" class="required" type="text" size="30" value="<?php echo $this->_var['row']['address']; ?>" alt=""/>
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