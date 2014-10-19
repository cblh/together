<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>coder</title>
<script>
    //跨域frame通信监听器，并出现调试信息
    window.addEventListener('message',function(e){
            var file=e.data;
            console.log("welcome "+file);
          },false);
</script>
<style>
body
{
  scrollbar-base-color:#C0D586;
  scrollbar-arrow-color:#FFFFFF;
  scrollbar-shadow-color:DEEFC6;
}
</style>
</head>

  <frameset cols="20%,80%,30%" name="btFrame" frameborder="NO" border="0" framespacing="0">
    <frame id="iframe1" src="<?php echo site_url("jqueryfiletree");?>" noresize name="menu" scrolling="yes">
    <frame id="iframe2" src="<?php echo site_url("codemirror");?>" noresize name="main" scrolling="yes">
    <frame id="iframe3" src="<?php echo site_url("photo");?>" noresize name="photo" scrolling="yes">
  </frameset>

<noframes>
  <body>您的浏览器不支持框架！</body>
</noframes>
</html>