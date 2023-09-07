<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HitungLvq;
use App\Models\Farm;
use App\Models\Parameter;
use App\Models\Perhitungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PerhitunganController extends Controller
{

    private $hitungLvq;

    public function __construct()
    {
        $this->hitungLvq = new HitungLvq();
    }

    public function index()
    {
        $data = Perhitungan::with(['parameter', 'afdeling'])->orderBy('created_at', 'desc')->paginate(10);
        $kebun = Farm::with(['afdeling' => function ($query) {
            $query->whereNotIn('id', function ($queryy) {
                $queryy->select('afdeling_id')->from('perhitungans');
            });
        }])->get();


        $parameter = Parameter::all();

        return view('pages.perhitungan.perhitungan', compact('data', 'kebun', 'parameter'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kebun' => 'required',
            'afdeling' => 'required|unique:perhitungans,afdeling_id',
            'ph' => 'required',
            'suhu_bawah' => 'required',
            'suhu_atas' => 'required',
            'hujan' => 'required',
            'ketinggian' => 'required',
        ], [
            'required' => 'Field wajib diisi!'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        $phkelas = $this->hitungLvq->process_hitung_kriteria('pH Tanah', $request->ph, $request->ph);
        $suhukelas = $this->hitungLvq->process_hitung_kriteria('Suhu', $request->suhu_bawah, $request->suhu_atas);
        $hujankelas = $this->hitungLvq->process_hitung_kriteria('Curah Hujan', $request->hujan, $request->hujan);
        $tinggikelas = $this->hitungLvq->process_hitung_kriteria('Tinggi Tanah', $request->ketinggian, $request->ketinggian);

        $paramm = array();
        $v_bot = array();

        $listParam = Parameter::all();

        foreach ($listParam as $key => $value) {
            $daftar_kelas = array($value['ph_kelas'], $value['suhu_kelas'], $value['hujan_kelas'], $value['tinggi_kelas']);
            $v_bot[$key] = $daftar_kelas;
            $paramm[$key] = $value['id'];
        }

        //random data latih
        $v_lat = array();
        for ($i = 0; $i < count($v_bot); $i++) {
            for ($j = 0; $j < count($v_bot[$i]); $j++) {
                $min = 1;
                $max = 1;
                if ($j == 0) {
                    $max = 4;
                }
                if ($j == 1) {
                    $max = 5;
                }
                if ($j == 2) {
                    $max = 4;
                }
                if ($j == 3) {
                    $max = 6;
                }
                $v_lat[$i][$j] = random_int($min, $max);
            }
        }

        $v_param = array($phkelas, $suhukelas, $hujankelas, $tinggikelas);

        $hasil = $this->hitungLvq->LVQ(1, 0.5, $v_bot, $v_lat, $v_param, $paramm);

        Perhitungan::create([
            "parameter_id" => $hasil,
            "afdeling_id" => $request->afdeling,
            "ph" => $request->ph,
            "suhu_a" => $request->suhu_bawah,
            "suhu_b" => $request->suhu_atas,
            "hujan" => $request->hujan,
            "tinggi" => $request->ketinggian,
            "ph_kelas" => $phkelas,
            "suhu_kelas" => $suhukelas,
            "hujan_kelas" => $hujankelas,
            "tinggi_kelas" => $tinggikelas,
        ]);

        Alert::success('Berhasil', 'Berhasil menambahkan data');
        return redirect()->route('perhitungan');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kebun' => 'required',
            'afdeling' => 'required',
            'ph' => 'required',
            'suhu_bawah' => 'required',
            'suhu_atas' => 'required',
            'hujan' => 'required',
            'ketinggian' => 'required',
        ], [
            'required' => 'Field wajib diisi!'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        $phkelas = $this->hitungLvq->process_hitung_kriteria('pH Tanah', $request->ph, $request->ph);
        $suhukelas = $this->hitungLvq->process_hitung_kriteria('Suhu', $request->suhu_bawah, $request->suhu_atas);
        $hujankelas = $this->hitungLvq->process_hitung_kriteria('Curah Hujan', $request->hujan, $request->hujan);
        $tinggikelas = $this->hitungLvq->process_hitung_kriteria('Tinggi Tanah', $request->ketinggian, $request->ketinggian);

        $paramm = array();
        $v_bot = array();

        $listParam = Parameter::all();

        foreach ($listParam as $key => $value) {
            $daftar_kelas = array($value['ph_kelas'], $value['suhu_kelas'], $value['hujan_kelas'], $value['tinggi_kelas']);
            $v_bot[$key] = $daftar_kelas;
            $paramm[$key] = $value['id'];
        }

        //random data latih
        $v_lat = array();
        for ($i = 0; $i < count($v_bot); $i++) {
            for ($j = 0; $j < count($v_bot[$i]); $j++) {
                $min = 1;
                $max = 1;
                if ($j == 0) {
                    $max = 4;
                }
                if ($j == 1) {
                    $max = 5;
                }
                if ($j == 2) {
                    $max = 4;
                }
                if ($j == 3) {
                    $max = 6;
                }
                $v_lat[$i][$j] = random_int($min, $max);
            }
        }

        $v_param = array($phkelas, $suhukelas, $hujankelas, $tinggikelas);

        $hasil = $this->hitungLvq->LVQ(1, 0.5, $v_bot, $v_lat, $v_param, $paramm);

        Perhitungan::where('id', $request->id)->update([
            "parameter_id" => $hasil,
            "afdeling_id" => $request->afdeling,
            "ph" => $request->ph,
            "suhu_a" => $request->suhu_bawah,
            "suhu_b" => $request->suhu_atas,
            "hujan" => $request->hujan,
            "tinggi" => $request->ketinggian,
            "ph_kelas" => $phkelas,
            "suhu_kelas" => $suhukelas,
            "hujan_kelas" => $hujankelas,
            "tinggi_kelas" => $tinggikelas,
        ]);

        Alert::success('Berhasil', 'Berhasil mengubah data');
        return redirect()->route('perhitungan');
    }

    public function deleteSelection(Request $request)
    {
        for ($i = 0; $i < count($request->ids); $i++) {
            Perhitungan::where('id', '=', $request->ids[$i])->delete();
        }

        Alert::success('Berhasil', 'Berhasil menghapus data');
        return redirect()->route('perhitungan');
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

                Perhitungan::find($kode)->delete();

                alert()->success('Berhasil', 'Berhasil Menghapus Data');
                return redirect()->route('perhitungan');
            } else {
                return redirect()->route('perhitungan');
            }
        } else {
            return redirect()->route('perhitungan');
        }
    }

    public function search($search)
    {
        $data = Perhitungan::with(['parameter', 'afdeling'])->orWhereHas('afdeling', function ($query) use ($search) {
            $query->Where('name', 'LIKE', '%' . $search . '%');
        })->orWhereHas('afdeling.farm', function ($query) use ($search) {
            $query->Where('name', 'LIKE', '%' . $search . '%');
        })->orderBy('created_at', 'desc')->paginate(10);


        $kebun = Farm::with(['afdeling' => function ($query) {
            $query->whereNotIn('id', function ($queryy) {
                $queryy->select('afdeling_id')->from('perhitungans');
            });
        }])->get();


        $parameter = Parameter::all();

        return view('pages.perhitungan.perhitungan', compact('data', 'kebun', 'parameter', 'search'));
    }
}
