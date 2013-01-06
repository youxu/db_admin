
$(document).ready(function(){
	$("#update_project").validate(
			{
				rules:{
					name:{
						required:true,
						remote:{
							url  : "/index.php/ajax/is_same_pro_name",
							type : "POST",
							data : {
									name:function(){return $("#name").val();},
									old_name:function(){return $("#project_old_name").val();},
									pid:function(){return $("#pid").val();},
									},
							},
						},
					
					},
				messages:{
					name:{
							required:"请填写分类名称",
							remote:"分类名称重复",
						},
					
					},
				submitHandler:function (){
						$.ajax({
						url : '/index.php/newsclass/update_newsclass',
						type : 'POST',
						data:{
							name:$("#name").val(),
							id:$("#project_id").val(),
							pid:$("#pid").val(),
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
										    	window.document.location.href='/index.php/newsclass/';
										    }
										    return true;
										};
										$.jBox.closeTip();
										// 自定义按钮
										$.jBox.confirm(n.message, "提示", submit, { buttons: { '返回分类列表': '1' }});
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
