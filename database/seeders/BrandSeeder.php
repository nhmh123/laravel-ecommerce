<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'Apple', 'slug' => 'apple'],
            ['name' => 'Samsung', 'slug' => 'samsung'],
            ['name' => 'Sony', 'slug' => 'sony'],
            ['name' => 'LG', 'slug' => 'lg'],
            ['name' => 'Philips', 'slug' => 'philips'],
            ['name' => 'Panasonic', 'slug' => 'panasonic'],
            ['name' => 'Dell', 'slug' => 'dell'],
            ['name' => 'HP', 'slug' => 'hp'],
            ['name' => 'Lenovo', 'slug' => 'lenovo'],
            ['name' => 'Asus', 'slug' => 'asus'],
            ['name' => 'Acer', 'slug' => 'acer'],
            ['name' => 'MSI', 'slug' => 'msi'],
            ['name' => 'Xiaomi', 'slug' => 'xiaomi'],
            ['name' => 'Huawei', 'slug' => 'huawei'],
            ['name' => 'Bosch', 'slug' => 'bosch'],
            ['name' => 'Siemens', 'slug' => 'siemens'],
            ['name' => 'Electrolux', 'slug' => 'electrolux'],
            ['name' => 'Whirlpool', 'slug' => 'whirlpool'],
            ['name' => 'GE Appliances', 'slug' => 'ge-appliances'],
            ['name' => 'Toshiba', 'slug' => 'toshiba'],
            ['name' => 'Sharp', 'slug' => 'sharp'],
            ['name' => 'Canon', 'slug' => 'canon'],
            ['name' => 'Nikon', 'slug' => 'nikon'],
            ['name' => 'Microsoft', 'slug' => 'microsoft'],
            ['name' => 'Intel', 'slug' => 'intel'],
            ['name' => 'AMD', 'slug' => 'amd'],
            ['name' => 'Nvidia', 'slug' => 'nvidia'],
            ['name' => 'Google', 'slug' => 'google'],
            ['name' => 'Amazon', 'slug' => 'amazon'],
            ['name' => 'OnePlus', 'slug' => 'oneplus'],
            ['name' => 'Oppo', 'slug' => 'oppo'],
            ['name' => 'Vivo', 'slug' => 'vivo'],
            ['name' => 'Realme', 'slug' => 'realme'],
            ['name' => 'Motorola', 'slug' => 'motorola'],
            ['name' => 'JBL', 'slug' => 'jbl'],
            ['name' => 'Bose', 'slug' => 'bose'],
            ['name' => 'Yamaha', 'slug' => 'yamaha'],
            ['name' => 'Kenwood', 'slug' => 'kenwood'],
            ['name' => 'Midea', 'slug' => 'midea'],
            ['name' => 'Haier', 'slug' => 'haier'],
            ['name' => 'Hisense', 'slug' => 'hisense'],
            ['name' => 'TCL', 'slug' => 'tcl'],
            ['name' => 'Hitachi', 'slug' => 'hitachi'],
            ['name' => 'Epson', 'slug' => 'epson'],
            ['name' => 'Brother', 'slug' => 'brother'],
            ['name' => 'Logitech', 'slug' => 'logitech'],
            ['name' => 'Razer', 'slug' => 'razer'],
            ['name' => 'Corsair', 'slug' => 'corsair'],
            ['name' => 'VinFast', 'slug' => 'vinfast'],
            ['name' => 'Lumi', 'slug' => 'lumi'],
            ['name' => 'Rang Dong', 'slug' => 'rang-dong'],
            ['name' => 'Dien Quang', 'slug' => 'dien-quang'],
            ['name' => 'Sunhouse', 'slug' => 'sunhouse'],
            ['name' => 'Kangaroo', 'slug' => 'kangaroo'],
            ['name' => 'Casper', 'slug' => 'casper'],
            ['name' => 'Karofi', 'slug' => 'karofi'],
            ['name' => 'Dreame', 'slug' => 'dreame'],
            ['name' => 'Roborock', 'slug' => 'roborock'],
            ['name' => 'Bear', 'slug' => 'bear'],
            ['name' => 'Baseus', 'slug' => 'baseus'],
            ['name' => 'Anker', 'slug' => 'anker'],
            ['name' => 'Tesla', 'slug' => 'tesla'],
            ['name' => 'Dyson', 'slug' => 'dyson'],
            ['name' => 'KitchenAid', 'slug' => 'kitchenaid'],
            ['name' => 'Sonos', 'slug' => 'sonos'],
            ['name' => 'SharkNinja', 'slug' => 'sharkninja'],
            ['name' => 'Miele', 'slug' => 'miele'],
            ['name' => 'Mitsubishi Electric', 'slug' => 'mitsubishi-electric'],
            ['name' => 'Google Nest', 'slug' => 'google-nest'],
            ['name' => 'Ring', 'slug' => 'ring'],
            ['name' => 'Echo', 'slug' => 'echo'],
        ];

        foreach ($brands as $brandData) {
            Brand::create($brandData);
        }

        // Additional factories for more data
        Brand::factory(10)->create();
    }
}
