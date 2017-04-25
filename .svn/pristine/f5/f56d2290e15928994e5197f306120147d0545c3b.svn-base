<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminOrderDecisionTable extends Migration
{

    protected $table = 'admin_order_decision';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists($this->table);

        Schema::create($this->table, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_id', '32')->unique();
            $table->text('order_main');
            $table->text('order_detail');
            $table->text('order_goods_info');
            $table->tinyInteger('status')->unsigned()->default(0);
            $table->string('modifey', '32')->default('');
            $table->unsignedInteger('created_at');
            $table->unsignedInteger('updated_at');
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
