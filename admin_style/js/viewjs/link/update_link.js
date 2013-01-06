
$(document).ready(function(){
	
	$("#update_link").validate(
			{
				rules:{
					name:{
						required:true,
						remote:{
							url  : "/index.php/ajax/is_same_pgroupname",
							type : "POST",
							//dataType : "xml",
							data : {
									name:function(){return $("#name").val();},
									old_name:function(){return $("#old_name").val();},
							},
						},
						},
					url:{
						required:true,
						},			
					},
				messages:{
					name:{
							required:"请填写链接名称",
							remote:"链接名重复",
						},
					url:{
							required:"请填写链接地址",
						},	
					},		
			});
	
})
