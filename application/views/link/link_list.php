
<div class="list">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <thead>
	  <tr>
	    <th class="line_l">链接名称</th>
	    <th class="line_l">链接地址</th>
	    <th class="line_l">链接图片</th>
	    <th class="line_l">是否显示</th>
	    <th class="line_l">显示顺序</th>
	    <th class="line_l">操作</th>
	  </tr>
	  </thead>
	<tbody id="tablist">
	  <?php foreach ($list as $k=>$v):?>
		  <tr overstyle='on'>
	
		    <td><?php echo $v['name']?>
		    <input type="hidden" name="id_list[]" value="<?php echo $v['id']?>" />
		    </td>
		    <td><?php echo $v['url']?></td>
		    <td><?php if(!empty($v['img'])) echo '<img src="'.$v['img'].'" width=200 height=100 />'?></td>
		   
		    <td><?php echo $v['status'] == '1' ? '启用' :'停用'?></td>
		    <td><input type="text" style="width:30px" name="order_num[]" value="<?php echo $v['order_num']?>" /></td>
			<td>
				<a href="<?php echo site_url().'/link/update_link/'.$v['id']?>" >编辑 </a> 
		    	<a href="#" onclick="del_user('<?php echo $v['name'] ?>','<?php echo $v['id'] ?>',this);">删除</a>
		    </td>
		  </tr>
		<?php endforeach;?>	  
		</tbody>
	</table>

</div>
  <div class="Toolbar_inbox">
  <input type="button" value="更改显示顺序" id="order_button" style="float:right" />
  	<div class="page right" id="pager">
	<?php echo $pager;?>
  	</div>
  </div>
  <div style="display:none">
  <form action="/index.php/link/order_num" id="order_num"  method="POST" enctype="multipart/form-data">
  	<input id="menu_id_list" name="menu_id_list" value="" type="hidden"/>
  	<input id="menu_num_list" name="menu_num_list" value="" type="hidden"/>
  	<input id="url" name="url" value="<?php echo $url?>" type="hidden"/>
  </form>
  </div> 