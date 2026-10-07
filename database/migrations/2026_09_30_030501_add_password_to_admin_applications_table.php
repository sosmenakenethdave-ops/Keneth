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
        Schema::table('admin_applications', function (Blueprint $table) {
            // I-check muna kung WALA PA ang password column bago idagdag
            if (!Schema::hasColumn('admin_applications', 'password')) {
                $table->string('password')->after('email');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_applications', function (Blueprint $table) {
            if (Schema::hasColumn('admin_applications', 'password')) {
                $table->dropColumn('password');
            }
        });
    }
};