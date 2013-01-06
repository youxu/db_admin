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
	});
var url="/index.php/mod/index";
function pagejump(page){
		$.ajax({
			url : url+'/'+page,
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
				$.each(data, function(i,n){
						$.each(n.userList, function(k,v){
							var ian='';
							html += '<tr  overstyle="on">';
							html += '<td>'+v.name+'</td>';
							html += '<td>'+v.model+'</td>';
							html += '<td>';
							html += '<a href="/index.php/mod/update_mod/'+v.id+'">编辑</a>&nbsp;';
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
				url :'/index.php/mod/del_mod',
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