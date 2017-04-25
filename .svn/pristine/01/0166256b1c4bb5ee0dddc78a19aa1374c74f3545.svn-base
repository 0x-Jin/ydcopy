<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminGoodsPrincipalsTable extends Migration
{

    protected $table = 'admin_goods_principals';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists($this->table);

        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->string('bn', 20)->default('')->unique();
            $table->string('name', 20)->default('');
            $table->string('principal', 20)->default('');
            $table->integer('created_at')->unsigned();
            $table->integer('updated_at')->unsigned();
            $table->string('extra', 255)->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop($this->table);
    }
}
