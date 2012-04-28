<div>
<p align="center"><b>Rexlog - A lightweight homepage solution. To build your site easily.</b></p>
<p align="center">Rexlog is an opensource homepage builder for developers to setup their site quickly, it is:</P>
<p>
<ul>
<li>Light weight: less than 1 MB;</li>
<li>Low requirement: does not need extra Database;</li>
<li>Easy to extend: quick plugin developments;</li>
</ul>
</P>
</div>
<?php
    require_once("include/message.php");
?>
<?php
    $messages=message_get(0,7);
    if($messages)
    {
        foreach($messages as $msg)
        {
            echo "<div class='message'><div class='message_time'>".$msg[1]."</div>".$msg[2]."</div>\n";
        }
    }
    else
    {
        echo "<div class='message'><div class='message_time'>&nbsp;</div>No Message</div>\n";
    }
?>
