<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('albums')) {
            Schema::table('albums', function (Blueprint $table) {
                if (Schema::hasColumn('albums', 'description')) {
                    $table->dropColumn('description');
                }

                if (! Schema::hasColumn('albums', 'photos')) {
                    $table->json('photos')->nullable()->after('is_active');
                }
            });
        }

        Schema::dropIfExists('album_photos');
    }

    public function down(): void
    {
        if (Schema::hasTable('albums')) {
            Schema::table('albums', function (Blueprint $table) {
                if (! Schema::hasColumn('albums', 'description')) {
                    $table->text('description')->nullable()->after('title');
                }

                if (Schema::hasColumn('albums', 'photos')) {
                    $table->dropColumn('photos');
                }
            });
        }

        if (! Schema::hasTable('album_photos')) {
            Schema::create('album_photos', function (Blueprint $table) {
                $table->id();
                $table->foreignId('album_id')->constrained()->cascadeOnDelete();
                $table->string('image_path');
                $table->string('caption')->nullable();
                $table->unsignedInteger('sort_order')->default(1);
                $table->timestamps();

                $table->index(['album_id', 'sort_order']);
            });
        }
    }
};
