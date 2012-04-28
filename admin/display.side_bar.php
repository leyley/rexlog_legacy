<?PHP
if(!defined("ADMIN_IN"))
{
	header("Location:../");
	exit();
}
?>
<?php require_once(dirname(__FILE__)."/../include/page.php");?>

<div id="side_bar" style="display:none">
<?PHP
    if($_GET['error'])
    echo "<div class='error_message'>Operation failed! Check your inputs.".strerror($_GET['error'])."</div>";
?>
<div class="admin_header">
Sidebar(raw html)
</div>
<form method="post" action="?path=admin&submit=side_bar">
<div class="white">
<textarea class="garea" name="side_bar_content" id="code_side_bar">
<?PHP
global $DATA_DIR;
echo page_convert(file_get_contents($DATA_DIR."/config.side_bar.php"));
?>
</textarea>
</div>
<div class="padding">
<input type="submit" class="gbtn" />
<input type="reset" class="gbtn" />
</div>
</form>
</div>

<script>
var editor = CodeMirror.fromTextArea(document.getElementById("code_side_bar"), {
	mode: "application/x-httpd-php",
	lineNumbers: true,
	lineWrapping: true,
	matchBrackets: true,
	indentUnit: 4,
	indentWithTabs: true,
	enterMode: "keep",
	tabMode: "shift",
	onCursorActivity: function() {
    editor.setLineClass(hlLine, null, null);
    hlLine = editor.setLineClass(editor.getCursor().line, null, "activeline");
  }
});
var hlLine = editor.setLineClass(0, "activeline");
</script>
