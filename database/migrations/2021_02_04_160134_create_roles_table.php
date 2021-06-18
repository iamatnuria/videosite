<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('rol', 55);
        });


        DB::table('roles')->insert(
            array(
                'rol' => 'admin'
            )
        );

        DB::table('roles')->insert(
            array(
                'rol' => 'user'
            )
        );

        DB::table('roles')->insert(
            array(
                'rol' => 'editor'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
