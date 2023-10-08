<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Afdeling;
use App\Models\User;

use App\Models\Criteria;
use App\Models\DetailCriteria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',

        // ]);

        // Add users
        $this->call(UsersTableSeeder::class);

        // Add plant
        $this->call(PlantSeeder::class);

        // Add parameter from plant
        $this->call(ParameterSeeder::class);

        // Add farm
        $this->call(FarmSeeder::class);

        // Add afdelings
        $this->call(AfdelingSeeder::class);

        // Add Block
        $this->call(BlockSeeder::class);

        // Add afdeling
        // $this->call(Afdeling::class);

        // Start here
        // Data criterias
        $criteria = ["Tinggi Tanah", "Curah Hujan", "Suhu", "pH Tanah"];

        $tinggi_description = ["Pesisir Pantai", "Kaki Gunung", "Perbukitan", "Pegunungan"];
        $tinggi_batas_a = [0, 601, 1501, 2501];
        $tinggi_batas_b = [600, 1500, 2500, 10000];
        $tinggi_kelas = [1, 2, 3, 4];

        Criteria::create([
            "id" => 1,
            "name" => $criteria[0]
        ]);

        // Data detail criterias, tinggi
        for ($k = 0; $k < count($tinggi_description); $k++) {
            DetailCriteria::create([
                "criteria_id" => 1,
                "description" => $tinggi_description[$k],
                "limit_a" => $tinggi_batas_a[$k],
                "limit_b" => $tinggi_batas_b[$k],
                "class" => $tinggi_kelas[$k]
            ]);
        }

        $hujan_description = ["Hujan Sangat Ringan", "Hujan Ringan", "Hujan Normal", "Hujan Deras", "Hujan Sangat Deras"];
        $hujan_batas_a = [0, 151, 601, 1501, 3001];
        $hujan_batas_b = [150, 600, 1500, 3000, 5000];
        $hujan_kelas = [1, 2, 3, 4, 5];

        Criteria::create([
            "id" => 2,
            "name" => $criteria[1]
        ]);

        // Data detail criterias, hujan
        for ($k = 0; $k < count($hujan_description); $k++) {
            DetailCriteria::create([
                "criteria_id" => 2,
                "description" => $hujan_description[$k],
                "limit_a" => $hujan_batas_a[$k],
                "limit_b" => $hujan_batas_b[$k],
                "class" => $hujan_kelas[$k]
            ]);
        }

        $suhu_description = ["Dingin", "Sejuk", "Sedang", "Tropis"];
        $suhu_batas_a = [6.2, 11.2, 17.2, 23];
        $suhu_batas_b = [11.1, 17.1, 22, 26.3];
        $suhu_kelas = [1, 2, 3, 4];

        Criteria::create([
            "id" => 3,
            "name" => $criteria[2]
        ]);

        // Data detail criterias, suhu
        for ($k = 0; $k < count($suhu_description); $k++) {
            DetailCriteria::create([
                "criteria_id" => 3,
                "description" => $suhu_description[$k],
                "limit_a" => $suhu_batas_a[$k],
                "limit_b" => $suhu_batas_b[$k],
                "class" => $suhu_kelas[$k]
            ]);
        }

        $ph_description = ["Sangat Masam", "Masam", "Agak Masam", "Netral", "Agak Alkalis", "Alkalis"];
        $ph_batas_a = [0, 4.6, 5.6, 6.6, 7.6, 8.6];
        $ph_batas_b = [4.5, 5.5, 6.5, 7.5, 8.5, 14];
        $ph_kelas = [1, 2, 3, 4, 5, 6];

        Criteria::create([
            "id" => 4,
            "name" => $criteria[3]
        ]);

        // Data detail criterias, ph
        for ($k = 0; $k < count($ph_description); $k++) {
            DetailCriteria::create([
                "criteria_id" => 4,
                "description" => $ph_description[$k],
                "limit_a" => $ph_batas_a[$k],
                "limit_b" => $ph_batas_b[$k],
                "class" => $ph_kelas[$k]
            ]);
        }

        // Add perhitungan
        $this->call(PerhitunganSeeder::class);
    }
}
