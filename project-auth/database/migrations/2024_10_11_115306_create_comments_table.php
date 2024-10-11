<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi dengan tabel users
            $table->foreignId('answer_id')->constrained()->onDelete('cascade'); // Relasi dengan tabel answers
            $table->text('body'); // Isi komentar
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }

};
