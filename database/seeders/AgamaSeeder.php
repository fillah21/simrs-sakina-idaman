<?php

namespace Database\Seeders;

use App\Models\Agama;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agama = ['ISLAM', 'KRISTEN', 'KATOLIK', 'HINDU', 'BUDDHA', 'KONGHUCU'];

        foreach($agama as $a) {
            Agama::create([
                'agama' => $a
            ]);
        }

        // Agama::create([
        //     ['agama' => 'ISLAM'],
        //     ['agama' => 'KRISTEN'],
        //     ['agama' => 'KATOLIK'],
        //     ['agama' => 'HINDU'],
        //     ['agama' => 'BUDDHA'],
        //     ['agama' => 'KONGHUCU'],
        // ]);

        echo "Agama Seeder Selesai \n";
    }
}
