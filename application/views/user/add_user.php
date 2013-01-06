

<div class="so_main">

  <div class="page_tit">添加用户</div>
 
  <div class="form2">
  	<form method="post" id="add_user" action="<?php echo site_url()?>/user/add_user" enctype="multipart/form-data">
    <dl class="lineD">
      <dt>登录名：</dt>
      <dd>
        <input name="name" id="name" type="text" value="" />
      </dd>
    </dl>

     <dl class="lineD">
      <dt>中文名：</dt>
      <dd>
        <input name="chname" id="chname" type="text" value="">
      </dd>
    </dl>
    <dl class="lineD">
      <dt>密码：</dt>
      <dd>
        <input name="password" id="password" type="password" value="">
      </dd>
    </dl>
    <dl class="lineD">
      <dt>重复密码：</dt>
      <dd>
        <input name="re_password" id="re_password" type="password" value="">
      </dd>
    </dl>
    </dl>
     <dl class="lineD">
      <dt>是否启用：</dt>
      <dd>
       		<label><input name="status" type="radio" value="1" checked/> 开启</label> 
            <label><input name="status" type="radio" value="0"/> 关闭</label>
      </dd>
    </dl>
    <div class="page_btm">
      <input type="submit" id="btn_sub" class="btn_b" value="确定" />
    </div>
  </form>
  </div>

</div>
