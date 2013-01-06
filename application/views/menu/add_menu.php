<div class="so_main">
  <div class="page_tit">添加导航</div>
  <div class="form2">
  	<form method="post" id="add_mod" action="<?php echo site_url()?>/project/add_project" enctype="multipart/form-data">
    <dl class="lineD">
      <dt>导航名称：</dt>
      <dd>
        <input name="name" id="name" type="text" value="">
      </dd>
    </dl>
    <dl class="lineD">
      <dt>导航地址：</dt>
      <dd>
        <input name="menu_url" id="menu_url" type="text" value="">
      </dd>
    </dl> 
   <dl class="lineD">
      <dt>父级：</dt>
      <dd>
       <?php echo $menu_tree?>
      </dd>
    </dl>
    <dl class="lineD">
      <dt>是否启用：</dt>
      <dd>
        <input name="status" id="pid" type="radio" value="1" checked>是
        <input name="status" id="pid" type="radio" value="0">否
      </dd>
    </dl>
    <div class="page_btm">
      <input type="submit" id="btn_sub" class="btn_b" value="确定" />
    </div>
  </form>
  </div>
</div>
