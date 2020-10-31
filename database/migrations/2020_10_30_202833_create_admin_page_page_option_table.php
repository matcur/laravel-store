<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminPagePageOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_page_page_option', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_page_id');
            $table->foreign('admin_page_id')
                ->on('admin_pages')
                ->references('id');
            $table->unsignedBigInteger('admin_page_option_id');
            $table->foreign('admin_page_option_id')
                ->on('admin_page_options')
                ->references('id');
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
        Schema::dropIfExists('admin_page_page_option');
    }
}
