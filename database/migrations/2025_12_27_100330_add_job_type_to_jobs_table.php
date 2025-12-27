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
    Schema::table('jobs', function (Blueprint $table) {
        // Kita kasih default 'Full Time' agar data lama tidak error
        $table->string('job_type')->default('Full Time')->after('location');
    });
}

public function down(): void
{
    Schema::table('jobs', function (Blueprint $table) {
        $table->dropColumn('job_type');
    });
}
};
