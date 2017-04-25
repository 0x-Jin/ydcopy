<?php

namespace App\Models\Admin\Task;

use Illuminate\Database\Eloquent\Model;


class Note extends Model {

    protected $table = 'admin_task_note';
    protected $dateFormat = 'U';
    protected $fillable = ['title', 'description', 'author', 'tags', 'type'];

    public static function create(array $attributes = []){
        $attributes['author'] = auth()->user()->code;
        return parent::create($attributes);
    }

}
