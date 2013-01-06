

<div class="so_main">

  <div class="page_tit">添加新闻</div>
 
  <div class="form2">
  	<form method="post" id="add_news" action="<?php echo site_url()?>/user/add_user" enctype="multipart/form-data">
    <dl class="lineD">
      <dt>新闻标题：</dt>
      <dd>
        <input name="title" id="title" type="text" value="" />
      </dd>
    </dl>
    <dl class="lineD">
      <dt>新闻类别：</dt>
      <dd>
       	<?php echo $pid_list?>
      </dd>
    </dl>
    <dl class="lineD">
      <dt>上传附件：</dt>
      <dd>
       <input type="file" name="userfile" id="userfile" /> <input type="button" value="上传" id="upload_btn" />
       <img id="loading" src="/admin_style/images/loading.gif" style="display:none;" />
       <img id="img_sl" src="" width="200" height="100" style="display:none;" />
      </dd>
    </dl>
	 <dl class="lineD">
      <dt>新闻内容：</dt>
      <dd>
       <textarea name="news_detail" id="news_detail"> </textarea>
		<script type="text/javascript">
		    var editor = new UE.ui.Editor();
		    editor.render("news_detail");
		    editor.ready(function(){
		    //需要ready后执行，否则可能报错

		})
		</script>
      </dd>
    </dl>
    <dl class="lineD">
      <dt>是否显示：</dt>
      <dd>
       		<label><input name="status" type="radio" value="1" checked/> 显示</label> 
            <label><input name="status" type="radio" value="0"/> 不显示</label>
      </dd>
    </dl>
    <dl class="lineD">
      <dt>是否置顶：</dt>
      <dd>
       		<label><input name="is_top" type="radio" value="1" /> 是</label> 
            <label><input name="is_top" type="radio" value="0" checked/> 否</label>
      </dd>
    </dl>
    
    <div class="page_btm">
      <input type="hidden" id="img_url" name="img_url" value="<?php echo $path?>" />
      <input type="hidden" id="img_name" name="img_name" value="" />
      <input type="submit" id="btn_sub" class="btn_b" value="确定" />
      <input type="button" id="test" class="btn_b" value="test" />
    </div>
  </form>
  </div>

</div>
