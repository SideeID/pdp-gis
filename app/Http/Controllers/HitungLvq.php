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
}