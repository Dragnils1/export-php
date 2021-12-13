


<?php

# include parseCSV class.


	require __DIR__ . './vendor/autoload.php';

	use ParseCsv\Csv;



	$con = new mysqli ('localhost', 'root', '', 'goroskv_goro');

	$ShowTable = 'users';


# Create new parseCSV object.

	

	$sql = "SELECT * FROM  `$ShowTable` ";

	$result = $con->query($sql);

	$row = mysqli_fetch_assoc($result);
	$csv = new Csv();
	
	$HeadingsArray = array();
	$valuesArray = array();

	foreach($row as $name => $value){
		$HeadingsArray[]=$name;
	}

	$csv->titles = $HeadingsArray;

	if($result = mysqli_query($con, $sql)){
			foreach($row as $name => $value){
				$row = mysqli_fetch_array($result);
				array_push($valuesArray, $row);
			} 
	}


	$csv->data = $valuesArray;

	
	$csv->save('people.csv');

	$csv->output('people.csv');
	

	// foreach($row as $name => $value){
	// 	// $value = array();
	// 	$valuesArray = $value;
	// 	// $value = array();
	// 	// array_push($valuesArray, $value);
	// }

	// print_r($HeadingsArray);
	// print_r($valuesArray);

	// var_dump(mysqli_fetch_assoc($result));
	// $row = mysqli_fetch_assoc($result);
	// var_dump(mysqli_fetch_array(mysqli_query($con, $sql)));


	// if ($file) {ftruncate($file, 0);}

	// $csv->delimiter = "\t";
	// $csv->parseFile($file);

	// if($result = mysqli_query($con, $sql)){
	// 	while($row = mysqli_fetch_array($result)){
	// 		foreach($row as $name => $value){
	// 			array_push($valuesArray, $row);
	// 			// print_r($value);
	// 			// $csv->data = $value;
	// 		}
	// 		// $userid = $row["id"];
	// 		// $username = $row["name"];
	// 		// $userage = $row["age"];
	// 		// print_r($row);
	// 		// array_push($csv->data, $row);
	// 		// $csv->data =  $row;
	//     }
	// }

	// $csv->titles = $HeadingsArray;
		
	// $csv->data = $value;

	// $csv->auto('data.csv');
?>

