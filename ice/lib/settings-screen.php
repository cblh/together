<?php include("settings.php");?>
<!DOCTYPE html>

<html>
<head>
<title>ICEcoder <?php echo $ICEcoder["versionNo"];?> settings screen</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex, nofollow">
<link rel="stylesheet" type="text/css" href="settings-screen.css">
<link rel="stylesheet" href="../<?php echo $ICEcoder["codeMirrorDir"]; ?>/lib/codemirror.css">
<script src="../<?php echo $ICEcoder["codeMirrorDir"]; ?>/lib/codemirror-compressed.js"></script>

<style type="text/css">
.CodeMirror {position: absolute; width: 409px; height: 240px; font-size: <?php echo $ICEcoder["fontSize"];?>}
.CodeMirror-scroll {overflow: hidden}
/* Make sure this next one remains the 3rd item, updated with JS */
.cm-tab {border-left-width: <?php echo $ICEcoder["visibleTabs"] ? "1px" : "0";?>; margin-left: <?php echo $ICEcoder["visibleTabs"] ? "-1px" : "0";?>; border-left-style: solid; border-left-color: rgba(255,255,255,0.2)}
</style>

<link rel="stylesheet" href="editor.css">
<?php
$themeArray = array();
$handle = opendir('../'.$ICEcoder["codeMirrorDir"].'/theme/');
while (false !== ($file = readdir($handle))) {
	if ($file !== "." && $file != "..") {
		array_push($themeArray,basename($file,".css"));
	}
}
sort($themeArray);
for ($i=0;$i<count($themeArray);$i++) {
	echo '<link rel="stylesheet" href="../'.$ICEcoder["codeMirrorDir"].'/theme/'.$themeArray[$i].'.css">'.PHP_EOL;
}
?>
</head>

<body class="settings">

<div class="infoPane">
	<a href="http://icecoder.net" target="_blank"><img src="../images/ice-coder.png" alt="ICEcoder" class="logo"></a>

	<h1 style="margin: 10px 0">settings</h1>

	<p>
	version:<br>
	v <?php echo $ICEcoder["versionNo"];?>
	<br><br>

	website:<br>
	<a href="http://icecoder.net" target="_blank">http://icecoder.net</a>
	<br><br>

	git:<br>
	<a href="http://github.com/mattpass/ICEcoder" target="_blank">http://github.com/mattpass/ICEcoder</a>
	<br><br>

	codemirror dir:<br>
	<?php echo $ICEcoder["codeMirrorDir"]; ?>
	<br><br>

	codemirror version:<br>
	<script>
	document.write(CodeMirror.version);
	</script>
	<br><br>

	file manager root:<br>
	<?php echo $ICEcoder['root'] == "" ? "/" : $ICEcoder['root'];?>
	<br><br>

	<div style="font-size: 10px; line-height: 12px">ICE coder by Matt Pass (<a href="http://www.twitter.com/mattpass" style="font-size: 10px" target="_blank">@mattpass</a>)<br><br>
		Free to use it for your own purposes, commercial or not, just let me know of any cool uses or customisations. :)<br><br>
		No warranty or liability accepted for anything, all responsibility of use is your own.<br><br>

		Thanks go to the following people who have inspired me to create this or provided feedback, code or testing:<br>
		<?php
			$peopleArray = array("marijnjh", "maettig", "darkosvitic", "anagnam", "a_harris88", "emmetio", "prinzhorn", "jakubvrana", "vicen_herrera", "abstractba", "adarwash", "themximum");
			function makeURL(&$value) {
				$value = '<a href="http://www.twitter.com/'.$value.'" style="font-size: 10px" target="_blank">@'.$value.'</a>';
			};
			array_walk($peopleArray, "makeURL");
			echo implode(", ",$peopleArray);
		?>
		<br><br>
		...plus a whole load of people on Github. Thanks for your contributions!
	</div>
	</p>
</div>

<form name="settings" action="settings.php" method="POST">
<div class="settingsColumn1">
<h2>functionality</h2>
<input type="checkbox" onclick="showButton()" name="checkUpdates" value="true"<?php if($ICEcoder["checkUpdates"]) {echo ' checked';};?>> check for updates on load<br>
<input type="checkbox" onclick="showButton()" name="openLastFiles" value="true"<?php if($ICEcoder["openLastFiles"]) {echo ' checked';};?>> auto open last files on login<br>
<br>
when finding in files, exclude:<br>
<input type="text" onkeydown="showButton()" name="findFilesExclude" value="<?php echo implode(", ",$ICEcoder["findFilesExclude"]); ?>"><br>
<br>

