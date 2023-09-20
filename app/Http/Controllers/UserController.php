<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $data = User::orderBy('created_at', 'desc')->paginate(6);

        return view('pages.users.user', compact('data'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ], [
            'required' => 'Field wajib diisi!',
            'unique' => 'Email telah digunakan!',
            'min' => 'Password harus memiliki minimal 6 karakter!',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->errors()->first());
            return redirect()->back()->withInput();
        }

        User::create([
            'id' => $request->id,
            'name' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Alert::success('Berhasil', 'Berhasil menambahkan pengguna');
        return redirect()->route('user');
    }

    public function update(Request $request)
{
    $rules = [
        'id' => 'required|max:40',
        'nama' => 'required|max:50',
        'email' => 'required|email|unique:users,email,' . $request->id,
    ];

    if ($request->filled('password')) {
        $rules['password'] = 'max:50|min:6';
    }

    $validator = Validator::make($request->all(), $rules, [
        'required' => 'Field wajib diisi!',
        'unique' => 'Email telah digunakan!',
        'min' => 'Password harus memiliki minimal 6 karakter!',
    ]);

    if ($validator->fails()) {
        Alert::error('Gagal', $validator->errors()->first());
        return redirect()->back()->withInput();
    }

    $user = User::find($request->id);
    if (!$user) {
        Alert::error('Gagal', 'Pengguna tidak ditemukan');
        return redirect()->back();
    }

    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->name = $request->nama;
    $user->email = $request->email;
    $user->save();

    Alert::success('Berhasil', 'Berhasil mengubah pengguna');
    return redirect()->route('user');
}

    public function deleteSelection(Request $request)
    {
        for ($i = 0; $i < count($request->ids); $i++) {
            User::where('id', '=', $request->ids[$i])->delete();
        }

        Alert::success('Berhasil', 'Berhasil menghapus pengguna');
        return redirect()->route('user');
    }

    public function deleteData($id, Request $request)
    {
        if ($request->has('token')) {
            if ($request->token === $request->session()->token()) {
                $request->session()->regenerateToken();

                User::find($id)->delete();

                Alert::success('Berhasil', 'Berhasil menghapus pengguna');
                return redirect()->route('user');
            } else {
                return redirect()->route('user');
            }
        } else {
            return redirect()->route('user');
        }
    }

    public function search($search)
    {
        $data = User::where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return view('pages.users.user', compact('data', 'search'));
    }
}