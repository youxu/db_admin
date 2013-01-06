<script>
$(document).ready(function(){
		$("tr[overstyle='on']").live('mouseover',
		  function () {
		    $(this).addClass("bg_hover");
		  }
		  
		);
		$("tr[overstyle='on']").live('mouseout',
		  function () {
		    $(this).removeClass("bg_hover");
		  }
		  
		);
		
	});
var url="<?php echo site_url()?>"+'/bd/user/index/';
function pagejump(page){
		$.ajax({
			url : url+'/'+page,
			type : 'POST',
			data:{
				post_page:page,
			},
			dataType:'json',
			beforeSend: function(){
				$.jBox.tip("请稍候", 'loading');		
			},
			success :function (data){
				var html='';
				$.each(data, function(i,n){
						$.each(n.userList, function(k,v){
							var ian='';
							var sts='';
							if(v.is_admin == '1'){
								ian='是';
							}
							else{
								ian='否';
							}
							if(v.status == '1'){
								sts='启用';
							}
							else{
								sts='未启用';
							}
							html += '<tr  overstyle="on">';
							html += '<td>'+v.name+'</td>';
							html += '<td>'+v.chname+'</td>';
							html += '<td>'+ian+'</td>';
							html += '<td>'+sts+'</td>';
							html += '<td>';
							html += '<a href="<?php echo site_url().'/bd/user/update_user/'?>'+v.id+'">编辑</a>&nbsp;';
							html += '<a href="#" onclick="">删除</a>';
							html += '</td>';
							html += '</tr>';
						});
						$("#pager").html(n.pager);
				});
					$("#tablist").html(html);
					$.jBox.closeTip();
				},
			error : function (){
					$.jBox.tip('数据错误', 'error')
				}
		})
	}
</script>
<div class="list">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <thead>
  <tr>


    <th class="line_l">用户名</th>
    <th class="line_l">中文名</th>
    <th class="line_l">审核</th>
    <th class="line_l">状态</th>
    <th class="line_l">操作</th>
  </tr>
  </thead>
  <tbody id="tablist">
  <?php foreach ($userList as $k=>$v):?>
  <tr overstyle='on'>

	    <td><?php echo $v['name']?></td>
	    <td><?php echo $v['chname']?></td>
		<td><?php echo $v['is_admin']=='1'?'是':'否'?></td>
	    <td><?php echo $v['status'] =='1'?'启用':'未启用'?></td>
		<td>
			<a href="<?php echo site_url().'/bd/user/update_user/'.$v['id']?>" >编辑 </a> 
	    	<a href="#" onclick="deleteCredit(118);">删除</a>
	    </td>
	  </tr>
<?php endforeach;?>	  
</tbody>
	  </table>

  </div>
  <div class="Toolbar_inbox">
  	<div class="page right" id="pager">
	<?php echo $pager;?>
  	</div>
  </div>