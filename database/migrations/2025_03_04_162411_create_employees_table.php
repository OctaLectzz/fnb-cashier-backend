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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('avatar');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('position');
            $table->string('pin');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('schedule_id');

            // Personal Data
            $table->string('ktp')->nullable();
            $table->string('ktp_image')->nullable();
            $table->date('dob')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('domicile')->nullable();
            $table->text('address')->nullable();
            $table->enum('employment_status', ['permanent', 'contract', 'freelance']);
            $table->date('date_joined');
            $table->date('end_date')->nullable();

            // BPJS Information
            $table->string('bpjs_tk_number')->nullable();
            $table->string('bpjs_tk_card')->nullable();
            $table->string('bpjs_health_number')->nullable();
            $table->string('bpjs_health_card')->nullable();

            // Bank Information
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('account_holder_name')->nullable();

            $table->boolean('status')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('branch_id')->references('id')->on('branches')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('schedule_id')->references('id')->on('schedules')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
