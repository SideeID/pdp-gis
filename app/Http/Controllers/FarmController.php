<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class FarmController extends Controller
{
    public function index()
    {
        $data = Farm::orderBy('created_at', 'desc')->paginate(10);
        $farm = Farm::all();

        return view('pages.farms.farm', compact('data', 'farm'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:40',
            'alamat' => 'required',
            'geojson' => 'required',
            'kecamatan' => 'required|max:50',
            'kota' => 'required|max:50',
            'luas' => 'required',
            'color' => 'required|max:10',
        ], [
            'required' => 'Field wajib diisi!'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        Farm::create([
            "name" => $request->nama,
            "address" => $request->alamat,
            "subdistrict" => $request->kecamatan,
            "city" => $request->kota,
            "area" => $request->luas,
            "geojson_data" => $request->geojson,
            "color" => $request->color
        ]);

        Alert::success('Berhasil', 'Berhasil menambahkan data');
        return redirect()->route('farm');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:40',
            'alamat' => 'required',
            'geojson' => 'required',
            'kecamatan' => 'required|max:50',
            'kota' => 'required|max:50',
            'luas' => 'required',
            'color' => 'required|max:10',
        ], [
            'required' => 'Field wajib diisi!'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        Farm::where('id', $request->id)->update([
            "name" => $request->nama,
            "address" => $request->alamat,
            "subdistrict" => $request->kecamatan,
            "city" => $request->kota,
            "area" => $request->luas,
            "geojson_data" => $request->geojson,
            "color" => $request->color
        ]);

        Alert::success('Berhasil', 'Berhasil mengubah data');
        return redirect()->route('farm');
    }

    public function deleteSelection(Request $request)
    {
        for ($i = 0; $i < count($request->ids); $i++) {
            Farm::where('id', '=', $request->ids[$i])->delete();
        }

        Alert::success('Berhasil', 'Berhasil menghapus data');
        return redirect()->route('farm');
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

                Farm::find($kode)->delete();

                alert()->success('Berhasil', 'Berhasil Menghapus Data');
                return redirect()->route('farm');
            } else {
                return redirect()->route('farm');
            }
        } else {
            return redirect()->route('farm');
        }
    }

    public function search($search)
    {
        $data = Farm::where(function ($query) use ($search) {
            $query->Where('name', 'LIKE', '%' . $search . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.farms.farm', compact('data', 'search'));
    }
}
