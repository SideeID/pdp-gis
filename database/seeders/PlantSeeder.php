<?php

namespace Database\Seeders;

use App\Models\Plants;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Plants::create([
            "id" => 1,
            "name" => "Padi",
            "description" => "Padi merupakan salah satu tanaman budidaya terpenting dalam peradaban.",
            "color" => "#FF9800"
        ]);

        Plants::create([
            "id" => 2,
            "name" => "Kedelai",
            "description" => "Kedelai, atau kacang kedelai, adalah salah satu tanaman jenis polong-polongan yang menjadi bahan dasar banyak makanan dari Asia Timur seperti susu, kecap, tahu, dan tempe.",
            "color" => "#5BF43C"
        ]);

        Plants::create([
            "id" => 3,
            "name" => "Jagung",
            "description" => "Jagung adalah salah satu tanaman pangan penghasil karbohidrat yang terpenting di dunia, selain gandum dan padi.",
            "color" => "#F9FF02"
        ]);
    }
}
