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
	//给ID为 tw 的 UL 标签添加树状交互
	$("#tree").treeview({
		classes: "important",
		collapsed: true,
		unique: true,
		url:"/index.php/news/gettree"
	});
	$("#class_btn").click(function(){		 
		classid=$("input[name='newsclass']:checked").val();
		if(classid == null){
			$.jBox.tip('请选择一个栏目', 'error');
		}
		else{
			window.location.href='/index.php/news/index/'+classid;
			//$("#newclass").submit();
		}
	})

});

var url="/index.php/news/index";
function pagejump(page){
		cid=$("#cid").val();
	
		$.ajax({
			url : url+'/'+cid+'/'+page,
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
							var sts='';
							var pid=$("#cid").val();
							if(v.status == '1'){
								sts='是';
							}
							else{
								sts='否';
							}
							if(v.is_top == '1'){
								it='是';
							}
							else{
								it='否';
							}
							html += '<tr  overstyle="on">';
							html += '<td>'+v.title+'</td>';
							html += '<td>'+v.cname+'</td>';
							html += '<td>'+sts+'</td>';
							html += '<td>'+it+'</td>';
							html += '<td>';
							html += '<a href="/index.php/news/update_news/'+v.id+'/'+pid+'">编辑</a>&nbsp;';
							html += '<a href="#" onclick="del_user(\''+v.title+'\',\''+v.id+'\',this)">删除</a>';
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
				url :'/index.php/news/del_news',
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

