
<div class="list">
<?php 
if($pid != '0'):
?>
<a href="javascript:self.history.back(1);" >返回上一级</a>
<?php endif;?>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <thead>
  <tr>
    <th class="line_l">导航名称</th>
    <th class="line_l">导航地址</th>
    <th class="line_l">导航父级</th>
    <th class="line_l">是否显示</th>
    <th class="line_l">顺序</th>
    <th class="line_l">操作</th>
  </tr>
  </thead>
  <tbody id="tablist">
  <?php foreach ($modList as $k=>$v):?>
  <tr overstyle='on' id="tr_<?php echo $v['id'];?>">

	    <td><a href="/index.php/menu/index/<?php echo $v['id']?>"><?php echo $v['name']?></a>
	    <input type="hidden" name="id_list[]" value="<?php echo $v['id']?>" />
	    </td>
	    <td><?php echo $v['menu_url']?></td>
	    <td><?php echo $v['pid_name'] == '' ? '顶级' : $v['pid_name'] ?></td>
	    <td><?php echo $v['status'] == '1' ? "是":"否"?></td>
	    <td><input type="text" name="order_num[]" style="width:30px" value="<?php echo $v['order_num']?>" /></td>
		<td>
			<a href="<?php echo site_url().'/menu/update_menu/'.$v['id']?>" >编辑 </a> 
	    	<a href="#" onclick="del_mod('<?php echo $v['name'];?>','<?php echo $v['id']?>',this);">删除</a>
	    </td>
	  </tr>
<?php endforeach;?>	  
</tbody>
	  </table>

  </div>
  <div class="Toolbar_inbox">
  <input type="hidden" value="<?php echo $pid?>" id="pid" />
  <input style="float:right" id="order_button" type="button" value="更改显示顺序" />
  	<div class="page right" id="pager">
  	
	<?php echo $pager;?>
  	</div>
  	
  </div>
  <div style="display:none">
  <form action="/index.php/menu/order_num" id="order_num"  method="POST" enctype="multipart/form-data">
  	<input id="menu_id_list" name="menu_id_list" value="" type="hidden"/>
  	<input id="menu_num_list" name="menu_num_list" value="" type="hidden"/>
  	<input id="url" name="url" value="<?php echo $url?>" type="hidden"/>
  </form>
  </div>