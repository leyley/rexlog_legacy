<?PHP
/*
*	The 'front' of comment;
*	This page displays a form and the list of comments for a certain entry;
*/
require_once("comment.php");

global $site_url;

$id=$_GET['id'];
echo "
document.write('<div class=comment_box>');
document.write('<form>');
document.write('<div class=comment_box_header>');
document.write('Comments of $id');
document.write('</div>'); 
document.write('<div id=\'comment_list\'>'); 
";

echo "
document.write('</div>'); 
document.write('<hr />'); 
document.write('<div class=padding>');
document.write('Name <input class=gin name=name id=name />');
document.write('</div>');
document.write('<div class=padding>');
document.write('Email <input class=gin name=email id=email />');
document.write('</div>');
document.write('<div class=padding>');
document.write('<textarea class=garea name=comment id=comment ></textarea>');
document.write('</div>');
document.write('<div class=padding>');
document.write('<input type=button id=postcomment class=gbtn onclick=comment_post() value=\'Post comment\'>');
document.write('</div>');
document.write('</div>');
";

/* Functions; */
echo "
	var thepage=1;
	$(window).load(function(){
		comment_refresh(1);
	}
		);
	/* Refresh comments; */
	function comment_refresh(cpage)
	{
		thepage=cpage;
		$('#comment_list').load('plugin/comment/ajax.comment.php',{action:'list',id:'$id',page:thepage});
	}
	/* Post new comment; */
	function comment_post()
	{
		var cname=$('#name').attr('value');
		var cemail=$('#email').attr('value');
		var ccomment=$('#comment').attr('value');
		if(!cname || !cemail || !ccomment)
		{
			alert('Please input all fields!');
			return false;
		}
		var reg=/^(\w)+(\.\w+)*@(\w)+((\.\w{2,3}){1,3})$/;
		if(!reg.test(cemail))
		{
			alert('The email address you entered is error!');
			return false;
		}
		if(cname.length>25)
		{
			alert('The name should be shorter than 25 characters!');
			return false;
		}
		if(ccomment.length>500)
		{
			alert('A comment should has 0-500 characters!');
			return false;
		}
		$('#postcomment').attr('value','Posting...');
		$('#postcomment').attr('disabled',true);
		$.post('plugin/comment/ajax.comment.php',{action:'post',id:'$id',name:cname,email:cemail,contents:ccomment},function(data) {
			comment_refresh(thepage);
			//alert(data);
		});
		$('#postcomment').attr('value','Post comment');
		$('#postcomment').attr('disabled',false);
		$('#comment').attr('value','');
	}
	/* Delete a certain comment; */
	function comment_del(ctime)
	{
		$.post('plugin/comment/ajax.comment.php',{action:'del',id:'$id',time:ctime},function(data) {
			comment_refresh(thepage);
			//alert(data);
		});
	}
	/* Reply a certain comment; */
	function comment_reply(content)
	{
		$('#comment').attr('value',$('#comment').attr('value')+'[quote]'+content+'[/quote]');
	}
";
?>
