<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Editor</title>
    <link rel="stylesheet" href="<?php echo base_url("static/zeditor/css/codemirror.css");?>"/>
    <link rel="stylesheet" href="<?php echo base_url("static/zeditor/css/docs.css");?>"/>
    <link rel="stylesheet" href="<?php echo base_url("static/zeditor/css/dialog.css");?>"/>
    <link rel="stylesheet" href="<?php echo base_url("static/zeditor/css/index.css");?>"/>
    <link rel="stylesheet" href="<?php echo base_url("static/zeditor/css/theme/solarized.css");?>"/>
  </head>
  <body>
    <div id="editor" class="editor">
        <input id="textValue" type="text" style="display: none;"></input>
        <textarea id="code" name="code"></textarea>
        <iframe id="preview" class="preview"></iframe>
        <div class="api-link">
            <font class="font">For Keyboard Shortcuts</font>
            <a href="javascript:;" onclick="showShorcuts()"><font class="font">Click Here</font></a>
        </div>
    </div>
    <div id="msgBoxArea" class="messageArea">
        <div id="choiceBox" class="msgBox">
            <div id='msg' class="contentArea">
                <center>
                    <font class="docTitle">Shotcuts Docs<font>
                </center>
                <div class="content">
                    <div class="key"> F11: </div> <div class="value"> Full screen </div> <br />
                    <div class="key"> F10: </div> <div class="value"> JSHint </div> <br />
                    <div class="key"> Ctrl + F: </div> <div class="value"> To Search </div> <br />
                </div>
            </div>
            <a href="#" class="ui-back" onclick="backToEditor()">Back</a>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url("static/zeditor/lib/codemirror.js");?>"></script>
    <script type="text/javascript" src="<?php echo base_url("static/zeditor/lib/javascript.js");?>"></script>
    <script type="text/javascript" src="<?php echo base_url("static/zeditor/lib/xml.js");?>"></script>
    <script type="text/javascript" src="<?php echo base_url("static/zeditor/lib/css.js");?>"></script>
    <script type="text/javascript" src="<?php echo base_url("static/zeditor/lib/htmlmixed.js");?>"></script>
    <script src="<?php echo base_url("static/zeditor/lib/match-highlighter.js");?>"></script>
    <script src="<?php echo base_url("static/zeditor/lib/searchcursor.js");?>"></script>
    <script src="<?php echo base_url("static/zeditor/lib/search.js");?>"></script>
    <script type="text/javascript" src="<?php echo base_url("static/zeditor/lib/dialog.js");?>"></script>
    <script type="text/javascript" src="<?php echo base_url("static/zeditor/lib/jshint.js");?>"></script>
    <script type="text/javascript" src="<?php echo base_url("static/zeditor/js/decorate.js");?>"></script>
    <script type="text/javascript" src="<?php echo base_url("static/zeditor/js/index.js");?>"></script>
    <script src="<?php echo base_url("static/codemirror/jquery.js");?>"></script>
    <script type="text/javascript">
        var showShorcuts = function () {
            OLEditor.showShorcuts();
        };
        var backToEditor = function () {
            OLEditor.backToEditor();
        }
        window.onload = function () {
            OLEditor.init();
        }
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
                tabMode: 'indent',
                lineWrapping: true,
                theme: 'solarized light',
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
        //post请求文件读取 
        function load(file) {
            $.post("http://localhost/coder/index.php/codemirror_server",
            {
              file:file,
            },
            function(data){
              //替换textarea
              document.getElementById("code").innerHTML=data;
              //进行代码高亮
              // codemirror("code");
              //重载textarea的内容
              OLEditor.setValue(data);
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
  </body>
</html>