<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'shipping_name',
        'customer_id',
        'shipping_address',
        'shipping_phone',
        'shipping_email'
    ];
    protected $primaryKey = 'shipping_id';
    protected $table = 'tbl_shipping';
}
