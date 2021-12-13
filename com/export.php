<?php
require_once __DIR__ . '/vendor/autoload.php';

// $file = fopen('./data.csv', 'w');

// $csv = new \ParseCsv\Csv();
// $csv->encoding('UTF-16', 'UTF-8');
// $csv->delimiter = "\t";
// $csv->parseFile($file);
// print_r($csv->data);

// foreach($csv->data as $d) {
//     echo $d;
// }

use ParseCsv\Csv;


# create new parseCSV object.
$csv = new Csv();


# Parse '_books.csv' using automatic delimiter detection...
$csv->auto('data.csv');

# ...or if you know the delimiter, set the delimiter character
# if its not the default comma...
// $csv->delimiter = "\t";   # tab delimited

# ...and then use the parse() function.
// $csv->parse('_books.csv');

# now we have data in $csv->data, at which point we can modify
# it to our hearts content, like removing the last item...
array_pop($csv->data);

# then we output the file to the browser as a downloadable file...
$csv->output('dd.csv');
# ...when the first parameter is given and is not null, the
# output method will itself send the correct headers and the
# data to download the output as a CSV file. if it's not set
# or is set to null, output will only return the generated CSV
# output data, and will not output to the browser itself.

?>