<?php

namespace Database\Seeders;

use App\Models\Pendidikan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pendidikan = [
            'PRE SCHOOL',
            'SEKOLAH DASAR',
            'SEKOLAH LANJUTAN TINGKAT PERTAMA',
            'SEKOLAH LANJUTAN TINGKAT ATAS',
            'DIPLOMA III',
            'SARJANA S1/DIPLOMA IV',
            'SARJANA S2/MAGISTER',
            'SARJANA S3/DOKTOR',
            'LAINNYA',
        ];

        foreach($pendidikan as $data) {
            Pendidikan::create([
                'pendidikan' => $data
            ]);
        }

        echo "Pendidikan Seeder Selesai \n";
    }
}
