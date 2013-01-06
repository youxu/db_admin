
$(document).ready(function(){
	
	$("#add_user").validate(
			{
				rules:{
					name:{
						required:true,
						remote:{
							url  : "/index.php/ajax/is_same_username",
							type : "POST",
							//dataType : "xml",
							data : {
									name:function(){return $("#name").val();},
							},
						},
						},
					chname:{
						required:true,
						},
					password:{
						required:true,
						minlength:"6",
						
						},	
					re_password:{
						required:true,
						minlength:"6",
						equalTo:"#password",
						},						
					},
				messages:{
					name:{
							required:"请填写登录名",
							remote:"用户名重复",
						},
					chname:{
							required:"请填写中文名",
						},
					passord:{
							required:"请填写密码",
							minlength:"密码不得少于6位",
						},
					re_password:{
							required:"请重复填写密码",
							minlength:"密码不得少于6位",
							equalTo:"两次输入的密码不一致",
						},					
					},
				submitHandler:function (){
						$.ajax({
						url : '/index.php/user/add_user',
						type : 'POST',
						data:{
							name:$("#name").val(),
							chname:$("#chname").val(),
							password:$("#password").val(),
							re_password:$("#re_password").val(),
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
										    if (v == true)
										    { 
										    	window.document.location.href='/index.php/user/add_user';
										    }
										    else
										    { 
										    	window.document.location.href='/index.php/user';
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
