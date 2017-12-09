<?php

	$mydir=$_GET['dirname'];
	echo $mydir;
	if(empty($mydir))
	{
		$basename= basename(__DIR__);
		
		$current_dir=getcwd();
		//$current_dir=$basename;
	}
	else
	{
		$basename=$mydir;
		$current_dir=$mydir;
	}
	
	
	
	$path=$current_dir;
	
function getDirectorySize($path = null)
{
    if (null === $path) {
        $path = getcwd();
    }
    $totalsize = 0;
    $totalcount = 0;
    $dircount = 0;
    if ($handle = opendir($path)) {
        while (false !== ($file = readdir($handle))) {
            $nextpath = $path . '/' . $file;
            if ($file != '.' && $file != '..' && !is_link($nextpath)) {
                if (is_dir($nextpath)) {
                    $dircount++;
                    $result = getDirectorySize($nextpath);
                    $totalsize += $result['size'];
                    $totalcount += $result['count'];
                    $dircount += $result['dircount'];
                } elseif (is_file($nextpath)) {
                    $totalsize += filesize($nextpath);
                    $totalcount++;
                }
            }
        }
    }
    //closedir ($handle);
    $total['size'] = $totalsize;
    $total['count'] = $totalcount;
    $total['dircount'] = $dircount;
    return $total;
}

function sizeFormat($size) {
    if ($size < 1024) {
        return $size . " bytes";
    } else if ($size < (1024 * 1024)) {
        $size = round($size / 1024, 1);
        return $size . " KB";
    } else if ($size < (1024 * 1024 * 1024)) {
        $size = round($size / (1024 * 1024), 1);
        return $size . " MB";
    } else {
        $size = round($size / (1024 * 1024 * 1024), 1);
        return $size . " GB";
    }
}

$path = $current_dir; // Write name or path for directory.
$ar = getDirectorySize($path);

$dir = $path;
require("phpDuplicateFilesFinder.php");  // including the php class to get duplicate files.
$obj = new phpDuplicateFilesFinder();
$duplicateFiles = $obj->findDuplicateFiles($dir);

echo "<h4>Details for the Directory : $path</h4>";
echo "Total size : " . sizeFormat($ar['size']) . "<br>";
echo "No. of files : " . $ar['count'] . "<br>";
//echo "No. of directories : ".$ar['dircount']."<br>"; 
//Display Results
$c = count($duplicateFiles);
if ($c === 0) {
    echo "No Duplicate Files were found in \"$dir\"";
} else {
    echo "<div>$c duplicate files found in \"$dir\"</div>";
}
	

?>