<h2>assisting</h2>
<input type="checkbox" onclick="showButton()" name="codeAssist" value="true"<?php if($ICEcoder["codeAssist"]) {echo ' checked';};?>> code assist<br>
<input type="checkbox" onclick="showButton();showHideTabs()" name="visibleTabs" value="true"<?php if($ICEcoder["visibleTabs"]) {echo ' checked';};?>> visible tabs<br>
<input type="checkbox" onclick="showButton()" name="lockedNav" value="true"<?php if($ICEcoder["lockedNav"]) {echo ' checked';};?>> locked nav<br><br>
tag wrapper command<br>
<select onchange="showButton()" name="tagWrapperCommand">
	<option value="ctrl+alt"<?php if($ICEcoder["tagWrapperCommand"]=='ctrl+alt') {echo " selected";};?>>ctrl/cmd + alt</option>
	<option value="alt-left"<?php if($ICEcoder["tagWrapperCommand"]=='alt-left') {echo " selected";};?>>alt left</option>
</select><br>
<br>
auto-complete on<br>
<select onchange="showButton()" name="autoComplete">
	<option value="ctrl+space"<?php if($ICEcoder["autoComplete"]=='ctrl+space') {echo " selected";};?>>ctrl/cmd + space</option>
	<option value="keypress"<?php if($ICEcoder["autoComplete"]=='keypress') {echo " selected";};?>>keypress</option>
</select><br>
<br>

<h2>security</h2>
new password <span class="info" title="8 chars min">[?]</span><br>
<input type="password" name="password" onkeydown="showButton()"><br>
confirm password<br>
<input type="password" name="passwordConfirm" onkeydown="showButton()"><br>
<br>
banned files/folders<br>
<input type="text" onkeydown="document.settings.changedFileSettings.value='true';showButton()" name="bannedFiles" value="<?php echo implode(", ",$ICEcoder["bannedFiles"]); ?>"><br>
banned paths <span class="info" title="Slash prefixed, comma delimited">[?]</span><br>
<input type="text" onkeydown="document.settings.changedFileSettings.value='true';showButton()" name="bannedPaths" value="<?php echo implode(", ",$ICEcoder["bannedPaths"]); ?>"><br>
<input type="hidden" name="changedFileSettings" value="false">
ip addresses <span class="info" title="Comma delimited">[?]</span><br>
<input type="text" onkeydown="showButton()" name="allowedIPs" value="<?php echo implode(", ",$ICEcoder["allowedIPs"]); ?>"><br>
</div>

<div class="settingsColumn2">
<h2>style</h2>
theme<br>
<select onchange="selectTheme();showButton()" id="select" name="theme" style="width: 95px">
    <option<?php if ($ICEcoder["theme"]=="default") {echo ' selected';}; ?>>default</option>
<?php
for ($i=0;$i<count($themeArray);$i++) {
	$optionSelected = $ICEcoder["theme"]==$themeArray[$i] ? ' selected' : '';
	echo '<option'.$optionSelected.'>'.$themeArray[$i].'</option>'.PHP_EOL;
}
?>
</select>

<span style="position: absolute; margin: -15px 0 0 10px">
	line wrapping<br>
	<select onchange="showButton()" name="lineWrapping">
		<option value="true"<?php if($ICEcoder["lineWrapping"]) {echo " selected";};?>>yes</option>
		<option value="false"<?php if(!$ICEcoder["lineWrapping"]) {echo " selected";};?>>no</option>
	</select>
</span>

<span style="position: absolute; margin: -15px 0 0 100px">
	indent type<br>
	<select onchange="showButton()" name="indentWithTabs">
		<option value="true"<?php if($ICEcoder["indentWithTabs"]) {echo " selected";};?>>tabs</option>
		<option value="false"<?php if(!$ICEcoder["indentWithTabs"]) {echo " selected";};?>>spaces</option>
	</select>
</span>

<span style="position: absolute; margin: -15px 0 0 190px">
	indent size <br>
	<input type="text" name="indentSize" id="indentSize" style="width: 30px" onkeydown="showButton()" onkeyup="changeIndentSize()" value="<?php echo $ICEcoder["indentSize"];?>">
</span>

