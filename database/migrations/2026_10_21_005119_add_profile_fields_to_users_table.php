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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'academic_rank')) {
                $table->string('academic_rank')->nullable();
            }
            if (!Schema::hasColumn('users', 'course')) {
                $table->string('course')->nullable();
            }
            if (!Schema::hasColumn('users', 'year_level')) {
                $table->string('year_level')->nullable();
            }
            if (!Schema::hasColumn('users', 'section')) {
                $table->string('section')->nullable();
            }
            if (!Schema::hasColumn('users', 'status')) {
                $table->string('status')->default('active')->nullable();
            }
            if (!Schema::hasColumn('users', 'google_id')) {
                $table->string('google_id')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'academic_rank', 
                'course', 
                'year_level', 
                'section', 
                'status', 
                'google_id'
            ]);
        });
    }
};