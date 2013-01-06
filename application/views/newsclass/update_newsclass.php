<div class="so_main">
  <div class="page_tit">编辑分类</div>
  <div class="form2">
  	<form method="post" id="update_project" action="<?php echo site_url()?>/newsclass/update_newsclass" enctype="multipart/form-data">
    <dl class="lineD">
      <dt>分类名称：</dt>
      <dd>
        <input name="name" id="name" type="text" value="<?php echo $newsclass_info['name']?>">
        
      </dd>
    </dl>
    <dl class="lineD">
      <dt>父级分类：</dt>
      <dd>
      	<?php echo $new_all_class?>
      </dd>
    </dl>

    <div class="page_btm">
     	<input type="hidden" name="project_id" id="project_id" value="<?php echo $newsclass_info['id']?>" />
     	<input type="hidden" name="project_old_name" id="project_old_name"  value="<?php echo $newsclass_info['name']?>" />
      <input type="submit" id="btn_sub" class="btn_b" value="确定" />
    </div>
  </form>
  </div>
</div>

<div id="div_count"  style="display:none"">

</div> 

