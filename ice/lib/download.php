<?php include("settings.php");?>
<?php
$file = $docRoot.$iceRoot.str_replace("|","/",$_GET['file']);

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Content-Length: '.filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
}
?>