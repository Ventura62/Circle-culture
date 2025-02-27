<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->integer('event_id')->nullable();
            $table->string('name')->nullable();
            $table->longText('users')->nullable();
            $table->string('activities')->nullable();
            $table->string('topics')->nullable();
            $table->string('meet_in')->nullable();
            $table->string('table_number')->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('restaurant_id')->nullable();
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
        Schema::dropIfExists('groups');
    }
}
