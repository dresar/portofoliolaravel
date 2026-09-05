<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->text('short_description')->nullable()->after('description');
            $table->json('technologies')->nullable()->after('category'); // Array of technologies used
            $table->string('client_name')->nullable()->after('url');
            $table->date('project_date')->nullable()->after('client_name');
            $table->text('challenges')->nullable()->after('short_description');
            $table->text('solution')->nullable()->after('challenges');
            $table->string('github_url')->nullable()->after('url');
            $table->string('demo_url')->nullable()->after('github_url');
            $table->integer('views_count')->default(0)->after('is_featured');
            $table->boolean('is_active')->default(true)->after('is_featured');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'short_description',
                'technologies',
                'client_name',
                'project_date',
                'challenges',
                'solution',
                'github_url',
                'demo_url',
                'views_count',
                'is_active',
            ]);
        });
    }
};
