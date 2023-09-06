<?php

namespace App\Http\Controllers;

use App\Models\Afdeling;
use App\Models\Block;
use App\Models\Farm;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class BlockController extends Controller
{
    public function index()
    {
        $data = Block::with('afdeling.farm')->orderBy('created_at', 'desc')->paginate(10);

        $kebun = Farm::with('afdeling')->get();
        $afdeling = Afdeling::all();


        return view('pages.blocks.block', compact('data', 'kebun', 'afdeling'));
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'kebun' => 'required',
            'afdeling' => 'required',
            'blok' => 'required|max:40',
            'deskripsi' => 'required',
            'latitude' => 'required|max:20',
            'longtitude' => 'required|max:20',
            'ketinggian' => 'required',
            'luas' => 'required',
        ], [
            'required' => 'Field wajib diisi!'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        Block::create([
            "afdeling_id" => $request->afdeling,
            "name" => $request->blok,
            "description" => $request->deskripsi,
            "latitude" => $request->latitude,
            "longtitude" => $request->longtitude,
            "area" => $request->luas,
            "elevation" => $request->ketinggian,
        ]);

        Alert::success('Berhasil', 'Berhasil menambahkan data');
        return redirect()->route('block');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kebun' => 'required',
            'afdeling' => 'required',
            'blok' => 'required|max:40',
            'deskripsi' => 'required',
            'latitude' => 'required|max:20',
            'longtitude' => 'required|max:20',
            'ketinggian' => 'required',
            'luas' => 'required',
        ], [
            'required' => 'Field wajib diisi!'
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        Block::where('id', $request->id)->update([
            "afdeling_id" => $request->afdeling,
            "name" => $request->blok,
            "description" => $request->deskripsi,
            "latitude" => $request->latitude,
            "longtitude" => $request->longtitude,
            "area" => $request->luas,
            "elevation" => $request->ketinggian,
        ]);

        Alert::success('Berhasil', 'Berhasil mengubah data');
        return redirect()->route('block');
    }

    public function deleteSelection(Request $request)
    {
        for ($i = 0; $i < count($request->ids); $i++) {
            Block::where('id', '=', $request->ids[$i])->delete();
        }

        Alert::success('Berhasil', 'Berhasil menghapus data');
        return redirect()->route('block');
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

                Block::find($kode)->delete();

                alert()->success('Berhasil', 'Berhasil Menghapus Data');
                return redirect()->route('block');
            } else {
                return redirect()->route('block');
            }
        } else {
            return redirect()->route('block');
        }
    }

    public function search($search)
    {
        $data = Block::where(function ($query) use ($search) {
            $query->Where('name', 'LIKE', '%' . $search . '%');
        })
            ->orWhereHas('afdeling', function ($query) use ($search) {
                $query->Where('name', 'LIKE', '%' . $search . '%');
            })
            ->orWhereHas('afdeling.farm', function ($query) use ($search) {
                $query->Where('name', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $kebun = Farm::with('afdeling')->get();
        $afdeling = Afdeling::all();

        return view('pages.blocks.block', compact('data', 'kebun', 'afdeling', 'search'));
    }
}
