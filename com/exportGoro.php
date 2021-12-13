


<?php


// header('Cache-Control: no-store, no-cache, must-revalidate');
// header('Cache-Control: post-check=0, pre-check=0', FALSE);
// header('Pragma: no-cache');

ob_end_clean();

$cols = [
    'id',
    'uid',
    'fav',
    'fav_date',
    'comp',
    'firstname',
    'lastname',
    'gender',
    'city',
    'birthday',
    'year',
    'birthyear',
    'zodiak',
    'langlove',
    'langlove2',
    'familystatus',
    'phone',
    'vk',
    'helptext',
    'targetsearch',
    'targetsearchtext',
    'about',
    'report',
    'height',
    'weight',
    'inst',
    'fb',
    'ok',
    'email',
    'pass',
    'dateofend',
    'source',
    'source_type',
    'images',
    'registermonth',
    'smoke',
    'children',
    'birthdaychild1',
    'birthdaychild2',
    'birthdaychild3',
    'birthdaychild4',
    'lastlove',
    'lastzodiak',
    'reg_date',
    'last_modify',
    'user_InNum',
    'user_OutNum',
    'comment',
    'vip',
    'defer',
    'status',
    'role',
];

if (isset($_POST['export'])) {


    

$con = new mysqli ('localhost', 'root', '', 'goroskv_goro');
// Table Name that you want
// to export in csv
$ShowTable = 'users';

$FileName = "./export/export.csv";
$file = fopen($FileName,"w");
if ($file) {ftruncate($file, 0);}


switch ($_POST['export']) {
    case 'import':
        $sql = "SELECT * FROM  `$ShowTable` ";
        break;
    case 'archive':
        $sql = "SELECT * FROM `$ShowTable` WHERE status = '2'";
        break;
    case 'lines':
        $sql = "SELECT * FROM `$ShowTable` WHERE status BETWEEN 1 AND 9";
        break;
    case 'line1':
    case 'moderation':
        $sql = "SELECT * FROM `$ShowTable` WHERE status = '0' ";
        break;
    case 'passive':
        $sql = "SELECT * FROM `$ShowTable` WHERE status = '27' ORDER BY birthday DESC";
        break;
    case 'active':
        $sql = "SELECT * FROM `$ShowTable` WHERE status = '26' ORDER BY birthday DESC";
        break;
    case 'profiles':
        $sql = "SELECT * FROM `$ShowTable` WHERE status = '29' ORDER BY birthday DESC";
        break;

}

// echo $sql . 'as:' . $_POST['export'];

$result = $con->query($sql);

$row = mysqli_fetch_assoc($result);
// Save headings alon
$HeadingsArray=array();

foreach($row as $name => $value){

    if (in_array($name, $cols)){
        $HeadingsArray[]=$name;
        // echo $name;
    }
}

fputcsv($file,$HeadingsArray); 
    
// Save all records without headings

while($row = mysqli_fetch_assoc($result)){

    $valuesArray=array();
    foreach($row as $name => $value){
        $valuesArray[]=$value;

}

fputcsv($file,$valuesArray); 
    
// iconv('UTF-8', 'Windows-1251', $file);
}
fclose($file);


if ($file) echo 'ok';

ob_end_clean();

}






?>