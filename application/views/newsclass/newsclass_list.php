
<div class="list">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <thead>
  <tr>
    <th class="line_l">分类名称</th>
    <th class="line_l">编辑</th>
  </tr>
  </thead>
  <tbody id="tablist">
  <?php foreach ($userList as $k=>$v):?>
  <tr overstyle='on' id="tr_<?php echo $v['id'];?>">

	    <td><?php echo $v['name']?></td>
		<td>
			<a href="<?php echo site_url().'/newsclass/update_newsclass/'.$v['id']?>" >编辑 </a> 
	    	<a href="#" onclick="del_project('<?php echo $v['name'];?>','<?php echo $v['id']?>',this);">删除</a>
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