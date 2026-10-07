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
            if (!Schema::hasColumn('users', 'course')) {
                $table->string('course')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'year_level')) {
                $table->string('year_level')->nullable()->after('course');
            }
            if (!Schema::hasColumn('users', 'section')) {
                $table->string('section')->nullable()->after('year_level');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columnsToDrop = [];

            if (Schema::hasColumn('users', 'course')) {
                $columnsToDrop[] = 'course';
            }
            if (Schema::hasColumn('users', 'year_level')) {
                $columnsToDrop[] = 'year_level';
            }
            if (Schema::hasColumn('users', 'section')) {
                $columnsToDrop[] = 'section';
            }

            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};