<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class FarmController extends Controller
{
    public function index(){
        $data = Farm::orderBy('created_at', 'desc')->paginate(1);

        return view('pages.farms.farm', compact('data'));
    }

    public function create(Request $request){
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

    public function update(Request $request){
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
}
