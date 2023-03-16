<?php

use Illuminate\Database\Seeder;
use App\Printer;

class PrinterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Printer::create([
            'name'=>'Epson TM-T20II',
        ]);
    }
}
