<?php
$csv_file = "/home/teodorvalov/www/passionpuro/database/backup/history_old.csv";
$new_csv_file = "/home/teodorvalov/www/passionpuro/database/backup/history_new.csv";

$row = 1;
$new_data[0] =  array("id", "product_id", "data", "created_at", "current_number", "artikul_number");

if (($handle = fopen($csv_file, "r")) !== FALSE) {

    while (($data = fgetcsv($handle, 3000, ";")) !== FALSE) {
        // just to skip the first row
        if(!is_numeric($data[0])){ continue; }
        $my_data = json_decode($data[2], true);
        $json_data = $my_data['new'];
        $json_data_to_add = $json_data;
        unset($json_data_to_add['id']);
        unset($json_data_to_add['current_number']);

        $new_data[$row][0] = $data[0];
        $new_data[$row][1] = $data[1];
        if($json_data_to_add != null){
            $new_data[$row][2] = json_encode($json_data_to_add);
        }

        $new_data[$row][3] = $data[3];
        foreach ($json_data as $id => $value){
            if ($id == 'current_number'){
                $new_data[$row][4] = $value;
            }
            if ($id == 'artikul_number'){
                $new_data[$row][5] = $value;
            }
        }

        $row++;
        $num = count($data);
    }
    fclose($handle);
}

$fp = fopen($new_csv_file, 'w');

foreach ($new_data as $fields) {
    fputcsv($fp, $fields, ";");
}

fclose($fp);
