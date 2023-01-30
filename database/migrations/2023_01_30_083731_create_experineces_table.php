<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experineces', function (Blueprint $table) {
            $table->uuid("id");
            $table->primary("id");
            $table->uuid("team_id");
            $table->foreign("team_id")->references("id")->on("teams")->onDelete("cascade")->onUpdate("cascade");
            $table->string("name");
            $table->integer("precent");
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
        Schema::dropIfExists('experineces');
    }
};
