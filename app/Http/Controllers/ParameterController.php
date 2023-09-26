<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HitungLvq;
use App\Models\DetailCriteria;
use App\Models\Parameter;
use App\Models\Plants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ParameterController extends Controller
{

    private $hitungLvq;

    public function __construct()
    {
        $this->hitungLvq = new HitungLvq();
    }

    public function index()
    {
        $data = Parameter::with('plant')->orderBy('created_at', 'desc')->paginate(10);
        $tanaman = Plants::whereNotIn('id', function ($query) {
            $query->select('plant_id')->from('parameters');
        })->get();

        $criteria = DetailCriteria::all();

        $dataDesc = array();
        foreach ($data as $key => $value) {
            $dataDesc[$key] = $value;
            foreach ($criteria as $keyy => $valuee) {

                if($value['ph_kelas'] == $valuee['class'] && $valuee['criteria_id'] == 4){
                    $dataDesc[$key]['ph_res'] = $valuee['description'];
                }

                if($value['suhu_kelas'] == $valuee['class'] && $valuee['criteria_id'] == 3){
                    $dataDesc[$key]['suhu_res'] = $valuee['description'];
                }

                if($value['hujan_kelas'] == $valuee['class'] && $valuee['criteria_id'] == 2){
                    $dataDesc[$key]['hujan_res'] = $valuee['description'];
                }

                if($value['tinggi_kelas'] == $valuee['class'] && $valuee['criteria_id'] == 1){
                    $dataDesc[$key]['tinggi_res'] = $valuee['description'];
                }
            }
        }

        return view('pages.parameter.parameter', compact('data', 'tanaman', 'dataDesc'));
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'ph_bawah' => 'required',
            'ph_atas' => 'required',
            'suhu_bawah' => 'required',
            'suhu_atas' => 'required',
            'hujan_bawah' => 'required',
            'hujan_atas' => 'required',
            'ketinggian_bawah' => 'required',
            'ketinggian_atas' => 'required',
            'tanaman' => 'required',
        ], [
            'required' => 'Field wajib diisi!'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        Parameter::create([
            "plant_id" => $request->tanaman,
            "ph_a" => $request->ph_bawah,
            "ph_b" => $request->ph_atas,
            "suhu_a" => $request->suhu_bawah,
            "suhu_b" => $request->suhu_atas,
            "hujan_a" => $request->hujan_bawah,
            "hujan_b" => $request->hujan_atas,
            "tinggi_a" => $request->ketinggian_bawah,
            "tinggi_b" => $request->ketinggian_atas,
            "ph_kelas" => $this->hitungLvq->process_hitung_kriteria('pH Tanah', $request->ph_bawah, $request->ph_atas),
            "suhu_kelas" => $this->hitungLvq->process_hitung_kriteria('Suhu', $request->suhu_bawah, $request->suhu_atas),
            "hujan_kelas" => $this->hitungLvq->process_hitung_kriteria('Curah Hujan', $request->hujan_bawah, $request->hujan_atas),
            "tinggi_kelas" => $this->hitungLvq->process_hitung_kriteria('Tinggi Tanah', $request->ketinggian_bawah, $request->ketinggian_atas),
        ]);


        Alert::success('Berhasil', 'Berhasil menambahkan data');
        return redirect()->route('parameter');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ph_bawah' => 'required',
            'ph_atas' => 'required',
            'suhu_bawah' => 'required',
            'suhu_atas' => 'required',
            'hujan_bawah' => 'required',
            'hujan_atas' => 'required',
            'ketinggian_bawah' => 'required',
            'ketinggian_atas' => 'required',
            'tanaman' => 'required',
        ], [
            'required' => 'Field wajib diisi!'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        Parameter::where('id', $request->id)->update([
            "plant_id" => $request->tanaman,
            "ph_a" => $request->ph_bawah,
            "ph_b" => $request->ph_atas,
            "suhu_a" => $request->suhu_bawah,
            "suhu_b" => $request->suhu_atas,
            "hujan_a" => $request->hujan_bawah,
            "hujan_b" => $request->hujan_atas,
            "tinggi_a" => $request->ketinggian_bawah,
            "tinggi_b" => $request->ketinggian_atas,
            "ph_kelas" => $this->hitungLvq->process_hitung_kriteria('pH Tanah', $request->ph_bawah, $request->ph_atas),
            "suhu_kelas" => $this->hitungLvq->process_hitung_kriteria('Suhu', $request->suhu_bawah, $request->suhu_atas),
            "hujan_kelas" => $this->hitungLvq->process_hitung_kriteria('Curah Hujan', $request->hujan_bawah, $request->hujan_atas),
            "tinggi_kelas" => $this->hitungLvq->process_hitung_kriteria('Tinggi Tanah', $request->ketinggian_bawah, $request->ketinggian_atas),
        ]);

        Alert::success('Berhasil', 'Berhasil mengubah data');
        return redirect()->route('parameter');
    }

    public function deleteSelection(Request $request)
    {
        for ($i = 0; $i < count($request->ids); $i++) {
            Parameter::where('id', '=', $request->ids[$i])->delete();
        }

        Alert::success('Berhasil', 'Berhasil menghapus data');
        return redirect()->route('parameter');
    }

    public function deleteData($kode, Request $request)
    {
        // check apakah terdapat token
        if ($request->has('token')) {
            // check apakah token sesuai dengan token yang ada pada session ?
            if ($request->token === $request->session()->token()) {
                // jika sesuai maka akan proses dan generate ulang token
                // jadi, tidak akan terjadi penggunaan token yang sama
                // hal ini dilakukan untuk pencegahan untuk hal hal yang tidak diinginkan
                // seperti memaksa menggunakan token yang telah dipakai sebelumnya untuk menghapus data yang lain
                $request->session()->regenerateToken();

                Parameter::find($kode)->delete();

                alert()->success('Berhasil', 'Berhasil Menghapus Data');
                return redirect()->route('parameter');
            } else {
                return redirect()->route('parameter');
            }
        } else {
            return redirect()->route('parameter');
        }
    }

    public function search($search)
    {
        $data = Parameter::with(['plant'])->whereHas('plant', function($query) use ($search){
            $query->where('name', 'LIKE', '%' . $search . '%');
        })->orderBy('created_at', 'desc')->paginate(10);

        $tanaman = Plants::whereNotIn('id', function ($query) {
            $query->select('plant_id')->from('parameters');
        })->get();

        $criteria = DetailCriteria::all();

        $dataDesc = array();
        foreach ($data as $key => $value) {
            $dataDesc[$key] = $value;
            foreach ($criteria as $keyy => $valuee) {

                if($value['ph_kelas'] == $valuee['class'] && $valuee['criteria_id'] == 4){
                    $dataDesc[$key]['ph_res'] = $valuee['description'];
                }

                if($value['suhu_kelas'] == $valuee['class'] && $valuee['criteria_id'] == 3){
                    $dataDesc[$key]['suhu_res'] = $valuee['description'];
                }

                if($value['hujan_kelas'] == $valuee['class'] && $valuee['criteria_id'] == 2){
                    $dataDesc[$key]['hujan_res'] = $valuee['description'];
                }

                if($value['tinggi_kelas'] == $valuee['class'] && $valuee['criteria_id'] == 1){
                    $dataDesc[$key]['tinggi_res'] = $valuee['description'];
                }
            }
        }

        return view('pages.parameter.parameter', compact('data', 'tanaman', 'dataDesc', 'search'));
    }
}
