
$(document).ready(function(){
	$("#update_ma_group").validate(
			{
				rules:{
					name:{
						required:true,
						remote:{
							url  : "/index.php/ajax/is_same_ma_group_name",
							type : "POST",
							data : {
									name:function(){return $("#name").val();},
									old_name:function(){return $("#old_name").val();},
							},
						},
						},
					ip:{
						required:true,
						},	
					ip_top:{
						required:true,
						},	
					},
				messages:{
					name:{
							required:"请填写机器组名称",
							remote:"机器组名称重复",
						},
					ip:{
							required:"IP不能为空",
						},	
					ip_top:{
							required:"测试主机IP不能为空",
						},		
					},
				submitHandler:function (){
						$.ajax({
						url : '/index.php/ma_group/update_ma_group',
						type : 'POST',
						data:{
							name:$("#name").val(),
							id:$("#m_id").val(),
							ip:$("#ip").val(),
							ip_top:$("#ip_top").val(),
							status:$("input[name='status']:checked").val(),
						},
						dataType:'json',
						beforeSend: function(){
							$.jBox.tip("正在提交，请稍候", 'loading');		
						},
						success :function (data){
								$.each(data, function(i,n){
									var submit = function (v, h, f) {
									if (v == true)
									
								    { 
								    	window.document.location.href='/index.php/ma_group/add_ma_group';
								    }
								    else
								    { 
								    	window.document.location.href='/index.php/ma_group/index';
								    }
								    return true;
									};
									$.jBox.closeTip();
									// 自定义按钮
									$.jBox.confirm(n.message, "提示", submit, { buttons: { '添加机器组': true, '返回列表': false} });
									
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
