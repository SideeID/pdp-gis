<?php

namespace Database\Seeders;

use App\Models\Perhitungan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerhitunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            array(
                "id" => "1",
                "parameter_id" => "3",
                "afdeling_id" => "3",
                "ph" => "6.8",
                "suhu_a" => "11.1",
                "suhu_b" => "17.1",
                "hujan" => "371.17",
                "tinggi" => "428",
                "ph_kelas" => "4",
                "suhu_kelas" => "2",
                "hujan_kelas" => "2",
                "tinggi_kelas" => "1",
                "created_at" => "2023-10-08 05:17:55",
                "updated_at" => "2023-10-08 12:46:28"
            ),
            array(
                "id" => "2",
                "parameter_id" => "3",
                "afdeling_id" => "4",
                "ph" => "6.8",
                "suhu_a" => "11.1",
                "suhu_b" => "17.1",
                "hujan" => "371.17",
                "tinggi" => "399",
                "ph_kelas" => "4",
                "suhu_kelas" => "2",
                "hujan_kelas" => "2",
                "tinggi_kelas" => "1",
                "created_at" => "2023-10-08 05:18:50",
                "updated_at" => "2023-10-08 12:47:51"
            ),
            array(
                "id" => "3",
                "parameter_id" => "1",
                "afdeling_id" => "6",
                "ph" => "6.8",
                "suhu_a" => "11.1",
                "suhu_b" => "17.1",
                "hujan" => "371.17",
                "tinggi" => "351",
                "ph_kelas" => "4",
                "suhu_kelas" => "2",
                "hujan_kelas" => "2",
                "tinggi_kelas" => "1",
                "created_at" => "2023-10-08 05:21:02",
                "updated_at" => "2023-10-08 12:43:45"
            ),
            array(
                "id" => "4",
                "parameter_id" => "1",
                "afdeling_id" => "7",
                "ph" => "6.4",
                "suhu_a" => "11.1",
                "suhu_b" => "17.1",
                "hujan" => "294.59",
                "tinggi" => "644",
                "ph_kelas" => "3",
                "suhu_kelas" => "2",
                "hujan_kelas" => "2",
                "tinggi_kelas" => "2",
                "created_at" => "2023-10-08 05:23:33",
                "updated_at" => "2023-10-08 12:43:41"
            ),
            array(
                "id" => "5",
                "parameter_id" => "1",
                "afdeling_id" => "8",
                "ph" => "6.4",
                "suhu_a" => "11.1",
                "suhu_b" => "17.1",
                "hujan" => "294.59",
                "tinggi" => "838",
                "ph_kelas" => "3",
                "suhu_kelas" => "2",
                "hujan_kelas" => "2",
                "tinggi_kelas" => "2",
                "created_at" => "2023-10-08 05:24:49",
                "updated_at" => "2023-10-08 12:43:37"
            ),
            array(
                "id" => "6",
                "parameter_id" => "1",
                "afdeling_id" => "9",
                "ph" => "6.4",
                "suhu_a" => "11.1",
                "suhu_b" => "17.1",
                "hujan" => "294.59",
                "tinggi" => "587",
                "ph_kelas" => "3",
                "suhu_kelas" => "2",
                "hujan_kelas" => "2",
                "tinggi_kelas" => "1",
                "created_at" => "2023-10-08 05:26:56",
                "updated_at" => "2023-10-08 12:43:32"
            )
        ];

        foreach ($data as $key => $value) {
            Perhitungan::create($value);
        }
    }
}
