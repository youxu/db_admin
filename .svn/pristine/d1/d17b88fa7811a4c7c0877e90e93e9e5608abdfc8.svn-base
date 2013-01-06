$(document).ready(function(){
	$("#update_user").validate(
			{
				rules:{
					chname:{
						required:true,
						},

					},
				messages:{
					chname:{
							required:"请填写中文用户名",
						},
	
					},
				submitHandler:function (){

						$.ajax({
						url : '/index.php/bd/user/update_user',
						type : 'POST',
						data:{
							chname:$("#chname").val(),
							id:$("#user_id").val(),	
							is_admin:$("input[name='is_admin']").val(),
							status:$("input[name='status']").val(),
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
										    if (v == true)
										    { 
										    	window.document.location.href='/index.php/bd/user/add_user';
										    }
										    else
										    { 
										    	window.document.location.href='/index.php/bd/user';
										    }
										
										    return true;
										};
										$.jBox.closeTip();
										// 自定义按钮
										$.jBox.confirm(n.message, "提示", submit, { buttons: { '继续添加': true, '返回列表页': false} });
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
