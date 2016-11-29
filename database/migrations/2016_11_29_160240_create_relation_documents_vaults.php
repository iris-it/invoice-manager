<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateRelationDocumentsVaults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('documents', function ($table) {
            $table->integer('vault_id')->unsigned()->nullable()->default(3)->index();
            $table->foreign('vault_id')->references('id')->on('vaults')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documents', function ($table) {
            $table->dropForeign('documents_vault_id_foreign');
            $table->dropColumn('vault_id');
        });
    }
}
