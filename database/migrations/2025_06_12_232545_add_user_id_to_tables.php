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
        // Add user_id to ideas table
        Schema::table('ideas', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->after('id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
        });

        // Add user_id to projects table
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->after('id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
        });

        // Add user_id to tasks table
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->after('id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
        });

        // Add user_id to tags table
        Schema::table('tags', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->after('id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ideas', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
