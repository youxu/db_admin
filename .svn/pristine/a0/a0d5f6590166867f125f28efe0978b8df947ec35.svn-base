<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="<?php echo base_url();?>admin_style/style.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>后台管理</title>
<script type="text/javascript" src="/admin_style/js/jquery.js"></script>
</head>
<body  style="margin:0; padding:0;" >
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3">
		<div class="header"><!-- 头部 begin -->
		    <div class="logo"><a href="index.php" >&nbsp;</a></div>
		    <div class="nav_sub">
		    	<p>Hi, <em><?php echo $userInfo['chname'];?></em> ,Last login:<?php echo $userInfo['last_login'];?>  ; [ <a href="/index.php/login/Logout" target="_top">Logout</a> ]</p>
            <div id="TopTime"></div>

		    </div>
			<!-- 
		    <div class="main_nav">
		    	<a id="channel_index" class="on" href="javascript:void(0)" onclick="switchChannel('index');" hidefocus="true" style="outline:none;">首页</a>
                <a id="channel_global"  href="javascript:void(0)" onclick="switchChannel('global');" hidefocus="true" style="outline:none;">全局</a>
                <a id="channel_extension"  href="javascript:void(0)" onclick="switchChannel('extension');" hidefocus="true" style="outline:none;">用户管理</a>
            </div>                   
			-->
		</div>

		<div class="header_line"><span>&nbsp;</span></div>

	</td>

  </tr>
</table>  
<table border="0" width="550" cellspacing="0" cellpadding="0" class="e_login_table">
    <tbody>
    <tr>
      <td width="200" align="right">姓&#12288;&#12288;名：
      </td>
      <td style="padding-left:10px;"><span><?php echo $userInfo['chname'];?></span></td>
    </tr>
    <tr>
      <td class="e_td2" valign="top"  align="right">所属项目：
        <td style="padding-left:10px;">
        	<?php if(isset($user_project_list) && !empty($user_project_list)): ?>
        
        		<?php foreach($user_project_list as $k=>$v):?>
        		
        		<p ><a href="/index.php/admin/admin_index/<?php echo $k?>"><?php echo $v?></a></p>
        		<?php endforeach;?>
        	<?php else:?>
        		<p>没有所属项目，请联系<a href="mailto:youxu@leju.com">管理员</a></p>	
        	<?php endif;?>
        </td>
    </tr>
    <tr>
    <?php if(isset($is_admin)):?>
    <tr>
   		<td colspan="2"><a href="">管理员进入</a></td> 
    </tr>
    <?php endif;?>
  </tbody>
</table>

</body>
</html>