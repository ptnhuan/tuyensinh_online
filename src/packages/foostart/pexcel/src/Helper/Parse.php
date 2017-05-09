<?php

namespace Foostart\Pexcel\Helper;

class Parse {

    public function isValidFile($file_path) {

        $flag = TRUE;
        return $flag;
    }

    public function get_students($pexcel) {
        $students = array();

        $excel = \App::make('excel');

        $file_path = realpath(base_path('public/' . $pexcel->pexcel_file_path));

        $data = \Excel::selectSheetsByIndex(0)->load($file_path, function($reader) {
                    // Getting all results
                    $reader->noHeading();
                     
                    $reader->formatDates(false);
                }, 'UTF-8')->get();
        $results = $data->toArray();

        $students = $this->parseExcel($pexcel, $results);

        return $students;
    }

    private function parseExcel($pexcel, $filedata) {

        $data = array();

        $fields = config('pexcel.fields');

        for ($index = $pexcel->pexcel_fromrow; $index < $pexcel->pexcel_torow; $index++) {

            $value = $filedata[$index];


            $data[] = $this->mapData($fields, $value);
        }
        return $data;
    }

    private function mapData($fields, $value) {
        $data = array();

        foreach ($fields as $key => $index) {

            $data[$key] = NULL;
            if (isset($value[$index - 1])) {

                $data[$key] = $value[$index-1];

            }
        }
        return $data;
    }
}
