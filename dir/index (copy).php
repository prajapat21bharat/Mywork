<form action="index.php" method="post">
	<input type="text" name="dirname" />
	<input type="submit" name="create" value="submit" />
</form>
<?php
if(isset($_POST['create']))
{
	
	$mydir=$_POST['dirname'];
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
	
	$totalSize = 0;
	foreach (new DirectoryIterator($current_dir) as $file)
	{
		//if ($file->isFile()) {
			$totalSize += $file->getSize();
		//}
	}
	$filesize=$totalSize/1024;
	
	echo 'Directory Size : '.$filesize.' kb.<br>';
	
	
	echo 'Directory Name : '.$basename.'<br>';
	$no_of_files = array_filter(($current_dir.'/*.*'), 'is_dir');
	print_r($current_dir).'<br>';
	
	$path = dirname($_SERVER['PHP_SELF']);

	$position = strrpos($path,'/') + 1;

	echo substr($path,$position);
	
	//file_get_contents("test.txt");
	
	
	
	//print_r( $no_of_files);
	
}


opendir('.');
	/*function createdir($dirname)
	{
		mkdir($dirname);
	}
	chdir('cvs');
	echo getcwd() . "\n";
	if (!file_exists('path/to/directory'))
	{
		mkdir(getcwd(), 0777, true);
	}*/
	
	/*$dirs = array_filter(glob('*'), 'is_dir');
	print_r( $dirs);*/
	
	//$directory=getcwd();
	function calculate_whole_directory($directory)
    {
        if ($handle = opendir($directory))
        {
			echo getcwd();
        $size = 0;
        $folders = 0;
        $files = 0;
 
        while (false !== ($file = readdir($handle)))
        {
            if ($file != "." && $file != "..")
            {
                if(is_dir($directory.$file))
                {
                $array = $this->calculate_whole_directory($directory.$file.'/');
                $size += $array['size'];
                $files += $array['files'];
                $folders += $array['folders'];
                }
                else
                {
                $size += filesize($directory.$file);
                $files++;
                }
            }
         }
         closedir($handle);
         }
 
         $folders++;
 
    print_r( array('size' => $size, 'files' => $files, 'folders' => $folders));
    }
?>
