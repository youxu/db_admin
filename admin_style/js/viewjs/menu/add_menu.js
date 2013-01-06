$(document).ready(function(){
	
	$("#add_mod").validate(
			{
				rules:{
					name:{
						required:true,
						remote:{
							url  : "/index.php/ajax/is_same_menu_name",
							type : "POST",
							data : {
									name:function(){return $("#name").val();},
							},
						},
						},
					},
				messages:{
					name:{
							required:"请填写导航名称",
							remote:"导航名称重复",
						},
					},
				submitHandler:function (){
						$.ajax({
						url : '/index.php/menu/add_menu',
						type : 'POST',
						data:{
							name:$("#name").val(),
							menu_url:$("#menu_url").val(),
							pid:$("#pid").val(),
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
										    	window.document.location.href='/index.php/menu/add_menu';
										    }
										    else
										    { 
										    	window.document.location.href='/index.php/menu/index';
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
