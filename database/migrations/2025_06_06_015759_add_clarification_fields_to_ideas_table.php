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
        Schema::table('ideas', function (Blueprint $table) {
            //
            $table->text('problem')->nullable();
            $table->text('audience')->nullable();
            $table->text('possible_solution')->nullable();
            $table->boolean('is_ready')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ideas', function (Blueprint $table) {
            //
            $table->dropColumn(['problem', 'audience', 'possible_solution', 'is_ready']);
        });
    }
};
