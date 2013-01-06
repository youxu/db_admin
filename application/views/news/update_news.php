

<div class="so_main">

  <div class="page_tit">编辑新闻</div>
 
  <div class="form2">
  	<form method="post" id="update_news" action="<?php echo site_url()?>/news/update_news" enctype="multipart/form-data">
    <dl class="lineD">
      <dt>新闻标题：</dt>
      <dd>
        <input name="title" id="title" type="text" value="<?php echo $news_info['title']?>" />
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
       <img id="img_sl" src="<?php echo $news_info['img_url']?>" width="200" height="100" <?php if(empty($news_info['img_url'])) echo 'style="display:none"' ?> />
      </dd>
    </dl>
	 <dl class="lineD">
      <dt>新闻内容：</dt>
      <dd>
       <textarea name="news_detail" id="news_detail"><?php echo $news_info['news_detail']?></textarea>
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
       		<label><input name="status" type="radio" value="1" <?php if($news_info['status'] == '1') echo " checked"?>/> 显示</label> 
            <label><input name="status" type="radio" value="0" <?php if($news_info['status'] == '0') echo " checked"?>/> 不显示</label>
      </dd>
    </dl>
    <dl class="lineD">
      <dt>是否置顶：</dt>
      <dd>
       		<label><input name="is_top" type="radio" value="1" <?php if($news_info['is_top'] == '1') echo " checked"?>/> 是</label> 
            <label><input name="is_top" type="radio" value="0" <?php if($news_info['is_top'] == '0') echo " checked"?>/> 否</label>
      </dd>
    </dl>
    
    <div class="page_btm">
      <input type="hidden" id="img_url" name="img_url" value="<?php echo $news_info['img_url'] == '' ? $path : $news_info['img_url']?>" />
      <input type="hidden" id="img_name" name="img_name" value="" />
      <input type="hidden" id="newsid" name="newsid" value="<?php echo $newsid?>" />
      <input type="hidden" id="path" name="path" value="<?php echo $path?>" />
      <input type="hidden" id="classid" name="classid" value="<?php echo $pid?>" />
      <input type="submit" id="btn_sub" class="btn_b" value="确定" />
      
    </div>
  </form>
  </div>

</div>
