
<div class="list">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <thead>
  <tr>
    <th class="line_l">新闻标题</th>
    <th class="line_l">新闻栏目</th>
    <th class="line_l">是否显示</th>
    <th class="line_l">是否置顶</th>
    <th class="line_l">编辑</th>
  </tr>
  </thead>
  <tbody id="tablist">
  <?php foreach ($userList as $k=>$v):?>
  <tr overstyle='on' id="tr_<?php echo $v['id'];?>">

	    <td><?php echo $v['title']?></td>
	    <td><?php echo $v['cname']?></td>
	    <td><?php if($v['status'] == '1') {echo "是";}else{echo '否';}?></td>
	     <td><?php if($v['is_top'] == '1') {echo "是";}else{echo '否';}?></td>
		<td>
			<a href="<?php echo site_url().'/news/update_news/'.$v['id'].'/'.$cid; ?>" >编辑 </a> 
	    	<a href="#" onclick="del_user('<?php echo $v['title'];?>','<?php echo $v['id']?>',this);">删除</a>
	    </td>
	  </tr>
<?php endforeach;?>	  
</tbody>
	  </table>

  </div>
  <div class="Toolbar_inbox">
   <input type="hidden" value="<?php  echo $cid?>" id="cid" />
  	<div class="page right" id="pager">
	<?php echo $pager;?>
  	</div>
  	
  </div>