<?php
ob_start();
date_default_timezone_set("Europe/Tirane");
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
  $protocol = 'http://';
} else {
  $protocol = 'https://';
}
$JSON_API_PATH = $protocol . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . "/JSON_Playlist_Data.txt";
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
<!-- Set JS Player From assets/js_players/*JS FILE -->
<script src="assets/js_players/youtube_mod.js" type="text/javascript"></script>
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

var player = new Playerjs({id:"player",file:"<?php echo $JSON_API_PATH; ?>"});
/*
   var player = new Playerjs(
   {
   id:"player",
   file:"Playlist_Reader.php",
   poster:"https://png.kodi.al/tv/albdroid/black.png"
   }
);
*/
</script>
</body>
</html>
<?php
ob_end_flush();
?>
