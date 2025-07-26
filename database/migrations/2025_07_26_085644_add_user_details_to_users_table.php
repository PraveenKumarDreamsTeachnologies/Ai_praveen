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
            $table->string('gender')->nullable()->after('password');
            $table->string('age')->nullable()->after('gender');
            $table->string('phone')->nullable()->after('age');
            $table->string('address')->nullable()->after('phone');
            $table->string('height')->nullable()->after('address');
            $table->string('weight')->nullable()->after('height');
            $table->text('medical_history')->nullable()->after('weight');
            $table->text('current_medications')->nullable()->after('medical_history');
            $table->text('allergies')->nullable()->after('current_medications');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'gender',
                'age',
                'phone',
                'address',
                'height',
                'weight',
                'medical_history',
                'current_medications',
                'allergies'
            ]);
        });
    }
};