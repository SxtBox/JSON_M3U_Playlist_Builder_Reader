<?php
ob_start();
date_default_timezone_set("Europe/Tirane");
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
  $protocol = 'http://';
} else {
  $protocol = 'https://';
}

$M3U_Playlist_Data = $protocol . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . "/Playlist_Data/M3U_Data/Simple_Playlist.m3u";

$M3U_Playlist_Data_PATH = "Playlist_Data/M3U_Data/Simple_Playlist.m3u";
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>My Player</title>
<link rel="shortcut icon" href="favicon.ico"/>
<link rel="icon" href="favicon.ico"/>
<meta property="og:image:width" content="100%">
<meta property="og:image:height" content="100%">
<meta property="og:url" content="https://kodi.al">
<meta property="og:image" content="https://png.kodi.al/tv/albdroid/black.png">
<meta property="og:title" content="My Player">
<meta property="og:description" content="My Player">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="assets/js_players/player_simple.js" type="text/javascript"></script>
<link rel="stylesheet" href="assets/Material_Design/css/materialdesignicons.min.css">
<style>
body, html {
    height: 100%;background-color:#000; color:#0F0;margin:0px;padding:0px;overflow:hidden;
}
#player{
}
</style>
</head>
<body>
<div id="player" class="player" style="height: 100%;"></div>
<script>
   var player = new Playerjs(
   {
   id:"player",
   file:"<?php echo $M3U_Playlist_Data; ?>",
   poster:"https://png.kodi.al/tv/albdroid/black.png"
   }
);
</script>
</body>
</html>
<?php
ob_end_flush();
?>