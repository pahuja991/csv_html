<?php

main::start("sales.csv");

class main {

    static public function start($filename) {
        $records =csv::getRecords($filename); // reads csv file
        $table = html::generateTable($records); // display table
        system::displayTable($table);
    }
}

class csv {

    static public function getRecords($filename) {

        $file = fopen($filename,  "r");
        $fieldNames = array();
        $records = array();
        $count = 0;
        while(!feof($file)) {
            $record = fgetcsv($file);

            if($count == 0) {
                $fieldNames = $record;
            }
            else {
                $records[] = recordFactory::create($fieldNames, $record);
            }
            $count++;
        }
        fclose($file);
        return $records;
    }
}

class recordFactory {

    public static  function  create(Array $fieldNames = null, Array $values = null) {
        $record = new record($fieldNames, $values);
        return $record;
    }
}