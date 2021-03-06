<?php

main::start("Myfile.csv");

class main {

    static public function start($filename) {
        $records =csv::getRecords($filename); // reads csv file
        $table = html1::generateTable($records); // display table
        sys::printTable($table);
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

    public static  function  create($fieldNames = null, $values = null) {
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


class Html {

    public static function open_tag() {
        return '<html>';
    }
}

class CloseHtml {

    public static function close_tag() {
        return '</html>';
    }
}

class create_header {

    public static function openHead() {
        $boot = '<head>';
        $boot .= '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">';
        $boot .= '<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>';
        $boot .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>';
        $boot .= '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>';
        return $boot;
    }
}

class close_header {

    public static function closeHead() {
        return '</head>';
    }
}

class Body1 {

    public static function open_body() {
        return '<body>';
    }
}

class Body2 {

    public static function close_body() {
        return '</body>';
    }
}

class Table_create {

    public static function create_table() {
        return '<table class="table table-bordered table-striped">';
    }
}


class Table_close {

    public static function close_table() {
        return '</table>';
    }
}


class Row_create {

    public static function Tr1() {
        return '<tr>';
    }
}

class Row_close {

    public static function Tr2() {
        return '</tr>';
    }
}

class create_header1 {

    public static function displayData($value, $tag) {
        return '<'.$tag.'>'. $value . '<'.'/'.$tag.'>';
    }
}






class Display {
        public static function display_util($head, $parameter) {
            $display = '';
            foreach ($head as $value) {
                switch ($parameter) {
                    case 0:
                        $display .= table_header::display_header($value);
                        break;

                    case 1:
                        $display .= table_column::display_column($value);
                        break;
                }
            }
            return $display;
        }
}

class table_header {


    public static function display_header($header) {
        return '<th>' .$header. '</th>';
    }
}

class table_column {


    public static function display_column($column) {
        return '<td>' .$column. '</td>';
    }
}


class html1 {

    public static function generateTable($records) {
        $count =0;

        $print = Html::open_tag();
        $print .= create_header::openHead();
        $print .= Body1::open_body();
        $print .= Table_create::create_table();

        foreach ($records as $record) {

            $array = $record->returnArray();
            $header = array_keys($array); // header
            $column = array_values($array); // column

            while($count == 0) {
                $print .= Row_create::Tr1();
                $print .= Display::display_util($header, 0);
                $print .= Row_close::Tr2();
                $count++;
            }

            $print .= Row_create::Tr1();
            $print .= Display::display_util($column, 1);
            $print .= Row_close::Tr2();

        }

        $print .= Table_close::close_table();
        $print .= Body2::close_body();
        $print .= close_header::closeHead();
        $print .= CloseHtml::close_tag();
        return $print;
    }
}

class Sys {

    public static function printTable($value) {
        echo $value;
    }
}



