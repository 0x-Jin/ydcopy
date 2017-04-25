<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminGoodsStoreTable extends Migration
{

    protected $table = 'admin_goods_store';

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
            $table->string('WarehouseCode', 20)->default('');
            $table->string('ProductSkuCode', 20)->default('');
            $table->integer('Quantity')->default(0)->unsigned();
            $table->integer('LockedQuantity')->default(0)->unsigned();
            $table->integer('ModifyTime')->default(0)->unsigned();
            $table->integer('created_at')->unsigned();
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
