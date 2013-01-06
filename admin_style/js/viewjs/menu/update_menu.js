
$(document).ready(function(){
	$("#update_menu").validate(
			{
				rules:{
					name:{
						required:true,
						remote:{
							url  : "/index.php/ajax/is_same_menu_name",
							type : "POST",
							data : {
									name:function(){return $("#name").val();},
									old_name:function(){return $("#old_name").val();},
									mod_id:function(){return $("#mod_id").val();},
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
						url : '/index.php/menu/update_menu',
						type : 'POST',
						data:{
							name:$("#name").val(),
							menu_url:$("#menu_url").val(),
							pid:$("#pid").val(),
							mod_id:$("#mod_id").val(),
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
										    	window.document.location.href='/index.php/menu/';
										    }
										    return true;
										};
										$.jBox.closeTip();
										// 自定义按钮
										$.jBox.confirm(n.message, "提示", submit, { buttons: { '返回列表': '1' }});
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
