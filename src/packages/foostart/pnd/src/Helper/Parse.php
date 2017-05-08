<?php

namespace Foostart\Pnd\Helper;

class Parse {

    public function isValidFile($file_path) {

        $flag = TRUE;
        return $flag;
    }

    public function get_students($pnd) {
        $students = array();

        $excel = \App::make('excel');

        $file_path = realpath(base_path('public/' . $pnd->pnd_file_path));

        $data = \Excel::selectSheetsByIndex(0)->load($file_path, function($reader) {
                    // Getting all results
                    // Getting all results
                    $reader->noHeading();
                    $reader->formatDates(false);
                }, 'UTF-8')->get();
        $results = $data->toArray();

        $students = $this->parseExcel($pnd, $results);

        return $students;
    }

    private function parseExcel($pnd, $filedata) {

        $data = array();

        $fields = config('pnd.fields');

        for ($index = $pnd->pnd_fromrow; $index < $pnd->pnd_torow; $index++) {

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
