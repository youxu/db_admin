
$(document).ready(function(){
	$("#pid").live('change',function (){
		$.ajax({
					url : '/index.php/ajax/get_project_info_bypid',
					type : 'POST',
					data:{
						id:$("#pid").val(),
					},
					dataType:'json',
					beforeSend: function(){
					//	$.jBox.tip("正在提交，请稍候", 'loading');		
					},
					success :function (data){
						var html_a=''//项目详细内容列表
						$("#div_count").html(html_a);//清空容器
						$.each(data, function(ck,cn){
							var c_status = '';
							var html_b=''//生成项目详细内容
							if(cn.status == '1'){
								c_status='启用';
							}
							else{
								c_status='未启用';
							}
		  					html_a +='<a href="#" class="a_mar_5" onclick="open_div(\''+cn.id+'\')">'+cn.name+'</a>';
		  					html_b += '<div id="project_info_'+cn.id+'" style="display:none">';
		  					html_b += '<table width="100%" border="0" cellspacing="2" cellpadding="2">';
		  					html_b += '<tr>';
		  					html_b += '<td align="right">名称：</td>';
		  					html_b += '<td align="left">'+cn.name+'</td>';
		  					html_b += '</tr>';
		  					html_b += '<td align="right">服务器ip地址：</td>';
		  					html_b += '<td align="left">'+cn.d_ip+'</td>';
		  					html_b += '</tr>';
							html_b += '<td align="right">端口：</td>';
		  					html_b += '<td align="left">'+cn.d_port+'</td>';
		  					html_b += '</tr>';
		  					html_b += '<td align="right">数据库名：</td>';
		  					html_b += '<td align="left">'+cn.database+'</td>';
		  					html_b += '</tr>';
		  					html_b += '<td align="right">数据库用户名：</td>';
		  					html_b += '<td align="left">'+cn.d_name+'</td>';
		  					html_b += '</tr>';
		  					html_b += '<td align="right">数据库密码：</td>';
		  					html_b += '<td align="left">'+cn.d_psd+'</td>';		  					
		  					html_b += '</tr>';
		  					html_b += '</tr>';
		  					html_b += '<td align="right">状态：</td>';	  					
		  					html_b += '<td align="left">'+c_status+'</td>';		  					
		  					html_b += '</tr>';
		  					html_b += '</table>';
		  					$("#div_count").append(html_b); 
				  		 });
				  		$("#project_name").html(html_a); 
					},
			});		
	});
	$("#add_project_info").validate(
			{
				rules:{
					project_info_name:{
						required:true,
						remote:{
							url  : "/index.php/ajax/is_same_pro_info_name",
							type : "POST",
							data : {
									name:function(){return $("#project_info_name").val();},
									pid:function(){return $("#pid").val();},
									},
							},
						},
					pid:{
						required:true,
						},	
					ma_group:{
						required:true,
						},	
					d_port:{
						required:true,
						},
					database:{
						required:true,
						},	
					d_name:{
						required:true,
						},	
					d_psd:{
						required:true,
						},	
					},
				messages:{
					project_info_name:{
							required:"请填写项目名称",
							remote:"项目名称重复",
						},
					pid:{
						required:'请选择所属项目',
						},	
					ma_group:{
						required:"请选择机器组",
						},	
					d_port:{
						required:"请填写端口",
						},	
					database:{
						required:"请填写数据库名",
						},	
					d_name:{
						required:"请填写数据库用户名",
						},	
					d_psd:{
						required:"请填写数据库密码",
						},	
					},
				submitHandler:function (){
						$.ajax({
						url : '/index.php/project/add_project_info',
						type : 'POST',
						data:{
							project_info_name:$("#project_info_name").val(),
							pid:$("#pid").val(),
							ma_group:$("#ma_group").val(),
							d_port:$("#d_port").val(),
							d_name:$("#d_name").val(),
							d_psd:$("#d_psd").val(),
							database:$("#database").val(),
						},
						dataType:'json',
						beforeSend: function(){
							$.jBox.tip("正在提交，请稍候", 'loading');		
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
										    	window.document.location.href='/index.php/project/add_project_info/'+$("#pid").val();
										    }
										    if (v == '2')
										    { 
										    	window.document.location.href='/index.php/project/add_project';
										    }
										    if (v == '3')
										    { 
										    	window.document.location.href='/index.php/project/';
										    }
										    return true;
										};
										$.jBox.closeTip();
										// 自定义按钮
										$.jBox.confirm(n.message, "提示", submit, { buttons: { '继续添加': '1','返回添加项目':'2','返回项目列表': '3'} });
				  					}
						  		 });
							},
						error : function (){
								$.jBox.tip('请求错误', 'error')
							}
					})
					return false;
				}		
			});

});
//提示项目机器详细信息
function open_div(id){
	var div_id="project_info_"+id;
	$.jBox('id:'+div_id+'',{"title":"提示"});
}
