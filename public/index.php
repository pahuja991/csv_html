<?php

main::start("sales.csv");

class main {

    static public function start($filename) {
        $records =csv::getRecords($filename); // reads csv file
        $table = html::generateTable($records); // display table
        system::displayTable($table);
    }
}