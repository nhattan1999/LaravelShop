<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class Imports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
          'category_id' => $row[0],
          'product_name' => $row[1],
          'product_desc' => $row[2],
          'product_content'  => $row[3],
          'product_price'  => $row[4],
          'product_image'  => $row[5],
          'product_status'  => $row[6]
        ]);
    }
}
