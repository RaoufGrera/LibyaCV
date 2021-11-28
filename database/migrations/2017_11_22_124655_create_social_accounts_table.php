<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_accounts', function (Blueprint $table) {
            $table->unsignedInteger('seeker_seeker_id');
            $table->string('provider');
            $table->string('provider_seeker_id');
            $table->timestamps();

            $table->unique(["seeker_seeker_id","provider"]);
            $table->foreign("seeker_seeker_id")->references("seeker_id")
                ->on("seekers")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_accounts');
    }
}
