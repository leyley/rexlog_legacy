<!--
################################################################################
BEGIN display.page.php
################################################################################
-->
<?php
//admin flag
if(!defined("ADMIN_IN"))
{
	header("Location:../");
	exit();
}
?>
<?php
//config file
require_once(dirname(__FILE__)."/../include/page.php");
if(!file_exists(dirname(__FILE__)."/../data/config.page.php"))
{
	if(TRUE==($fp=fopen(dirname(__FILE__)."/../data/config.page.php","w+")))
	{
		fprintf($fp,"%s","<?php\n\$page_php_supported=0;");
		fclose($fp);
	}
}
require_once(dirname(__FILE__)."/../data/config.page.php");
global $DATA_PAGE_DIR;
?>

<!--html-->
<div id="page" style="display:none">
	<?php
		//error output
    	if($_GET['error'])
    	echo "<div class='error_message'>Operation failed! Check your inputs.".strerror($_GET['error'])."</div>";
	?>

	<!-- part 1: add page-->
	<div class="admin_header">
		Add Page (Support HTML, CSS and JavaScript)
	</div>
	<!--add page edit area-->
	<form method="post" action="?path=admin&submit=page&redirect=page&act=add&php=<?php echo $page_php_supported?>">
		<!--page name area-->
		<div class="padding">
			<label>Page Name: </label>
			<input type="text" name="page_name" class="gin" <?php $name=$_GET['name'];$act=$_GET['act']; if($act=="edit"){echo "value='".$name."'";}?>/>
			PHP CODE <?php if($page_php_supported){echo "<font color='green'>SUPPORTED</font>";}else{echo "<font color='red'>UNSUPPORTED</font>";}?>
			<a href="#" onclick="php_switch(<?php echo (($page_php_supported+1)%2);?>)"> Click to Change!</a>
		</div>
		<!--textarea-->
		<div class="white">
			<textarea class="garea" name="page_content" id="code_page"><?php $name=$_GET['name'];$act=$_GET['act']; if($act=="edit"){echo page_convert(file_get_contents($DATA_PAGE_DIR."/".$name.".php"));}?></textarea>
		</div>
		<!--action area-->
		<div class="padding">
			<input type="submit" class="gbtn" />
			<input type="reset" class="gbtn" />
		</div>
	</form>
	
	<!--part 2: manage pages-->
	<div class="admin_header">
		Manage Pages
	</div>
	<div class="padding">
	<?php
		$files=page_get();
		if($files==null)
		{
			echo "No page exists.";
		}
		else
		{
			foreach ($files as $file)
			{
				echo "<div><a href='#' onclick='del_page(\"".$file."\")'>(X)</a> <a href='?path=admin&redirect=page&act=edit&name=".$file."'>(E)</a> <a href='/index.php?path=".$file."'>".$file."</a></div>\n";
			}
		}
		?>
	</div>
</div>

<!--js action-->
<script language="JavaScript">
function php_switch(enable)
{
	if(enable)
	{
		if(confirm("Wanna edit files with dangerous PHP code?\n Then, prove that you are a php genius!"))
		{
			if(confirm("The legal comment style of PHP is ...\n [OK]\t\t==>\t/*CODE*/\n [Cancel]\t==>\t<!--CODE-->"))
			{
				if(!confirm("If I wanna get a date like this \"2011-2-14\", Which code should I choose? \n [OK]\t\t==>\tdata('Y-m-D');\n [Cancel]\t==>\tdata('Y-n-d');"))
				{
					if(!confirm("Which is dangerouse PHP code? \n [OK]\t\t==>\techo 'important_file_path'\n [Cancel]\t==>\tunlink('important_file_path')"))
					{
						;
					}
					else
					{
						return false;
					}
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
		alert("Great!\nAs you wish, the pages will support PHP code! enjoy!");
	}
	location.href="?path=admin&submit=page&act=php_switch&php="+enable;
}

function del_page(name)
{
	if(confirm("Are you sure to delete this page?"))
		location.href="?path=admin&submit=page&act=del&name="+name;
	else
		return FALSE;
}
</script>
<script>
var editor = CodeMirror.fromTextArea(document.getElementById("code_page"), {
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
<!--
################################################################################
END display.page.php
################################################################################
-->
