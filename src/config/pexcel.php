<?php

return [
    /**
     * NUMBERS
     */
    'per_page' => 20,
    'per_page_students' => 50,
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
];
