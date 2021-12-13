
<?php

# include parseCSV class.
require  '../vendor/autoload.php';
require 'core/config.php';
require 'core/db.php';

use ParseCsv\Csv;

if(isset($_POST)) {

	$con = new mysqli ('localhost', 'root', '', 'goroskv_goro');

	$ShowTable = 'users';
	$titl = [];
	$dat = [];

	if(isset($_POST['clear']) && $_POST['clear'] !== NULL){

		if($_POST['clear'] == 'yes') {
			DB::querySet("TRUNCATE TABLE users");
		} else {
			$deleteStatus = $_POST['clear'];
			DB::querySet("DELETE FROM `users` WHERE status = $deleteStatus");
		}

	}

	


	# create new parseCSV object.
	$csv = new Csv();


	// fopen($_FILES['file']['tmp_name'], "r")
	# Parse '_books.csv' using automatic delimiter detection...
	$csv->auto($_FILES['file']['tmp_name']);

	foreach ($csv->titles as $value) {
		array_push($titl, $value);
	}
	$Lst = array_pop($titl);
		echo $Lst;
	$str = implode(",", $titl);

	foreach($csv->data as $key => $row) {
		if(strlen(implode("", $row)) > 0) {
			$Last = array_pop($row);
			// echo $Last;
			// array_unshift($row, $Last);
			foreach ($row as $val){
				if($val == '[]') {
					array_push($dat, 'smth');
				} else if(strlen($val) == 0) {
					array_push($dat, 'NULL');
				} else {
					array_push($dat, $val);
				}
			}
			$today = date("YmdHis");
			$pass = $today + rand(1, 1000);
			$st = implode("','", $dat);
			$sql = "INSERT INTO `users` ($str , uid, pass) VALUES ('$st' , $today , $pass)";
			// echo $st;
			echo $sql;
			$dat = [];
			if($result = $con->query($sql)) {
				echo 'exelent work';
			} else {
				echo 'do not work';
			}
		}
	}
}
?>