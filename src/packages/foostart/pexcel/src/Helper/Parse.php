<?php

namespace Foostart\Pexcel\Helper;

class Parse {

    public function isValidFile($file_path) {

        $flag = TRUE;
        return $flag;
    }

    /**
     * Read file excel
     * Read first sheet
     * @param type $pexcel
     * @return type
     */
    public function read_data($pexcel) {
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

    /**
     * Parse data from excel with list of column in configs
     * @param type $pexcel
     * @param type $filedata
     * @return type
     */
    private function parseExcel($pexcel, $filedata) {

        $data = array();

        $fields = config('pexcel.fields');

        for ($index = $pexcel->pexcel_fromrow; $index < $pexcel->pexcel_torow; $index++) {

            $value = $filedata[$index];


            $data[] = $this->mapData($fields, $value, $pexcel);
        }
        return $data;
    }

    /**
     * Map data excel with configs
     * @param type $fields
     * @param type $value
     * @param type $pexcel
     * @return type
     */
    private function mapData($fields, $value, $pexcel) {
        $data = array(
            'pexcel_id' => $pexcel->pexcel_id,
            'category_name' => $pexcel->pexcel_category_name,
        );

        foreach ($fields as $key => $index) {

            $data[$key] = NULL;
            if (isset($value[$index - 1])) {

                $data[$key] = $value[$index - 1];
            }
        }
        return $data;
    }

    public function export_data($data, $file_name) {
        \Excel::create($file_name .'_' . date('d-m-Y', time()), function($excel) use($data) {

            $excel->sheet('pexels', function($sheet) use($data) {

                $sheet->appendRow(array(
                        'Pexcel ID',
                        'Pexcel name',
                        'Created at',
                        'File path'
                ));
                foreach ($data as $item) {
                    $sheet->appendRow(array(
                        $item->pexcel_id,
                        $item->pexcel_name,
                        date('d-m-Y', $item->pexcel_created_at),
                        $item->pexcel_file_path
                    ));
                }
            });
        })->download('xlsx');
    }
}
