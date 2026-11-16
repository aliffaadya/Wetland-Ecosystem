<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluation_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('evaluation_key');
            $table->string('evaluation_name');
            $table->unsignedTinyInteger('score');
            $table->unsignedSmallInteger('correct_answers');
            $table->unsignedSmallInteger('total_questions');
            $table->timestamp('completed_at');
            $table->timestamps();
            $table->index(['user_id', 'completed_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluation_results');
    }
};
