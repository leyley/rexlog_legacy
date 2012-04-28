<?php
require_once("include/message.php");
?>
<?php
$page=$_GET['page'];
if(!$page)
  $page=1;
$start=$page==1?0:($page-1)*20;
$end=$page==1?20:$page*20;
$messages=message_get($start,$end);
if($messages)
{
	foreach($messages as $msg)
	{
		echo "<div class='message'><div class='message_time'>".$msg[1]."</div>".$msg[2]."</div>\n";
	}
	//Previous;
	if($page!=1 && message_get($start-20,$start))
	{
	  $page-=1;
	  echo "<div class='previous'><a href='/?path=message&page=$page'>Previous Messages</a></div>";
	}
	//Next;
	if(message_get($end,$end+20))
	{
	  $page+=1;
	  echo "<div class='next'><a href='/?path=message&page=$page'>More Messages</a></div>";
	}
}
else
{
	echo "<div class='message'><div class='message_time'>&nbsp;</div>No Message</div>\n";
}
?>