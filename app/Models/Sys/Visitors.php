<?php

namespace App\Models\Sys;

use Illuminate\Database\Eloquent\Model;

class Visitors extends Model {

    const UPDATED_AT = null;
    protected $table = 'sys_visitors';
    protected $dateFormat = 'U';
    protected $fillable = ['ip', 'host', 'uri', 'get_query', 'post_query', 'method', 'status'];
}
