<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCarpentersTableColumnImg2 extends Migration
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
            $table->longText('img')->default(NULL)->change();
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
            $table->text('img')->change();

        });
    }
}
