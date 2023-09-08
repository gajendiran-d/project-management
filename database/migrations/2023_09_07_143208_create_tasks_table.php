<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('creator_id');
            $table->foreign('creator_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('is_completed', ['0','1'])->default($value='0');
            $table->enum('status', ['0','1'])->default($value='1');
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
        Schema::dropIfExists('tasks');
    }
}
