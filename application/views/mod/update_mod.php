<div class="so_main">
  <div class="page_tit">编辑模块</div>
  <div class="form2">
  	<form method="post" id="update_mod" action="<?php echo site_url()?>/project/update_project" enctype="multipart/form-data">
    <dl class="lineD">
      <dt>模块名称：</dt>
      <dd>
        <input name="name" id="name" type="text" value="<?php echo $mod_info['name']?>">
      </dd>
    </dl>
    <dl class="lineD">
      <dt>模块代码：</dt>
      <dd>
        <input name="model" id="model" type="text" value="<?php echo $mod_info['model']?>">
      </dd>
    </dl>
    <div class="page_btm">
     	<input type="hidden" name="mod_id" id="mod_id" value="<?php echo $mod_info['id']?>" />
     	<input type="hidden" name="old_name" id="old_name" value="<?php echo $mod_info['name']?>" />
      <input type="submit" id="btn_sub" class="btn_b" value="确定" />
    </div>
  </form>
  </div>
</div>

