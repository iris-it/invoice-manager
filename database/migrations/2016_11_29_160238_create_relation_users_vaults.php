<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationUsersVaults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('vault_pivot', function (Blueprint $table) {

            $table->integer('user_id')->unsigned();
            $table->integer('vault_id')->unsigned();
            $table->boolean('is_valid')->false();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('vault_id')
                ->references('id')
                ->on('vaults')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->primary(['user_id', 'vault_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vault_pivot');
    }
}
