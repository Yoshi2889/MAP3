<?php

/** 
 * MAP3 Software
 * Open source forum software written in PHP 
 *  
 * Version: 1.0 Alpha 
 * Developed by: Rick "Yoshi2889" and Robert "Stijllozekip" 
 * Website: http://map3cms.co.cc 
 *  
 * A list of all contributors can be found on the credits page in the admin panel 
 * 
 * License: BSD
 *
*/
 
function template_settings()
{
        $currentstyle = array(
                'dir' => 'default',
                'name' => 'MAP3 Default Theme',
                'author' => 'The MAP3 team'
        );
}
        
function template_header_start()
{
        global $modSettings, $urls, $user, $context;
        
        echo '<!DOCTYPE html>
<html>
<head>
        <title>', $modSettings['forum_name'], '</title>
        
        <!-- jQuery -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	
	<!-- CSS -->
        <link href="', $urls['css'], '/main.css" rel="stylesheet" />
	
	<!-- Theme JavaScript -->
	<script type="text/javascript" src="', $urls['scripts'], '/theme.js"></script>
	
	<!-- JS paths and variables -->
	<script type="text/javascript">
		//<![CDATA[
		
		var m3_images_url = \'', $urls['images'], '\';
		var m3_user_id = \'', ($user->isLoggedIn ? $user->details['user_id'] : 0), '\';
		var m3_script_url = \'', $urls['script'], '\';
		
		//]]>
	</script>
	
	<!-- Any remaining HTML headers -->
	', $context['html_headers'], '
</head>';
}
        
function template_body_start()
{
	global $modSettings, $user, $txt, $urls, $context;
        echo '
<body>';

	// Are we running IE 8 or even older?
	if ($context['browser']['ie_under_warn'] && !empty($modSettings['ie_warning']))
		echo '
	<div style="height:20px;background-color:#FFFF66;padding:5px;text-align:center">', sprintf($txt['ie_warning'], $context['browser']['ie_ver'], $modSettings['forum_name']), '</div>';
	
	echo '
        <div id="content">
        	<div id="header">
			<a href="', $urls['script'], '">', $modSettings['forum_name'], '</a>
		</div>
	        ', template_menu(), '
	        <div id="maincontent">
        		<div id="userinfo">
        			<table style="width:95%" class="floatleft" id="header_userinfo">
        				<tr>';
        			
        if ($user->isLoggedIn)
        {
        	echo '
						', !empty($user->details['avatar']) ? '<td width="5%" class="righttext">
							<img src="' . $user->details['avatar'] . '" style="height:80px; width: 80px;" alt="" />
						</td>' : '', '
						<td width="93%" valign="top">
							<strong>', sprintf($txt['welcome'], $user->details['displayname']), '</strong><br />
							<a href="', $urls['script'], '?act=unread">', $txt['unread'], '</a><br />
							<a href="', $urls['script'], '?act=messages">', $txt['unread_pms'], '</a><br />
							', sprintf($txt['current_time'], $user->time()), '<br />
							', $txt['news'], ' <em>', $modSettings['news'], '</em>
						</td>';
        }
        else
        	echo '
						<td class="fullwidth">
							', $txt['news'], ' <em>', $modSettings['news'], '</em>
						</td>';
        				
        echo '
					</tr>
				</table>
				<div class="floatright">
					<img id="collapse_userinfo" src="', $urls['images'], '/up.png" alt="" />
				</div>
				<br class="clear" />
			</div><br />';
}
        
function template_body_end()
{
	global $txt;
        echo '
        	</div>
        </div>
	<div id="copyright">
		<a href="http://map3forum.tk">', $txt['copyright'], '</a>
	</div>';
}
        
function template_header_end()
{
        echo '
</body>
</html>';
}
        
function template_menu()
{
        global $modSettings, $map3;
        echo '
        <div class="navigation">
        	<ul>';
                
        $menu = $map3->menu();
        foreach ($menu as $button)
        {
                if (!$button['show'])
                        continue;
                       
                echo '
			<li', !empty($button['active']) ? ' class="active"' : '', '><a href="', $button['url'], '">&nbsp;&nbsp;', $button['title'], '</a></li>';
        }
                
        echo '
		</ul>
	</div>';
}
