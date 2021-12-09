<?php

use App\Constants\DbTables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(DbTables::USER_IMAGES, function (Blueprint $table) {
            $table->id();
            $table->string('file_path');
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnDelete();
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
        Schema::dropIfExists(DbTables::USER_IMAGES);
    }
}
