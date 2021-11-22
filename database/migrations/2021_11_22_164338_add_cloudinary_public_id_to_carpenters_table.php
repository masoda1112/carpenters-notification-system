<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCloudinaryPublicIdToCarpentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carpenters', function (Blueprint $table) {
            //
            $table->text('cloudinary_public_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carpenters', function (Blueprint $table) {
            //
            $table->dropColumn('cloudinary_public_id');
        });
    }
}
