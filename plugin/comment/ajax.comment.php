<?PHP
/*
*	Ajax file of comment;
*/
require_once("comment.php");
require_once(dirname(__FILE__)."/../../include/user.php");

global $errorno;

if(!($id=$_POST['id']))
{
	echo "<div class='padding'>
		Illegal call.
		</div>
	";
}
switch($_POST['action'])
{
	/* List comments; */
	case 'list':
		if(!($arycmt=comment_get($id)))
		{
			echo "<div class='padding'>
				No comment.
				</div>
			";
		}
		else
		{
			$page=$_POST['page'];
			if(!$page)
				$page=1;
			/* Each page display 30 comments; */
			$istart=$page==1?0:($page-1)*30;	
			$iend=$page==1?30:$page*30+30;
			for($i=$istart;$i<$iend;$i++)
			{
				$floor=$i+1;
				if($arycmt[$i])
				{
					$contents=$arycmt[$i]['contents'];
					$contents=str_replace("<div class='comment_quote'>","[quote]",$contents);
					$contents=str_replace("</div>","[/quote]",$contents);
					$contents=str_replace("<br>","[br]",$contents);
					echo "<div class='comment_item'>
					<div class='padding'>#$floor
					";
					if(user_level()<=1 && user_level()>=0)
					{
						echo "<a href='#' onclick='comment_del(\"".$arycmt[$i]['time']."\")'>(X)</a> ";
					}
					echo $arycmt[$i]['name']." post at ".$arycmt[$i]['time']." <a href='#' onclick='comment_reply(\"".$arycmt[$i]['name']." post at ".$arycmt[$i]['time']."[br]".$contents."\")'>[Quote]</a>
					</div>
					<div class='padding'>
					".$arycmt[$i]['contents']."
					</div>
					</div>
					";
				}
			}
			/* Show page list; hightlight the current page as a []; */
			if(($cntary=count($arycmt))>30)
			{
				$cntpg=$cntary%30==0?$cntary/30:$cntary/30+1;
				echo "<div class='padding'>";
				for($i=1;$i<=$cntpg;$i++)
					echo $i==$page?"[$i] ":"<a href='#' onclick=comment_refresh($i)>$i</a> ";
				echo "</div>";
			}
		}
	break;
	/* Post a new comment; */
	case 'post':
		if(!comment_add($id,$_POST['name'],$_POST['email'],$_POST['contents']))
		{
			echo strerror($errorno);
			exit(-1);
		}
	break;
	/* Delete a certain comment; */
	case 'del':
		if(!comment_del($id,$_POST['time']))
		{
			echo strerror($errorno);
			exit(-1);
		}
	break;
}
?>
