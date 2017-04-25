<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminGoodsLimitTable extends Migration
{

    protected $table = 'admin_goods_limit';
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
            $table->string('category', 20)->default('');
            $table->string('kind', 1000)->default('');
            $table->string('remark', 1000)->default('');
            $table->integer('created_at')->unsigned();
            $table->integer('updated_at')->unsigned();
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
