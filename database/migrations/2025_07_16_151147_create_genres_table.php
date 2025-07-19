<?php

// database/migrations/2024_06_10_000002_create_genres_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateGenresTable extends Migration
{
 public function up()
 {
 Schema::create('genres', function (Blueprint $table) {
 $table->id();
 $table->string('name');
 $table->timestamps();
 });
 }
 public function down()
 {
 Schema::dropIfExists('genres');
 }
}
