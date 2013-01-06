
$(document).ready(function(){
	$("#update_user").validate(
			{
				rules:{
					name:{
						required:true,
						remote:{
							url  : "/index.php/ajax/is_same_username",
							type : "POST",
							data : {
									name:function(){return $("#name").val();},
									old_name:function(){return $("#old_name").val();},

									},
							},
						},
					chname:{
						required:true,
						},	
					},
				messages:{
					name:{
							required:"请填写用户名",
							remote:"用户名重复",
						},
					chname:{
							required:"请填写中文名",
						},	
					
					},
				submitHandler:function (){
						$.ajax({
						url : '/index.php/user/update_user',
						type : 'POST',
						data:{
							name:$("#name").val(),
							chname:$("#chname").val(),
							id:$("#user_id").val(),
							status:$("input[name='status']:checked").val(),
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
										    	window.document.location.href='/index.php/user/';
										    }
										    return true;
										};
										$.jBox.closeTip();
										// 自定义按钮
										$.jBox.confirm(n.message, "提示", submit, { buttons: { '返回用户列表': '1' }});
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
