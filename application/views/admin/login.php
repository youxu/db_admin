
<style type="text/css">
<!--
*{margin:0;padding:0}
body {

	font-family:arial;

	font-size: 12px;

	background:#EFF3F6;

	margin: 0px;

}

li{ list-style-type: none;}

ul, form, input { font-size:12px; padding:0; margin:0;}

a:link { color:#084F63;}

a:visited { color:#084F63;}

a:hover{ color:#cc3300;}

a img { border: none;}

img{ border: 0px;}

.fl { float:left;}

.wrap_login {width:532px;height:380px;margin:0 auto;margin-top:150px;background:url(/admin_style/images/login/login_box_bg.png) no-repeat top;position:relative}

.wrap_login .la {}

.wrap_login .lb { width:176px; height:215px; background:url(/admin_style/images/login/gm_l_f.gif) no-repeat center center;}

.wrap_login .box_login { width:257px;color:#fff;position:absolute;right:40px;top:35px;padding:20px 0 0 30px;font-size:14px}

.wrap_login .box_login dd{padding:0 0 15px}

.wrap_login .box_login dd label{width:60px;display:block;float:left;padding:5px 0}

.wrap_login .box_login .c1{margin-left:60px}

.wrap_login .box_login .txt{padding:5px;background-color:#C0E3F1;border:#C0E3F1 solid 1px; vertical-align:middle}

.wrap_login .box_login .txt2{padding:5px;background-color:#fff;border:#fff solid 1px; vertical-align:middle}

.wrap_login .lc ul { padding-left:20px;}

.wrap_login .lc li { float:left; width:237px; line-height:22px;}

.wrap_login .lx { margin-left:24px;}

.ldinput {border:1px solid #c3c6cb; padding:2px;}

.lf {  margin-bottom:13px; }

.footer_login {

	height:39px;

	line-height:22px;

	color:#084F63;

	text-align:center;

	padding-top:15px;

	position:absolute;

	bottom:10px;

	width:532px

}
#login_tab td{padding-top:10px; text-align:left}
-->

</style>

<script>

function changeverify(){
	var date = new Date();
	var ttime = date.getTime();
	var url = "http://192.168.1.111/sns/index.php?app=home&mod=Public&act=verify";
	$('#verifyimg').attr('src',url+'&'+ttime);
}
</script>


<div class="wrap_login">

  <div class="la fl">

    <div class="box_login">
	
      <form action="" name="reg" method="post"  class="nf lf" id="login">
		<table cellpadding="2" cellspacing="2" width="100%" border="0" id="login_tab">
			<tr>
				<td>帐　号：</td>
				<td><input type="text"  class="txt" value="<?php echo $username;?>" name="username" id="username" onfocus="this.className='txt2'" onblur="this.className='txt'" style="width:180px" />
				<div></div>
				</td>
			</tr>
			<tr>
				<td>密　码：</td>
				<td><input type="password"  class="txt" name="password" id="password" onfocus="this.className='txt2'" onblur="this.className='txt'" style="width:180px" />
				<div></div>
				</td>
			</tr>
			<tr>
				<td>验证码：</td>
				<td align="left">
					<input class="txt" onfocus="this.className='txt2'" onblur="this.className='txt'" id="captcha" name="captcha" value="" style="width:58px">
				<div></div>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
				    <a href="javascript:void(0);" onclick="changeverify()"><?php echo $cap['image']?></a> 
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<p id="message_error" class="red" style="padding-bottom:5px;"><?php echo $error?></p>
				    <input type="image"  src="/admin_style/images/login/btn_login.png" style="height:32px; width:102px;" />
				</td>
			</tr>
		</table>

            </form>
		</div>

	</div>

	<div class="footer_login">Copyright &copy; 2008-2012 <a href="http://http://www.zhishisoft.com/" target="_blank" >（北京）有限公司</a> 版权所有</div>

</div>
