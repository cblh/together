<?php include("lib/settings.php");

// Check IP permissions
if (!in_array($_SERVER["REMOTE_ADDR"], $_SESSION['allowedIPs']) && !in_array("*", $_SESSION['allowedIPs'])) {
	header('Location: /');
};

$updateMsg = '';
// Check for updates
if ($ICEcoder["checkUpdates"]) {
	$icv_url = "http://icecoder.net/latest-version?thisVersion=".$ICEcoder["versionNo"];
	if (ini_get('allow_url_fopen')) {
		$icvInfo = explode("\n",file_get_contents($icv_url,false,$context));
	} elseif (function_exists('curl_init')) {
		$ch = curl_init($icv_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$icvInfo = explode("\n", curl_exec($ch));
	}
	$icv = $icvInfo[0];
	$icvI = str_replace('"','\\\'',$icvInfo[1]);
	$thisV = $ICEcoder["versionNo"];
	if (strpos($thisV,"beta")>-1 && !strpos($icv,"beta") && str_replace(" beta","",$thisV) == $icv) {$thisV-=0.1;};
	if ($thisV<$icv) {
		$updateMsg = ";top.ICEcoder.dataMessage('<b>UPDATE INFO:</b> ICEcoder v ".$icv." now available. (Your version is v ".$ICEcoder["versionNo"].").<br><br><a onclick=\\'top.ICEcoder.update()\\' style=\\'color:#fff; background: #b00; padding: 5px; text-decoration: none; cursor: pointer\\'>Update now</a><br><br>".$icvI."');";
	}
}

$isMac = strpos($_SERVER['HTTP_USER_AGENT'], "Macintosh")>-1 ? true : false;
?>
<!DOCTYPE html>
<html onMouseDown="top.ICEcoder.mouseDown=true" onMouseUp="top.ICEcoder.mouseDown=false; if (!top.ICEcoder.overCloseLink) {top.ICEcoder.tabDragEnd()}" onMouseMove="if(top.ICEcoder) {top.ICEcoder.getMouseXY(event,'top');top.ICEcoder.canResizeFilesW()}" onMouseWheel="if (!top.ICEcoder.getcMInstance().hasFocus()) {event.wheelDelta > 0 ? top.ICEcoder.nextTab() : top.ICEcoder.previousTab();}">
<head>
<title>ICEcoder v <?php echo $ICEcoder["versionNo"];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex, nofollow">
<link rel="stylesheet" type="text/css" href="lib/ice-coder.css">
<link rel="icon" type="image/png" href="favicon.png">
<script>
iceRoot = "<?php echo $ICEcoder['root']; ?>";

window.onbeforeunload = function() {
	for(var i=1;i<=ICEcoder.savedPoints.length;i++) {
		if (ICEcoder.savedPoints[i-1]!=top.ICEcoder.getcMInstance(ICEcoder.cMInstances[i-1]).changeGeneration()) {
			return "You have some unsaved changes.";
		}
	}
}
</script>
<script language="JavaScript" src="lib/ice-coder<?php if (!$ICEcoder['devMode']) {echo '.min';};?>.js"></script>
<script src="lib/mmd.js"></script>
<script src="farbtastic/farbtastic.js"></script>
<link rel="stylesheet" href="farbtastic/farbtastic.css" type="text/css">
</head>

<body onLoad="<?php
	echo 'top.ICEcoder.previousFiles = [';
	if ($ICEcoder["previousFiles"]!="") {
		$openFilesArray = explode(",",$ICEcoder["previousFiles"]);
		echo "'".implode("','",$openFilesArray)."'";
	}
	echo "];";
	echo "top.ICEcoder.theme = '".($ICEcoder["theme"]=="default" ? 'icecoder' : $ICEcoder["theme"])."';".
		"top.ICEcoder.fontSize = '".$ICEcoder["fontSize"]."';".
		"top.ICEcoder.openLastFiles = ".($ICEcoder["openLastFiles"] ? 'true' : 'false').";".
		"top.ICEcoder.codeAssist = ".($ICEcoder["codeAssist"] ? 'true' : 'false').";".
		"top.ICEcoder.lineWrapping = ".($ICEcoder["lineWrapping"] ? 'true' : 'false').";".
		"top.ICEcoder.indentWithTabs = ".($ICEcoder["indentWithTabs"] ? 'true' : 'false').";".
		"top.ICEcoder.indentSize = ".$ICEcoder["indentSize"].";".
		"top.ICEcoder.demoMode = ".($ICEcoder["demoMode"] ? 'true' : 'false').";".
		"top.ICEcoder.tagWrapperCommand = '".$ICEcoder["tagWrapperCommand"]."';".
		"top.ICEcoder.autoComplete = '".$ICEcoder["autoComplete"]."';".
		"top.ICEcoder.bugFilePaths = ['".implode("','",$ICEcoder["bugFilePaths"])."'];".
		"top.ICEcoder.bugFileCheckTimer = ".$ICEcoder["bugFileCheckTimer"].";".
		"top.ICEcoder.bugFileMaxLines = ".$ICEcoder["bugFileMaxLines"];
?>;ICEcoder.init()<?php echo $updateMsg.$onLoadExtras;?>;top.ICEcoder.content.style.visibility='visible';top.ICEcoder.filesFrame.contentWindow.frames['processControl'].location.href = 'processes/on-load.php';" onResize="ICEcoder.setLayout()" onKeyDown="return ICEcoder.interceptKeys('coder',event);" onKeyUp="parent.ICEcoder.resetKeys(event);" onBlur="parent.ICEcoder.resetKeys(event);">

<div id="blackMask" class="blackMask" onClick="if (!ICEcoder.overPopup) {ICEcoder.showHide('hide',this)}" onContextMenu="return false">
	<div class="popupVCenter">
		<div class="popup" id="mediaContainer"></div>
	</div>
</div>

<div id="loadingMask" class="blackMask" style="visibility: visible" onContextMenu="return false">
	<div class="popupVCenter">
		<div class="popup">
			<div class="spinner"></div>
			working...
		</div>
	</div>
</div>

<div id="plugins" class="plugins" style="<?php echo $ICEcoder["pluginPanelAligned"];?>: 0" onMouseOver="top.ICEcoder.showHidePlugins('show')" onMouseOut="top.ICEcoder.showHidePlugins('hide')" onClick="top.ICEcoder.showHidePlugins('hide')">
	<div style="padding: 15px">
		<a nohref onClick="top.ICEcoder.showColorPicker(top.document.getElementById('color') ? top.document.getElementById('color').value : '#123456')" title="Farbtastic
Color picker"><img src="images/color-picker.png" style="cursor: pointer" alt="Color Picker"></a><br><br>
		<div id="pluginsOptional"><?php echo $pluginsDisplay; ?></div>
		<a nohref onclick="top.ICEcoder.pluginsManager()" title="Plugins Manager" style="color: #fff; cursor: pointer">+ / -</a>
	</div>
</div>

<div id="fileMenu" class="fileMenu" onMouseOver="ICEcoder.changeFilesW('expand')" onMouseOut="ICEcoder.changeFilesW('contract');top.ICEcoder.hideFileMenu()" style="opacity: 0" onContextMenu="return false">
	<span id="folderMenuItems">
		<a href="javascript:top.ICEcoder.newFile()" onMouseOver="ICEcoder.showFileMenu()">New File</a>
		<a href="javascript:top.ICEcoder.newFolder()" onMouseOver="ICEcoder.showFileMenu()">New Folder</a>
		<div onMouseOver="ICEcoder.showFileMenu()" style="padding: 2px 0"><hr></div>
		<a href="javascript:top.ICEcoder.uploadFilesSelect(top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1])" onMouseOver="ICEcoder.showFileMenu()">Upload File(s)</a>
		<div style="display: none">
			<form enctype="multipart/form-data" id="uploadFilesForm" action="lib/file-control.php?action=upload&file=/uploaded" method="POST" target="fileControl">
				<input type="hidden" name="folder" id="uploadDir" value="/">
				<input type="file" name="filesInput[]" id="fileInput" onchange="top.ICEcoder.uploadFilesSubmit(this)" multiple>
				<input type="submit" value="Upload File">
			</form>
		</div>
		<a href="javascript:top.ICEcoder.pasteFiles(top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1])" onMouseOver="ICEcoder.showFileMenu()" id="fmMenuPasteOption" style="display: none">Paste</a>
		<div onMouseOver="ICEcoder.showFileMenu()" style="padding: 2px 0"><hr></div>
	</span>
	<a href="javascript:top.ICEcoder.openFilesFromList(top.ICEcoder.selectedFiles)" onMouseOver="ICEcoder.showFileMenu()">Open</a>
	<a href="javascript:top.ICEcoder.copyFiles(top.ICEcoder.selectedFiles)" onMouseOver="ICEcoder.showFileMenu()">Copy</a>
	<a href="javascript:top.ICEcoder.duplicateFiles(top.ICEcoder.selectedFiles)" onMouseOver="ICEcoder.showFileMenu()">Duplicate</a>
	<a href="javascript:top.ICEcoder.deleteFiles(top.ICEcoder.selectedFiles)" onMouseOver="ICEcoder.showFileMenu()">Delete</a>
	<span id="singleFileMenuItems">
		<a href="javascript:top.ICEcoder.renameFile(top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1])" onMouseOver="ICEcoder.showFileMenu()">Rename</a>
		<div onMouseOver="ICEcoder.showFileMenu()" style="padding: 2px 0"><hr></div>
		<a nohref onClick="window.open(iceRoot + top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1].replace(/\|/g,'/'))" onMouseOver="ICEcoder.showFileMenu()" style="cursor: pointer">View Webpage</a>
	</span>
	<div onMouseOver="ICEcoder.showFileMenu()" style="padding: 2px 0"><hr></div>
	<?php
	if (file_exists(dirname(__FILE__)."/plugins/zip-it/index.php")) {
		echo '<a href="javascript:top.ICEcoder.zipIt(top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1])" onMouseOver="ICEcoder.showFileMenu()">Zip It!</a>'.PHP_EOL;
	};
	?>
	<a href="javascript:top.ICEcoder.downloadFile(top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1])" onMouseOver="ICEcoder.showFileMenu()">Download</a>
	<div onMouseOver="ICEcoder.showFileMenu()" style="padding: 2px 0"><hr></div>
	<a href="javascript:top.ICEcoder.propertiesScreen(top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1])" onMouseOver="ICEcoder.showFileMenu()">Properties</a>
</div>

<div id="header" class="header" onContextMenu="return false"></div>

<div id="files" class="files" onMouseOver="ICEcoder.changeFilesW('expand')" onMouseOut="ICEcoder.changeFilesW('contract'); top.ICEcoder.hideFileMenu();" onContextMenu="return false">
	<div id="fileNav" class="fileNav">
		<ul>
			<li><a nohref onmouseover="top.ICEcoder.showHideFileNav('show','optionsFile')" id="optionsFileNav">File</a></li>
			<li><a nohref onmouseover="top.ICEcoder.showHideFileNav('show','optionsEdit')" id="optionsEditNav">Edit</a></li>
			<li><a nohref onmouseover="top.ICEcoder.showHideFileNav('show','optionsRemote')" id="optionsRemoteNav">Remote</a></li>
			<li><a nohref onmouseover="top.ICEcoder.showHideFileNav('show','optionsHelp')" id="optionsHelpNav">Help</a></li>
		</ul>
	</div>
	<div class="options" id="fileOptions">
		<div id="optionsFile" class="optionsList" onmouseover="top.ICEcoder.showHideFileNav('show',this.id)" onmouseout="top.ICEcoder.showHideFileNav('hide',this.id)">
			<ul>
				<li><a nohref onClick="ICEcoder.newFile()">New File...</a></li>
				<li><a nohref onClick="ICEcoder.newFolder()">New Folder...</a></li>
				<li><a nohref onClick="ICEcoder.openPrompt()">Open...</a></li>
				<li><a nohref onClick="ICEcoder.saveFile()">Save</a></li>
				<li><a nohref onclick="ICEcoder.saveFile('saveAs')">Save As...</a></li>
				<li><a nohref onclick="ICEcoder.openPreviewWindow()">Live Preview</a></li>
				<li><a nohref onclick="ICEcoder.downloadFile(top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1])">Download</a></li>
				<li><a nohref onclick="ICEcoder.copyFiles(top.ICEcoder.selectedFiles)">Copy</a></li>
				<li><a nohref onclick="ICEcoder.pasteFiles(top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1])">Paste</a></li>
				<li><a nohref onclick="ICEcoder.deleteFiles(top.ICEcoder.selectedFiles)">Delete</a></li>
				<li><a nohref onclick="ICEcoder.duplicateFiles(top.ICEcoder.selectedFiles)">Duplicate</a></li>
				<li><a nohref onclick="ICEcoder.renameFile(top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1])">Rename</a></li>
				<li><a nohref onclick="ICEcoder.uploadFilesSelect(top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1])">Upload...</a></li>
				<li><a nohref onclick="ICEcoder.zipIt(top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1])">Zip</a></li>
				<li><a nohref onclick="ICEcoder.propertiesScreen(top.ICEcoder.selectedFiles[top.ICEcoder.selectedFiles.length-1])">Properties...</a></li>
				<li><a nohref onClick="ICEcoder.fullScreenSwitcher()">Fullscreen toggle</a></li>
				<li><a nohref onClick="ICEcoder.logout()">Logout</a></li>
			</ul>
		</div>
		<div id="optionsEdit" class="optionsList" onmouseover="top.ICEcoder.showHideFileNav('show',this.id)" onmouseout="top.ICEcoder.showHideFileNav('hide',this.id)">
			<ul>
				<li><a nohref onclick="ICEcoder.undo()">Undo</a></li>
				<li><a nohref onclick="ICEcoder.redo()">Redo</a></li>
				<li><a nohref onclick="ICEcoder.indent('more')">Indent more</a></li>
				<li><a nohref onclick="ICEcoder.indent('less')">Indent less</a></li>
				<li><a nohref onclick="ICEcoder.autocomplete()">Autocomplete</a></li>
				<li><a nohref onclick="ICEcoder.lineCommentToggle()">Comment/Uncomment</a></li>
				<li><a nohref onclick="ICEcoder.jumpToDefinition()">Jump to Definition</a></li>
			</ul>
		</div>
		<div id="optionsRemote" class="optionsList" onmouseover="top.ICEcoder.showHideFileNav('show',this.id)" onmouseout="top.ICEcoder.showHideFileNav('hide',this.id)">
			<ul>
				<li><a nohref onclick="ICEcoder.message('Git & GitHub integration coming soon')">GitHub</a></li>
				<li><a nohref onclick="ICEcoder.message('SVN integration coming soon')">SVN</a></li>
				<li><a nohref onclick="ICEcoder.message('Bitbucket integration coming soon\n\nCan you help with this? Get involved at icecoder.net')">Bitbucket</a></li>
				<li><a nohref onclick="ICEcoder.message('Amazon AWS integration coming soon\n\nCan you help with this? Get involved at icecoder.net')">Amazon AWS</a></li>
				<li><a nohref onclick="ICEcoder.message('Dropbox integration coming soon\n\nCan you help with this? Get involved at icecoder.net')">Dropbox</a></li>
				<li><a nohref onclick="ICEcoder.message('FTP integration coming soon\n\nCan you help with this? Get involved at icecoder.net')">FTP</a></li>
				<li><a nohref onclick="ICEcoder.message('SSH integration coming soon\n\nCan you help with this? Get involved at icecoder.net')">SSH</a></li>
			</ul>
		</div>
		<div id="optionsHelp" class="optionsList" onmouseover="top.ICEcoder.showHideFileNav('show',this.id)" onmouseout="top.ICEcoder.showHideFileNav('hide',this.id)">
			<ul>
				<li><a nohref onclick="ICEcoder.showManual('<?php echo $ICEcoder["versionNo"];?>')">Manual</a></li>
				<li><a nohref onClick="ICEcoder.helpScreen()">Shortcuts</a></li>
				<li><a nohref onClick="ICEcoder.settingsScreen()">Settings</a></li>
				<li><a nohref onclick="ICEcoder.searchForSelected()">Search for selected</a></li>
				<li><a href="http://icecoder.net" target="_blank">ICEcoder website</a></li>
				<li><a href="http://igg.me/at/icecoder4" target="_blank">Crowdfund ICEcoder v4.0</a></li>
			</ul>
		</div>
	</div>
	<iframe id="filesFrame" class="frame" name="ff" src="files.php" style="opacity: 0" onLoad="this.style.opacity='1';this.contentWindow.onscroll=function(){top.ICEcoder.mouseDown=false}"></iframe>
	<div class="serverMessage" id="serverMessage"></div>
</div>

<div id="editor" class="editor">
	<div id="tabsBar" class="tabsBar" onContextMenu="return false">
		<a nohref onClick="top.ICEcoder.closeAllTabs()"><img src="images/nav-close-all.gif" class="closeAllTabs" title="Close all tabs"></a>
		<a nohref onClick="top.ICEcoder.alphaTabs()"><img src="images/nav-alpha.png" class="alphaTabs" title="Alphabetize tabs"></a>
		<?php
		for ($i=1;$i<=100;$i++) {
			echo '<div id="tab'.$i.'" class="tab" onMouseDown="ICEcoder.canSwitchTabs ? ICEcoder.switchTab(parseInt(this.id.slice(3),10)) : ICEcoder.canSwitchTabs=true; thisColor=top.ICEcoder.tabFGselected; if (!top.ICEcoder.overCloseLink) {ICEcoder.tabDragStart(parseInt(this.id.slice(3),10))}; if (event.button==1) {ICEcoder.closeTab(parseInt(this.id.slice(3),10)); return false};" onMouseOver="thisColor=this.style.color;this.style.color=top.ICEcoder.tabFGselected" onMouseOut="this.style.color=thisColor"></div>';
		}
		?><div class="newTab" onClick="ICEcoder.newTab()" id="newTab">+</div>
	</div>
	<div id="findBar" class="findBar" onContextMenu="return false">
		<form name="findAndReplace" onSubmit="ICEcoder.findReplace(top.document.getElementById('find').value,false,true);return false">
			<div class="findReplace">
				<div class="findText">Find</div>
				<input type="text" name="find" value="" id="find" class="textbox find" onKeyUp="ICEcoder.findReplace(top.document.getElementById('find').value,true,false)">
				
				<div class="selectWrapper" style="width: 41px">
					<select name="connector" onChange="ICEcoder.findReplaceOptions()" style="width: 40px; margin-top: 4px">
					<option>in</option>
					<option>and</option>
					</select>
				</div>
				<div class="replaceText" id="rText" style="display: none">
					<div class="selectWrapper" style="width: 75px; overflow: visible">
						<select name="replaceAction" style="width: 72px; margin-top: -2px">
							<option>replace</option>
							<option>replace all</option>
						</select>
					</div>
					 with
				</div>
				<input type="text" name="replace" value="" id="replace" class="textbox replace" style="display: none">
				<div class="targetText" id="rTarget" style="display: none">in</div>
					<div class="selectWrapper" style="width: 104px">
						<select name="target" onChange="ICEcoder.updateResultsDisplay(this.value=='this document' ? 'show' : 'hide')" style="width: 101px; margin-top: 4px; margin-left: 2px">
							<option>this document</option>
							<option>open documents</option>
							<option>all files</option>
							<option>all filenames</option>
						</select>
					</div>
				<input type="submit" name="submit" value="&gt;&gt;" class="submit">
				<div class="results" id="results"></div>
			</div>
		</form>
		<form onSubmit="return ICEcoder.goToLine()">
			<div class="codeAssist" title="Turn on/off JS Hint &amp; CSS color previews">
				<input type="checkbox" name="codeAssist" id="codeAssist" class="codeAssistCheckbox" <?php if ($ICEcoder['codeAssist']) {echo 'checked ';};?>>
				<span class="codeAssistDisplay" id="codeAssistDisplay" style="background-position: <?php echo $ICEcoder['codeAssist'] ? "0" : "-16";?> 0" onClick="top.ICEcoder.codeAssistToggle()"></span> Code Assist
			</div>
			<div class="goLine">Go to Line <input type="text" name="goToLine" value="" id="goToLineNo" class="textbox goToLine">
			<div class="view" title="View" onClick="top.ICEcoder.openPreviewWindow()" id="fMView"></div>
			<div class="bug" title="Bug reporting not active" onClick="top.ICEcoder.openBugReport()" id="bugIcon"></div>
		</form>
	</div>
	<iframe name="contentFrame" id="content" src="editor.php" class="code"></iframe>
</div>

<div class="footer" id="footer" onContextMenu="return false">
	<div class="nesting" id="nestValid"></div>
	<div class="nestDisplay" id="nestDisplay"></div>
	<div class="byteDisplay" id="byteDisplay" style="display: none" onClick="top.ICEcoder.showDisplay('char')"></div>
	<div class="charDisplay" id="charDisplay" style="display: inline-block" onClick="top.ICEcoder.showDisplay('byte')"></div>
</div>

<script>
ICEcoder.initAliases();
ICEcoder.setLayout('dontSetEditor');
</script>

</body>

</html>