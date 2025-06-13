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
        Schema::table('tasks', function (Blueprint $table) {
            // Task scheduling fields
            $table->dateTime('due_date')->nullable();
            $table->integer('estimated_hours')->nullable();
            $table->integer('priority')->default(0); // 

            // Task organization fields
            $table->string('group')->nullable(); 
            $table->integer('order')->default(0); 
            $table->json('labels')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn([
                'due_date',
                'estimated_hours',
                'priority',
                'group',
                'order',
                'labels'
            ]);
        });
    }
};
