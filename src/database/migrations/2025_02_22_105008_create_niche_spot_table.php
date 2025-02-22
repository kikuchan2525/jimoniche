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
        Schema::create('niche_spot', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string('name');
            $table->double('latitude');
            $table->double('longitude');
            $table->string('address');
            $table->bigInteger('view_count');
            $table->text('comment');
            $table->foreignId('user_id')->constrained('user')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('niche_spot');
    }
};
