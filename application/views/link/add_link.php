

<div class="so_main">

  <div class="page_tit">添加链接</div>
 
  <div class="form2">
  	<form method="post" id="add_link" action="<?php echo site_url()?>/link/add_link" enctype="multipart/form-data">
    <dl class="lineD">
      <dt>友情链接名称：</dt>
      <dd>
        <input name="name" id="name" type="text" value="">
      </dd>
    </dl>
    <dl class="lineD">
      <dt>友情链接url：</dt>
      <dd>
        <input name="url" id="url" type="text" value="">
      </dd>
    </dl>
    <dl class="lineD">
      <dt>友情链接图片：</dt>
      <dd>
        <input name="img" id="img" type="file" value="">
      </dd>
    </dl>
     <dl class="lineD">
      <dt>是否启用：</dt>
      <dd>
       		<label><input name="status" type="radio" value="1" checked/> 开启</label> 
            <label><input name="status" type="radio" value="0"/> 关闭</label><?php if(isset($error))echo $error?>
      </dd>
    </dl>
    
    <div class="page_btm">
    
      <input type="submit" id="btn_sub" class="btn_b" value="确定" />
    </div>
  </form>
  </div>

</div>
