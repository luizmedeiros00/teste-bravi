<?php

namespace Database\Seeders;

use App\Models\ContactType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            'email',
            'telefone',
            'whatsapp'
        ];

        foreach($datas as $data){
            ContactType::firstOrCreate([
                'name'  => $data
            ]);
        }
    }
}
