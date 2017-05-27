<?php

return [
    /**
     * NUMBERS
     */
    'per_page' => 20,
    'per_page_students' => 500,
    'account_max_length' => 7,
    /**
     * VALIDATORS
     */
    'length_category_name_min' => 10,
    'length_category_name_max' => 150,
    /**
     * STATUS
     */
    'status' => [
        'new' => 11,
        'deleted' => 22,
        'confirmed' => 33,
    ],
    'status_str' => [
        11 => 'Chưa xác nhận',
        22 => 'Đã xóa',
        33 => 'Đã xác nhận'
    ],
    'status_category_lable' =>[
        'available' => 99,
        'blocked' => 77,
    ],
    'status_category' => [
        99  => 'Sẵn sàng',
        77  => 'Đã khóa'
    ],
    /**
     * SAVE TO TABLE
     * STATUS
     */
    'save_to_table' => 'school_students',
    /**
     * FIELDS
     */
    'fields' => [
        'student_first_name' => 2,
        'student_last_name' => 3,
        'student_sex' => 4,
        'student_birth_day' => 5,
        'student_birth_month' => 6,
        'student_birth_year' => 7,
        'student_birth_place' => 8,
        'school_code' => 9,
        'school_district_code' => 10,
        'student_class' => 11,
        'student_capacity_6' => 12,
        'student_conduct_6' => 13,
        'student_capacity_7' => 14,
        'student_conduct_7' => 15,
        'student_capacity_8' => 16,
        'student_conduct_8' => 17,
        'student_capacity_9' => 18,
        'student_conduct_9' => 19,
        'student_average' => 20,
        'student_average_1' => 21,
        'student_average_2' => 22,
        'student_graduate' => 23,
        'student_score_prior' => 24,
        'student_score_prior_comment' => 25,
        'student_nominate' => 26,
        'school_code_option' => 27,
        'school_class_code' => 28,
        'school_code_option_1' => 29,
        'school_code_option_2' => 30,
        'student_email' => 31,
        'student_phone' => 32
    ],

    'columns' => [
        'stt_id' => 'A',
        'student_first_name' => 'B',
        'student_last_name' => 'C',
        'student_sex' => 'D',
        'student_birth_day' => 'E',
        'student_birth_month' => 'F',
        'student_birth_year' => 'G',
        'student_birth_place' => 'H',
        'school_code' => 'I',
        'school_district_code' => 'J',
        'student_class' => 'K',
        'student_capacity_6' => 'L',
        'student_conduct_6' => 'M',
        'student_capacity_7' => 'N',
        'student_conduct_7' => 'O',
        'student_capacity_8' => 'P',
        'student_conduct_8' => 'Q',
        'student_capacity_9' => 'R',
        'student_conduct_9' => 'S',
        'student_average' => 'T',
        'student_average_1' => 'U',
        'student_average_2' => 'V',
        'student_graduate' => 'W',
        'student_score_prior' => 'X',
        'student_score_prior_comment' => 'Y',
        'student_nominate' => 'Z',
        'school_code_option' => 'AA',
        'school_class_code' => 'AB',
        'school_code_option_1' => 'AC',
        'school_code_option_2' => 'AD',
        'student_email' => 'AE',
        'student_phone' => 'AF',
    ],
    'write_from' => 10,
    
    
    /**
     * SAVE TO THONG KE
     * STATUS
     */
    'save_to_table_school' => 'school_students',
    /**
     * FIELDS
     */
    'field_schools' => [
        'school_code' => 2,
        'school_name' => 3,
        'countstudent' => 4,
        
    ],

    'column_schools' => [
        'stt_id' => 'A',
        'school_code' => 'B',
        'school_name' => 'C',
        'countstudent' => 'D',
       
    ],
    'write_from_school' => 5,
    
    
    /**
     * FIELDS
     */
    'field_option_schools' => [
        'school_code' => 2,
        'school_name' => 3,
        'school_index_1' => 4,        
        'school_option_1' => 5,
        'school_option_2' => 6,
        
    ],

    'column_option_schools' => [
        'stt_id' => 'A',
        'school_code' => 'B',
        'school_name' => 'C',
        'school_index_1' => 'D',       
        'school_option_1' => 'E',
        'school_option_2' => 'F',
       
    ],
    'write_from__option_school' => 6,
    
    
    
    /**
     * FIELDS
     */
    'field_student_users' => [
        'student_first_name' => 2,
        'student_last_name' => 3,
        'student_sex' => 4,
        'student_birth_day' => 4,
        'student_birth_month' => 5,
        'student_birth_year' => 6,    
        'student_class' => 7,
        'student_user' => 8,
        'student_pass' => 9
        
    ],

    'column_student_users' => [
       'stt_id' => 'A',
        'student_first_name' => 'B',
        'student_last_name' => 'C',
        'student_sex' => 'D',
        'student_birth_day' => 'E',
        'student_birth_month' => 'F',
        'student_birth_year' => 'G',
        'student_class' => 'H',
        'student_user' => 'I',
        'student_pass' => 'J',
       
    ],
    'write_from_student_users' => 8,
];