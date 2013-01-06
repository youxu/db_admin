<div class="so_main">
  <div class="page_tit">分配权限</div>
  <div class="form2">
  	<form method="post" id="user_root" action="<?php echo site_url()?>/user/user_project" enctype="multipart/form-data">
    <dl class="lineD">
      <dt>用户名：</dt>
      <dd>
        <?php echo $user_info['name'] ?>
      </dd>
    </dl>
     <dl class="lineD">
      <dt>权限列表：</dt>
      <dd>
       		<?php foreach ($mod_list as $k=>$v):?>
       			<p><input type="checkbox" value="<?php echo $v['id'] ?>" name="mod_id" <?php  if(in_array($v['id'],$mod_ids_list)) echo "checked='checked'"?> /><span  <?php  if(in_array($v['id'],$mod_ids_list)) echo "class='red'"?>><?php echo $v['name']; ?></span>&nbsp;&nbsp;</p>
       			
       		<?php endforeach;?>
      </dd>
    </dl>
    <div class="page_btm">
   	  <input type="hidden" id="u_id" name="u_id" class="btn_b" value="<?php echo $user_info['id'] ?>" />
      <input type="submit" id="btn_sub" class="btn_b" value="确定" />
    </div>
  </form>
  </div>

</div>
