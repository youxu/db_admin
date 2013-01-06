
$(document).ready(function(){

	$('#upload_btn').click(function (){
		if($("#userfile").val()!=''){
			ajaxFileUpload();
		}
		else{
			$.jBox.tip('请选择一张图片上传', 'error')
		}
	});
	$.validator.addMethod("af",function(){
		//判断下一个option是否有子集
	    var select_text=$('#pid').find("option:selected").text();
		var newx_text=$('#pid').find("option:selected").next('option').text();
		var select_num =getNum(select_text,'--');
		var next_num =getNum(newx_text,'--');
		if(next_num>select_num){
			return false;
		}
		else{
			return true;
		}
	},"您选择的这个栏目不能够发布新闻，因为他不是末级菜单");
	//console.log($.validator.addMethod);
	$("#update_news").validate(	
			{
				rules:{
					title:{
						required:true,
						},	
					pid:{
						required:true,
						af:true,
						},				
					},
				messages:{
					title:{
							required:"请填写新闻标题",
						},	
					pid:{
							required:"请选择新闻栏目",
							af:"您选择的这个栏目不能够发布新闻，因为他不是末级菜单",
						},					
					},
				submitHandler:function (){
						$.ajax({
						url : '/index.php/news/update_news',
						type : 'POST',
						data:{
							title:$("#title").val(),
							pid:$("#pid").val(),
							newsid:$("#newsid").val(),
							news_detail:$("#news_detail").val(),
							img_url:$("#img_url").val()+$("#img_name").val(),
							status:$("input[name='status']:checked").val(),
							is_top:$("input[name='is_top']:checked").val(),
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
										    	pclass_id=$("#classid").val();
										    	window.document.location.href='/index.php/news/index/'+pclass_id;
										    }
										
										    return true;
										};
										$.jBox.closeTip();
										// 自定义按钮
										$.jBox.confirm(n.message, "提示", submit, { buttons: { '返回列表页': true} });
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

function getNum(s,c){//s是原字符串.c是我们要找个字符串.当然,可以是一个字符
   x=s.indexOf(c);  //判断S中是否有C!如果x=-1,则表明没有.
   sum=0;  //出现的次数!
  while(x!=-1){
   sum++;
   s=s.replace(c, "");//将C用""来代替.再次循环寻找下一个C
   x=s.indexOf(c);
  }
  return sum;
 }
 //上传缩略图
function ajaxFileUpload()
	{
		$("#loading")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});
		//动态上传图片
		$.ajaxFileUpload
		(
			{
				url:'/index.php/news/upload_url/',
				secureuri:false,
				fileElementId:'userfile',
				dataType: 'json',
				
				success: function (data, status)
				{
					$.each(data, function(i,n){
						if(n.status == '0'){
	  						$.jBox.tip(n.message, 'error')
	  					}
	  					if(n.status == '1'){
	  						$("#img_name").val(n.message);
	
	  						$("#img_sl").attr('src',$("#path").val()+n.message).show();
	  						
	  					}
  				});	
				},
				error: function (data, status, e)
				{

					alert(e);
				}
			}
		)
		
		return false;

	} 