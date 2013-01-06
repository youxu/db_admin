<div class="so_main">
  <div class="page_tit">编辑机器组</div>
  <div class="form2">
  	<form method="post" id="update_ma_group" action="<?php echo site_url()?>/ma_group/update_ma_group" enctype="multipart/form-data">
    <dl class="lineD">
      <dt>机器组名称：</dt>
      <dd>
        <input name="name" id="name" type="text" value="<?php echo $ma_group_info['name']?>">
      </dd>
    </dl>
    <dl class="lineD">
      <dt>IP组：</dt>
      <dd>
        <textarea class="textarea" name="ip" id="ip"><?php echo $ma_group_info['ip']?></textarea>
        （用,分隔）
      </dd>
    </dl>
    <dl class="lineD">
      <dt>测试主机IP：</dt>
      <dd>
        <textarea class="textarea" name="ip_top" id="ip_top"><?php echo $ma_group_info['ip_top']?></textarea>
        （用,分隔）
      </dd>
    </dl>
    <dl class="lineD">
      <dt>状态：</dt>
      <dd>
       		<label><input name="status" type="radio" value="1" <?php echo $ma_group_info['status'] =='1' ? 'checked="checked"': ''?> /> 开启</label> 
            <label><input name="status" type="radio" value="0" <?php echo $ma_group_info['status'] =='0' ? 'checked="checked"': ''?>/> 关闭</label>
      </dd>
    </dl>
    <div class="page_btm">
      <input name="old_name" id="old_name" type="hidden" value="<?php echo $ma_group_info['name']?>">
      <input name="m_id" id="m_id" type="hidden" value="<?php echo $ma_group_info['id']?>">
      <input type="submit" id="btn_sub" class="btn_b" value="确定" />
    </div>
  </form>
  </div>
</div>


