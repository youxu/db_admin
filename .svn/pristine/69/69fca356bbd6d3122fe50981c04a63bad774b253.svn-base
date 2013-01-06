<?php include_once 'header.php' ?>
<div class="so_main">
  <div class="page_tit">用户管理</div>
  <!-------- 搜索用户 -------->
  <div id="searchUser_div" style="display:none;">
  	<div class="page_tit">搜索用户 [ <a href="javascript:void(0);" onclick="searchUser();">隐藏</a> ]</div>
	
	<div class="form2">
	<form method="post" action="http://192.168.1.111/sns/index.php?app=admin&mod=User&act=doSearchUser">
    <dl class="lineD">
      <dt>Email：</dt>
      <dd>
        <input name="email" id="email" type="text" value="">
        <p>用户进行登录的帐号,多个时使用英文的","分割</p>
      </dd>
    </dl>
	
	    <dl class="lineD">
      <dt>用户ID：</dt>
      <dd>
        <input name="uid" id="uid" type="text" value="">
        <p>用户ID,多个时使用英文的","分割</p>
      </dd>
    </dl>
	
    <dl class="lineD">
      <dt>昵称：</dt>
      <dd>
        <input name="uname" id="uname" type="text" value="">
        <p>多个时使用英文的","分割</p>
      </dd>
    </dl>
	 
	<dl>
      <dt>用户组：</dt>
      <dd>
      	<a href="javascript:void(0);" onclick="folder('user_group', this);">展开</a>
        <div id="search_user_group" style="display:none;">
			<div class="selection">

<div class="selection_left">
<ul id="selected_user_groups">
</ul>
</div>

<div class="selection_right">
<input type="hidden" name="user_group_id" id="user_group_id" value="" />

<ul class="sort">
<li id="user_group_1">
		<div class="c1">
			<div>
				<label><input type="checkbox" id="selectUserGroup_1" onclick="selectUserGroup(1);">
				<span class="user_group_name" id="user_group_name_1">管理员</span></label>
			</div>
		</div>
	</li></ul>

<div style="clear:both"></div>
</div>
<div style="clear:both"></div>
</div>

<script type="text/javascript">
/*
 *  方法:Array.remove(dx) 通过遍历,重构数组
 *  功能:删除数组元素.
 *  参数:dx删除元素的下标.
 */
Array.prototype.remove=function(dx)
{
    if(isNaN(dx)||dx>this.length){return false;}
    for(var i=0,n=0;i<this.length;i++)
    {
        if(this[i]!=this[dx])
        {
            this[n++]=this[i]
        }
    }
    this.length-=1
}

//已选择的部门
var w_selected_user_group 	  = new Array();

//将已选择的用户组选中

//选择部门
function selectUserGroup(w_user_group_id) {
	w_user_group_index   	  = $.inArray(w_user_group_id, w_selected_user_group);
	w_user_group_html	 	  = '';

	if(w_user_group_index == '-1') {
		//选中一个用户组
		w_selected_user_group.push(w_user_group_id);
		
		//用户组名称
		w_user_group_name     = $('#user_group_name_'+w_user_group_id).html();
		
		//填充
		w_user_group_html    += '<li id="selected_user_group_'+w_user_group_id+'">' + w_user_group_name + '&nbsp;&nbsp;&nbsp;';
		w_user_group_html    += '<span><a href="javascript:void(0);" onclick="deleteUserGroup('+w_user_group_id+');">x</a></span>';
		w_user_group_html    += '</li>';
		$('#selected_user_groups').append(w_user_group_html);
	}else {
		//删除一个用户组
		w_selected_user_group.remove(w_user_group_index);
		$('#selected_user_group_'+w_user_group_id).remove();
	}
	$('#user_group_id').val(w_selected_user_group.toString());
}

