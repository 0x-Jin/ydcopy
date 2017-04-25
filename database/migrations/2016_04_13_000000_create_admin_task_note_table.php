<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTaskNoteTable extends Migration
{

    protected $table = 'admin_task_note';
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
            $table->string('title', 20)->default('')->index();
            $table->text('description', 20)->default('');
            $table->string('author', 20)->default('');
            $table->string('tags', 255)->default('');
            $table->integer('type')->default(0)->unsigned();
            $table->integer('visitor_num')->default(0)->unsigned();
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
