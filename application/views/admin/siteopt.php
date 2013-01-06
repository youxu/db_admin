<?php include_once 'header.php'; ?>
<div class="so_main">
  <div class="page_tit">站点配置</div>
  <div class="tit_tab">
  	<ul>
    <li><a href="#" class="on" >站点配置</a></li>
    <li><a href="#" >是否需要登录</a></li>
    </ul>
</div>
  <div class="form2">
  	<form method="post" action="http://192.168.1.111/sns/index.php?app=admin&mod=Global&act=doSetSiteOpt" enctype="multipart/form-data">
    <dl class="lineD">
      <dt>站点名称：</dt>
      <dd>
        <input name="site_name" type="text" value="ThinkSNS">
      </dd>
    </dl>
    <dl class="lineD">
    	<dt>群微博：</dt>
    	<dd>
            <label><input name="weibo" type="radio" value="1"/> 开启</label> 
            <label><input name="weibo" type="radio" value="0"/> 关闭</label>
            <p>多个使用英文的“|”分割</p>
        </dd>
    </dl>
    <dl class="lineD">
      <dt>slogan：</dt>
      <dd>
        <input name="site_slogan" type="text" value="社会化动力平台">
      </dd>
    </dl>    
    <dl class="lineD">
      <dt>左侧的应用名超过4个字时：</dt>
      <dd>
        <label>
            <input name="site_appalias_wordwrap" type="radio" value="1" checked>换行
        </label>
        <br>
        <label>
            <input name="site_appalias_wordwrap" type="radio" value="0" >隐藏多余字符
        </label>
      </dd>
    </dl>
    <dl class="lineD">
      <dt>公司名/ICP/IP/域名备案：</dt>
      <dd>
        <input name="site_icp" type="text" value="智士软件（北京）有限公司 京ICP备04000001号">
        <p>例如：智士软件(北京)有限公司 京ICP备04000001号</p>
      </dd>
    </dl>
    <dl class="lineD">
      <dt>风格包：</dt>
      <dd>
          <select name="site_theme">
              <option value="weibo" >weibo</option><option value="newstyle" selected>newstyle</option><option value="classic2" >classic2</option>          </select>
          <p>重要: 修改风格包后需要手动清理缓存!</p>
      </dd>
      <dt>logo：</dt>
      <dd>
          <img src="admin/images/logo.jpg" /><br />
		  <input type="file" name="site_logo" />
          <p>重要: 在线上传LOGO，需要赋予public/themes/newstyle/images/目录写权限，最好是透明PNG图标!</p>
      </dd>
      <dt>banner：</dt>
      <dd>
          <img src="" style="width:600px" /><br />
          <input type="file" name="banner_logo" />
          <p>重要: 因为各种模板的样式和比例不同，请注意图片大小，程序并不进行自动剪切!</p>
          <p>Newstyle模板，为960*305尺寸</p>
          <p>weibo模板，为525*430尺寸</p>
          <p>classic2模板，为960*305尺寸</p>
      </dd>
    </dl>
    <dt>表情包：</dt>
      <dd>
          <select name="expression">
              <option value="miniblog" selected>miniblog</option>          </select>
          <p>重要: 修改表情包后需要手动清理缓存!</p>
      </dd>
    </dl>
    <dl>
      <dt>开启验证码：</dt>
      <dd>
        <label>
        	<input name="site_verify[]" type="checkbox" value="register" checked>注册页面
        </label>
        <br>
        <label>
        	<input name="site_verify[]" type="checkbox" value="login" >登录页面
        </label>
      </dd>
    </dl>
    <dl class="">
      <dt>全站微博、评论字数限制：</dt>
      <dd>
        <input name="length" type="text" value=""> 字
      </dd>
    </dl>
    <div class="page_btm">
      <input type="submit" class="btn_b" value="确定" />
    </div>
    <input type="hidden" name="__hash__" value="40ac31def650d59ecf40b31d907cedcd" /></form>
  </div>

</div>
<?php include_once 'footer.php' ?>