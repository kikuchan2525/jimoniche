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
        Schema::create('niche_spot_image', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId('niche_spot_id')->constrained('niche_spot')->onDelete('cascade');
            $table->string('image_path');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('niche_spot_image');
    }
};
