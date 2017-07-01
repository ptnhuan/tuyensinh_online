<?php

namespace Foostart\Pexcel\Helper;

use Foostart\Pnd\Models\Students;
use Foostart\Pnd\Models\Schools;
use Foostart\Pnd\Models\SchoolTests;
use Foostart\Pnd\Models\PexcelCategories;
use Foostart\Pnd\Models\Districts;
use Foostart\Pnd\Models\Specialists;
use Foostart\Pnd\Models\Examines;

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
    private $obj_students = NULL;
    private $obj_schoolTests = NULL;
    private $obj_schools = NULL;
    private $obj_categories = NULL;
    private $obj_districts = null;
    private $obj_specialists = null;
    private $obj_examines = NULL;

    public function __construct() {


        $this->obj_students = new Students();
        $this->obj_schoolTests = new SchoolTests();
        $this->obj_schools = new Schools();
        $this->obj_categories = new PexcelCategories();
        $this->obj_districts = new Districts();
        $this->obj_specialists = new Specialists();
        $this->obj_examines = new Examines();
    }

    public function read_data($pexcel) {
        $students = array();

        $excel = \App::make('excel');

        $file_path = realpath(base_path('public/' . $pexcel->pexcel_file_path));

        $data = \Excel::selectSheetsByIndex(0)->load($file_path, function ($reader) {
                    // Getting all results
                    $reader->noHeading();

                    $reader->formatDates(false);
                }, 'UTF-8')->get();
        $results = $data->toArray();

        $students = $this->parseExcel($pexcel, $results);

        return $students;
    }

    public function read_data_update($pexcel) {
        $students = array();

        $excel = \App::make('excel');

        $file_path = realpath(base_path('public/' . $pexcel->pexcel_file_path));

        $data = \Excel::selectSheetsByIndex(0)->load($file_path, function ($reader) {
                    // Getting all results
                    $reader->noHeading();

                    $reader->formatDates(false);
                }, 'UTF-8')->get();
        $results = $data->toArray();

        $students = $this->parseExcel_update($pexcel, $results);

        return $students;
    }

    private function parseExcel($pexcel, $filedata) {
        $data = array();

        $fields = config('pexcel.fields');

        for ($index = $pexcel->pexcel_fromrow - 1; $index < $pexcel->pexcel_torow; $index++) {

            $value = $filedata[$index];


            $data[] = $this->mapData($fields, $value, $pexcel);
        }
        return $data;
    }

    private function parseExcel_update($pexcel, $filedata) {
        $data = array();

        $fields = config('pexcel.field_updates');

        for ($index = $pexcel->pexcel_fromrow - 1; $index < $pexcel->pexcel_torow; $index++) {

            $value = $filedata[$index];


            $data[] = $this->mapData_update($fields, $value, $pexcel);
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

    private function mapData_update($fields, $value, $pexcel) {
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
        \Excel::create($file_name . '_' . date('d-m-Y', time()), function ($excel) use ($data) {

            $excel->sheet('pexels', function ($sheet) use ($data) {

                $sheet->appendRow(array(
                    'Pexcel ID',
                    'Pexcel ID',
                    'Pexcel ID',
                    'Pexcel ID',
                    'Pexcel name',
                    'Created at',
                    'File path'
                ));
                foreach ($data as $item) {
                    $sheet->appendRow(array(
                        $item->pexcel_id,
                        $item->pexcel_id,
                        $item->pexcel_id,
                        $item->pexcel_id,
                        $item->pexcel_name,
                        date('d-m-Y', $item->pexcel_created_at),
                        $item->pexcel_file_path
                    ));
                }
            });
        })->download('xls');
    }

    public function export_data_students($data, $schoolname) {


        $temp = realpath(base_path('public/templates/MAUNHAPHOCSINH.xls'));

        $columns = config('pexcel.columns');

        $fromrow = config('pexcel.write_from');

        \Excel::load($temp, function ($excel) use ($data, $schoolname, $columns, $fromrow) {

            $fields = array_keys($columns);

            $sheet = $excel->setActiveSheetIndex(0);

            $sheet->setCellValue("A2", mb_strtoupper($schoolname));

            foreach ($data as $item) {

                foreach ($item->toArray() as $key => $value) {

                    $sheet->setCellValue("A" . $fromrow, $fromrow - 9);

                    if (in_array($key, $fields)) {

                        $cell = $columns[$key] . $fromrow;

                        $sheet->setCellValue($cell, $value);
                    }
                }
                $fromrow++;
            }
        })->setFilename('DANHSACHHOCSINH')->download('xls');
    }

    public function export_data_student_user_pass($data, $schoolname) {


        $temp = realpath(base_path('public/templates/MAUMATKHAU.xls'));

        $columns = config('pexcel.column_student_users');

        $fromrow = config('pexcel.write_from_student_users');

        \Excel::load($temp, function ($excel) use ($data, $schoolname, $columns, $fromrow) {

            $fields = array_keys($columns);

            $sheet = $excel->setActiveSheetIndex(0);

            $sheet->setCellValue("A2", mb_strtoupper($schoolname));

            foreach ($data as $item) {

                foreach ($item->toArray() as $key => $value) {

                    $sheet->setCellValue("A" . $fromrow, $fromrow - 8);

                    if (in_array($key, $fields)) {

                        $cell = $columns[$key] . $fromrow;

                        $sheet->setCellValue($cell, $value);
                    }
                }
                $fromrow++;
            }
        })->setFilename('MATKHAU')->download('xls');
    }

    public function export_data_school_students($data) {


        $temp = realpath(base_path('public/templates/MAUTHONGKE_CAP2.xls'));

        $columns = config('pexcel.column_schools');

        $fromrow = config('pexcel.write_from_school');

        \Excel::load($temp, function ($excel) use ($data, $columns, $fromrow) {

            $fields = array_keys($columns);

            $sheet = $excel->setActiveSheetIndex(0);


            foreach ($data as $item) {

                foreach ($item as $key => $value) {

                    $sheet->setCellValue("A" . $fromrow, $fromrow - 4);

                    if (in_array($key, $fields)) {

                        $cell = $columns[$key] . $fromrow;

                        $sheet->setCellValue($cell, $value);
                    }
                }
                $fromrow++;
            }
        })->setFilename('THONGKECAP2')->download('xls');
    }

    public function export_data_school_option_dieuchinh_students($data, $schoolname) {



        $temp = realpath(base_path('public/templates/MAUNHAPHOCSINHDIEUCHINH.xls'));

        $columns = config('pexcel.column_dcs');

        $fromrow = config('pexcel.write_dc_from');

        \Excel::load($temp, function ($excel) use ($data, $schoolname, $columns, $fromrow) {

            $fields = array_keys($columns);

            $sheet = $excel->setActiveSheetIndex(0);

            $sheet->setCellValue("A2", mb_strtoupper($schoolname));

            foreach ($data as $item) {

                foreach ($item->toArray() as $key => $value) {

                    $sheet->setCellValue("A" . $fromrow, $fromrow - 9);

                    if (in_array($key, $fields)) {

                        $cell = $columns[$key] . $fromrow;

                        $sheet->setCellValue($cell, $value);
                    }
                }
                $fromrow++;
            }
        })->setFilename('DANHSACHHOCSINH_DIEUCHINH')->download('xls');
    }

    public function export_data_school_option_students($data) {


        $temp = realpath(base_path('public/templates/MAUTHONGKE_CAP3.xls'));

        $columns = config('pexcel.column_option_schools');

        $fromrow = config('pexcel.write_from__option_school');

        \Excel::load($temp, function ($excel) use ($data, $columns, $fromrow) {

            $fields = array_keys($columns);

            $sheet = $excel->setActiveSheetIndex(0);


            foreach ($data as $item) {

                foreach ($item as $key => $value) {

                    $sheet->setCellValue("A" . $fromrow, $fromrow - 5);

                    if (in_array($key, $fields)) {

                        $cell = $columns[$key] . $fromrow;

                        $sheet->setCellValue($cell, $value);
                    }
                }
                $fromrow++;
            }
        })->setFilename('THONGKECAP3')->download('xls');
    }

    public function export_data_room_students($data, $schoolname, $schooltitle, $school_code, $school_test_code, $phongthi) {


        $temp = realpath(base_path('public/templates/MAUNIEMYET.xls'));

        $columns = config('pexcel.column_niemyets');

        $fromrow = config('pexcel.write_niemyet');

        \Excel::load($temp, function ($excel) use ($data, $schoolname, $schooltitle, $school_code, $school_test_code, $phongthi, $columns, $fromrow) {


            $fields = array_keys($columns);

            $sheet = $excel->setActiveSheetIndex(0);

            $sheet->setCellValue("A2", mb_strtoupper($schoolname));
            $sheet->setCellValue("I1", mb_strtoupper($phongthi));
            $sheet->setCellValue("I2", mb_strtoupper($schooltitle));
            $sheet->setCellValue("C3", $this->obj_categories->get_pexcels_categories_action()->pexcel_category_ngaythi);
            $sheet->setCellValue("A1", mb_strtoupper($this->obj_categories->get_pexcels_categories_action()->pexcel_category_kythi));


            foreach ($data as $item) {

                foreach ($item->toArray() as $key => $value) {

                    $sheet->setCellValue("A" . $fromrow, $fromrow - 6);

                    if (in_array($key, $fields)) {

                        $cell = $columns[$key] . $fromrow;

                        if ($columns[$key] == 'E') {

                            $sheet->setCellValue($cell, $this->obj_students->get_student_id($value)->student_birth_day . '/' . $this->obj_students->get_student_id($value)->student_birth_month . '/' . $this->obj_students->get_student_id($value)->student_birth_year);
                        } else {
                            if ($columns[$key] == 'H') {
                                $sheet->setCellValue($cell, $this->obj_schools->pluck_school_name_code($value)->school_name);
                            } else {

                                $sheet->setCellValue($cell, $value);
                            }
                        }
                    }
                }
                $fromrow++;
            }

            $sheet->setCellValue("D32", $fromrow - 7);
            $sheet->setCellValue("C39", mb_strtoupper($this->obj_schoolTests->get_school_test_by_school_code($school_code, $school_test_code)->school_test_thuky));

            $sheet->setCellValue("H39", mb_strtoupper($this->obj_schoolTests->get_school_test_by_school_code($school_code, $school_test_code)->school_test_chutich));
        })->setFilename('NIEMYET_PHONG_' . $phongthi)->download('xls');
    }
    public function export_data_room_chuyen_students($data, $schoolname, $schooltitle, $school_code, $school_test_code, $phongthi) {


        $temp = realpath(base_path('public/templates/MAUNIEMYETCHUYEN.xls'));

        $columns = config('pexcel.column_niemyetsc');

        $fromrow = config('pexcel.write_niemyetc');

        \Excel::load($temp, function ($excel) use ($data, $schoolname, $schooltitle, $school_code, $school_test_code, $phongthi, $columns, $fromrow) {


            $fields = array_keys($columns);

            $sheet = $excel->setActiveSheetIndex(0);

            $sheet->setCellValue("A2", mb_strtoupper($schoolname));
            $sheet->setCellValue("I1", mb_strtoupper($phongthi));
            $sheet->setCellValue("I2", mb_strtoupper($schooltitle));
            $sheet->setCellValue("C3", $this->obj_categories->get_pexcels_categories_action()->pexcel_category_ngaythi);
            $sheet->setCellValue("A1", mb_strtoupper($this->obj_categories->get_pexcels_categories_action()->pexcel_category_kythi));


            foreach ($data as $item) {

                foreach ($item->toArray() as $key => $value) {

                    $sheet->setCellValue("A" . $fromrow, $fromrow - 6);

                    if (in_array($key, $fields)) {

                        $cell = $columns[$key] . $fromrow;

                        if ($columns[$key] == 'E') {
       $sheet->setCellValue("E3", "MÔN CHUYÊN ".$this->obj_specialists->get_mon_specialists($this->obj_students->get_student_id($value)->school_class_code));

                            $sheet->setCellValue($cell, $this->obj_students->get_student_id($value)->student_birth_day . '/' . $this->obj_students->get_student_id($value)->student_birth_month . '/' . $this->obj_students->get_student_id($value)->student_birth_year);
                        } else {
                            if ($columns[$key] == 'H') {
                                $sheet->setCellValue($cell, $this->obj_schools->pluck_school_name_code($value)->school_name);
                            } else {

                                if ($columns[$key] == 'J') {
                                    $sheet->setCellValue($cell, @$this->obj_schools->pluck_school_name_code($value)->school_name);
                                } else {

                                    $sheet->setCellValue($cell, $value);
                                }
                            }
                        }
                    }
                }
                $fromrow++;
            }

            $sheet->setCellValue("D32", $fromrow - 7);
            $sheet->setCellValue("C39", mb_strtoupper($this->obj_schoolTests->get_school_test_by_school_code($school_code, $school_test_code)->school_test_thuky));

            $sheet->setCellValue("H39", mb_strtoupper($this->obj_schoolTests->get_school_test_by_school_code($school_code, $school_test_code)->school_test_chutich));
        })->setFilename('NIEMYET_PHONG_' . $phongthi)->download('xls');
    }

    public function export_data_room_ghiten_students($data, $schoolname, $schooltitle, $school_code, $school_test_code, $phongthi) {


        $temp = realpath(base_path('public/templates/MAUGHITENDUTHI.xls'));

        $columns = config('pexcel.column_ghitens');

        $fromrow = config('pexcel.write_ghiten');

        \Excel::load($temp, function ($excel) use ($data, $schoolname, $schooltitle, $school_code, $school_test_code, $phongthi, $columns, $fromrow) {


            $fields = array_keys($columns);

            $sheet = $excel->setActiveSheetIndex(0);

            $sheet->setCellValue("A2", mb_strtoupper($schoolname));
            $sheet->setCellValue("J1", "PHÒNG THI SỐ : " . mb_strtoupper($phongthi));
            $sheet->setCellValue("J2", "HỘI ĐỒNG COI THI : " . mb_strtoupper($schooltitle));
            $sheet->setCellValue("C3", $this->obj_categories->get_pexcels_categories_action()->pexcel_category_ngaythi);
            $sheet->setCellValue("A1", mb_strtoupper($this->obj_categories->get_pexcels_categories_action()->pexcel_category_kythi));


            foreach ($data as $item) {

                foreach ($item->toArray() as $key => $value) {

                    $sheet->setCellValue("A" . $fromrow, $fromrow - 7);

                    if (in_array($key, $fields)) {

                        $cell = $columns[$key] . $fromrow;

                        if ($columns[$key] == 'H') {

                            $sheet->setCellValue($cell, $this->obj_students->get_student_id($value)->student_birth_day . '/' . $this->obj_students->get_student_id($value)->student_birth_month . '/' . $this->obj_students->get_student_id($value)->student_birth_year);
                        } else {
                            if ($columns[$key] == 'J') {
                                $sheet->setCellValue($cell, $this->obj_schools->pluck_school_name_code($value)->school_name);
                            } else {

                                $sheet->setCellValue($cell, $value);
                            }
                        }
                    }
                }
                $fromrow++;
            }

            $sheet->setCellValue("D33", $fromrow - 8);
            $sheet->setCellValue("B42", mb_strtoupper($this->obj_schoolTests->get_school_test_by_school_code($school_code, $school_test_code)->school_test_thuky));

            $sheet->setCellValue("I42", mb_strtoupper($this->obj_schoolTests->get_school_test_by_school_code($school_code, $school_test_code)->school_test_chutich));
        })->setFilename('BANGGHITENDUTHI_PHONG_' . $phongthi)->download('xls');
    }
    public function export_data_room_ghiten_chuyen_students($data, $schoolname, $schooltitle, $school_code, $school_test_code, $phongthi) {


        $temp = realpath(base_path('public/templates/MAUGHITENDUTHICHUYEN.xls'));

        $columns = config('pexcel.column_ghitensc');

        $fromrow = config('pexcel.write_ghitenc');

        \Excel::load($temp, function ($excel) use ($data, $schoolname, $schooltitle, $school_code, $school_test_code, $phongthi, $columns, $fromrow) {


            $fields = array_keys($columns);

            $sheet = $excel->setActiveSheetIndex(0);

            $sheet->setCellValue("A2", mb_strtoupper($schoolname));
            $sheet->setCellValue("J1", "PHÒNG THI SỐ : " . mb_strtoupper($phongthi));
            $sheet->setCellValue("J2", "HỘI ĐỒNG COI THI : " . mb_strtoupper($schooltitle));
            $sheet->setCellValue("C3", $this->obj_categories->get_pexcels_categories_action()->pexcel_category_ngaythi);
            $sheet->setCellValue("A1", mb_strtoupper($this->obj_categories->get_pexcels_categories_action()->pexcel_category_kythi));
          
            foreach ($data as $item) {

                foreach ($item->toArray() as $key => $value) {

                    $sheet->setCellValue("A" . $fromrow, $fromrow - 7);

                    if (in_array($key, $fields)) {

                        $cell = $columns[$key] . $fromrow;

                        if ($columns[$key] == 'I') {
                            $sheet->setCellValue("G3", "MÔN CHUYÊN ".$this->obj_specialists->get_mon_specialists($this->obj_students->get_student_id($value)->school_class_code));

                            $sheet->setCellValue($cell, $this->obj_students->get_student_id($value)->student_birth_day . '/' . $this->obj_students->get_student_id($value)->student_birth_month . '/' . $this->obj_students->get_student_id($value)->student_birth_year);
                        } else {
                            if ($columns[$key] == 'K') {
                                $sheet->setCellValue($cell, $this->obj_schools->pluck_school_name_code($value)->school_name);
                            } else {

                                $sheet->setCellValue($cell, $value);
                            }
                        }
                    }
                }
                $fromrow++;
            }

            $sheet->setCellValue("D33", $fromrow - 8);
            $sheet->setCellValue("B42", mb_strtoupper($this->obj_schoolTests->get_school_test_by_school_code($school_code, $school_test_code)->school_test_thuky));

            $sheet->setCellValue("J42", mb_strtoupper($this->obj_schoolTests->get_school_test_by_school_code($school_code, $school_test_code)->school_test_chutich));
        })->setFilename('BANGGHITENDUTHI_PHONG_' . $phongthi)->download('xls');
    }

    public function export_data_room_thubai_students($data, $schoolname, $schooltitle, $school_code, $school_test_code, $phongthi) {


        $temp = realpath(base_path('public/templates/MAUPHIEUTHUBAITHI.xls'));

        $columns = config('pexcel.column_thubais');

        $fromrow = config('pexcel.write_thubai');

        \Excel::load($temp, function ($excel) use ($data, $schoolname, $schooltitle, $school_code, $school_test_code, $phongthi, $columns, $fromrow) {


            $fields = array_keys($columns);

            $sheet = $excel->setActiveSheetIndex(0);

            $sheet->setCellValue("A2", mb_strtoupper($schoolname));
            $sheet->setCellValue("A4", "PHÒNG THI SỐ : " . mb_strtoupper($phongthi));
            $sheet->setCellValue("A5", "HỘI ĐỒNG COI THI : " . mb_strtoupper($schooltitle));
            $sheet->setCellValue("A3", "KHÓA THI NGÀY:" . $this->obj_categories->get_pexcels_categories_action()->pexcel_category_ngaythi);
            $sheet->setCellValue("A1", mb_strtoupper($this->obj_categories->get_pexcels_categories_action()->pexcel_category_kythi));

            $sbdto = "";
            $sbdfrom = "";
            $sbdto = "";
            foreach ($data as $item) {

                foreach ($item->toArray() as $key => $value) {

                    $sheet->setCellValue("A" . $fromrow, $fromrow - 10);

                    if (in_array($key, $fields)) {

                        $cell = $columns[$key] . $fromrow;

                        if ($cell == 'B11') {
                            $sbdto = $value;
                        }

                        if ($columns[$key] == 'B') {
                            $sbdfrom = $value;
                        }

                        $sheet->setCellValue($cell, $value);
                    }
                }
                $fromrow++;
            }

            $sheet->setCellValue("D6", "(Từ số báo danh " . $sbdto . " đến số báo danh " . $sbdfrom . ")");
        })->setFilename('PHIEUTHUBAITHI_PHONG_' . $phongthi)->download('xls');
    }

    public function export_data_room_giaybaothi_students($data, $schoolname, $schooltitle, $school_code, $school_test_code, $phongthi) {


        $temp = realpath(base_path('public/templates/MAUGIAYBAOTHI.xls'));

        $columns = config('pexcel.column_thubais');

        $fromrow = config('pexcel.write_thubai');

        \Excel::load($temp, function ($excel) use ($data, $schoolname, $schooltitle, $school_code, $school_test_code, $phongthi, $columns, $fromrow) {


            $fields = array_keys($columns);

            $sheet = $excel->setActiveSheetIndex(0);


            // $sheet->setCellValue("A4", "PHÒNG THI SỐ : ".mb_strtoupper($phongthi));
            //$sheet->setCellValue("A5", "HỘI ĐỒNG COI THI : ".mb_strtoupper($schooltitle));
            //$sheet->setCellValue("A3","KHÓA THI NGÀY:".$this->obj_categories->get_pexcels_categories_action()->pexcel_category_ngaythi);

            $fromrow = 4;

            foreach ($data as $item) {

                $sheet->setCellValue("A" . ($fromrow), "SỞ GD&ĐT PHÚ YÊN");
                $sheet->setCellValue('A' . ($fromrow + 1), mb_strtoupper($schoolname));

                $sheet->setCellValue("F" . ($fromrow), "CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM");
                $sheet->setCellValue("G" . ($fromrow + 1), "Độc lập- Tự do- Hạnh phúc");
                $sheet->setCellValue("D" . ($fromrow + 3), "            GIẤY BÁO THI");
                $sheet->setCellValue("C" . ($fromrow + 5), "Báo cho thí sinh :");
                $sheet->setCellValue("D" . ($fromrow + 5), $item->student_first_name . ' ' . $item->student_last_name);

                $sheet->setCellValue("K" . ($fromrow + 5), "Giới tính :" . $item->student_sex);

                $sheet->setCellValue("C" . ($fromrow + 6), "Sinh Ngày:" . $item->student_birth_day . '/' . $item->student_birth_month . '/' . $item->student_birth_year);

                $sheet->setCellValue("H" . ($fromrow + 6), "Nơi Sinh: " . $item->student_birth_place);
                $sheet->setCellValue("C" . ($fromrow + 7), "Học sinh trường: " . $this->obj_schools->pluck_school_name_code($item->school_code)->school_name);
                $sheet->setCellValue("C" . ($fromrow + 8), "Đúng: " . $this->obj_categories->get_pexcels_categories_action()->pexcel_category_taptrung);
                $sheet->setCellValue("C" . ($fromrow + 9), "Có mặt tại:Trường " . $this->obj_schoolTests->get_school_test_by_school_code($school_code, $school_test_code)->school_test_name);
                $sheet->setCellValue("C" . ($fromrow + 10), "Địa chỉ: " . $this->obj_schoolTests->get_school_test_by_school_code($school_code, $school_test_code)->school_test_address);
                $sheet->setCellValue("A" . ($fromrow + 10), "ẢNH 3X4");
                $sheet->setCellValue("C" . ($fromrow + 11), "Để làm thủ tục tham dự kỳ thi:" . $this->obj_categories->get_pexcels_categories_action()->pexcel_category_kythi);
                $sheet->setCellValue("C" . ($fromrow + 12), "Khóa ngày: " . $this->obj_categories->get_pexcels_categories_action()->pexcel_category_ngaythi);
                $sheet->setCellValue("C" . ($fromrow + 13), "Phòng thi: " . $item->student_room);
                $sheet->setCellValue("E" . ($fromrow + 13), "Số báo danh: " . $item->student_identifi_name);


                $sheet->setCellValue("C" . ($fromrow + 14), "Nguyện vọng 1:" . $this->obj_schools->pluck_school_name_code($item->school_code_option_1)->school_name);
                if ($item->school_code_option_2 > 0) {

                    $sheet->setCellValue("C" . ($fromrow + 15), "Nguyện vọng 2:" . @$this->obj_schools->pluck_school_name_code($item->school_code_option_2)->school_name);
                }
                $sheet->setCellValue("A" . ($fromrow + 16), "Khi tham dự kỳ thi nhớ mang theo Giấy báo thi này.");
                $sheet->setCellValue("J" . ($fromrow + 17), $this->obj_categories->get_pexcels_categories_action()->pexcel_category_ngayky);
                $sheet->setCellValue("I" . ($fromrow + 18), "CHỦ TỊCH HỘI ĐỒNG TUYỂN SINH");
                
                if (($item->school_code_option==9900)or ($item->school_code_option==9900)){
                      $sheet->setCellValue("I" . ($fromrow + 22), mb_strtoupper($this->obj_schools->pluck_school_name_code($item->school_code_option)->school_contact_chutich));
                }
                else{
                      $sheet->setCellValue("I" . ($fromrow + 22), mb_strtoupper($this->obj_schools->pluck_school_name_code($item->school_code_option_1)->school_contact_chutich));
                    
                }
              
                
                
                $fromrow = $fromrow + 26;
            }
        })->setFilename('GIAYBAOTHI_PHONG_' . $phongthi)->download('xls');
    }

    public function export_data_hoidong_coithi($data, $schoolname, $school_code) {


        $temp = realpath(base_path('public/templates/MAUHOIDONGCOITHI.xls'));

        $columns = config('pexcel.column_thubais');

        $fromrow = config('pexcel.write_thubai');

        \Excel::load($temp, function ($excel) use ($data, $schoolname, $school_code) {




            $sheet = $excel->setActiveSheetIndex(0);


            $sheet->setCellValue("A1", mb_strtoupper($this->obj_categories->get_pexcels_categories_action()->pexcel_category_kythi));
            $sheet->setCellValue("A2", mb_strtoupper($schoolname));

            $sheet->setCellValue("A3", "KHÓA THI NGÀY:" . $this->obj_categories->get_pexcels_categories_action()->pexcel_category_ngaythi);


            $fromrow = 7;

            foreach ($data as $item) {

                $sheet->setCellValue("A" . ($fromrow), $fromrow - 6);
                $sheet->setCellValue('B' . ($fromrow), $this->obj_schoolTests->get_school_test_by_school_code($item->school_code, $item->school_code_test)->school_test_name);
                $sheet->setCellValue('C' . ($fromrow), $item->school_room);
                $sheet->setCellValue('D' . ($fromrow), $item->school_number_students);
                $sheet->setCellValue('E' . ($fromrow), $item->student_indentifi_to);
                $sheet->setCellValue('F' . ($fromrow), $item->student_indentifi_from);


                $fromrow = $fromrow + 1;
            }
        })->setFilename('THONGKEHOIDONGCOITHI')->download('xls');
    }

     public function export_data_hoidong_coithi_chuyen($data, $schoolname, $school_code) {


        $temp = realpath(base_path('public/templates/MAUHOIDONGCOITHICHUYEN.xls'));

        $columns = config('pexcel.column_thubais');

        $fromrow = config('pexcel.write_thubai');

        \Excel::load($temp, function ($excel) use ($data, $schoolname, $school_code) {




            $sheet = $excel->setActiveSheetIndex(0);


            $sheet->setCellValue("A1", mb_strtoupper($this->obj_categories->get_pexcels_categories_action()->pexcel_category_kythi));
            $sheet->setCellValue("A2", mb_strtoupper($schoolname));

            $sheet->setCellValue("A3", "KHÓA THI NGÀY:" . $this->obj_categories->get_pexcels_categories_action()->pexcel_category_ngaythi);


            $fromrow = 7;

            foreach ($data as $item) {

                $sheet->setCellValue("A" . ($fromrow), $fromrow - 6);
                $sheet->setCellValue('B' . ($fromrow), $this->obj_schoolTests->get_school_test_by_school_code($item->school_code, $item->school_code_test)->school_test_name);
                $sheet->setCellValue('C' . ($fromrow), $item->school_choose_specialist);
                $sheet->setCellValue('D' . ($fromrow), $item->school_room);
                $sheet->setCellValue('E' . ($fromrow), $item->school_number_students);
                $sheet->setCellValue('F' . ($fromrow), $item->student_indentifi_to);
                $sheet->setCellValue('G' . ($fromrow), $item->student_indentifi_from);
              


                $fromrow = $fromrow + 1;
            }
        })->setFilename('THONGKEHOIDONGCOITHI')->download('xls');
    }
    
    public function export_data_print_exame($data) {
      

        $temp = realpath(base_path('public/templates/MAUINDETHI.xls'));


        \Excel::load($temp, function ($excel) use ($data) {



            $sheet = $excel->setActiveSheetIndex(0);


            $sheet->setCellValue("A1", mb_strtoupper($this->obj_categories->get_pexcels_categories_action()->pexcel_category_kythi));

            $sheet->setCellValue("A2", "KHÓA THI NGÀY:" . $this->obj_categories->get_pexcels_categories_action()->pexcel_category_ngaythi);


            $fromrow = 7;

            foreach ($data as $item) {

                $sheet->setCellValue("A" . ($fromrow), $fromrow - 6);
                $sheet->setCellValue('B' . ($fromrow), $this->obj_schools->pluck_school_name_code($item->school_code)->school_name);
                $sheet->setCellValue('C' . ($fromrow), $item->school_test_name);
                $sheet->setCellValue('D' . ($fromrow), $item->school_number_room);
                $sheet->setCellValue('E' . ($fromrow), $item->school_number_room_to);
                $sheet->setCellValue('F' . ($fromrow), $item->school_number_room_from);
                $sheet->setCellValue('G' . ($fromrow), $this->obj_examines->min_room_number_student($item->school_code, $item->school_test_code)->min('school_number_students'));


                $fromrow = $fromrow + 1;
            }
            
           
        })->setFilename('SAOIN')->download('xls');
    }

    
    public function export_data_print_exame_chuyen($data, $schoolname, $school_code) {

 
       
        $temp = realpath(base_path('public/templates/MAUHOIDONGCOITHICHUYEN.xls'));

        $columns = config('pexcel.column_thubais');

        $fromrow = config('pexcel.write_thubai');

        \Excel::load($temp, function ($excel) use ($data, $schoolname, $school_code) {




            $sheet = $excel->setActiveSheetIndex(0);


            $sheet->setCellValue("A1", mb_strtoupper($this->obj_categories->get_pexcels_categories_action()->pexcel_category_kythi));
            $sheet->setCellValue("A2", mb_strtoupper($schoolname));

            $sheet->setCellValue("A3", "KHÓA THI NGÀY:" . $this->obj_categories->get_pexcels_categories_action()->pexcel_category_ngaythi);


            $fromrow = 7;

            foreach ($data as $item) {

                $sheet->setCellValue("A" . ($fromrow), $fromrow - 6);
                $sheet->setCellValue('B' . ($fromrow), $this->obj_schoolTests->get_school_test_by_school_code($item->school_code, $item->school_code_test)->school_test_name);
                $sheet->setCellValue('C' . ($fromrow), $item->school_choose_specialist);
                $sheet->setCellValue('D' . ($fromrow), $item->school_room);
                $sheet->setCellValue('E' . ($fromrow), $item->school_number_students);
                $sheet->setCellValue('F' . ($fromrow), $item->student_indentifi_to);
                $sheet->setCellValue('G' . ($fromrow), $item->student_indentifi_from);
              


                $fromrow = $fromrow + 1;
            }
        })->setFilename('THONGKEHOIDONGCOITHI')->download('xls');
    }

    
     public function export_data_hongdongcoithi($data) {


        $temp = realpath(base_path('public/templates/MAUHOIDONGTUYENSINHCOITHI.xls'));


        \Excel::load($temp, function ($excel) use ($data) {



            $sheet = $excel->setActiveSheetIndex(0);


            $sheet->setCellValue("A1", mb_strtoupper($this->obj_categories->get_pexcels_categories_action()->pexcel_category_kythi));

            $sheet->setCellValue("A2", "KHÓA THI NGÀY:" . $this->obj_categories->get_pexcels_categories_action()->pexcel_category_ngaythi);


            $fromrow = 7;

            foreach ($data as $item) {
                
                


                $sheet->setCellValue("A" . ($fromrow), $fromrow - 6);
                $sheet->setCellValue('B' . ($fromrow), $item->school_name);
                $sheet->setCellValue('C' . ($fromrow), $item->school_test_name);
                $sheet->setCellValue('D' . ($fromrow), $item->school_test_chutich);
                $sheet->setCellValue('E' . ($fromrow), $item->school_test_phone_chutich);
                $sheet->setCellValue('F' . ($fromrow), $item->school_test_email_chutich);
                $sheet->setCellValue('G' . ($fromrow), $item->school_test_thuky);
                $sheet->setCellValue('H' . ($fromrow), $item->school_test_phone_thuky);
                $sheet->setCellValue('I' . ($fromrow), $item->school_test_email_thuky);
                $sheet->setCellValue('J' . ($fromrow), $item->school_number_room_from);
                $sheet->setCellValue('K' . ($fromrow), $item->school_number_room_to);
                $sheet->setCellValue('L' . ($fromrow), $item->school_number_room_from);
               
                $fromrow = $fromrow + 1;
            }
        })->setFilename('HOIDONGCOITHI')->download('xls');
    }
     public function export_data_absent_students($data,$data1) {


        $temp = realpath(base_path('public/templates/MAUVANGTHI.xls'));


        \Excel::load($temp, function ($excel) use ($data,$data1) {



            $sheet = $excel->setActiveSheetIndex(0);


            $sheet->setCellValue("A1", mb_strtoupper($this->obj_categories->get_pexcels_categories_action()->pexcel_category_kythi));

            $sheet->setCellValue("A2", "KHÓA THI NGÀY:" . $this->obj_categories->get_pexcels_categories_action()->pexcel_category_ngaythi);
            $sheet->setCellValue("A3", "HỘI ĐỒNG:" .$data1);

            $fromrow = 8;

            foreach ($data as $item) {
                
                  $sheet->setCellValue("A" . ($fromrow), $fromrow - 7);
                $sheet->setCellValue('B' . ($fromrow), $item->student_identifi_name);
                $sheet->setCellValue('C' . ($fromrow), $item->school_room);
                $sheet->setCellValue('D' . ($fromrow), $item->student_first_name);
                $sheet->setCellValue('E' . ($fromrow), $item->student_last_name);
                $sheet->setCellValue('F' . ($fromrow), $item->	school_subject_name);
             
                $fromrow = $fromrow + 1;
            }
        })->setFilename('VANGTHI')->download('xls');
    }
     public function export_data_inde($data,$datac) {
   
$temp = realpath(base_path('public/templates/MAUINDETHI.xls'));


        \Excel::load($temp, function ($excel) use ($data,$datac) {



            $sheet = $excel->setActiveSheetIndex(0);


            $sheet->setCellValue("A1", mb_strtoupper($this->obj_categories->get_pexcels_categories_action()->pexcel_category_kythi));

            $sheet->setCellValue("A2", "KHÓA THI NGÀY:" . $this->obj_categories->get_pexcels_categories_action()->pexcel_category_ngaythi);


            $fromrow = 7;

            foreach ($data as $item) {
                
                
                $sheet->setCellValue("A" . ($fromrow), $fromrow - 6);
                $sheet->setCellValue('B' . ($fromrow),  $item->school_name);
                $sheet->setCellValue('C' . ($fromrow), $item->school_test_name);
                $sheet->setCellValue('D' . ($fromrow), $item->school_number_room);
                $sheet->setCellValue('E' . ($fromrow), $item->school_number_room_to);
                $sheet->setCellValue('F' . ($fromrow), $item->school_number_room_from);
                $sheet->setCellValue('G' . ($fromrow), $this->obj_examines->min_room_number_student($item->school_code, $item->school_test_code)->min('school_number_students'));
              
                $fromrow = $fromrow + 1;
            }
            
            
            
              $sheet = $excel->setActiveSheetIndex(1);


            $sheet->setCellValue("A1", mb_strtoupper($this->obj_categories->get_pexcels_categories_action()->pexcel_category_kythi));

            $sheet->setCellValue("A2", "KHÓA THI NGÀY:" . $this->obj_categories->get_pexcels_categories_action()->pexcel_category_ngaythi);


            $fromrow = 7;

            foreach ($datac as $item) {

                $sheet->setCellValue("A" . ($fromrow), $fromrow - 6);
                $sheet->setCellValue('B' . ($fromrow),$this->obj_schools->pluck_school_name_code($item->school_code)->school_name);
                $sheet->setCellValue('C' . ($fromrow), $this->obj_schoolTests->get_school_test_by_school_code($item->school_code, $item->school_code_test)->school_test_name);
                $sheet->setCellValue('D' . ($fromrow), $item->school_choose_specialist);
                $sheet->setCellValue('E' . ($fromrow), $item->school_room);
                $sheet->setCellValue('F' . ($fromrow), $item->student_indentifi_to);
                $sheet->setCellValue('G' . ($fromrow),$item->student_indentifi_from);
                $sheet->setCellValue('H' . ($fromrow),$item->school_number_students);


                $fromrow = $fromrow + 1;
            }
            
            
        })->setFilename('INDE')->download('xls');
    }
    
}
