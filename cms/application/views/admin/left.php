<div class="LeftMenu">
<!-- 第一级菜单，即大频道 -->
<ul class="MenuList" id="root_index" >
<!-- 第二级菜单 -->
<li class="treemenu">
<a id="root_1" class="actuator" href="javascript:void(0)" onclick="switch_root_menu('1');" hidefocus="true" style="outline:none;">首页</a>
<ul id="tree_1" class="submenu">
<!-- 第三级菜单 -->
<li><a id="menu_2" href="javascript:void(0)" onClick="switch_sub_menu('2', 'statistics.php');" class="submenuA" hidefocus="true" style="outline:none;">首页</a></li>
<li><a id="menu_3" href="javascript:void(0)" onClick="switch_sub_menu('3', 'update.php');" class="submenuA" hidefocus="true" style="outline:none;">系统升级</a></li>
</ul>
</li>
</ul>
<ul class="MenuList" id="root_global" style="display:none;">
<!-- 第二级菜单 -->
<li class="treemenu">
<a id="root_4" class="actuator" href="javascript:void(0)" onclick="switch_root_menu('4');" hidefocus="true" style="outline:none;">全局配置</a>
<ul id="tree_4" class="submenu">
<!-- 第三级菜单 -->
<li><a id="menu_5" href="javascript:void(0)" onClick="switch_sub_menu('5', 'siteopt.php');" class="submenuA" hidefocus="true" style="outline:none;">站点配置</a></li>
<li><a id="menu_6" href="javascript:void(0)" onClick="switch_sub_menu('6', 'imgcredit.php');" class="submenuA" hidefocus="true" style="outline:none;">积分配置</a></li>
<li><a id="menu_7" href="javascript:void(0)" onClick="switch_sub_menu('7', 'log.php');" class="submenuA" hidefocus="true" style="outline:none;">后台管理日志</a></li>
<li><a id="menu_8" href="javascript:void(0)" onClick="switch_sub_menu('8', 'user.php');" class="submenuA" hidefocus="true" style="outline:none;">用户管理</a></li>
</ul>
</li>
<li class="treemenu">
<a id="root_9" class="actuator" href="javascript:void(0)" onclick="switch_root_menu('9');" hidefocus="true" style="outline:none;">权限</a>
<ul id="tree_9" class="submenu">
<!-- 第三级菜单 -->
<li><a id="menu_10" href="javascript:void(0)" onClick="switch_sub_menu('10', 'imgnode');" class="submenuA" hidefocus="true" style="outline:none;">节点管理</a></li>
<li><a id="menu_11" href="javascript:void(0)" onClick="switch_sub_menu('11', 'imgpopedom');" class="submenuA" hidefocus="true" style="outline:none;">权限管理</a></li>
</ul>
</li>
</ul>
<ul class="MenuList" id="root_extension" style="display:none;">
<!-- 第二级菜单 -->
<li class="treemenu">
<a id="root_12" class="actuator" href="javascript:void(0)" onclick="switch_root_menu('12');" hidefocus="true" style="outline:none;">用户管理</a>
<ul id="tree_12" class="submenu">
<!-- 第三级菜单 -->
<li><a id="menu_13" href="javascript:void(0)" onClick="switch_sub_menu('13', '<?php echo site_url()?>/bd/user/add_user');" class="submenuA" hidefocus="true" style="outline:none;">添加用户</a></li>
<li><a id="menu_13" href="javascript:void(0)" onClick="switch_sub_menu('14', '<?php echo site_url()?>/bd/user/index');" class="submenuA" hidefocus="true" style="outline:none;">用户列表</a></li>
</ul>
</li>
</ul>
</div>