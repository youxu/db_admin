
$(document).ready(function(){
	$("#update_project_info").validate(
	{
		rules:{
				name:{
					required:true,
					remote:{
						url  : "/index.php/ajax/is_same_pro_info_name",
						type : "POST",
						data : {
								name:function(){return $("#name").val();},
								pid:function(){return $("#pid").val();},
								old_name:function(){return $("#old_name").val();},
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
				name:{
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
				url : '/index.php/project/update_project_info',
				type : 'POST',
				data:{
					name:$("#name").val(),
					pid:$("#pid").val(),
					id:$("#u_id").val(),
					ma_group:$("#ma_group").val(),
					d_port:$("#d_port").val(),
					d_name:$("#d_name").val(),
					d_psd:$("#d_psd").val(),
					database:$("#database").val(),
					status:$("input[name=status]:checked").val(),
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
								    if (v == '0')
								    { 
								    	window.document.location.href='/index.php/project/';
								    }
								    if (v == '1')
								    { 
								    	window.document.location.href='/index.php/project/update_project/'+$("#pid").val();
								    }
								    return true;
								};
								$.jBox.closeTip();
								// 自定义按钮
								$.jBox.confirm(n.message, "提示", submit, { buttons: { '返回项目列表':'0', '返回项目信息页': '1'} });
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
	

})

