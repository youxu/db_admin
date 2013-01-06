
$(document).ready(function(){
	$("input[name=mod_id]").change(function (){
		if(this.checked){
			$(this).next("span").addClass('red');
		}
		else{
			$(this).next("span").removeClass();
		}
	});
	$("#user_root").validate(
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
						
					},
				messages:{
					
					},
				submitHandler:function (){
						 var str = '';
						 $("input[name=mod_id]:checked").each(function(){
						   str += $(this).val()+',';
						 });
						$.ajax({
						url : '/index.php/user/user_root',
						type : 'POST',
						data:{
							mod_ids:str,
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
										    if (v == '1')
										    { 
										    	window.document.location.href='/index.php/user';
										    }
										
										    return true;
										};
										$.jBox.closeTip();
										// 自定义按钮
										$.jBox.confirm(n.message, "提示", submit, { buttons: { '返回列表页': '1'} });
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