//删除已选择的部门
function deleteUserGroup(w_user_group_id) {
	w_user_group_index = $.inArray(w_user_group_id, w_selected_user_group);
	if(w_user_group_index == '-1') return false;
	
	w_selected_user_group.remove(w_user_group_index);
	$('#selected_user_group_'+w_user_group_id).remove();
	$('#user_group_id').val(w_selected_user_group.toString());
	$('#selectUserGroup_'+w_user_group_id).removeAttr('checked');
}
</script>		</div>
      </dd>
    </dl>
    
    <dl class="lineD">
      <dt>性别：</dt>
      <dd>
      	<input name="sex" type="radio" value="" checked>全部
        <input name="sex" type="radio" value="1" >男
        <input name="sex" type="radio" value="0" >女
      </dd>
    </dl>
	
	<dl class="lineD">
      <dt>是否激活：</dt>
      <dd>
      	<input name="is_active" type="radio" value="" checked>全部
        <input name="is_active" type="radio" value="1" >是
        <input name="is_active" type="radio" value="0" >否
      </dd>
    </dl>
    <div class="page_btm">
      <input type="submit" class="btn_b" value="确定" />
    </div>
	<input type="hidden" name="__hash__" value="67b335cd7630ec10b69ba217d7ce7d05" /></form>
  </div>
  </div>
  
  <!-------- 用户列表 -------->
  <div class="Toolbar_inbox">
  	<div class="page right"></div>
	<a href="http://192.168.1.111/sns/index.php?app=admin&mod=User&act=addUser" class="btn_a"><span>添加用户</span></a>
	<a href="javascript:void(0);" class="btn_a" onclick="searchUser();">
		<span class="searchUser_action">搜索用户</span>
	</a>
  	<a href="javascript:void(0);" class="btn_a" onclick="changeUserGroup();"><span>转移用户组</span></a>
	<a href="javascript:void(0);" class="btn_a" onclick="deleteUser();"><span>删除用户</span></a>
  </div>
  <div class="list">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th style="width:30px;">
		<input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
    	<label for="checkbox"></label>
	</th>
    <th class="line_l">ID</th>
    <th class="line_l">用户信息</th>
    <th class="line_l">部门信息</th>
    <th class="line_l">用户组</th>
    <th class="line_l">注册时间</th>
    <th class="line_l">状态</th>
    <th class="line_l">操作</th>
  </tr>
  <tr overstyle='on' id="user_1">
	  		    	<td><input type="checkbox" name="checkbox" id="checkbox2" value="" disabled></td>	    <td>1</td>
	    <td>
			<div style="float:left;margin-right:10px;border:1px solid #8098A8;"">
            <img src="admin/images/avatar.png" width="70"></div>
			<div style="float:left;margin-top:20px;"><a href='http://192.168.1.111/sns/index.php?app=home&mod=Space&act=index&uid=1' class='fn' target='_blank'>管理员</a><br>518668@qq.com</div></td>
		<td>
			暂无部门信息					</td>
	    <td>
						管理员<br />		</td>
	    <td>2012-03-19 10:25</td>
	    <td>激活</else></td>
	    <td>
			<!--<a href="javascript:void(0);" onclick="changeDepartment(1);">转移部门</a>-->
			<a href="http://192.168.1.111/sns/index.php?app=admin&mod=User&act=editUser&uid=1">编辑</a>
							<span>删除</span>		</td>
	  </tr>  </table>
  </div>

  <div class="Toolbar_inbox">
	<div class="page right"></div>
	<a href="http://192.168.1.111/sns/index.php?app=admin&mod=User&act=addUser" class="btn_a"><span>添加用户</span></a>
	<a href="javascript:void(0);" class="btn_a" onclick="searchUser();">
		<span class="searchUser_action">搜索用户</span>
	</a>
  	<a href="javascript:void(0);" class="btn_a" onclick="changeUserGroup();"><span>转移用户组</span></a>
	<a href="javascript:void(0);" class="btn_a" onclick="deleteUser();"><span>删除用户</span></a>
  </div>
</div>

<script>
	//鼠标移动表格效果
	$(document).ready(function(){
		$("tr[overstyle='on']").hover(
		  function () {
		    $(this).addClass("bg_hover");
		  },
		  function () {
		    $(this).removeClass("bg_hover");
		  }
		);
	});
	
	function checkon(o){
		if( o.checked == true ){
			$(o).parents('tr').addClass('bg_on') ;
		}else{
			$(o).parents('tr').removeClass('bg_on') ;
		}
	}
	
	function checkAll(o){
		if( o.checked == true ){
			$('input[name="checkbox"]').attr('checked','true');
			$('tr[overstyle="on"]').addClass("bg_on");
		}else{
			$('input[name="checkbox"]').removeAttr('checked');
			$('tr[overstyle="on"]').removeClass("bg_on");
		}
	}

	//获取已选择用户的ID数组
	function getChecked() {
		var uids = new Array();
		$.each($('table input:checked'), function(i, n){
			uids.push( $(n).val() );
		});
		return uids;
	}

	//转移部门
	function changeDepartment(uids) {
		var uids = uids ? uids : getChecked();
		uids = uids.toString();
		if(!uids) {
			ui.error('请先选择用户');
			return false;
		}

		if(!confirm('转移成功后，已选择用户原来的部门信息将被覆盖，确定继续？')) return false;
		
		ui.box.load("http://192.168.1.111/sns/index.php?app=admin&mod=User&act=changeDepartment&uids="+uids, {title:'转移部门'});
	}
	
	//转移用户组
	function changeUserGroup(uids) {
		var uids = uids ? uids : getChecked();
		uids = uids.toString();
		if(!uids) {
			ui.error('请先选择用户');
			return false;
		}

		if(!confirm('转移成功后，已选择用户原来的用户组信息将被覆盖，确定继续？')) return false;
		
		ui.box.load("http://192.168.1.111/sns/index.php?app=admin&mod=User&act=changeUserGroup&uids="+uids, {title:'转移用户组'});
	}
	
	//删除用户
	function deleteUser(uid) {
		uid = uid ? uid : getChecked();
		uid = uid.toString();
		if(uid == '' || !confirm('删除成功后将无法恢复，确认继续？')) return false;
		
		$.post("http://192.168.1.111/sns/index.php?app=admin&mod=User&act=doDeleteUser", {uid:uid}, function(res){
			if(res == '1') {
				uid = uid.split(',');
				for(i = 0; i < uid.length; i++) {
					$('#user_'+uid[i]).remove();
				}
				ui.success('操作成功');
			}else {
				ui.error('操作失败');
			}
		});
	}
	
	//搜索用户
	var isSearchHidden = 1;
	function searchUser() {
		if(isSearchHidden == 1) {
			$("#searchUser_div").slideDown("fast");
			$(".searchUser_action").html("搜索完毕");
			isSearchHidden = 0;
		}else {
			$("#searchUser_div").slideUp("fast");
			$(".searchUser_action").html("搜索用户");
			isSearchHidden = 1;
		}
	}
	
	function folder(type, _this) {
		$('#search_'+type).slideToggle('fast');
		if ($(_this).html() == '展开') {
			$(_this).html('收起');
		}else {
			$(_this).html('展开');
		}
		
	}
</script>
<?php include_once 'footer.php' ?>