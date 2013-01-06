<div class="LeftMenu">
<!-- 第一级菜单，即大频道 -->
<ul class="MenuList" id="root_index" >
<!-- 第二级菜单 -->
	<li class="treemenu">
		<a id="root_1" class="actuator" href="javascript:void(0)" onclick="switch_root_menu('1');" hidefocus="true" style="outline:none;">首页</a>
		<ul id="tree_1" class="submenu">
		<!-- 第三级菜单 -->
		<li><a id="menu_2" href="javascript:void(0)" onClick="switch_sub_menu('2', '/project');" class="submenuA" hidefocus="true" style="outline:none;">首页</a></li>
		<li><a id="menu_3" href="javascript:void(0)" onClick="switch_sub_menu('3', '/project');" class="submenuA" hidefocus="true" style="outline:none;">系统升级</a></li>
		</ul>
	</li>
	<?php if (is_have_power('newsclass',$user_mod_list)):?>
	<li class="treemenu">
		<a id="root_2" class="actuator" href="javascript:void(0)" onclick="switch_root_menu('2');" hidefocus="true" style="outline:none;">分类管理</a>
		<ul id="tree_2" class="submenu">
		<!-- 第三级菜单 -->
		<li><a id="menu_4" href="javascript:void(0)" onClick="switch_sub_menu('4', '<?php echo site_url()?>/newsclass');" class="submenuA" hidefocus="true" style="outline:none;">分类列表</a></li>
		<li><a id="menu_5" href="javascript:void(0)" onClick="switch_sub_menu('5', '<?php echo site_url()?>/newsclass/add_newsclass');" class="submenuA" hidefocus="true" style="outline:none;">添加分类</a></li>
		</ul>
	</li>
	<?php endif;?>
	<?php if (is_have_power('news',$user_mod_list)):?>
	<li class="treemenu">
		<a id="root_3" class="actuator" href="javascript:void(0)" onclick="switch_root_menu('3');" hidefocus="true" style="outline:none;">新闻管理</a>
		<ul id="tree_3" class="submenu">
		<!-- 第三级菜单 -->
		<li><a id="menu_7" href="javascript:void(0)" onClick="switch_sub_menu('7', '<?php echo site_url()?>/news');" class="submenuA" hidefocus="true" style="outline:none;">新闻列表</a></li>
		<li><a id="menu_8" href="javascript:void(0)" onClick="switch_sub_menu('8', '<?php echo site_url()?>/news/add_news');" class="submenuA" hidefocus="true" style="outline:none;">添加新闻</a></li>
		</ul>
	</li>
	<?php endif;?>
	<?php if (is_have_power('user',$user_mod_list)):?>
	<li class="treemenu">
		<a id="root_4" class="actuator" href="javascript:void(0)" onclick="switch_root_menu('4');" hidefocus="true" style="outline:none;">用户管理</a>
		<ul id="tree_4" class="submenu">
		<!-- 第三级菜单 -->
		<li><a id="menu_9" href="javascript:void(0)" onClick="switch_sub_menu('9', '<?php echo site_url()?>/user');" class="submenuA" hidefocus="true" style="outline:none;">用户列表</a></li>
		<li><a id="menu_10" href="javascript:void(0)" onClick="switch_sub_menu('10', '<?php echo site_url()?>/user/add_user');" class="submenuA" hidefocus="true" style="outline:none;">添加用户</a></li>

		</ul>
	</li>
	<?php endif;?>
	<?php if (is_have_power('menu',$user_mod_list)):?>
	<li class="treemenu">
		<a id="root_5" class="actuator" href="javascript:void(0)" onclick="switch_root_menu('5');" hidefocus="true" style="outline:none;">导航管理</a>
		<ul id="tree_5" class="submenu">
		<!-- 第三级菜单 -->
		<li><a id="menu_14" href="javascript:void(0)" onClick="switch_sub_menu('14', '<?php echo site_url()?>/menu');" class="submenuA" hidefocus="true" style="outline:none;">导航列表</a></li>
		<li><a id="menu_15" href="javascript:void(0)" onClick="switch_sub_menu('15', '<?php echo site_url()?>/menu/add_menu');" class="submenuA" hidefocus="true" style="outline:none;">添加导航</a></li>
		</ul>
	</li>
	<?php endif;?>
	<?php if (is_have_power('link',$user_mod_list)):?>
	<li class="treemenu">
		<a id="root_7" class="actuator" href="javascript:void(0)" onclick="switch_root_menu('7');" hidefocus="true" style="outline:none;">链接管理</a>
		<ul id="tree_7" class="submenu">
		<!-- 第三级菜单 -->
		<li><a id="menu_18" href="javascript:void(0)" onClick="switch_sub_menu('18', '<?php echo site_url()?>/link');" class="submenuA" hidefocus="true" style="outline:none;">链接列表</a></li>
		<li><a id="menu_19" href="javascript:void(0)" onClick="switch_sub_menu('19', '<?php echo site_url()?>/link/add_link');" class="submenuA" hidefocus="true" style="outline:none;">添加链接</a></li>
		</ul>
	</li>
	<?php endif;?>
	<?php if (is_have_power('mod',$user_mod_list)):?>
	<li class="treemenu">
		<a id="root_6" class="actuator" href="javascript:void(0)" onclick="switch_root_menu('6');" hidefocus="true" style="outline:none;">系统管理</a>
		<ul id="tree_6" class="submenu">
		<!-- 第三级菜单 -->
		<li><a id="menu_16" href="javascript:void(0)" onClick="switch_sub_menu('16', '<?php echo site_url()?>/mod');" class="submenuA" hidefocus="true" style="outline:none;">模块管理</a></li>
		<li><a id="menu_17" href="javascript:void(0)" onClick="switch_sub_menu('17', '<?php echo site_url()?>/mod/add_mod');" class="submenuA" hidefocus="true" style="outline:none;">添加模块</a></li>
		</ul>
	</li>
	<?php endif;?>
