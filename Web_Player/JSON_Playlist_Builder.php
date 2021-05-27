<?php

$json_structure = '[';
$Playlist_Data = "Playlist_Data/Video_Data"; // SET VIDEO FOLDER TO READ
Scan_Playlist_Folder($Playlist_Data);

function Scan_Playlist_Folder($folder){
    global $json_structure;
    foreach (scandir($folder) as $file){
        if(is_dir($file)){
            if($file!='..' && $file!='.'){
                $json_structure.='{"title":"'.$file.'","folder":[';
                Scan_Playlist_Folder($file);
                $json_structure = chop($json_structure,',');
                $json_structure.=']},';
            }
        }else{
            JSON_Playlist_Builder($file,$folder);
        }
    }
}

function JSON_Playlist_Builder($file,$folder){
    global $json_structure;
    if($file){
        $cut_extensions_dots = substr($file,strrpos($file,'.'));
		$disallow_extensions = [".php",".jpg",".py",".js",".txt",".htaccess",".htpasswd"]; // disable extensions
        if(strpos($file,'.')>0 &&!in_array($cut_extensions_dots,$disallow_extensions)){
            $filename = substr($file,0,strpos($file,'.'));
            $thumbnail = 'https://png.kodi.al/tv/albdroid/black.png';
            
            $path =  (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}".pathinfo($_SERVER['PHP_SELF'], 1).'/'.($folder!='.'?$folder.'/':'');

            if(file_exists(($folder!='.'?$folder.'/':'').$filename.'.jpg')){
            $thumbnail = ',"poster":"'.$path.($filename.'.jpg').'"';
            }

// REMOVE SPACES FROM TITLES
$filename = str_replace(
	// REPLACE FROM
    array("%20","_","%","?","/"),
	// REPLACE TO
    array(" "," "," "," "," "),
    $filename
);
// REMOVE SPACES FROM HTTP(s) LINKS
$file = str_replace(
	// REPLACE FROM
    array(" "),
	// REPLACE TO
    array("%20"),
    $file
);

$json_structure.='
	{
		"title":"'.$filename.'",
		"file":"'.$path.$file.'",
		"poster":"'.$thumbnail.'"
	},';
  }
}
}

$json_structure = chop($json_structure,',')."\n".']';
echo($json_structure);
file_put_contents('JSON_Playlist_Data.txt', $json_structure);
?>
