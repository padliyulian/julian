<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('skills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('skill_id');
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->date('startdate');
            $table->date('enddate');
            $table->timestamps();
        });

        // dummy data
        DB::table('profiles')->insert([
            ['name' => 'admin', 'created_at' => now()],
            ['name' => 'board', 'created_at' => now()],
            ['name' => 'expert', 'created_at' => now()],
            ['name' => 'trainer', 'created_at' => now()],
            ['name' => 'competitior', 'created_at' => now()],
        ]);

        DB::table('skills')->insert([
            ['name' => 'skill as admin', 'created_at' => now()],
            ['name' => 'skill as board', 'created_at' => now()],
            ['name' => 'skill as expert', 'created_at' => now()],
            ['name' => 'skill as trainer', 'created_at' => now()],
            ['name' => 'skill as competitior', 'created_at' => now()],
        ]);

        DB::table('activities')->insert([
            ['skill_id' => 1, 'title' => 'activity 1', 'description' => 'description activity 1', 'startdate' => now(), 'enddate' => now(), 'created_at' => now()],
            ['skill_id' => 2, 'title' => 'activity 2', 'description' => 'description activity 2', 'startdate' => now(), 'enddate' => now(), 'created_at' => now()],
            ['skill_id' => 3, 'title' => 'activity 3', 'description' => 'description activity 3', 'startdate' => now(), 'enddate' => now(), 'created_at' => now()],
            ['skill_id' => 4, 'title' => 'activity 4', 'description' => 'description activity 4', 'startdate' => now(), 'enddate' => now(), 'created_at' => now()],
            ['skill_id' => 5, 'title' => 'activity 5', 'description' => 'description activity 5', 'startdate' => now(), 'enddate' => now(), 'created_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities', 'skills', 'profiles');
    }
}
