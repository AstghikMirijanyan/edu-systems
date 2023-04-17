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
       Schema::create('tags_videos', function (Blueprint $table) {
                       $table->id();
                       $table->timestamps();
                       $table->foreignId('tags_id')->constrained();
                       $table->foreignId('videos_id')->constrained();

                   });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_tags');
    }
};
