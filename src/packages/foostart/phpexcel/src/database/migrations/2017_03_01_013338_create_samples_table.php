<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatephpexcelsTable extends Migration {

    private $_table = NULL;
    private $fileds = NULL;

    public function __construct() {
        $this->_table = 'phpexcels';
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        /**
         * Existing table
         */
        if (!Schema::hasTable($this->_table)) {
            Schema::create($this->_table, function (Blueprint $table) {
                $table->increments('phpexcel_id');
                $table->string('phpexcel_name');
            });
        }

        /**
         * Existing fields
         */
        //phpexcel_id
        if (!Schema::hasColumn($this->_table, 'phpexcel_id')) {
            Schema::table($this->_table, function (Blueprint $table) {
                $table->increments('phpexcel_id');
            });
        }
        //phpexcel_name
        if (!Schema::hasColumn($this->_table, 'phpexcel_name')) {
            Schema::table($this->_table, function (Blueprint $table) {
                $table->string('phpexcel_name', 255);
            });
        }
        //category_id
        if (!Schema::hasColumn($this->_table, 'category_id')) {
            Schema::table($this->_table, function (Blueprint $table) {
                $table->integer('category_id');
            });
        }

        //phpexcel_image
        if (!Schema::hasColumn($this->_table, 'phpexcel_image')) {
            Schema::table($this->_table, function (Blueprint $table) {
                $table->string('phpexcel_image', 255);
            });
        }
        //status_id
        if (!Schema::hasColumn($this->_table, 'status_id')) {
            Schema::table($this->_table, function (Blueprint $table) {
                $table->integer('status_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('phpexcels');
    }

}
