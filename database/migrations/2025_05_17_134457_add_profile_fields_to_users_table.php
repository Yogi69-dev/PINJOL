<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('job')->nullable();
            $table->integer('income')->nullable();
            $table->string('ktp')->nullable();
            $table->string('salary_slip')->nullable();
            $table->string('selfie_ktp')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['job', 'income', 'ktp', 'salary_slip', 'selfie_ktp']);
        });
    }
};
