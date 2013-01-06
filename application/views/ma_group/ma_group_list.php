
<div class="list">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <thead>
  <tr>
    <th class="line_l">机器组名称</th>
    <th class="line_l">IP组</th>
    <th class="line_l">测试主机IP：</th>
    <th class="line_l">状态</th>
    <th class="line_l">编辑</th>
  </tr>
  </thead>
  <tbody id="tablist">
  <?php foreach ($userList as $k=>$v):?>
  <tr overstyle='on' id="tr_<?php echo $v['id'];?>">

	    <td><?php echo $v['name']?></td>
	    <td><?php echo $v['ip']?></td>
	    <td><?php echo $v['ip_top']?></td>
	    <td><?php echo $v['status'] =='1'?'启用':'未启用'?></td>
		<td>
			<a href="<?php echo site_url().'/ma_group/update_ma_group/'.$v['id']?>" >编辑 </a> 
	    	<a href="#" onclick="del_ma_group('<?php echo $v['name'];?>','<?php echo $v['id']?>',this);">删除</a>
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