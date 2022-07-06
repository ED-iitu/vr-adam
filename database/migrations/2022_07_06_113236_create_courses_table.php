<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('short_description');
            $table->text('full_description');
            $table->integer('old_price');
            $table->integer('current_price');
            $table->boolean('is_cashback_available')->default(false);
            $table->integer('cashback_percent');
            $table->integer('author_id');
            $table->integer('category_id');
            $table->dateTime('start_date')->default(date('Y-m-d H:i:s'));
            $table->dateTime('end_date')->default(date('Y-m-d H:i:s'));
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
