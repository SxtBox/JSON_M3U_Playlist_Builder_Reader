<?php
// JSON FOLDER READER
$json_structure = '{
	"Albdroid_Streaming_API":{
	"Stream_Wrapper_Data":[';
$Playlist_Data = "Playlist_Data"; // SET PLAYLIST FOLDER TO READ
Scan_Playlist_Folder($Playlist_Data);

function Scan_Playlist_Folder($folder)
{
    global $json_structure;
    foreach (scandir($folder) as $playlist){
        if(is_dir($playlist)){
            if($playlist!='..' && ($playlist!='.')){
                $json_structure.='{"title":"'.$playlist.'","playlist":[';
                Scan_Playlist_Folder($playlist);
                $json_structure = chop($json_structure,',');
                $json_structure.=']},';
            }
        }else{
            JSON_Playlist_Builder($playlist,$folder);
        }
    }
}

function JSON_Playlist_Builder($playlist,$folder)
{
    global $json_structure;
	
    if($playlist)
	{
        $cut_extensions_dots = substr($playlist,strrpos($playlist,'.'));
        $disallow_extensions = [".php",".jpg",".py",".js",".htaccess",".htpasswd"]; // disable extensions
        if(strpos($playlist,'.')>0 &&!in_array($cut_extensions_dots,$disallow_extensions))
		{
			
            $playlistname = substr($playlist,0,strpos($playlist,'.'));
            $thumbnail = 'https://png.kodi.al/tv/albdroid/black.png'; // thumbnail

            $path = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}".pathinfo($_SERVER['PHP_SELF'], 1).'/'.($folder!='.'?$folder.'/':'');

            if(file_exists(($folder!='.'?$folder.'/':'').$playlistname.'.jpg'))
			{
            $thumbnail = ',"thumbnail":"'.$path.($playlistname.'.jpg').'"';
            }

// REMOVE SPACES FROM TITLES
$playlistname = str_replace(
	// REPLACE FROM
    array("%20","-","_","%","?","/"),
	// REPLACE TO
    array(" "," "," "," "," "," "),
    $playlistname
);
// REMOVE SPACES FROM HTTP(s) LINKS
$playlist = str_replace(
	// REPLACE FROM
    array(" "),
	// REPLACE TO
    array("%20"),
    $playlist
);

$json_structure.='
	{
		"title":"'.$playlistname.'",
		"playlist":"'.$path.$playlist.'",
		"thumbnail":"'.$thumbnail.'"
	},';
  }
}
}

//$json_structure = chop($json_structure,',').']';
$json_structure = chop($json_structure,',')."\n".']'."\n".'}'."\n".'}'; // 
echo($json_structure);
?>
