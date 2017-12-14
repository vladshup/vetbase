<?php
$dbpath = 'c:\xampp\mysql\data\vetbase';
$basepath = 'd:' . DIRECTORY_SEPARATOR . '!vetliga_base_backup';
$date = date('d-m-Y',time());
$backuppath = $basepath . DIRECTORY_SEPARATOR . $date;

if (!is_dir($basepath)) {
    mkdir($basepath, 0777, true);
}

if (!is_dir($backuppath)) {
    mkdir($backuppath, 0777, true);
	recurse_copy($dbpath,$backuppath);
}



function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . DIRECTORY_SEPARATOR . $file) ) { 
                recurse_copy($src . DIRECTORY_SEPARATOR . $file,$dst . DIRECTORY_SEPARATOR . $file); 
            } 
            else { 
                copy($src . DIRECTORY_SEPARATOR . $file,$dst . DIRECTORY_SEPARATOR . $file); 
            } 
        } 
    } 
    closedir($dir); 
}

?>