<?php

// A Steam API Key is required so as to be able to contact steam and get a users profile image and name
// You can get a Steam API Key by visiting http://steamcommunity.com/dev/apikey
// Don't worry about the web address, it won't have any effect so just type in any web site
// Once you have your steam API Key simply paste the key below. (Make sure the quotation marks are still there or else it won't work)
$SteamAPIKey = "5D2DEA0BCA760CF29FE90974D403E24C";


// Don't edit any of the PHP stuff here or else you may break the script
// If you website isn't displaying correctly then please make sure you have configured your loading url correctly

$error_url = "http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI];
$error_url_test = $error_url . "?steamid=76561198000430367";
$error_url_server = $error_url . "?steamid=%s";

if (!isset($_GET["steamid"])) {
	die("<img src='images/logo.png' /><br /><br />
	Woops, you don't seem to be using the correct extension in the address bar to get the loading screen to work.<br />
	Please make sure it has the correct extension it should have ?steamid= at the end of it and look something like this: www.yourdomain.com/loading/index.php?steamid=%s<br /><br />

	You can use the link below which will automatically add a test steam id to see if your loading screen is configured properly<br />
	<a href='$error_url_test'>$error_url_test</a><br /><br />
	
	When setting your loading url please make sure you set the steam id to %s as shown in the link below<br />
	<a href='$error_url_server'>$error_url_server</a>
	
	");
}

$steamid64 = $_GET["steamid"];

$url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=" . $SteamAPIKey . "&steamids=" . $steamid64;
$json = file_get_contents($url);
$table2 = json_decode($json, true);
$table = $table2["response"]["players"][0];

?>

<!DOCTYPE HTML>
<html>
	<head>
    <!-- Hello, your reading the source code for the server load page -->
	<!-- Created by CaptainMcMarcus for ScriptFodder -->
    <!-- This is the HTML code below and is safe to edit to your needs -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<meta name="description" content="Welcome to Flat Load" /> <!-- Webpage Description --> 
	<title>Flat Load</title> <!-- Webpage Title -->
	<link href="style.css" rel="stylesheet" type="text/css" /> <!-- Links to the Stylesheet -->
    <link href="colour.css" rel="stylesheet" type="text/css" /> <!-- Links to the Colour Stylesheet -->
	
    <script type="text/javascript" src="scripts/jquery.js"></script><!-- Link to jquery so we can center the content -->
    <script type="text/javascript" src="scripts/cycle.js"></script><!-- For Rotating Backgrounds -->
	<script type="text/javascript" src="scripts/main.js"></script><!-- Script to get downloads -->
    
    <script type="text/javascript"><!-- Script to center content -->
	$(document).ready(function() {
		
	//Changes volume of song. 0.5=50% 1=100% volume 
	$('.audio').prop("volume", 0.1);
		
	$(window).resize(function(){

  $('.core-wrapper').css({
   position:'absolute',
   left: ($(window).width() 
     - $('.core-wrapper').outerWidth())/2,
   top: ($(window).height() 
     - $('.core-wrapper').outerHeight())/2
  });
		
 });
 
 // To initially run the function:
 $(window).resize();
 
 	$('#background-scroll').cycle({ 
		fx: 'fade',
		pause: 0, 
		speed: 1800, //Duration of Effect in milliseconds
		timeout: 3500  //Time spent on image in milliseconds
		});
	
	});
    </script>
    

	</head>
	
	<body>
    
    <div id="background-scroll"><!-- Add Backgrounds in via PHP, all we need to do is add backgrounds into the backgrounds folder -->
    	<?php
		
			$bg_folder = "backgrounds/";
			$bg_array = array_diff(scandir($bg_folder), array('..', '.'));
			
			foreach ($bg_array as $bg) {
			echo "<img src='backgrounds/" .$bg . "' class='background' />";
			}
		
		?>
   	</div>
    
    <div class="core-wrapper"><!-- Opens the wrapper so we can contain and center everything -->
    
    	<div id="left-items"><!-- Opens the wrapper for the left content, there isn't really much to change on the left side as it's dynamic -->
    
			<?php
				//PHP Code for the avatar display, it's probably best to leave this alone
                echo "<div id=\"avatar-box\">";
				
                	echo "<div id=\"avatarimg\">";
						echo "<img src=\"" . $table["avatarfull"] . "\" />";
					echo "</div>";
					
					echo "<h2>Welcome<br /> Back</h2>";
				echo "</div>";
				
				//PHP Code for the users steam name, it's probably best to leave this alone
				echo "<div id=\"name-box\">";
					echo "<div class=\"left-box\"><img src=\"images/id.png\" alt=\"ID\"></div>";
                	echo "<p>" . $table["personaname"] . "</p>";
				echo "</div>";
				
				//PHP Code for displayed the users steam id, it's probably best to leave this alone
				echo "<div id=\"steam-box\">";
					echo "<div class=\"left-box\"><img src=\"images/key.png\" alt=\"Steam Key\"></div>";
                	echo "<p>" . $steamid64 . "</p>";
                echo"</div>";
            ?>
           	
            <!-- HTML Code to add the download counter box, it's probably best to leave this alone -->
            <div id="download-box">
            	<div class="left-box"><img src="images/download.png" alt="Download" /></div>
                
                <div id="files">
            		<p>Connecting</p><!-- This is the default text shown in the download box when we are waiting for the download number -->
               	</div>
            </div>
            
     	</div><!-- Close The Wrapper for the Left Items -->
        
        <div id="right-items"><!-- Open wrapper for the items on the right -->
        
        	<h2>Werwolf Gaming</h2><!-- TITLE FOR RIGHT TITLE BAR -->
            
            <p id="text-box"><!-- PAGE TEXT -->
            Hello, Welcome to Crazy's Dank Server<br /><br /><!-- WE USE <br /><br /> to drop a few lines -->

			Hope you have fun.<br /><br />

			don't fuck around.
            </p>
            
      	</div><!-- This closes the right content wrapper -->
        
        <div class="clear"></div><!-- This clears things up so that we can vertically align things correctly -->
    
    </div><!-- now we close the core wrapper to keep everything nicely contained -->
    
    <!-- MUSIC SCRIPT -->
    <!-- To activate simply add a .OGG to the songs directy and it will automatically work, the more songs you add the more random things become :) -->
    <!-- Adding copyrighted music is illegal as you will be redistributing from the server this is hosted from, this means that you will be held liable -->
    
	<?php
	
    $dir = "songs/";
    $song = scandir($dir);
    $i = rand(2, sizeof($song)-1); 

    echo "<audio class='audio' autoplay autobuffer='autobuffer'>";
    echo "<source type='audio/ogg' src='songs/" . $song[$i] . "'>";
	echo "</audio>"
	
	?>
   

	</body><!-- Closes off the HTML Document -->
</html>
