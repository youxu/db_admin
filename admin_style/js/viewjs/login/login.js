$(document).ready(function(){
	
	$("#login").validate(
			{
				//errorLabelContainer:"#message_error",
				errorPlacement: function(error, element) { 
					error.appendTo( element.next('div') ); 
				} ,
				rules:{
					username:{
						required:true,
						},
					password:{
						required:true,
						minlength:'6',
						},
					captcha:{
						required:true,
						number:true,
						minlength:'4'

						},		
					},
				messages:{
					username:{
							required:"请填写账号",
						},
					password:{
							required:"请填写密码",
							minlength:"密码不得少于6位",
						},	
					captcha:{
							required:"请填写验证码",
							number:"验证码必须是数字",
							minlength:"验证码不得少于4位",
	
						},	
					},		
			});

})
