<?php

namespace App\Http\Controllers;

use App\Models\Afdeling;
use App\Models\Farm;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AfdelingController extends Controller
{
    public function index()
    {
        $data = Afdeling::with('farm')->orderBy('created_at', 'desc')->paginate(10);

        $kebun = Farm::all(['id', 'name', 'geojson_data', 'color']);


        return view('pages.afdelings.afdeling', compact('data', 'kebun'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kebun' => 'required',
            'afdeling' => 'required|max:40',
            'latitude' => 'required|max:40',
            'longtitude' => 'required|max:40',
            'ketinggian' => 'required',
            'geojson' => 'required',
            'luas' => 'required',
            'color' => 'required|max:10',
        ], [
            'required' => 'Field wajib diisi!'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        Afdeling::create([
            "farm_id" => $request->kebun,
            "name" => $request->afdeling,
            "area" => $request->luas,
            "latitude" => $request->latitude,
            "longtitude" => $request->longtitude,
            "elevation" => $request->ketinggian,
            "geojson_data" => $request->geojson,
            "color" => $request->color
        ]);

        Alert::success('Berhasil', 'Berhasil menambahkan data');
        return redirect()->route('afdeling');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kebun' => 'required',
            'afdeling' => 'required|max:40',
            'latitude' => 'required|max:40',
            'longtitude' => 'required|max:40',
            'ketinggian' => 'required',
            'geojson' => 'required',
            'luas' => 'required',
            'color' => 'required|max:10',
        ], [
            'required' => 'Field wajib diisi!'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        Afdeling::where('id', $request->id)->update([
            "farm_id" => $request->kebun,
            "name" => $request->afdeling,
            "area" => $request->luas,
            "latitude" => $request->latitude,
            "longtitude" => $request->longtitude,
            "elevation" => $request->ketinggian,
            "geojson_data" => $request->geojson,
            "color" => $request->color
        ]);

        Alert::success('Berhasil', 'Berhasil mengubah data');
        return redirect()->route('afdeling');
    }

    public function deleteSelection(Request $request)
    {
        for ($i = 0; $i < count($request->ids); $i++) {
            Afdeling::where('id', '=', $request->ids[$i])->delete();
        }

        Alert::success('Berhasil', 'Berhasil menghapus data');
        return redirect()->route('afdeling');
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

                Afdeling::find($kode)->delete();

                alert()->success('Berhasil', 'Berhasil Menghapus Data');
                return redirect()->route('afdeling');
            } else {
                return redirect()->route('afdeling');
            }
        } else {
            return redirect()->route('afdeling');
        }
    }

    public function search($search)
    {
        $data = Afdeling::where(function ($query) use ($search) {
            $query->Where('name', 'LIKE', '%' . $search . '%');
        })
            ->orWhereHas('farm', function ($query) use ($search) {
                $query->Where('name', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $kebun = Farm::all(['id', 'name', 'geojson_data', 'color']);

        return view('pages.afdelings.afdeling', compact('data', 'kebun', 'search'));
    }
}
