<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppendAdminMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
         DB::table('admin_menu')->insert([
                  [
                      'title' => 'Videos',
                      'uri' => 'videos',
                      'icon' => 'fa-video-camera',
                      'order' => 8,
                      'parent_id' => 2,
                  ],
                  [
                      'title' => 'Tags',
                      'uri' => 'tags',
                      'icon' => 'fa-tags',
                      'order' => 9,
                      'parent_id' => 2,
                  ]
              ]);
    }
}
