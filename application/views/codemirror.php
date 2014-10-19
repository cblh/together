<!doctype html>

<title>CodeMirror</title>
<meta charset="utf-8"/>

<link rel=stylesheet href="<?php echo base_url("static/codemirror/lib/codemirror.css");?>">
<link rel=stylesheet href="<?php echo base_url("static/codemirror/doc/docs.css");?>">
<link rel=stylesheet href="<?php echo base_url("static/codemirror/addon/display/fullscreen.css");?>">
<script src="<?php echo base_url("static/codemirror/lib/codemirror.js");?>"></script>
<script src="<?php echo base_url("static/codemirror/mode/xml/xml.js");?>"></script>
<script src="<?php echo base_url("static/codemirror/mode/javascript/javascript.js");?>"></script>
<script src="<?php echo base_url("static/codemirror/mode/css/css.js");?>"></script>
<script src="<?php echo base_url("static/codemirror/mode/htmlmixed/htmlmixed.js");?>"></script>
<script src="<?php echo base_url("static/codemirror/addon/edit/matchbrackets.js");?>"></script>
<script src="<?php echo base_url("static/codemirror/jquery.js");?>"></script>
<script src="<?php echo base_url("static/codemirror/addon/display/fullscreen.js");?>"></script>
<!-- <script src="doc/activebookmark.js"></script> -->

<style>
  .CodeMirror {
    float: left;
    /*width: 50%;*/
    border: 1px solid black;
  }
/*  iframe {
    width: 49%;
    float: left;
    height: 300px;
    border: 1px solid black;
    border-left: 0px;
  }*/
</style>



    <textarea id="demotext">    <!-- Create a simple CodeMirror instance -->
    <link rel="stylesheet" href="lib/codemirror.css">
    <script src="lib/codemirror.js"></script>
    <script>
      var editor = CodeMirror.fromTextArea(myTextarea, {
        mode: "text/html"
      });11
    </script>
    </textarea>

  <script>
    // codemirror("demotext");
    //跨域frame通信监听器，并读取文件
    window.addEventListener('message',function(e){
            var file=e.data;
            console.log("codemirror "+file);
            load(file);
          },false);
    //代码高亮编辑器全局实例化
    function codemirror(id){
    window.editor=
      CodeMirror.fromTextArea(document.getElementById(id), {
        lineNumbers: true,
        mode: "text/html",
        tabMode: 'indent',
        extraKeys: {
          "F11": function(cm) {
            cm.setOption("fullScreen", !cm.getOption("fullScreen"));
          },
          "Esc": function(cm) {
            if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
          }
        },
      });
    };
    //预览功能，还没调试出来
    // var delay;
    //   editor.on("change", function() {
    //     clearTimeout(delay);
    //     delay = setTimeout(updatePreview, 300);
    //   });
      
    //   function updatePreview() {
    //     var previewFrame = document.getElementById('preview');
    //     var preview =  previewFrame.contentDocument ||  previewFrame.contentWindow.document;
    //     preview.open();
    //     preview.write(editor.getValue());
    //     preview.close();
    //   }
    //   setTimeout(updatePreview, 300);  

    //post请求文件读取 
    function load(file) {
        $.post("http://localhost/coder/index.php/codemirror_server",
        {
          file:file,
        },
        function(data){
          //替换textarea
          document.getElementById("demotext").innerHTML=data;
          //进行代码高亮
          codemirror("demotext");
          console.log("data: " + data);
        });
      // console.log("nimei");  
    };
    //post请求文件保存
    function save(file,data) {
      var data = editor.getValue();
      var file="/1.php";
        $.post("http://localhost/coder/index.php/codemirror_server",
        {
          file:file,
          data:data,
        },
        function(status,data){
          console.log("Status: " + status);
        });
      // console.log("nimei");  
    };
  </script>

