<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      Admin::insert([
          'admin_name' => 'admin',
          'admin_email' => 'administrator@gmail.com',
          'admin_password' => md5('123456'),
          'admin_phone' => '0987654321'
      ]);
    }
}
