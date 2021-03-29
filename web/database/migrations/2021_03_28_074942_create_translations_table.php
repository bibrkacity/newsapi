<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('translatable_id')->nullable(false);
            $table->string('translatable_type',70)->nullable(false);

            $table->unsignedBigInteger('language_id')->nullable(false);
            $table->foreign('language_id')->references('id')->on('languages');

            $table->text('title');
            $table->text('description')->nullable(true);
            $table->text('content')->nullable(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translations');
    }
}
