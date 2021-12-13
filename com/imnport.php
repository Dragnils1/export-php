<pre>
<?php

# include parseCSV class.
require __DIR__ . './vendor/autoload.php';

use ParseCsv\Csv;

$con = new mysqli ('localhost', 'root', '', 'goroskv_goro');

$ShowTable = 'users';
$titl = [];
$dat = [];


# create new parseCSV object.
$csv = new Csv();


# Parse '_books.csv' using automatic delimiter detection...
$csv->auto('people.csv');

foreach ($csv->titles as $value) {
    array_push($titl, $value);
}
$Lst = array_pop($titl);
    echo $Lst;
$str = implode(",", $titl);

foreach($csv->data as $key => $row) {
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

?>
</pre>
<style type="text/css" media="screen">
    table {
        background-color: #BBB;
    }

    th {
        background-color: #EEE;
    }

    td {
        background-color: #FFF;
    }
</style>
<table>
    <tr>
        <?php foreach ($csv->titles as $value): ?>
            <th><?php echo $value; ?></th>
        <?php endforeach; ?>
    </tr>
    <?php foreach ($csv->data as $key => $row): ?>
        <tr>
            <?php foreach ($row as $value): ?>
                <td><?php echo $value; ?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
</table>