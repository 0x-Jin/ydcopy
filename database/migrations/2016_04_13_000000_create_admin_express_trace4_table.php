<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminExpressTrace4Table extends Migration
{

    protected $table = 'admin_express_trace4';

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
            $table->string('ExpressNumber', 32)->default('');
            $table->string('AcceptStation', 255)->default('');
            $table->integer('AcceptTime')->default(0)->unsigned();
            $table->integer('created_at')->default(0)->unsigned();
            $table->integer('updated_at')->default(0)->unsigned();
            $table->index(['ExpressNumber', 'AcceptTime']);
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
