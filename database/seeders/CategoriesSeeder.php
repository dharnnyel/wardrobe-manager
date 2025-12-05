<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $samples = [
            ['name'=> 'Tops','slug'=> 'tops','icon'=> ''],
            ['name'=> 'Shirts','slug'=> 'shirts','icon'=> ''],
            ['name'=> 'Trousers','slug'=> 'trousers','icon'=> ''],
            ['name'=> 'Footwear','slug'=> 'footwear','icon'=> ''],
            ['name'=> 'Accessories','slug'=> 'accessories','icon'=> ''],
            ['name'=> 'Caps','slug'=> 'cap','icon'=> ''],
            ['name'=> 'Head gears','slug'=> 'head-gears','icon'=> ''],
            
        ];
        foreach($samples as $sample){
            Category::updateOrCreate(
                ['slug'=> $sample['slug']],
                ['name'=> $sample['name'],'icon'=> $sample['icon']]);
        }
    }
}
