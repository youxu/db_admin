
<div class="list">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <thead>
	  <tr>
	    <th class="line_l">用户名</th>
	    <th class="line_l">中文名</th>
	    <th class="line_l">状态</th>
	    <th class="line_l">操作</th>
	  </tr>
	  </thead>
	<tbody id="tablist">
	  <?php foreach ($userList as $k=>$v):?>
		  <tr overstyle='on'>
	
		    <td><?php echo $v['name']?></td>
		    <td><?php echo $v['chname']?></td>
		    <td><?php echo $v['status'] =='1'?'启用':'未启用'?></td>
			<td>
				<a href="<?php echo site_url().'/user/update_user/'.$v['id']?>" >编辑 </a> 
				<a href="<?php echo site_url().'/user/user_project/'.$v['id']?>" >分配项目 </a> 
				<a href="<?php echo site_url().'/user/user_root/'.$v['id']?>" >分配权限 </a> 
		    	<a href="#" onclick="del_user('<?php echo $v['name'] ?>','<?php echo $v['id'] ?>',this);">删除</a>
		    </td>
		  </tr>
		<?php endforeach;?>	  
		</tbody>
	</table>

</div>
  <div class="Toolbar_inbox">
  	<div class="page right" id="pager">
	<?php echo $pager;?>
  	</div>
  </div>