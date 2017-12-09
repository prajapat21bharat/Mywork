<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CSVReader {

  function parse_file($p_Filepath) {

     define('CSV_PATH','C:/xampp/htdocs/demo/'); 
// path where your CSV file is located

    $csv_file = CSV_PATH . "csvdata.csv"; // Name of your CSV file
    $csvfile = fopen($csv_file, 'r');
    $theData = fgets($csvfile);
    $i = 0;
    while (!feof($csvfile)) {
        $csv_data[] = fgets($csvfile, 1024);
        $csv_array = explode(",", $csv_data[$i]);
        $insert_csv = array();
		echo '<pre>';
		print_r($csv_array);
		echo '</pre>';
		//die;
        //$insert_csv['ID'] = $csv_array[0];
        $insert_csv['name'] = $csv_array[0];
        $insert_csv['email'] = $csv_array[1];
        $query = "INSERT INTO csvdata(ID,name,email) 
VALUES('','".$insert_csv['name']."','".$insert_csv['email']."')";
        $n=mysql_query($query, $connect );
        $i++;
    }
    fclose($csvfile);

   echo "File data successfully imported to database!!";
    mysql_close($connect);
    }

   
}
?> 