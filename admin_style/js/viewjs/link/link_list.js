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
var url="/index.php/link/index";
function pagejump(page){
		$.ajax({
			url : url+'/'+page,
			type : 'POST',
			data:{
				post_page:page
			},
			dataType:'json',
			beforeSend: function(){
				$.jBox.tip("请稍候", 'loading');		
			},
			success :function (data){
				var html='';
				$("#url").val(url+'/'+page);
				$.each(data, function(i,n){
						$.each(n.list, function(k,v){
							var ian='';
							var sts='';
							if(v.img != '' ){
								img='<img src='+v.img+' border=0 width="200" height="100"/>';
							}
							else{
								img='';
							}
							if(v.status == '1'){
								sts='启用';
							}else{
								sts='停用';
							}
							html += '<tr  overstyle="on">';
							html += '<td>'+v.name+'<input type="hidden" name="id_list[]" value="'+v.id+'" /></td>';
							html += '<td>'+v.url+'</td>';
							html += '<td>'+img+'</td>';
							html += '<td>'+sts+'</td>';
							html += '<td><input type="text" name="order_num[]" style="width:30px" value="'+v.order_num+'" /></td>';
							html += '<td>';
							html += '<a href="/index.php/link/update_link/'+v.id+'">编辑</a>&nbsp;';
							html += '<a href="#" onclick="del_user(\''+v.name+'\',\''+v.id+'\',this)">删除</a>';
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
function del_user(name,project_id,va){
	var submit = function (v, h, f) {
    if (v == true)
    {
    	if(project_id == ''){
			$.jBox.tip('数据错误', 'error')
		}else{
			$.ajax({
				url :'/index.php/link/del_link',
				type : 'POST',
				data:{
					id:project_id
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