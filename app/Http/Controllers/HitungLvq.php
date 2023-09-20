<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Support\Facades\DB;

class HitungLvq {

    public function __construct()
    {
        
    }

    public function process_hitung_kriteria($nama, $batas_a, $batas_b){

        $data = Criteria::with('detail_criteria')->where('name', $nama)->whereHas('detail_criteria', function($query){
            $query->orderBy('class', 'ASC');
        })->first();


		$range_array = array();
        foreach ($data->detail_criteria as $key => $value) {
            # code...
            $range_array[$value['class']] = array($value['limit_a'], $value['limit_b']);
        }
		
		$param1 = array($batas_a, $batas_b);
		$result = $this->get_kelas($param1, $range_array);
		
		return $result;
	}

    private function get_kelas($param_range, $range){
		$kelas_bawah=0;
		$kelas_atas=0;
		$kelas_akhir = 0;
		
		$param_bawah = 0;
		$param_atas = 0;
		$range_bawah = 0;
		$range_atas = 0;
		
		$param_bawah_gap = 0;
		$param_atas_gap = 0;
		foreach($range as $range_class => $range_range){
			
			$param_bawah = $param_range[0];
			$param_atas = $param_range[1];
			$range_bawah = $range_range[0];
			$range_atas = $range_range[1];
			
			$param_bawah_gap = 0;
			$param_atas_gap = 0;
			
			if ($kelas_bawah==0){
				if ($param_bawah >= $range_bawah && $param_bawah <= $range_atas){
					$kelas_bawah = $range_class;
					$param_bawah_gap = $range_atas - $param_bawah;
				}
			}
			if ($kelas_atas==0){
				if ($param_atas >= $range_bawah && $param_atas <= $range_atas){
					$kelas_atas = $range_class;
					$param_atas_gap = $param_atas - $range_bawah;
				}
			}
		}
		
		if($kelas_atas - $kelas_akhir > 1){
			$kelas_akhir = ceil(($kelas_bawah + $kelas_atas) / 2);
		}else{
			if ($param_bawah_gap - $param_atas_gap >=0){
				$kelas_akhir = $kelas_bawah;
			}else{
				$kelas_akhir = $kelas_atas;
			}
		}
		
		return $kelas_akhir;
	}

    public function LVQ($max_epoch, $alpha, $v_bot, $v_lat, $v_parameter, $parameter){

		$w_temp = array();
		$result_param = "";
		for($epoch=1; $epoch<=$max_epoch; $epoch++){
			foreach($v_lat as $kelas_lat => $data_lat){
				
				$w_temp = array();
				foreach($v_bot as $kelas_bot => $data_bot){
					
					$sum = 0;
					for ($data=0; $data < count($data_bot); $data++){
						$sum = $sum + pow($v_lat[$kelas_lat][$data] - $data_bot[$data], 2);
						//echo $v_lat[$kelas_lat][$data]."-".$data_bot[$data].",";
					}
					
					$w_temp[$kelas_bot] = $sum;
				}
				
				$nilai_terkecil = min($w_temp);
				$kelas_terkecil = array_search($nilai_terkecil, $w_temp);
				
				$w_temp = array();
				for ($data=0; $data < count($v_bot[$kelas_terkecil]); $data++){
					$lat_lama = $v_lat[$kelas_terkecil][$data];
					$bot_lama = $v_bot[$kelas_terkecil][$data];
					$bot_baru = 0;
					
					if ($kelas_terkecil == $kelas_lat){
						$bot_baru = $bot_lama + $alpha * ($lat_lama - $bot_lama);
					}else{
						$bot_baru = $bot_lama - $alpha * ($lat_lama - $bot_lama);
					}
					
					$w_temp[$data] = round($bot_baru, 4);
					//echo $w_temp[$data].",";
				}
				$v_bot[$kelas_terkecil] = $w_temp;
			}
			
			
			//Penentuan jenis tanaman
			
			$w_temp = array();
			foreach($v_bot as $kelas_bot => $data_bot){
				$sum = 0;
				for ($data=0; $data < count($data_bot); $data++){
					$sum = $sum + pow($v_parameter[$data] - $data_bot[$data], 2);
				}
				$w_temp[$kelas_bot] = $sum;
			}
			
			$nilai_terkecil = min($w_temp);
			$kelas_terkecil = array_search($nilai_terkecil, $w_temp);
			
			$result_param = $parameter[$kelas_terkecil];
			
			/*
			echo "Kelas terkecil = ".$kelas_terkecil;
			echo "<br>";
			echo "Tanaman yang cocok = ".$parameter[$kelas_terkecil];
			echo "<br>";
			echo "<br>";
			* */
			
			$alpha = $alpha * .1;
			
			
		}
		return $result_param;
	}
}