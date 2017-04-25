<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysVisitorsTable extends Migration
{
    protected $table = 'sys_visitors';

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
            $table->string('host', 20)->default('');
            $table->string('ip', 16)->default('');
            $table->string('uri', 20)->default('');
            $table->string('get_query', 1024)->default('');
            $table->string('method', 20)->default('');
            $table->string('status', '3')->default('');
            $table->text('post_query')->default('');
            $table->integer('created_at')->default(0)->unsigned();
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
