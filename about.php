<?php
if(file_exists("page/about.php"))
{
	include("page/about.php");
}
else
{
	require_once("data/config.site.php");
	echo '
	
	<div id="about">
	<div class="header">About this homepage</div>
	<div class="normal"><span class="title">Name</span><span>'.$site_name.'</span></div>
	<div class="normal"><span class="title">Description</span><span>'.$site_desc.'</span></div>
	<div class="normal"><span class="title">Homepage URL</span><span>'.$site_url.'</span></div>
	<div class="header">About me</div>
	<div class="normal"><span class="title">Name</span><span>'.$me_name.'</span></div>
	<div class="normal"><span class="title">Description</span><span>'.$me_desc.'</span></div>
	<div class="normal"><span class="title">Homepage</span><span>'.$me_url.'</span></div>
	<div class="normal"><span class="title">Email Address</span><span>'.$me_email.'</span></div>
	<div class="normal"><span class="title">AIM Account</span><span>'.$me_aim.'</span></div>
	<div class="normal"><span class="title">MSN Address</span><span>'.$me_msn.'</span></div>
	<div class="normal"><span class="title">ICQ Number</span><span>'.$me_icq.'</span></div>
	<div class="normal"><span class="title">Google Talk</span><span>'.$me_gtalk.'</span></div>
	</div>
	';
}
