<?php

use App\Models\User;
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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignId('category_id')->constrained();
            $table->string('title');
            $table->string('genre');
            $table->string('duration');
            $table->string('year_of_release');
            $table->string('rating');
            $table->string('thumbnail')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
