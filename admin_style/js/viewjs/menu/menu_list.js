$(document).ready(function(){
		$("tr[overstyle='on']").live('mouseover',
		  function () {
		    $(this).addClass("bg_hover");
		  }
		  
		);
		$("tr[overstyle='on']").live('mouseout',
		  function () {
		    $(this).removeClass("bg_hover");
		  }
		  
		);
		$("#order_button").click(function (){
			var id_list =  new Array();   
			var num_list = new Array();   
			 var j = 0;   
			 var i = 0;   
			$("input[name='id_list[]']").each(   
			            function(){   
			                id_list[i] = $(this).val();    
			                i++;   
			            }   
			 )
			 $("input[name='order_num[]']").each(   
			            function(){   
			                num_list[j] = $(this).val();    
			                j++;   
			            }   
			 )
			 $('#menu_id_list').val(id_list);
			 $('#menu_num_list').val(num_list);
			 $('#order_num').submit();
		});
	});
var url="/index.php/menu/index";
function pagejump(page){
	   pid=$('#pid').val();

		$.ajax({
			url : url+'/'+pid+'/'+page,
			type : 'POST',
			data:{
				post_page:page,
			},
			dataType:'json',
			beforeSend: function(){
				$.jBox.tip("请稍候", 'loading');		
			},
			success :function (data){
				var html='';
				$("#url").val(url+'/'+pid+'/'+page);
				$.each(data, function(i,n){
						$.each(n.modList, function(k,v){
							if(v.status == '1'){
								sts='是';
							}
							else{
								sts='否';
							}
							if(v.pid_name='null'){
								pid_name="顶级";
							}
							else{
								pid_name=v.pid_name;
							}
							var ian='';
							html += '<tr  overstyle="on">';
							html += '<td><a href="/index.php/menu/index/'+v.id+'">'+v.name+'</a><input type="hidden" name="id_list[]" value="'+v.id+'" /></td>';
							html += '<td>'+v.menu_url+'</td>';
							html += '<td>'+pid_name+'</td>';
							html += '<td>'+sts+'</td>';
							html += '<td><input type="text" name="order_num[]" style="width:30px" value="'+v.order_num+'" /></td>';
							html += '<td>';
							html += '<a href="/index.php/menu/update_menu/'+v.id+'">编辑</a>&nbsp;';
							html += '<a href="#" onclick="del_mod(\''+v.name+'\',\''+v.id+'\',this)">删除</a>';
							html += '</td>';
							html += '</tr>';
							
						});
						$("#pager").html(n.pager);
				});
					$("#tablist").html(html);
					$.jBox.closeTip();
				},
			error : function (){
					$.jBox.tip('数据错误', 'error')
				}
		})
	}
function del_mod(name,project_id,va){
	var submit = function (v, h, f) {
    if (v == true)
    {
    	if(project_id == ''){
			$.jBox.tip('数据错误', 'error')
		}else{
			$.ajax({
				url :'/index.php/menu/del_menu',
				type : 'POST',
				data:{
					id:project_id,
				},
				dataType:'json',
				beforeSend: function(){
					$.jBox.tip("请稍候", 'loading');		
				},
				success :function (data){
							$.each(data, function(i,n){
			  					if(n.status == '0'){
			  						$.jBox.tip(n.message, 'error')
			  					}
			  					if(n.status == '1'){
			  						var submit = function (v, h, f) {
									    if (v == '1')
									    { 
									    	return true;
									    }
									    
									};
									$(va).parent().parent().remove();
									$.jBox.closeTip();
									// 自定义按钮
									$.jBox.confirm(n.message, "提示", submit, { buttons: { '确定': '1' }});
			  					}
					  		 });
					},
				error : function (){
						$.jBox.tip('数据错误', 'error')
					}
			})
		}
    }   
    else{
    	$.jBox.closeTip();
    }
	};
	$.jBox.confirm("你确定要删除"+name+"吗？", "提示", submit, { buttons: { '确定': true, '取消': false} });
}