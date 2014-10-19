<!doctype html>

<title>CodeMirror</title>
<meta charset="utf-8"/>

<link rel=stylesheet href="lib/codemirror.css">
<link rel=stylesheet href="doc/docs.css">
<script src="lib/codemirror.js"></script>
<script src="mode/xml/xml.js"></script>
<script src="mode/javascript/javascript.js"></script>
<script src="mode/css/css.js"></script>
<script src="mode/htmlmixed/htmlmixed.js"></script>
<script src="addon/edit/matchbrackets.js"></script>
<script src="jquery.js"></script>
<!-- <script src="doc/activebookmark.js"></script> -->

<style>
  .CodeMirror { height: auto; border: 1px solid #ddd; }
  .CodeMirror-scroll { max-height: 200px; }
  .CodeMirror pre { padding-left: 7px; line-height: 1.25; }
</style>


<form style="position: relative; margin-top: .5em;">
    <textarea id="demotext">
    </textarea>
    <button id="load" onclick="load()">load</button>
    <button id="save" onclick="save()">save</button>
    <div id="div"></div>
</form>
  <script>
    codemirror("demotext");
    function codemirror(id){
    window.editor=
      CodeMirror.fromTextArea(document.getElementById(id), {
        lineNumbers: true,
        mode: "text/html",
        matchBrackets: true,
        // content: textarea.value,
        parserfile: ["tokenizejavascript.js", "parsejavascript.js"],
        stylesheet: "css/jscolors.css",
        path: "js/",
      });
    }        
    function load() {
      // var content = editor.getValue();
      var file="1.php";
        $.post("test.php",
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
    }
    function save() {
      var data = editor.getValue();
      var file="1.php";
        $.post("test.php",
        {
          file:file,
          data:data,
        },
        function(status,data){
          console.log("Status: " + status);
        });
      // console.log("nimei");  
    }
  </script>

