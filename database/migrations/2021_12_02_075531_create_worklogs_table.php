<?php

use App\Constants\DbTables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorklogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(DbTables::WORKLOGS, function (Blueprint $table) {
            $table->id();
            $table->string('title', 80);
            $table->tinyText('description')->nullable();
            $table->foreignId('user_id')
                ->constrained(DbTables::USERS)
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
        Schema::dropIfExists(DbTables::WORKLOGS);
    }
}
