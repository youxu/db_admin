<?php include_once 'header.php' ?>
<div class="so_main">

  <div id="search_div" style="display:none;">
    <div class="page_tit">搜索后台日志 [ <a href="javascript:void(0);" onclick="searchDenounce();">隐藏</a> ]</div>
    <div class="form2">
    <form method="post" action="http://192.168.1.111/sns/index.php?app=admin&mod=Content&act=doSearchAdminLog">
    <input type="hidden" name="isSearch" value="1"/>
    <dl class="lineD">
      <dt>ID：</dt>
      <dd>
        <input name="id" type="text" value="">
        <p>多个时使用英文的“,”分割</p>
      </dd>
    </dl>
    
        <dl class="lineD">
      <dt>操作人ID：</dt>
      <dd>
        <input name="uid" type="text" value="">
        <p>后台日志操作人ID,多个时使用英文的","分割</p>
      </dd>
    </dl>
    
    <dl class="lineD">
      <dt>类型：</dt>
      <dd>
      	<select name="type">
      		<option value="0">选择类型</option>
      		<option value="1">增加</option>
      		<option value="2">删除</option>
      		<option value="3">修改</option>
      	</select>
      </dd>
    </dl>
    <div class="page_btm">
      <input type="submit" class="btn_b" value="确定" />
    </div>
    <input type="hidden" name="__hash__" value="846712b6919da426db0e0075e43eb018" /></form>
  </div>
  </div>
  
  <div class="page_tit">后台日志管理</div>
  <div class="Toolbar_inbox">
    <div class="page right"></div>
    <a href="javascript:void(0);" class="btn_a" onclick="searchDenounce();">
        <span class="search_action">搜索后台日志</span>
    </a>
    <a href="javascript:void(0);" class="btn_a" onclick="deleteRecord();"><span>删除记录</span></a>
  </div>
  <div class="list">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th style="width:30px;">
        <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
        <label for="checkbox"></label>
    </th>
    <th class="line_l">ID</th>
    <th class="line_l">操作人ID</th>
    <th class="line_l">操作人用户名</th>
    <th class="line_l">操作类型</th>
    <th class="line_l">操作位置</th>
    <th class="line_l">操作时间</th>
    <th class="line_l">操作</th>
  </tr>
  <tr overstyle='on' id="adminLog_7">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="7"></td>
        <td>7</td>
        <td>1</td>
        <td>管理员</td>
        <td>
        增加        </td>
        <td>
        应用 - 安装应用         </td>
        <td>2012-03-19 10:27</td>
        <td><a href="http://192.168.1.111/sns/index.php?app=admin&mod=Content&act=showAdminLog&id=7" class="btn_a">查看详细</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void(0);" class="btn_a" onclick="deleteRecord(7);">删除</a></td>
      </tr><tr overstyle='on' id="adminLog_6">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="6"></td>
        <td>6</td>
        <td>1</td>
        <td>管理员</td>
        <td>
        增加        </td>
        <td>
        应用 - 安装应用         </td>
        <td>2012-03-19 10:27</td>
        <td><a href="http://192.168.1.111/sns/index.php?app=admin&mod=Content&act=showAdminLog&id=6" class="btn_a">查看详细</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void(0);" class="btn_a" onclick="deleteRecord(6);">删除</a></td>
      </tr><tr overstyle='on' id="adminLog_5">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="5"></td>
        <td>5</td>
        <td>1</td>
        <td>管理员</td>
        <td>
        增加        </td>
        <td>
        应用 - 安装应用         </td>
        <td>2012-03-19 10:27</td>
        <td><a href="http://192.168.1.111/sns/index.php?app=admin&mod=Content&act=showAdminLog&id=5" class="btn_a">查看详细</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void(0);" class="btn_a" onclick="deleteRecord(5);">删除</a></td>
      </tr><tr overstyle='on' id="adminLog_4">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="4"></td>
        <td>4</td>
        <td>1</td>
        <td>管理员</td>
        <td>
        增加        </td>
        <td>
        应用 - 安装应用         </td>
        <td>2012-03-19 10:26</td>
        <td><a href="http://192.168.1.111/sns/index.php?app=admin&mod=Content&act=showAdminLog&id=4" class="btn_a">查看详细</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void(0);" class="btn_a" onclick="deleteRecord(4);">删除</a></td>
      </tr><tr overstyle='on' id="adminLog_3">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="3"></td>
        <td>3</td>
        <td>1</td>
        <td>管理员</td>
        <td>
        增加        </td>
        <td>
        应用 - 安装应用         </td>
        <td>2012-03-19 10:26</td>
        <td><a href="http://192.168.1.111/sns/index.php?app=admin&mod=Content&act=showAdminLog&id=3" class="btn_a">查看详细</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void(0);" class="btn_a" onclick="deleteRecord(3);">删除</a></td>
      </tr><tr overstyle='on' id="adminLog_2">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="2"></td>
        <td>2</td>
        <td>1</td>
        <td>管理员</td>
        <td>
        增加        </td>
        <td>
        应用 - 安装应用         </td>
        <td>2012-03-19 10:26</td>
        <td><a href="http://192.168.1.111/sns/index.php?app=admin&mod=Content&act=showAdminLog&id=2" class="btn_a">查看详细</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void(0);" class="btn_a" onclick="deleteRecord(2);">删除</a></td>
      </tr><tr overstyle='on' id="adminLog_1">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="1"></td>
        <td>1</td>
        <td>1</td>
        <td>管理员</td>
        <td>
        增加        </td>
        <td>
        应用 - 安装应用         </td>
        <td>2012-03-19 10:26</td>
        <td><a href="http://192.168.1.111/sns/index.php?app=admin&mod=Content&act=showAdminLog&id=1" class="btn_a">查看详细</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void(0);" class="btn_a" onclick="deleteRecord(1);">删除</a></td>
      </tr>  </table>
  </div>
  <div class="Toolbar_inbox">
    <div class="page right"></div>
    <a href="javascript:void(0);" class="btn_a" onclick="searchDenounce();">
        <span class="search_action">搜索后台日志</span>
    </a>
    <a href="javascript:void(0);" class="btn_a" onclick="deleteRecord();"><span>删除记录</span></a>
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
        var ids = new Array();
        $.each($('table input:checked'), function(i, n){
            ids.push( $(n).val() );
        });
        return ids;
    }
    
    function deleteRecord(ids) {
    	
        var length = 0;
    	if(ids) {
    		length = 1;    		
    	}else {
    		ids    = getChecked();
    		length = ids.length;
            ids    = ids.toString();
    	}
    	if(ids=='') {
    		ui.error('请先选择一个后台日志');
    		return ;
    	}
    	if(confirm('您将删除'+length+'条记录，确定继续？')) {
    		$.post("http://192.168.1.111/sns/index.php?app=admin&mod=Content&act=doDeleteAdminLog",{ids:ids},function(res){
    			if(res=='1') {
    				ui.success('删除成功');
    				if( length == 1){
    					$('#adminLog_'+ids).remove();
    				}else{
    					removeItem(ids);
    				}
    			}else {
    				ui.error('删除失败');
    			}
    		});
    	}
    }
    
    function lookDetail(ids){
    	$.post("http://192.168.1.111/sns/index.php?app=admin&mod=Content&act=lookDetail",{ids:ids},function(txt){
    		ui.box.show(txt,{title:'查看后台日志详细信息',closeable:true});
    	});
    }
    
    function removeItem(ids) {
    	ids = ids.split(',');
        for(i = 0; i < ids.length; i++) {
            $('#adminLog_'+ids[i]).remove();
        }
    }
    
    //搜索用户
    var isSearchHidden = 1;
    function searchDenounce() {
        if(isSearchHidden == 1) {
            $("#search_div").slideDown("fast");
            $(".search_action").html("搜索完毕");
            isSearchHidden = 0;
        }else {
            $("#search_div").slideUp("fast");
            $(".search_action").html("搜索后台日志");
            isSearchHidden = 1;
        }
    }
</script>
<?php include_once 'footer.php' ?>