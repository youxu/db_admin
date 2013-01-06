
$(document).ready(function(){
	$("input[name=project_id]").change(function (){
		if(this.checked){
			$(this).next("span").addClass('red');
		}
		else{
			$(this).next("span").removeClass();
		}
	});
	$("#user_project").validate(
			{
				errorPlacement : function(error, element) { 
				if (element.is(":radio")) 
				error.appendTo(element.parent()); 
				else if (element.is(":checkbox")) 
				error.appendTo(element.parent()); 
				else 
				error.appendTo(element.parent().next()); 
				},
				rules:{
					project_id:{
						required:true,
						},		
					},
				messages:{
					project_id:{
							required:"请至少选择一个项目",
						},
					},
				submitHandler:function (){
						 var str = '';
						 $("input[name=project_id]:checked").each(function(){
						   str += $(this).val()+',';
						 });
						$.ajax({
						url : '/index.php/user/user_project',
						type : 'POST',
						data:{
							project_id:str,
							u_id:$("#u_id").val(),
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
										    	$.jBox.closeTip();
										    }
										    else
										    { 
										    	window.document.location.href='/index.php/user';
										    }
										
										    return true;
										};
										$.jBox.closeTip();
										// 自定义按钮
										$.jBox.confirm(n.message, "提示", submit, { buttons: { '确定': true, '返回列表页': false} });
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
