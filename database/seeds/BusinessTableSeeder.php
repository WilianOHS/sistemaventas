<?php

use Illuminate\Database\Seeder;
use App\Business;

class BusinessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Business::create([
            'name'=>'Nombre de la empresa',
            'description'=>'Descripcion de la empresa',
            'logo'=>'logo.png',
            'mail'=>'Ejemplo@gmail.com',
            'address'=>'Direccion de la empresa',
            'nit'=>'11111111111111',
            'number'=>'0000-0000',
            'business_sector'=>'Giro',
            'message'=>'Mensaje',
        ]);
    }
}
