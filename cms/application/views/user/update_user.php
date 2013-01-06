
<div class="so_main">
  <div class="page_tit">编辑用户</div>
 
  <div class="form2">
  	<form method="post" action="<?php echo site_url()?>/bd/user/update_user" enctype="multipart/form-data" id="update_user">
    <dl class="lineD">
      <dt>用户名：</dt>
      <dd>
        <input name="name"  type="text" readonly value="<?php echo $userInfo['name']?>">
      </dd>
    </dl>
    <dl class="lineD">
      <dt>中文用户名：</dt>
      <dd>
        <input name="chname"  id="chname" type="text" value="">
      </dd>
    </dl>
    <dl class="lineD">
      <dt>密码：</dt>
      <dd>
        <input name="psd" id="psd" type="password" value="">
      </dd>
    </dl>
    <dl class="lineD">
      <dt>重复密码：</dt>
      <dd>
        <input name="repsd" id="repsd" type="password" value="">
      </dd>
    </dl>
    <dl class="lineD">
      <dt>是否具有审核权限：</dt>
      <dd>
       		<label><input name="is_admin" type="radio" value="1" <?php echo $userInfo['is_admin'] == '1' ? 'checked' : '' ?>/> 开启</label> 
            <label><input name="is_admin" type="radio" value="0"  <?php echo $userInfo['is_admin'] == '0' ? 'checked' : '' ?>/> 关闭</label>
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
      <input type="submit" class="btn_b" value="确定" />
    </div>
  </form>
  </div>

</div>

