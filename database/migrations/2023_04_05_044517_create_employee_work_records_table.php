<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee_work_records', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('employee_id');
            $table->timestamp('started_work_at');
            $table->timestamp('finished_work_at')->nullable();

            $table->foreign('employee_id')->references('id')->on('employees');
            $table->index(['employee_id']);
            $table->index(['started_work_at']);
            $table->index(['finished_work_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_work_records', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
            $table->dropIndex(['employee_id']);
            $table->dropIndex(['started_work_at']);
            $table->dropIndex(['finished_work_at']);
        });
        Schema::dropIfExists('employee_work_records');
    }
};
