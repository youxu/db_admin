<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="<?php echo base_url();?>admin_style/style.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>后台管理</title>
<script type="text/javascript" src="<?php echo base_url();?>admin_style/js/jquery.js"></script>
</head>

<body scroll="no" style="margin:0; padding:0;" >
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3">

		<div class="header"><!-- 头部 begin -->

		    <div class="logo"><a href="index.php" >&nbsp;</a></div>

		    <div class="nav_sub">
		    	<p>Hi, <em>root</em> ,Last login:2012-3-19 23:20:20  ; Times:7   [ <a href="" target="_top">Logout</a> ]</p>
            <div id="TopTime"></div>

		    </div>

		    <div class="main_nav">
		    	<a id="channel_index" class="on" href="javascript:void(0)" onclick="switchChannel('index');" hidefocus="true" style="outline:none;">首页</a>
                <a id="channel_global"  href="javascript:void(0)" onclick="switchChannel('global');" hidefocus="true" style="outline:none;">全局</a>
                <a id="channel_extension"  href="javascript:void(0)" onclick="switchChannel('extension');" hidefocus="true" style="outline:none;">用户管理</a>
            </div>                   

		</div>

		<div class="header_line"><span>&nbsp;</span></div>

	</td>

  </tr>

  <tr>

  	<td width="200px" height="100%" valign="top" id="FrameTitle" background="<?php echo base_url();?>admin_style/images/left_bg.gif">
  		<?php include_once 'left.php'; ?>
	</td>

    <td>

   	  <iframe id="MainIframe" name="MainIframe" scrolling="yes" src="statistics.php" width="100%" height="100%" frameborder="0" noresize> </iframe>

	</td>

  </tr>

</table>

</body>



<script type="text/javascript">

	var current_channel   = null;

	var current_menu_root = null;

	var current_menu_sub  = null;

	var viewed_channel	  = new Array();

	

	$(document).ready(function(){

		switchChannel('index');

	});

	

	//切换频道（即头部的tab）

	function switchChannel(channel) {

		if(current_channel == channel) return false;

		

		$('#channel_'+current_channel).removeClass('on');

		$('#channel_'+channel).addClass('on');

		

		$('#root_'+current_channel).css('display', 'none');

		$('#root_'+channel).css('display', 'block');

		

		var tmp_menulist = $('#root_'+channel).find('a');

		tmp_menulist.each(function(i, n) {

			// 防止重复点击ROOT菜单

			if( i == 0 && $.inArray($(n).attr('id'), viewed_channel) == -1 ) {

				$(n).click();

				viewed_channel.push($(n).attr('id'));

			}

			if ( i == 1 ) {

				$(n).click();

			}

		});



		current_channel = channel;

	}

	

	function switch_root_menu(root) {

		root = $('#tree_'+root);

		if (root.css('display') == 'block') {

			root.css('display', 'none');

			root.parent().css('backgroundImage', 'url(<?php echo base_url();?>admin_style/images/ArrOn.png)');

		}else {

			root.css('display', 'block');

			root.parent().css('backgroundImage', 'url(<?php echo base_url();?>admin_style/images/ArrOff.png)');

		}

	}

	

	function switch_sub_menu(sub, url) {

		if(current_menu_sub) {

			$('#menu_'+current_menu_sub).attr('class', 'submenuA');

		}

		$('#menu_'+sub).attr('class', 'submenuB');

		current_menu_sub = sub;

		

		parent.MainIframe.location = url;

	}

</script>

</html>