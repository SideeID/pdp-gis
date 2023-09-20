<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use App\Models\Plants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PlantController extends Controller
{
    public function index()
    {
        $data = Plants::orderBy('created_at', 'desc')->paginate(10);

        return view('pages.plants.plant', compact('data'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanaman' => 'required|max:40',
            'color' => 'required|max:10',
        ], [
            'required' => 'Field wajib diisi!'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        Plants::create([
            "name" => $request->tanaman,
            "description" => $request->deskripsi,
            "color" => $request->color
        ]);

        Alert::success('Berhasil', 'Berhasil menambahkan data');
        return redirect()->route('plant');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanaman' => 'required|max:40',
            'color' => 'required|max:10',
        ], [
            'required' => 'Field wajib diisi!'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        Plants::where('id', $request->id)->update([
            "name" => $request->tanaman,
            "description" => $request->deskripsi,
            "color" => $request->color
        ]);

        Alert::success('Berhasil', 'Berhasil mengubah data');
        return redirect()->route('plant');
    }

    public function deleteSelection(Request $request)
    {
        for ($i = 0; $i < count($request->ids); $i++) {
            Plants::where('id', '=', $request->ids[$i])->delete();
        }

        Alert::success('Berhasil', 'Berhasil menghapus data');
        return redirect()->route('plant');
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

                Plants::find($kode)->delete();

                alert()->success('Berhasil', 'Berhasil Menghapus Data');
                return redirect()->route('plant');
            } else {
                return redirect()->route('plant');
            }
        } else {
            return redirect()->route('plant');
        }
    }

    public function search($search)
    {
        $data = Plants::where(function ($query) use ($search) {
            $query->Where('name', 'LIKE', '%' . $search . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.plants.plant', compact('data', 'search'));
    }
}
