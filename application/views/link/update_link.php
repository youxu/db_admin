

<div class="so_main">

  <div class="page_tit">编辑链接</div>
 
  <div class="form2">
  	<form method="post" id="update_link" action="<?php echo site_url()?>/link/update_link" enctype="multipart/form-data">
    <dl class="lineD">
      <dt>链接名称：</dt>
      <dd>
        <input name="name" id="name" type="text" value="<?php echo $project_group_list['name'] ?>">
      </dd>
    </dl>
    <dl class="lineD">
      <dt>链接地址：</dt>
      <dd>
        <input name="url" id="url" type="text" value="<?php echo $project_group_list['url']?>">
      </dd>
    </dl>
    <dl class="lineD">
      <dt>链接图片：</dt>
      <dd>
        <input name="img" id="img" type="file" value="">
        <?php echo $project_group_list['img'] != '' ? '<img src="'.$project_group_list['img'].'"  border=0 width="200" height=100/>'  : '' ?>
      </dd>
    </dl>
     <dl class="lineD">
      <dt>是否启用：</dt>
      <dd>
       		<label><input name="status" type="radio" value="1" <?php echo $project_group_list['status'] =='1' ? 'checked' :'';?>/> 开启</label> 
            <label><input name="status" type="radio" value="0" <?php echo $project_group_list['status'] =='0' ? 'checked' :'';?>/> 关闭</label>
<?php if(isset($error))echo $error?>
            </dd>
    </dl>
    <div class="page_btm">
    	<input type="hidden" id="link_id" name="link_id" value="<?php echo $project_group_list['id']; ?>" />
    	<input type="hidden" id="old_img" name="old_img" value="<?php echo $project_group_list['img']; ?>" />
    	<input type="hidden" id="old_name" name="old_name" value="<?php echo $project_group_list['name']; ?>" />
    	
      <input type="submit" id="btn_sub" class="btn_b" value="确定" />
    </div>
  </form>
  </div>

</div>
