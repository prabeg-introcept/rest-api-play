<?php

use App\Constants\DbTables;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(DbTables::FEEDBACKS, function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->foreignId('worklog_id')
                ->constrained(DbTables::WORKLOGS)
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
        Schema::dropIfExists(DbTables::FEEDBACKS);
    }
}
