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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('branch_id');
            $table->date('date');

            // Entry
            $table->time('entry_time');
            $table->string('entry_location');
            $table->string('entry_photo')->nullable();
            $table->enum('entry_status', ['on_time', 'late']);
            $table->integer('late_minutes')->nullable();
            $table->text('late_reason')->nullable();

            // Exit
            $table->time('exit_time')->nullable();
            $table->string('exit_location')->nullable();
            $table->string('exit_photo')->nullable();
            $table->enum('exit_status', ['on_time', 'early_leave'])->nullable();
            $table->integer('early_leave_minutes')->nullable();
            $table->text('early_leave_reason')->nullable();

            $table->enum('status', ['valid', 'invalid', 'pending'])->default('pending');
            $table->unsignedBigInteger('verified_by')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('verified_by')->references('id')->on('employees')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
