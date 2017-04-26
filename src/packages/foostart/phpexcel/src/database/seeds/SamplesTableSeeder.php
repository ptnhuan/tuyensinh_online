<?php

use Illuminate\Database\Seeder;

class phpexcelsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        //Create example data
        for ($i = 0; $i < 50; $i++) {
            DB::table('phpexcels')->insert([
                'phpexcel_name' => str_random(10)
            ]);
        }
    }

}