<span style="position: absolute; margin: -15px 0 0 267px">
	font size <br>
	<input type="text" name="fontSize" id="fontSize" style="width: 44px" onkeydown="showButton()" onkeyup="changeFontSize()" value="<?php echo $ICEcoder["fontSize"];?>">
</span>
<br><br>

<textarea id="code" name="code">
function findSequence(goal) {
	function find(start,history) {
		if (start==goal)
			return history;
		else if (start>goal)
			return null;
		else
			return find(start+5,"("+history+"+5)") ||
			find(start*3,"("+history+"*3)");
	}
	return find(1,"1");
}</textarea>
<br>

<span style="position: absolute; top: 360px">

	<div style="position: relative; display: inline-block; margin-right: 20px">
		<h2>layout</h2>
		plugin panel aligned<br>
		<select onchange="showButton()" name="pluginPanelAligned">
			<option value="left"<?php if($ICEcoder["pluginPanelAligned"] == "left") {echo " selected";};?>>left</option>
			<option value="right"<?php if($ICEcoder["pluginPanelAligned"] == "right") {echo " selected";};?>>right</option>
		</select>
	</div>

	<div style="position: relative; display: inline-block">
		<h2>file manager</h2>
		root <span class="info" title="Slash prefixed">[?]</span><br>
		<input type="text" name="root" style="width: 200px" onkeydown="document.settings.changedFileSettings.value='true';showButton()" value="<?php echo $ICEcoder["root"];?>">
	</div>
	<br><br>

	<h2>bug reporting</h2>
	check in files <span class="info" title="Slash prefixed, comma delimited">[?]</span><br>
	<input type="text" name="bugFilePaths" style="width: 120px" onkeydown="showButton()" value="<?php echo implode(", ",$ICEcoder["bugFilePaths"]);?>">
	<span style="display: inline-block; padding: 4px 5px 0 5px">every</span>
	<input type="text" name="bugFileCheckTimer" style="width: 50px" onkeydown="showButton()" value="<?php echo $ICEcoder["bugFileCheckTimer"];?>">
	<span style="display: inline-block; padding: 4px 5px 0 5px">secs, getting last</span>
	<input type="text" name="bugFileMaxLines" style="width: 50px" onkeydown="showButton()" value="<?php echo $ICEcoder["bugFileMaxLines"];?>">
	<span style="display: inline-block; padding: 4px 5px 0 5px">lines</span>
</span>

<script>
var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
	lineNumbers: true,
	readOnly: "nocursor",
	indentUnit: top.ICEcoder.indentSize,
	tabSize: top.ICEcoder.indentSize,
	mode: "javascript",
	theme: "<?php echo $ICEcoder["theme"]=="default" ? 'icecoder' : $ICEcoder["theme"];?>"
	});

var input = document.getElementById("select");
function selectTheme() {
	var theme = input.options[input.selectedIndex].innerHTML;
	if (theme=="default") {theme = "icecoder"};
	editor.setOption("theme", theme);
}

function changeIndentSize() {
	var indentSize = document.getElementById("indentSize").value;
	editor.setOption("indentUnit", indentSize);
	editor.setOption("tabSize", indentSize);
}

function changeFontSize() {
	cMCSS = document.styleSheets[2];
	cMCSS.rules ? strCSS = 'rules' : strCSS = 'cssRules';
	cMCSS[strCSS][0].style['fontSize'] = document.getElementById("fontSize").value;
}

var showButton = function() {
	document.getElementById('updateButton').style.opacity = 1;
}

var showHideTabs = function() {
	cMCSS = document.styleSheets[2];
	cMCSS.rules ? strCSS = 'rules' : strCSS = 'cssRules';
	cMCSS[strCSS][2].style['border-left-width'] = document.settings.visibleTabs.checked ? '1px' : '0';
	cMCSS[strCSS][2].style['margin-left'] = document.settings.visibleTabs.checked ? '-1px' : '0';
}

var validatePasswords = function() {
	if (document.settings.password.value != 0 && document.settings.password.value.length<8) {
		top.ICEcoder.message('Please use at least 8 chars in the password');
	} else {
		if (document.settings.password.value != document.settings.passwordConfirm.value) {
			top.ICEcoder.message('Sorry, your passwords don\'t match')
		} else {
			document.settings.submit();
		}
	}
}
</script>

<div class="update" id="updateButton" onClick="<?php echo $ICEcoder['demoMode'] ? "top.ICEcoder.message('Sorry, can\'t commit settings in demo mode')" : "validatePasswords()"; ?>">update</div>

</div>

</form>

</body>

</html>