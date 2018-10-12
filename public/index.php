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

class record {

    public function __construct(Array $fieldNames =null, $values = null) {
        if (count($fieldNames) == count($values)) {
            $record = array_combine($fieldNames,$values);
            foreach ($record as $property => $value) {
                $this->createProperty($property,$value);
            }
        }
    }

    public function createProperty($name, $value) {
        $this->{$name} = $value;
    }

    public function returnArray() {
        $array = (array) $this;
        return $array;
    }
}
