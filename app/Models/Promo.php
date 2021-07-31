<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'promo_name',
        'promo_image',
        'product_status'
    ];
    protected $primaryKey = 'promo_id';
    protected $table = 'tbl_promo';
}
