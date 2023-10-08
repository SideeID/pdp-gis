<?php

namespace Database\Seeders;

use App\Models\Parameter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Parameter::create([
            "plant_id" => 1,
            "ph_a" => 5.5,
            "ph_b" => 7,
            "suhu_a" => 17.2,
            "suhu_b" => 22,
            "hujan_a" => 0,
            "hujan_b" => 200,
            "tinggi_a" => 600,
            "tinggi_b" => 1500,
            "ph_kelas" => 3,
            "suhu_kelas" => 3,
            "hujan_kelas" => 2,
            "tinggi_kelas" => 2,
        ]);

        Parameter::create([
            "plant_id" => 2,
            "ph_a" => 6,
            "ph_b" => 6.5,
            "suhu_a" => 23,
            "suhu_b" => 26.3,
            "hujan_a" => 100,
            "hujan_b" => 200,
            "tinggi_a" => 0,
            "tinggi_b" => 500,
            "ph_kelas" => 3,
            "suhu_kelas" => 4,
            "hujan_kelas" => 2,
            "tinggi_kelas" => 1,
        ]);

        Parameter::create([
            "plant_id" => 3,
            "ph_a" => 6.8,
            "ph_b" => 7.5,
            "suhu_a" => 23,
            "suhu_b" => 26.3,
            "hujan_a" => 85,
            "hujan_b" => 200,
            "tinggi_a" => 0,
            "tinggi_b" => 600,
            "ph_kelas" => 4,
            "suhu_kelas" => 4,
            "hujan_kelas" => 2,
            "tinggi_kelas" => 1,
        ]);
    }
}
