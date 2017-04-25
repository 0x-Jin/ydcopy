<?php

namespace App\Models\Admin\Goods;

use Illuminate\Database\Eloquent\Model;

class Principal extends Model {

    protected $table = 'admin_goods_principals';
    protected $dateFormat = 'U';
    protected $fillable = ['bn', 'name', 'principal', 'extra'];

}
