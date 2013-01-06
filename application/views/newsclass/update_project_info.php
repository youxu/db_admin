<div class="so_main">
  <div class="page_tit">编辑项目详细</div>
  <div class="form2">
  	<form method="post" id="update_project_info" action="<?php echo site_url()?>/project/add_project" enctype="multipart/form-data">
  	<dl class="lineD">
      <dt>选择机器组：</dt>
      <dd>
         <select id="ma_group" name='ma_group'>
	       <option value="">请选择</option>
	       <?php foreach ($ma_group_list as $k=>$v):?>
	       		<option value="<?php echo $v['id']?>" <?php if($project_info_list['ma_group'] == $v['id']) echo 'selected="selected"' ?>><?php echo $v['name']?></option>
	       <?php endforeach;?>		
	       </select>
      </dd>
    </dl>
  	<dl class="lineD">
      <dt>名称<?php echo $project_info_list['ma_group'] ?>：</dt>
      <dd>
        <input name="name" id="name" type="text" value="<?php echo $project_info_list['name'] ?>">
      </dd>
    </dl>
    <dl class="lineD">
      <dt>端口：</dt>
      <dd>
        <input name="d_port" id="d_port" type="text" value="<?php echo $project_info_list['d_port'] ?>">
      </dd>
    </dl>
     <dl class="lineD">
      <dt>数据库名：</dt>
      <dd>
        <input name="database" id="database" type="text" value="<?php echo $project_info_list['database'] ?>">
      </dd>
    </dl>
    <dl class="lineD">
      <dt>数据库用户名：</dt>
      <dd>
        <input name="d_name" id="d_name" type="text" value="<?php echo $project_info_list['d_name'] ?>">
      </dd>
    </dl>
    
   <dl class="lineD">
      <dt>数据库密码：</dt>
      <dd>
        <input name="d_psd" id="d_psd" type="text" value="<?php echo $project_info_list['d_psd'] ?>">
      </dd>
    </dl>
     <dl class="lineD">
      <dt>是否启用：</dt>
      <dd>
       		<label><input name="status" type="radio" value="1" <?php if ($project_info_list['status'] == '1')  echo "checked='checked'"?> /> 开启</label> 
            <label><input name="status" type="radio" value="0" <?php if ($project_info_list['status'] == '0')  echo "checked='checked'"?>/> 关闭</label>
      </dd>
    </dl>
    <div class="page_btm">
    <input type="hidden" name="id" id="u_id" value="<?php echo $project_info_list['id'] ?>" />
      <input type="hidden" name="pid" id="pid" value="<?php echo $project_info_list['pid'] ?>" />
      <input type="hidden" name="old_name" id="old_name" value="<?php echo $project_info_list['name'] ?>" />
      <input type="submit" class="btn_b" value="确定" />
    </div>
  </form>
  </div>
</div>

