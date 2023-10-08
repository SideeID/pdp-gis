<?php

namespace Database\Seeders;

use App\Models\Afdeling;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AfdelingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            array(
                "id" => "3",
                "farm_id" => "9",
                "name" => "Afdeling Pakem",
                "area" => "100",
                "latitude" => "-8.233132",
                "longtitude" => "113.799552",
                "geojson_data" => "{\"type\":\"FeatureCollection\",\"features\":[{\"type\":\"Feature\",\"properties\":{},\"geometry\":{\"type\":\"Polygon\",\"coordinates\":[[[113.796741,-8.233132],[113.796741,-8.230309],[113.799552,-8.230309],[113.799552,-8.233132],[113.796741,-8.233132]]]}}]}",
                "color" => "#EF51CF",
                "created_at" => "2022-07-20 10:51:48",
                "updated_at" => "2023-09-07 13:19:16"

            ),
            array(
                "id" => "4",
                "farm_id" => "9",
                "name" => "Afdeling Lanas",
                "area" => "100",
                "latitude" => "-8.257897",
                "longtitude" => "113.811335",
                "geojson_data" => "{\"type\":\"FeatureCollection\",\"features\":[{\"type\":\"Feature\",\"properties\":{},\"geometry\":{\"type\":\"Polygon\",\"coordinates\":[[[113.811335,-8.257897],[113.811716,-8.25787],[113.812048,-8.257823],[113.812413,-8.257802],[113.812858,-8.257876],[113.813159,-8.257918],[113.81332,-8.257642],[113.813395,-8.25734],[113.813405,-8.256852],[113.813121,-8.257101],[113.812885,-8.257419],[113.812574,-8.257504],[113.812134,-8.257642],[113.811335,-8.257897]]]}}]}",
                "color" => "#53F03C",
                "created_at" => "2022-07-20 14:45:10",
                "updated_at" => "2023-09-07 13:18:31"

            ),
            array(
                "id" => "6",
                "farm_id" => "9",
                "name" => "Afdeling Wadung",
                "area" => "229",
                "latitude" => "-8.256023",
                "longtitude" => "113.813593",
                "geojson_data" => "{\"type\":\"FeatureCollection\",\"features\":[{\"type\":\"Feature\",\"properties\":{},\"geometry\":{\"type\":\"Polygon\",\"coordinates\":[[[113.813593,-8.256023],[113.813357,-8.255392],[113.814317,-8.254882],[113.815159,-8.255105],[113.815503,-8.2558],[113.813668,-8.25632],[113.813438,-8.256124],[113.813593,-8.256023]]]}}]}",
                "color" => "#4CDE5C",
                "created_at" => "2022-07-24 23:06:13",
                "updated_at" => "2023-09-07 13:17:40"
            ),
            array(
                "id" => "7",
                "farm_id" => "8",
                "name" => "Afdeling Gentong",
                "area" => "257",
                "latitude" => "-8.092345",
                "longtitude" => "113.623964",
                "geojson_data" => "{\"type\":\"FeatureCollection\",\"features\":[{\"type\":\"Feature\",\"properties\":{},\"geometry\":{\"type\":\"Polygon\",\"coordinates\":[[[113.623964,-8.093047],[113.624092,-8.092346],[113.623921,-8.091539],[113.623406,-8.090817],[113.623019,-8.09052],[113.622955,-8.089819],[113.623234,-8.08914],[113.622977,-8.088397],[113.623449,-8.087675],[113.624436,-8.087568],[113.626152,-8.087016],[113.627311,-8.08708],[113.628491,-8.088673],[113.628427,-8.091628],[113.626968,-8.094431],[113.624521,-8.095068],[113.623685,-8.094983],[113.623191,-8.094601],[113.623234,-8.094049],[113.62332,-8.093433],[113.623964,-8.093047]]]}}]}",
                "color" => "#76D1EF",
                "created_at" => "2022-07-24 23:36:17",
                "updated_at" => "2023-09-07 13:16:23"
            ),
            array(
                "id" => "8",
                "farm_id" => "8",
                "name" => "Afdeling Kaliputih",
                "area" => "148",
                "latitude" => "-8.08016",
                "longtitude" => "113.618578",
                "geojson_data" => "{\"type\":\"FeatureCollection\",\"features\":[{\"type\":\"Feature\",\"properties\":{},\"geometry\":{\"type\":\"Polygon\",\"coordinates\":[[[113.618578,-8.08016],[113.618578,-8.071327],[113.623921,-8.071327],[113.623921,-8.08016],[113.618578,-8.08016]]]}}]}",
                "color" => "#FF5858",
                "created_at" => "2022-07-25 00:01:40",
                "updated_at" => "2023-09-07 13:15:15"
            ),
            array(
                "id" => "9",
                "farm_id" => "8",
                "name" => "Afdeling Gunung Pasang",
                "area" => "852",
                "latitude" => "-8.099723",
                "longtitude" => "113.625219",
                "geojson_data" => "{\"type\":\"FeatureCollection\",\"features\":[{\"type\":\"Feature\",\"properties\":{},\"geometry\":{\"type\":\"Polygon\",\"coordinates\":[[[113.625219,-8.099723],[113.625219,-8.090083],[113.637106,-8.090083],[113.637106,-8.099723],[113.625219,-8.099723]]]}}]}",
                "color" => "#62F8AD",
                "created_at" => "2022-07-25 00:02:23",
                "updated_at" => "2023-09-07 13:13:17"
            )
        ];

        //

        foreach ($data as $value) {
            Afdeling::create($value);
        }
    }
}
