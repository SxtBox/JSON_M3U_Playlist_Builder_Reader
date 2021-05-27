<?php
/*
Required LiveStreamsPro.zip
https://addons.kodi.al/LiveStreamsPro.zip
*/
ob_start();
date_default_timezone_set("Europe/Tirane");
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
  $protocol = 'http://';
} else {
  $protocol = 'https://';
}
$JSON_API_PATH = $protocol . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . "/JSON_Playlist_Builder.php";
/* JSON_API_PATH =
JSON_Playlist_Builder.php
JSON_Playlist_Reader.php
JSON_Playlist_Data.json
*/
header('Content-Type: application/xml');
?>
<item> <!-- https://rubular.com/r/d8WLCNyCJgmvAM -->
<title>[COLOR lime][B]JSON[/B][/COLOR][COLOR red][B] ([/B][/COLOR][COLOR lime][B]Regex Mode[COLOR red][B])[/B][/COLOR]</title>
<thumbnail>https://png.kodi.al/tv/albdroid/black.png</thumbnail>
<fanart>https://png.kodi.al/tv/albdroid/black.png</fanart>
<link>$doregex[makelist]</link>
<regex>
<name>makelist</name>
<listrepeat><![CDATA[
<title>[UPPERCASE][COLOR lime][B][makelist.param1][/B][/COLOR][/UPPERCASE]</title>
<link>Albdroid Streaming</link>
<externallink>[makelist.param2]|Referer=[makelist.param2]</externallink>
<thumbnail>[makelist.param3]</thumbnail>
<fanart>[makelist.param3]</fanart>
]]></listrepeat>
<expres><![CDATA[title":"(.*?)".*\n.*playlist":"(.*?)".*\n.*thumbnail":"(.*?)"]]></expres>
<page><?php echo $JSON_API_PATH; ?></page>
</regex>
</item>
<?php
ob_end_flush();
?>