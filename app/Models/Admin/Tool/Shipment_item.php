<?php
namespace App\Models\Admin\Tool;

use Illuminate\Database\Eloquent\Model;

class Shipment_item extends Model{
    
    protected $connection = 'sqlsrv';
    protected $table = 'DispatchProductOrderDetail';
    protected $primaryKey = 'DispatchProductOrderId';
    
    
    
}
 

