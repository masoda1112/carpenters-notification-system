<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnCarpentersColumn extends Migration
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
            $table->dropColumn('gender');
            $table->dropColumn('birthday');
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
            $table->string('gender')->default(false);
            $table->date('birthday')->default(false);
        });
    }
}
