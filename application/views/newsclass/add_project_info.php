<div class="so_main">
  <div class="page_tit">添加项目详细信息</div>
  <div class="form2">
  	<form method="post" id="add_project_info" action="<?php echo site_url()?>/project/add_project" enctype="multipart/form-data">
     <dl class="lineD">
      <dt>所属项目：</dt>
      <dd>
	       <select id="pid" name='pid' <?php if(isset($h_pid) && !empty($h_pid)) {echo 'disabled';}?> >
	       <option value="">请选择</option>
	       <?php foreach ($project_list as $k=>$v):?>
	       		<option value="<?php echo $v['id']?>" <?php if(isset($h_pid) && !empty($h_pid)){if($h_pid == $v['id']){echo 'selected="selected"';}} ?>><?php echo $v['name']?></option>
	       <?php endforeach;?>		
	       </select>
	       <span id="project_name">
	  			<?php if(isset($project_info) && !empty($project_info)):?>
					<?php foreach ($project_info as $pk=>$pv): ?>
						<a href="#" class="a_mar_5" onclick="open_div('<?php echo $pv['id']?>')"><?php echo $pv['name']?></a>
					<?php endforeach;?>
				<?php endif;?>	
	       </span>
      </dd>
    </dl>
    <dl class="lineD">
      <dt>选择机器组：</dt>
      <dd>
         <select id="ma_group" name='ma_group'>
	       <option value="">请选择</option>
	       <?php foreach ($ma_group_list as $k=>$v):?>
	       		<option value="<?php echo $v['id']?>"><?php echo $v['name']?></option>
	       <?php endforeach;?>		
	       </select>
      </dd>
    </dl>
  	<dl class="lineD">
      <dt>名称：</dt>
      <dd>
        <input name="project_info_name" id="project_info_name" type="text" value="">
      </dd>
    </dl>
    
    <dl class="lineD">
      <dt>端口：</dt>
      <dd>
        <input name="d_port" id="d_port" type="text" value="">
      </dd>
    </dl>
    <dl class="lineD">
      <dt>数据库名：</dt>
      <dd>
        <input name="database" id="database" type="text" value="">
      </dd>
    </dl>
    <dl class="lineD">
      <dt>数据库用户名：</dt>
      <dd>
        <input name="d_name" id="d_name" type="text" value="">
      </dd>
    </dl>
    
   <dl class="lineD">
      <dt>数据库密码：</dt>
      <dd>
        <input name="d_psd" id="d_psd" type="text" value="">
      </dd>
    </dl>
     <dl class="lineD">
      <dt>是否启用：</dt>
      <dd>
       		<label><input name="status" type="radio" value="1" checked/> 开启</label> 
            <label><input name="status" type="radio" value="0"/> 关闭</label>
      </dd>
    </dl>
    <div class="page_btm">
      <input type="submit" class="btn_b" value="确定" />
    </div>
  </form>
  </div>
</div>
<div id="div_count" style="display:none">
	<?php if(isset($project_info) && !empty($project_info)):?>
		<?php foreach ($project_info as $pk=>$pv): ?>
		<div id="project_info_<?php echo $pv['id']?>" style="display:none">
			<table width="100%" border="0" cellspacing="2" cellpadding="2">
				<tr>
					<td align="right">名称：</td>
					<td align="left"><?php echo $pv['name'];?></td>
				</tr>
				<tr>
					<td align="right">服务器ip地址：</td>
					<td align="left"><?php echo $pv['d_ip'];?></td>
				</tr>
				<tr>
					<td align="right">端口：</td>
					<td align="left"><?php echo $pv['d_port'];?></td>
				</tr>
				<tr>
					<td align="right">数据库名：</td>
					<td align="left"><?php echo $pv['database'];?></td>
				</tr>
				<tr>
					<td align="right">数据库用户名：</td>
					<td align="left"><?php echo $pv['d_name'];?></td>
				</tr>
				<tr>
					<td align="right">数据库密码：</td>
					<td align="left"><?php echo $pv['d_psd'];?></td>
				</tr>
				<tr>
					<td align="right">状态：</td>
					<td align="left"><?php echo $pv['status'] == '1'? '启用' : '未启用' ;?></td>
				</tr>
			</table>
		</div>	
		
		<?php endforeach;?>
	
	<?php endif;?>
</div>