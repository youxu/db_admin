
<div class="so_main">
  <div class="page_tit">编辑用户</div>
  <div class="form2">
  	<form method="post" action="<?php echo site_url()?>/user/update_user" enctype="multipart/form-data" id="update_user">
    <dl class="lineD">
      <dt>用户名：</dt>
      <dd>
        <input name="name"  type="text" id="name"  value="<?php echo $userInfo['name']?>">
      </dd>
    </dl>
    <dl class="lineD">
      <dt>中文名：</dt>
      <dd>
        <input name="chname"  type="text" id="chname"  value="<?php echo $userInfo['chname']?>">
      </dd>
    </dl>
     <dl class="lineD">
      <dt>是否启用：</dt>
      <dd>
       		<label><input name="status" type="radio" value="1"  <?php echo $userInfo['status'] == '1' ? 'checked' : '' ?>/> 开启</label> 
            <label><input name="status" type="radio" value="0" <?php echo $userInfo['status'] == '0' ? 'checked' : '' ?>/> 关闭</label>
      </dd>
    </dl>
   
    <div class="page_btm">
      <input type="hidden" name="id" id="user_id" value="<?php echo $userInfo['id']?>" />
      <input type="hidden" name="old_name" id="old_name" value="<?php echo $userInfo['name']?>" />
      <input type="submit" class="btn_b" value="确定" />
    </div>
  </form>
  </div>

</div>

