<div class="so_main">
  <div class="page_tit">添加新闻分类</div>
  <div class="form2">
  	<form method="post" id="add_newsclass" action="<?php echo site_url()?>/newsclass/add_newsclass" enctype="multipart/form-data">
    <dl class="lineD">
      <dt>分类名称：</dt>
      <dd>
        <input name="name" id="name" type="text" value="">
      </dd>
    </dl>
    <dl class="lineD">
      <dt>父级：</dt>
      <dd>
        <?php echo $new_all_class?>
      </dd>
    </dl>

    <div class="page_btm">
      <input type="submit" id="btn_sub" class="btn_b" value="确定" />
    </div>
  </form>
  </div>
</div>
