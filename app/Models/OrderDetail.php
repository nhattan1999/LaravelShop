<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_price',
        'product_quantity'
    ];
    protected $primaryKey = 'order_detail_id';
    protected $table = 'tbl_order_detail';
    public function product(){
   		return $this->belongsTo('App\Models\Product','product_id');
 	  }
}
