
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>jqueryfiletree</title>
	<script src="<?php echo base_url("static/jqueryfiletree/jquery.js");?>" type="text/javascript"></script><style type="text/css"></style>
	<script src="<?php echo base_url("static/jqueryfiletree/jquery.easing.js");?>" type="text/javascript"></script>
	<script src="<?php echo base_url("static/jqueryfiletree/jqueryFileTree.js");?>" type="text/javascript"></script>
	<link href="<?php echo base_url("static/jqueryfiletree/jqueryFileTree.css");?>" rel="stylesheet" type="text/css" media="screen">
	<script type="text/javascript">
		$(document).ready( function() {
			//调用jqueryfiletree接口函数
			$('#fileTree').fileTree({ root: '/', script: 'http://localhost/coder/index.php/jqueryfiletree_server', folderEvent: 'click', expandSpeed: 750, collapseSpeed: 750, expandEasing: 'easeOutBounce', collapseEasing: 'easeOutBounce', loadMessage: 'Un momento...' }, function(file) { 
        			// console.log(file);
        			window.parent.frames[1].postMessage(file, '*');
			});});
		function filetree(dir){
			$('#fileTree').fileTree({ root: dir, script: 'http://localhost/coder/index.php/jqueryfiletree_server', folderEvent: 'click', expandSpeed: 750, collapseSpeed: 750, expandEasing: 'easeOutBounce', collapseEasing: 'easeOutBounce', loadMessage: 'Un momento...' }, function(file) { 
        			// console.log(file);
        			window.parent.frames[1].postMessage(file, '*');
			});
		}
		//跨域frame通信监听器，并出现调试信息
	    window.addEventListener('message',function(e){
	        var file=e.data;
	        console.log("jq "+file);
	      },false);
	</script>
	<style type="text/css">
	.example {
		float: left;
		margin: 5px;
	}
	.demo {
		width: 100%;
		height: 100%;
		border-top: solid 1px #BBB;
		border-left: solid 1px #BBB;
		border-bottom: solid 1px #FFF;
		border-right: solid 1px #FFF;
		background: #FFF;
		overflow: scroll;
	}
	</style>
</head>
<body>
	<div class="example">
		<select id="select">
			<option value ="/">项目一</option>
			<option value ="/wamp/">项目二</option>
			<option value="/wamp/www/">项目三</option>
		</select>
		<div id="fileTree" class="demo">
	</div>
<script>
    var se1=document.getElementById('select');
    se1.onchange=function(){
        var index=this.selectedIndex;//索引
        console.log(this.options[index].value);
        filetree(this.options[index].value);
    }
</script>
</body>
</html>