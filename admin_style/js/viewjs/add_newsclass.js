$(document).ready(function(){
	
	$("#add_newsclass").validate(
			{
				rules:{
					name:{
						required:true,
						remote:{
							url  : "/index.php/ajax/is_same_pro_name",
							type : "POST",
							data : {
									name:function(){return $("#name").val();},
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
						url : '/index.php/newsclass/add_newsclass',
						type : 'POST',
						data:{
							name:$("#name").val(),
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
										    if (v == true)
										    { 
										    	window.document.location.href='/index.php/newsclass/add_newsclass';
										    }
										    else
										    { 
										    	window.document.location.href='/index.php/newsclass/index';
										    }
										    return true;
										};
										$.jBox.closeTip();
										// 自定义按钮
										$.jBox.confirm(n.message, "提示", submit, { buttons: { '继续添加': true, '返回分类列表': false} });
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