</ul>
<!-- 
<ul class="MenuList" id="root_global" style="display:none;">

<li class="treemenu">
	<a id="root_4" class="actuator" href="javascript:void(0)" onclick="switch_root_menu('4');" hidefocus="true" style="outline:none;">全局配置</a>
	<ul id="tree_4" class="submenu">

	<li><a id="menu_5" href="javascript:void(0)" onClick="switch_sub_menu('5', 'siteopt.php');" class="submenuA" hidefocus="true" style="outline:none;">站点配置</a></li>
	<li><a id="menu_6" href="javascript:void(0)" onClick="switch_sub_menu('6', 'imgcredit.php');" class="submenuA" hidefocus="true" style="outline:none;">积分配置</a></li>
	<li><a id="menu_7" href="javascript:void(0)" onClick="switch_sub_menu('7', 'log.php');" class="submenuA" hidefocus="true" style="outline:none;">后台管理日志</a></li>
	<li><a id="menu_8" href="javascript:void(0)" onClick="switch_sub_menu('8', 'user.php');" class="submenuA" hidefocus="true" style="outline:none;">用户管理</a></li>
	</ul>
</li>
<li class="treemenu">
	<a id="root_9" class="actuator" href="javascript:void(0)" onclick="switch_root_menu('9');" hidefocus="true" style="outline:none;">权限</a>
	<ul id="tree_9" class="submenu">

	<li><a id="menu_10" href="javascript:void(0)" onClick="switch_sub_menu('10', 'imgnode');" class="submenuA" hidefocus="true" style="outline:none;">节点管理</a></li>
	<li><a id="menu_11" href="javascript:void(0)" onClick="switch_sub_menu('11', 'imgpopedom');" class="submenuA" hidefocus="true" style="outline:none;">权限管理</a></li>
	</ul>
</li>
</ul>

<ul class="MenuList" id="root_extension" style="display:none;">

<li class="treemenu">
<a id="root_12" class="actuator" href="javascript:void(0)" onclick="switch_root_menu('12');" hidefocus="true" style="outline:none;">用户管理</a>
	<ul id="tree_12" class="submenu">

	<li><a id="menu_13" href="javascript:void(0)" onClick="switch_sub_menu('13', '<?php echo site_url()?>/bd/user/add_user');" class="submenuA" hidefocus="true" style="outline:none;">添加用户</a></li>
	<li><a id="menu_13" href="javascript:void(0)" onClick="switch_sub_menu('14', '<?php echo site_url()?>/bd/user/index');" class="submenuA" hidefocus="true" style="outline:none;">用户列表</a></li>
	</ul>
</li>
</ul>

-->
</div>